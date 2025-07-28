<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Prodcat;
use FiberError;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Support\Enums\FontWeight;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'Inventory';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Product Details')
                    ->tabs([
                        Tabs\Tab::make('Basic Information')
                            ->schema([
                                Section::make('Product Details')
                                    ->schema([
                                        TextInput::make('name')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn(string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null),

                                        TextInput::make('slug')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(Product::class, 'slug', ignoreRecord: true)
                                            ->rules(['alpha_dash']),

                                        Select::make('type')
                                            ->options([
                                                'simple' => 'Simple Product',
                                                'variable' => 'Variable Product',
                                                'grouped' => 'Grouped Product',
                                                'external' => 'External Product',
                                                'digital' => 'Digital Product',
                                            ])
                                            ->default('simple')
                                            ->required(),

                                        TextInput::make('sku')
                                            ->label('SKU')
                                            ->maxLength(255)
                                            ->unique(Product::class, 'sku', ignoreRecord: true),
                                        Grid::make(3)
                                            ->schema([
                                                Select::make('parent_id')
                                                    ->label('Parent Product')
                                                    ->relationship('parentproduct', 'name')
                                                    ->searchable()
                                                    ->nullable()
                                                    ->getSearchResultsUsing(fn (string $search): array => Product::where('name', 'like', "%{$search}%")->limit(50)->pluck('name', 'id')->toArray())
                                                    ->getOptionLabelUsing(fn ($value): ?string => Product::find($value)?->name),

                                                Select::make('prodcats')
                                                    ->label('Categories')
                                                    ->relationship('prodcats', 'name')
                                                    ->multiple()
                                                    ->searchable()
                                                    ->getSearchResultsUsing(fn (string $search): array => \App\Models\Prodcat::where('name', 'like', "%{$search}%")->limit(50)->pluck('name', 'id')->toArray())
                                                    ->getOptionLabelsUsing(fn (array $values): array => \App\Models\Prodcat::whereIn('id', $values)->pluck('name', 'id')->toArray()),

                                                Select::make('shop_id')
                                                    ->label('Shop')
                                                    ->relationship('shop', 'name')
                                                    ->required()
                                                    ->searchable()
                                                    ->getSearchResultsUsing(fn (string $search): array => Shop::where('name', 'like', "%{$search}%")->limit(50)->pluck('name', 'id')->toArray())
                                                    ->getOptionLabelUsing(fn ($value): ?string => Shop::find($value)?->name),
                                            ]),
                                        Grid::make(1)
                                            ->schema([
                                                Toggle::make('status')
                                                    ->label('Active')
                                                    ->default(true),

                                                Toggle::make('featured')
                                                    ->label('Featured Product')
                                                    ->default(false),
                                            ]),

                                    ])
                                    ->columns(2),

                                Section::make('Product Description')
                                    ->schema([
                                        RichEditor::make('short_description')
                                            ->label('Short Description')
                                            ->maxLength(500),

                                        RichEditor::make('description')
                                            ->label('Full Description'),
                                    ]),
                            ]),

                        Tabs\Tab::make('Pricing & Inventory')
                            ->schema([
                                Section::make('Pricing')
                                    ->schema([
                                        TextInput::make('price')
                                            ->label('Regular Price')
                                            ->numeric()
                                            ->prefix('$')
                                            ->maxValue(999999.99)
                                            ->required(),

                                        TextInput::make('sale_price')
                                            ->label('Sale Price')
                                            ->numeric()
                                            ->prefix('$')
                                            ->maxValue(999999.99)
                                            ->nullable()
                                            ->rules([
                                                fn (callable $get) => function (string $attribute, $value, callable $fail) use ($get) {
                                                    $price = $get('price');
                                                    if ($value && $price && floatval($value) > floatval($price)) {
                                                        $fail('Sale price must be less than or equal to regular price.');
                                                    }
                                                },
                                            ]),
                                    ])
                                    ->columns(2),

                                Section::make('Inventory')
                                    ->schema([
                                        Toggle::make('manage_stock')
                                            ->label('Manage Stock')
                                            ->live(),

                                        TextInput::make('quantity')
                                            ->label('Stock Quantity')
                                            ->numeric()
                                            ->minValue(0)
                                            ->visible(fn(callable $get) => $get('manage_stock')),

                                        TextInput::make('total_sale')
                                            ->label('Total Sales')
                                            ->numeric()
                                            ->disabled()
                                            ->dehydrated(false),
                                    ])
                                    ->columns(2),

                                Section::make('Shipping')
                                    ->schema([
                                        TextInput::make('weight')
                                            ->label('Weight (kg)')
                                            ->numeric(),

                                        TextInput::make('dimensions')
                                            ->label('Dimensions (L x W x H)')
                                            ->placeholder('e.g., 10 x 5 x 3'),
                                    ])
                                    ->columns(2),
                            ]),

                        Tabs\Tab::make('Media & Variations')
                            ->schema([
                                Section::make('Product Images')
                                    ->schema([
                                        FileUpload::make('image')
                                            ->label('Featured Image')
                                            ->image()
                                            ->directory('products')
                                            ->visibility('public'),

                                        FileUpload::make('images')
                                            ->label('Gallery Images')
                                            ->image()
                                            ->multiple()
                                            ->directory('products')
                                            ->visibility('public'),
                                    ]),

                                Section::make('Product Variations')
                                    ->schema([
                                        KeyValue::make('variations')
                                            ->label('Product Variations')
                                            ->keyLabel('Attribute')
                                            ->valueLabel('Options (comma separated)')
                                            ->helperText('Add product variations like Size: S,M,L,XL or Color: Red,Blue,Green')
                                            ->addActionLabel('Add Variation'),

                                        // RichEditor::make('variations')
                                        //     ->label('Product Variations')
                                        //     // ->helperText('Add product variations like Size: S,M,L,XL or Color: Red,Blue,Green')
                                        //     ->toolbarButtons([
                                        //         'bold',
                                        //         'italic',
                                        //         'underline',
                                        //         'link',
                                        //         'bulletList',
                                        //         'numberedList',
                                        //         'blockquote',
                                        //         'codeBlock',
                                        //     ]),
                                    ]),

                                Section::make('Downloads')
                                    ->schema([
                                        Textarea::make('downloads')
                                            ->label('Downloadable Files')
                                            ->helperText('For digital products, add download links or file paths')
                                            ->rows(3),
                                    ])
                                    ->visible(fn(callable $get) => $get('type') === 'digital'),
                            ]),

                        Tabs\Tab::make('Additional Info')
                            ->schema([
                                Section::make('Product Rating')
                                    ->schema([
                                        TextInput::make('rating_count')
                                            ->label('Rating Count')
                                            ->numeric()
                                            ->disabled()
                                            ->dehydrated(false),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Image')
                    ->circular()
                    ->size(60),
                TextColumn::make('name')
                    ->label('Product Name')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary')
                    ->weight(FontWeight::Medium)
                    ->limit(30),
                TextColumn::make('prodcats.name')
                    ->label('Categories')
                    ->badge()
                    ->separator(',')
                    ->limit(20)
                    ->icon('heroicon-o-tag')
                    ->toggleable()
                    ->formatStateUsing(function ($record) {
                        return $record->prodcats()->limit(3)->pluck('name')->join(', ');
                    }),
                TextColumn::make('price')
                    ->label('Regular Price')
                    ->money('USD')
                    ->color('success')
                    ->sortable(),
                TextColumn::make('sale_price')
                    ->label('Sale Price')
                    ->money('USD')
                    ->color('danger')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('quantity')
                    ->label('Stock')
                    ->sortable()
                    ->badge()
                    ->color(fn($state) => $state > 10 ? 'success' : ($state > 0 ? 'warning' : 'danger'))
                    ->toggleable(),
                BooleanColumn::make('status')
                    ->label('Active')
                    ->icon('heroicon-o-check-circle')
                    ->sortable(),
                BooleanColumn::make('featured')
                    ->label('Featured')
                    ->icon('heroicon-o-star')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'simple' => 'Simple Product',
                        'variable' => 'Variable Product',
                        'grouped' => 'Grouped Product',
                        'external' => 'External Product',
                        'digital' => 'Digital Product',
                    ]),

                Filter::make('featured')
                    ->query(fn(Builder $query): Builder => $query->where('featured', true))
                    ->label('Featured Products'),

                Filter::make('active')
                    ->query(fn(Builder $query): Builder => $query->where('status', true))
                    ->label('Active Products'),

                Filter::make('out_of_stock')
                    ->query(fn(Builder $query): Builder => $query->where('quantity', '<=', 0))
                    ->label('Out of Stock'),

                Filter::make('low_stock')
                    ->query(fn(Builder $query): Builder => $query->whereBetween('quantity', [1, 10]))
                    ->label('Low Stock (1-10)'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->label('View Product')
                        ->icon('heroicon-o-eye'),
                    Tables\Actions\EditAction::make()
                        ->label('Edit Product')
                        ->icon('heroicon-o-pencil-square'),
                    Tables\Actions\DeleteAction::make()
                        ->label('Delete Product')
                        ->icon('heroicon-o-trash'),
                ])->iconButton(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Activate Selected')
                        ->icon('heroicon-o-check-circle')
                        ->action(fn($records) => $records->each(fn($record) => $record->update(['status' => true])))
                        ->color('success'),
                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Deactivate Selected')
                        ->icon('heroicon-o-x-circle')
                        ->action(fn($records) => $records->each(fn($record) => $record->update(['status' => false])))
                        ->color('danger'),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->defaultPaginationPageOption(25)
            ->paginationPageOptions([10, 25, 50, 100]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['prodcats' => function($query) {
            $query->select('id', 'name');
        }]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        try {
            $count = static::getModel()::count();
            return $count > 0 ? (string) $count : null;
        } catch (\Exception $e) {
            return null;
        }
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        try {
            $lowStockCount = static::getModel()::where('quantity', '<=', 10)->count();
            return $lowStockCount > 0 ? 'warning' : 'primary';
        } catch (\Exception $e) {
            return 'primary';
        }
    }
}

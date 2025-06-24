<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Prodcat;
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
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\KeyValue;
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
                                            ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null),

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

                                        Toggle::make('status')
                                            ->label('Active')
                                            ->default(true),

                                        Toggle::make('featured')
                                            ->label('Featured Product')
                                            ->default(false),

                                        Select::make('parent_id')
                                            ->label('Parent Product')
                                            ->relationship('parentproduct', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->nullable(),
                                    ])
                                    ->columns(2),

                                Section::make('Product Description')
                                    ->schema([
                                        Textarea::make('short_description')
                                            ->label('Short Description')
                                            ->rows(3)
                                            ->maxLength(500),

                                        Textarea::make('description')
                                            ->label('Full Description')
                                            ->rows(6),
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
                                            ->maxValue(999999.99),

                                        TextInput::make('sale_price')
                                            ->label('Sale Price')
                                            ->numeric()
                                            ->prefix('$')
                                            ->maxValue(999999.99)
                                            ->lte('price'),
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
                                            ->visible(fn (callable $get) => $get('manage_stock')),

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
                                    ]),

                                Section::make('Downloads')
                                    ->schema([
                                        Textarea::make('downloads')
                                            ->label('Downloadable Files')
                                            ->helperText('For digital products, add download links or file paths')
                                            ->rows(3),
                                    ])
                                    ->visible(fn (callable $get) => $get('type') === 'digital'),
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
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Medium)
                    ->limit(30),

                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'simple' => 'success',
                        'variable' => 'warning',
                        'grouped' => 'info',
                        'external' => 'danger',
                        'digital' => 'primary',
                        default => 'gray',
                    }),

                TextColumn::make('price')
                    ->label('Regular Price')
                    ->money('USD')
                    ->sortable(),

                TextColumn::make('sale_price')
                    ->label('Sale Price')
                    ->money('USD')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('quantity')
                    ->label('Stock')
                    ->sortable()
                    ->toggleable()
                    ->color(fn ($state) => $state > 10 ? 'success' : ($state > 0 ? 'warning' : 'danger')),

                BooleanColumn::make('status')
                    ->label('Active')
                    ->sortable(),

                BooleanColumn::make('featured')
                    ->label('Featured')
                    ->sortable(),

                TextColumn::make('total_sale')
                    ->label('Sales')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                    ->query(fn (Builder $query): Builder => $query->where('featured', true))
                    ->label('Featured Products'),

                Filter::make('active')
                    ->query(fn (Builder $query): Builder => $query->where('status', true))
                    ->label('Active Products'),

                Filter::make('out_of_stock')
                    ->query(fn (Builder $query): Builder => $query->where('quantity', '<=', 0))
                    ->label('Out of Stock'),

                Filter::make('low_stock')
                    ->query(fn (Builder $query): Builder => $query->whereBetween('quantity', [1, 10]))
                    ->label('Low Stock (1-10)'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Activate Selected')
                        ->icon('heroicon-o-check-circle')
                        ->action(fn ($records) => $records->each(fn ($record) => $record->update(['status' => true])))
                        ->color('success'),
                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Deactivate Selected')
                        ->icon('heroicon-o-x-circle')
                        ->action(fn ($records) => $records->each(fn ($record) => $record->update(['status' => false])))
                        ->color('danger'),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::where('quantity', '<=', 10)->count() > 0 ? 'warning' : 'primary';
    }
}

<?php

namespace App\Filament\Vendor\Resources;

use App\Facade\Sohoj;
use App\Filament\Vendor\Resources\ProductResource\Pages;
use App\Filament\Vendor\Resources\ProductResource\RelationManagers;
use App\Models\FilamentProduct;
use App\Models\Product;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Facades\Log;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ProductResource extends Resource
{
    protected static ?string $model = FilamentProduct::class;
    protected static ?string $navigationGroup = 'Inventory';
    protected static ?string $navigationIcon = 'heroicon-o-cube';
    public static function canCreate(): bool
    {
        $user = Auth::user();
        if (!$user || !$user->shop) {
            return false;
        }
        return $user->shop->status == 1;
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();
        if (!$user || !$user->shop) {
            return parent::getEloquentQuery()->whereRaw('1 = 0'); // Return empty query
        }

        // SIMPLIFIED QUERY - Remove complex with() and select() to prevent memory exhaustion
        return parent::getEloquentQuery()
            ->where('shop_id', $user->shop->id)
            ->whereNull('parent_id');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('shop_id')
                    ->default(function () {
                        $user = Auth::user();
                        return $user && $user->shop ? $user->shop->id : null;
                    }),

                Tabs::make('Product Management')
                    ->tabs([
                        Tabs\Tab::make('Basic Information')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\Section::make('Product Details')
                                    ->description('Essential product information and categorization.')
                                    ->schema([
                                        Forms\Components\Grid::make(3)
                                            ->schema([
                                                TextInput::make('name')
                                                    ->label('Product Name')
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->live(onBlur: true)
                                                    ->afterStateUpdated(fn(string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null)
                                                    ->placeholder('Enter product name')
                                                    ->helperText('Enter a clear, descriptive name for your product. This will be displayed to customers and used to generate the URL slug.')
                                                    ->columnSpan(2),

                                                TextInput::make('sku')
                                                    ->label('SKU')
                                                    ->maxLength(255)
                                                    ->unique(Product::class, 'sku', ignoreRecord: true)
                                                    ->placeholder('Auto-generated or custom')
                                                    ->helperText('Stock Keeping Unit. Leave empty to auto-generate, or enter a unique identifier for inventory tracking.')
                                                    ->columnSpan(1),

                                                TextInput::make('slug')
                                                    ->label('Slug')
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->unique(Product::class, 'slug', ignoreRecord: true)
                                                    ->rules(['alpha_dash'])
                                                    ->placeholder('Auto-generated from name')
                                                    ->helperText('URL-friendly version of the product name. Used in web addresses. Auto-generated from product name.')
                                                    ->columnSpan(2),

                                                Select::make('type')
                                                    ->label('Product Type')
                                                    ->options([
                                                        'simple' => 'Simple Product',
                                                        'variable' => 'Variable Product',
                                                        'grouped' => 'Grouped Product',
                                                        'external' => 'External Product',
                                                        'digital' => 'Digital Product',
                                                    ])
                                                    ->default('simple')
                                                    ->required()
                                                    ->helperText('Choose the type of product: Simple (single item), Variable (sizes/colors), Grouped (bundle), External (affiliate), or Digital (downloadable).')
                                                    ->columnSpan(1),
                                            ]),

                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Select::make('parent_id')
                                                    ->label('Parent Product')
                                                    ->relationship('parentproduct', 'name')
                                                    ->searchable()
                                                    ->nullable()
                                                    ->getSearchResultsUsing(function (string $search) {
                                                        $user = Auth::user();
                                                        if (!$user || !$user->shop) return [];

                                                        return Product::where('shop_id', $user->shop->id)
                                                            ->where('name', 'like', "%{$search}%")
                                                            ->whereNull('parent_id')
                                                            ->limit(50)
                                                            ->pluck('name', 'id')
                                                            ->toArray();
                                                    })
                                                    ->helperText('Optional. Select if this is a variation of another product (e.g., different size or color of the same item).')
                                                    ->columnSpan(2),
                                            ]),
                                    ]),
                            ]),

                        Tabs\Tab::make('Categories')
                            ->icon('heroicon-o-tag')
                            ->schema([
                                Forms\Components\Section::make('Product Categories')
                                    ->description('Select relevant categories for your product to help customers find it easily.')
                                    ->schema([
                                        Forms\Components\Grid::make(1)
                                            ->schema([
                                                // All Categories in One CheckboxList
                                                CheckboxList::make('prodcats')
                                                    ->label('Select Categories')
                                                    ->relationship('prodcats', 'name')
                                                    ->searchable()
                                                    ->bulkToggleable()
                                                    ->options(function () {
                                                        return \App\Models\Prodcat::query()
                                                            ->orderBy('name')
                                                            ->pluck('name', 'id')
                                                            ->toArray();
                                                    })
                                                    ->columns(3)
                                                    ->columnSpanFull()
                                                    ->helperText('Select one or more categories that best describe your product. This helps customers find your product when browsing or searching.'),

                                                // Or use a more organized structure with parent/child categories
                                                // Forms\Components\Fieldset::make('Category Selection Guide')
                                                //     ->schema([
                                                //         Forms\Components\Placeholder::make('category_help')
                                                //             ->label('💡 Category Tips')
                                                //             ->content(new \Illuminate\Support\HtmlString('
                                                //                 <div class="space-y-2 text-sm">
                                                //                     <p><strong>Choose relevant categories:</strong> Select categories that accurately describe your product.</p>
                                                //                     <p><strong>Multiple selections:</strong> You can select multiple categories to increase product visibility.</p>
                                                //                     <p><strong>Search function:</strong> Use the search box above to quickly find specific categories.</p>
                                                //                     <p><strong>Bulk toggle:</strong> Use "Select All" or "Deselect All" for quick selection management.</p>
                                                //                 </div>
                                                //             '))
                                                //             ->columnSpanFull(),
                                                //     ])
                                                //     ->columns(1),

                                                // // Alternative: Hierarchical Category Selection
                                                // Forms\Components\Section::make('Hierarchical Categories (Optional)')
                                                //     ->description('Select primary and secondary categories for better organization.')
                                                //     ->schema([
                                                //         Forms\Components\Select::make('primary_category')
                                                //             ->label('Primary Category')
                                                //             ->options(function () {
                                                //                 return \App\Models\Prodcat::query()
                                                //                     ->whereNull('parent_id')
                                                //                     ->orderBy('name')
                                                //                     ->pluck('name', 'id')
                                                //                     ->toArray();
                                                //             })
                                                //             ->searchable()
                                                //             ->placeholder('Select a main category')
                                                //             ->helperText('Choose the primary category that best represents your product.')
                                                //             ->live()
                                                //             ->afterStateUpdated(function (callable $set) {
                                                //                 $set('secondary_category', null);
                                                //             }),

                                                //         Forms\Components\Select::make('secondary_category')
                                                //             ->label('Secondary Category')
                                                //             ->options(function (callable $get) {
                                                //                 $primaryCategory = $get('primary_category');
                                                //                 if (!$primaryCategory) {
                                                //                     return [];
                                                //                 }

                                                //                 return \App\Models\Prodcat::query()
                                                //                     ->where('parent_id', $primaryCategory)
                                                //                     ->orderBy('name')
                                                //                     ->pluck('name', 'id')
                                                //                     ->toArray();
                                                //             })
                                                //             ->searchable()
                                                //             ->placeholder('Select a subcategory')
                                                //             ->helperText('Choose a more specific subcategory if available.')
                                                //             ->visible(fn (callable $get) => !empty($get('primary_category'))),
                                                //     ])
                                                //     ->columns(2)
                                                //     ->collapsed()
                                                //     ->collapsible(),
                                            ]),
                                    ]),
                            ]),

                        Tabs\Tab::make('Pricing & Inventory')
                            ->icon('heroicon-o-currency-dollar')
                            ->schema([
                                Forms\Components\Section::make('Pricing Information')
                                    ->description('Set product prices and manage inventory.')
                                    ->schema([
                                        Forms\Components\Grid::make(3)
                                            ->schema([
                                                TextInput::make('price')
                                                    ->label('Regular Price')
                                                    ->numeric()
                                                    ->prefix('$')
                                                    ->maxValue(999999.99)
                                                    ->required()
                                                    ->helperText('Set the standard selling price for this product.')
                                                    ->reactive()
                                                    ->afterStateUpdated(function (callable $set, callable $get) {
                                                        $price = floatval($get('price'));
                                                        $salePrice = $get('sale_price');

                                                        // Use sale price if it's not null, else fallback to price
                                                        $basePrice = (!is_null($salePrice) && $salePrice !== '') ? floatval($salePrice) : $price;

                                                        $vendorPrice = $basePrice - ($basePrice * \Sohoj::vendorCommission());
                                                        $set('vendor_price', round($vendorPrice, 2));
                                                    })
                                                    ->columnSpan(1),

                                                TextInput::make('sale_price')
                                                    ->label('Sale Price')
                                                    ->numeric()
                                                    ->prefix('$')
                                                    ->maxValue(999999.99)
                                                    ->nullable()
                                                    ->reactive()
                                                    ->afterStateUpdated(function (callable $set, callable $get, $state) {
                                                        $price = floatval($get('price'));

                                                        // If sale price is null or empty, fallback to price
                                                        $basePrice = (!is_null($state) && $state !== '') ? floatval($state) : $price;

                                                        $vendorPrice = $basePrice - ($basePrice * \Sohoj::vendorCommission());
                                                        $set('vendor_price', round($vendorPrice, 2));
                                                    })
                                                    ->rules([
                                                        fn(callable $get) => function (string $attribute, $value, callable $fail) use ($get) {
                                                            $price = floatval($get('price'));
                                                            if ($value && floatval($value) > $price) {
                                                                $fail('Sale price must be less than or equal to regular price.');
                                                            }
                                                        },
                                                    ])
                                                    ->helperText('Optional. Discounted price. Must be lower than regular price.')
                                                    ->columnSpan(1),

                                                TextInput::make('vendor_price')
                                                    ->label('Vendor Price')
                                                    ->numeric()
                                                    ->prefix('$')
                                                    ->readOnly()
                                                    ->required()
                                                    ->helperText('Auto-calculated as 10% less than sale/regular price.')
                                                    ->columnSpan(1),
                                            ]),
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Toggle::make('manage_stock')
                                                    ->label('Manage Stock')
                                                    ->live()
                                                    ->helperText('Enable to track inventory levels for this product. When enabled, you can set stock quantities.')
                                                    ->columnSpan(1),

                                                TextInput::make('quantity')
                                                    ->label('Stock Quantity')
                                                    ->numeric()
                                                    ->minValue(0)
                                                    ->visible(fn(callable $get) => $get('manage_stock'))
                                                    ->helperText('Enter the number of items you have in stock. This will be updated automatically when orders are placed.')
                                                    ->columnSpan(1),
                                            ]),
                                    ]),
                            ]),

                        Tabs\Tab::make('Physical Properties')
                            ->icon('heroicon-o-scale')
                            ->schema([
                                Forms\Components\Section::make('Product Dimensions & Weight')
                                    ->description('Define physical characteristics of the product.')
                                    ->schema([
                                        Forms\Components\Grid::make(3)
                                            ->schema([
                                                TextInput::make('weight')
                                                    ->label('Weight (kg)')
                                                    ->numeric()
                                                    ->step(0.01)
                                                    ->helperText('Product weight in kilograms. Used for shipping calculations and logistics planning.')
                                                    ->columnSpan(1),

                                                TextInput::make('dimensions')
                                                    ->label('Dimensions (L x W x H)')
                                                    ->placeholder('e.g., 10 x 5 x 3 cm')
                                                    ->helperText('Product dimensions in Length x Width x Height format. Include units (cm, inches, etc.). Used for shipping and display purposes.')
                                                    ->columnSpan(1),

                                                TextInput::make('rating_count')
                                                    ->label('Rating Count')
                                                    ->numeric()
                                                    ->default(0)
                                                    ->disabled()
                                                    ->dehydrated(false)
                                                    ->helperText('Number of customer ratings received. This field is automatically updated and cannot be edited manually.')
                                                    ->columnSpan(1),
                                            ]),
                                    ]),
                            ]),

                        Tabs\Tab::make('Media')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Forms\Components\Section::make('Product Images')
                                    ->description('Upload product images and media files.')
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                FileUpload::make('image')
                                                    ->label('Featured Image')
                                                    ->image()
                                                    ->directory('products')
                                                    ->imagePreviewHeight('120')
                                                    ->visibility('public')
                                                    ->maxSize(2048)
                                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/jpg', 'image/gif', 'image/svg+xml', 'image/avif'])
                                                    ->helperText('Upload a high-quality image that represents your product. This will be the main image displayed.')
                                                    ->columnSpan(1),

                                                FileUpload::make('images')
                                                    ->label('Gallery Images')
                                                    ->image()
                                                    ->multiple()
                                                    ->directory('products')
                                                    ->imagePreviewHeight('120')
                                                    ->visibility('public')
                                                    ->maxSize(2048)
                                                    ->maxFiles(10)
                                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/jpg', 'image/gif', 'image/svg+xml', 'image/avif'])
                                                    ->helperText('Upload additional product images (max 10). Show different angles, details, or variations of your product.')
                                                    ->dehydrateStateUsing(fn($state) => is_array($state) ? $state : [])
                                                    ->columnSpan(1),
                                            ]),
                                    ]),
                            ]),

                        Tabs\Tab::make('Content')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Forms\Components\Section::make('Product Descriptions')
                                    ->description('Add detailed product descriptions and content.')
                                    ->schema([
                                        RichEditor::make('short_description')
                                            ->label('Short Description')
                                            ->maxLength(500)
                                            ->placeholder('A brief summary for product listings')
                                            ->helperText('Brief product summary (max 500 characters). This appears in product listings and search results to give customers a quick overview.')
                                            ->toolbarButtons([
                                                'bold',
                                                'italic',
                                                'underline',
                                                'bulletList',
                                                'orderedList',
                                                'link',
                                            ]),

                                        RichEditor::make('description')
                                            ->label('Full Description')
                                            ->placeholder('Detailed product description with features and specifications')
                                            ->helperText('Comprehensive product description with features, specifications, benefits, and usage instructions. This is displayed on the product detail page.')
                                            ->toolbarButtons([
                                                'bold',
                                                'italic',
                                                'underline',
                                                'strike',
                                                'bulletList',
                                                'orderedList',
                                                'h2',
                                                'h3',
                                                'link',
                                                'blockquote',
                                            ]),
                                    ]),
                            ]),

                        Tabs\Tab::make('Settings')
                            ->icon('heroicon-o-cog-6-tooth')
                            ->schema([
                                Forms\Components\Section::make('Product Settings')
                                    ->description('Configure product visibility and special features.')
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Toggle::make('status')
                                                    ->label('Active')
                                                    ->default(true)
                                                    ->helperText('Make product visible to customers. Inactive products are hidden from the store but remain in your inventory.')
                                                    ->columnSpan(1),

                                                Toggle::make('is_variable_product')
                                                    ->label('Variable Product')
                                                    ->helperText('Enable if this product has variations like different sizes, colors, or materials. This will show the Variations tab.')
                                                    ->default(false)
                                                    ->live()
                                                    ->columnSpan(1),

                                                Toggle::make('featured')
                                                    ->label('Featured')
                                                    ->default(false)
                                                    ->helperText('Highlight this product as a featured item.')
                                                    ->columnSpan(1),
                                            ]),
                                    ]),
                            ]),

                        Tabs\Tab::make('Variations')
                            ->icon('heroicon-o-squares-plus')
                            ->visible(fn(callable $get) => $get('is_variable_product'))
                            ->schema([
                                Forms\Components\Section::make('Product Variants')
                                    ->description('Create and manage individual product variants with specific attributes and pricing.')
                                    ->schema([
                                        Forms\Components\Repeater::make('variations')
                                            ->label('')
                                            ->schema([
                                                Forms\Components\Section::make('Variant Details')
                                                    ->schema([
                                                        Forms\Components\Grid::make(2)
                                                            ->schema([
                                                                TextInput::make('sku')
                                                                    ->label('SKU')
                                                                    ->required()
                                                                    ->unique(ignoreRecord: true)
                                                                    ->placeholder('Enter variant SKU')
                                                                    ->columnSpan(1),

                                                                TextInput::make('barcode')
                                                                    ->label('Barcode')
                                                                    ->placeholder('Product barcode (UPC, EAN, etc.)')
                                                                    ->columnSpan(1),
                                                            ]),

                                                        Forms\Components\Fieldset::make('Attributes (e.g. color, size)')
                                                            ->schema([
                                                                Forms\Components\Repeater::make('attributes')
                                                                    ->schema([
                                                                        Forms\Components\Grid::make(2)
                                                                            ->schema([
                                                                                TextInput::make('attribute')
                                                                                    ->label('Attribute')
                                                                                    ->placeholder('e.g., Color, Size')
                                                                                    ->required()
                                                                                    ->columnSpan(1),

                                                                                TextInput::make('value')
                                                                                    ->label('Value')
                                                                                    ->placeholder('e.g., Red, Large')
                                                                                    ->required()
                                                                                    ->columnSpan(1),
                                                                            ]),
                                                                    ])
                                                                    ->addActionLabel('Add row')
                                                                    ->deleteAction(
                                                                        fn($action) => $action->label('Remove')
                                                                    )
                                                                    ->defaultItems(1)
                                                                    ->columns(1)
                                                                    ->helperText('Specify attributes like color, size, etc.')
                                                                    ->columnSpanFull(),
                                                            ]),

                                                        Forms\Components\Fieldset::make('Pricing & Inventory')
                                                            ->schema([
                                                                Forms\Components\Grid::make(2)
                                                                    ->schema([
                                                                        Toggle::make('track_quantity')
                                                                            ->label('Track Quantity')
                                                                            ->helperText('Enable to track inventory quantity.')
                                                                            ->default(true)
                                                                            ->live()
                                                                            ->columnSpan(2),
                                                                    ]),

                                                                Forms\Components\Grid::make(3)
                                                                    ->schema([
                                                                        TextInput::make('price')
                                                                            ->label('Price')
                                                                            ->numeric()
                                                                            ->prefix('$')
                                                                            ->required()
                                                                            ->helperText('Current selling price.')
                                                                            ->columnSpan(1),

                                                                        TextInput::make('compare_at_price')
                                                                            ->label('Compare at Price')
                                                                            ->numeric()
                                                                            ->prefix('$')
                                                                            ->helperText('Original price for showing discounts.')
                                                                            ->columnSpan(1),

                                                                        TextInput::make('cost_per_item')
                                                                            ->label('Cost per Item')
                                                                            ->numeric()
                                                                            ->prefix('$')
                                                                            ->helperText('Internal cost for profit calculation.')
                                                                            ->columnSpan(1),
                                                                    ]),

                                                                TextInput::make('stock')
                                                                    ->label('Stock')
                                                                    ->numeric()
                                                                    ->default(0)
                                                                    ->visible(fn(callable $get) => $get('track_quantity'))
                                                                    ->helperText('Available quantity in inventory.')
                                                                    ->columnSpan(1),
                                                            ]),

                                                        Forms\Components\Fieldset::make('Dimensions (Physical dimensions for shipping)')
                                                            ->schema([
                                                                Forms\Components\TextInput::make('dimensions_help')
                                                                    ->label('')
                                                                    ->default('Physical dimensions for shipping.')
                                                                    ->disabled()
                                                                    ->dehydrated(false)
                                                                    ->extraAttributes(['style' => 'background: transparent; border: none; font-size: 12px; color: #6b7280;'])
                                                                    ->columnSpanFull(),

                                                                Forms\Components\Grid::make(4)
                                                                    ->schema([
                                                                        TextInput::make('weight')
                                                                            ->label('Weight (kg)')
                                                                            ->numeric()
                                                                            ->step(0.01)
                                                                            ->columnSpan(1),

                                                                        TextInput::make('height')
                                                                            ->label('Height (cm)')
                                                                            ->numeric()
                                                                            ->step(0.1)
                                                                            ->columnSpan(1),

                                                                        TextInput::make('width')
                                                                            ->label('Width (cm)')
                                                                            ->numeric()
                                                                            ->step(0.1)
                                                                            ->columnSpan(1),

                                                                        TextInput::make('length')
                                                                            ->label('Length (cm)')
                                                                            ->numeric()
                                                                            ->step(0.1)
                                                                            ->columnSpan(1),
                                                                    ]),
                                                            ]),

                                                        Forms\Components\Fieldset::make('Variant Image')
                                                            ->schema([
                                                                FileUpload::make('variant_image')
                                                                    ->label('')
                                                                    ->image()
                                                                    ->directory('variants')
                                                                    ->imagePreviewHeight('150')
                                                                    ->visibility('public')
                                                                    ->maxSize(2048)
                                                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/jpg', 'image/gif', 'image/svg+xml', 'image/avif'])
                                                                    ->helperText('Image specific to this variant.')
                                                                    ->columnSpanFull(),
                                                            ]),
                                                    ])
                                                    ->collapsible()
                                                    ->collapsed(false),
                                            ])
                                            ->addActionLabel('Add Variant')
                                            ->deleteAction(
                                                fn($action) => $action->label('Remove Variant')
                                            )
                                            ->reorderableWithButtons()
                                            ->collapsible()
                                            ->itemLabel(
                                                fn(array $state): ?string => ($state['sku'] ?? 'New Variant') .
                                                    (isset($state['attributes'][0]['value']) ? ' - ' . $state['attributes'][0]['value'] : '')
                                            )
                                            ->defaultItems(1)
                                            ->columnSpanFull(),
                                    ]),


                            ]),
                    ])
                    ->columnSpanFull()
                    ->persistTabInQueryString(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Image')
                    ->circular()
                    ->size(60)
                    ->defaultImageUrl(url('/assets/img/no-image.png')),

                TextColumn::make('name')
                    ->label('Product Name')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary')
                    ->weight(FontWeight::Medium)
                    ->limit(30)
                    ->wrap(),

                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable()
                    ->icon('heroicon-o-hashtag')
                    ->copyable()
                    ->toggleable(),

                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->icon('heroicon-o-cube')
                    ->color(fn(string $state): string => match ($state) {
                        'simple' => 'success',
                        'variable' => 'warning',
                        'grouped' => 'info',
                        'external' => 'danger',
                        'digital' => 'primary',
                        default => 'gray',
                    })
                    ->toggleable(),

                // Simplified category display to prevent memory issues
                TextColumn::make('categories_count')
                    ->label('Categories')
                    ->getStateUsing(function (Product $record): string {
                        try {
                            $count = $record->prodcats()->count();
                            return $count > 0 ? "{$count} categories" : 'No categories';
                        } catch (\Exception $e) {
                            return 'Error loading';
                        }
                    })
                    ->badge()
                    ->color('secondary')
                    ->icon('heroicon-o-tag')
                    ->toggleable(),

                TextColumn::make('price')
                    ->label('Regular Price')
                    ->money('USD')
                    ->color('success')
                    ->sortable()
                    ->weight(FontWeight::SemiBold),

                TextColumn::make('sale_price')
                    ->label('Sale Price')
                    ->money('USD')
                    ->color('warning')
                    ->sortable()
                    ->placeholder('—')
                    ->toggleable(),

                TextColumn::make('quantity')
                    ->label('Stock')
                    ->sortable()
                    ->badge()
                    ->color(fn($state) => match (true) {
                        $state === null => 'gray',
                        $state > 50 => 'success',
                        $state > 10 => 'warning',
                        $state > 0 => 'danger',
                        default => 'gray'
                    })
                    ->formatStateUsing(fn($state) => $state ?? 'N/A')
                    ->toggleable(),

                TextColumn::make('views')
                    ->label('Views')
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-o-eye')
                    ->toggleable(isToggledHiddenByDefault: true),

                BooleanColumn::make('status')
                    ->label('Active')
                    ->icon('heroicon-o-check-circle')
                    ->sortable()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                BooleanColumn::make('featured')
                    ->label('Featured')
                    ->icon('heroicon-o-star')
                    ->sortable()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray')
                    ->toggleable(),

                BooleanColumn::make('manage_stock')
                    ->label('Stock Managed')
                    ->icon('heroicon-o-archive-box')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('total_sale')
                    ->label('Sales')
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-o-shopping-cart')
                    ->sortable()
                    ->default(0)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('shipping_cost')
                    ->label('Shipping')
                    ->money('USD')
                    ->color('secondary')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('weight')
                    ->label('Weight (kg)')
                    ->icon('heroicon-o-scale')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('M j, Y g:i A')
                    ->icon('heroicon-o-calendar-days')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime('M j, Y g:i A')
                    ->icon('heroicon-o-arrow-path')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Product Type')
                    ->options([
                        'simple' => 'Simple Product',
                        'variable' => 'Variable Product',
                        'grouped' => 'Grouped Product',
                        'external' => 'External Product',
                        'digital' => 'Digital Product',
                    ])
                    ->multiple(),

                Filter::make('featured')
                    ->query(fn(Builder $query): Builder => $query->where('featured', true))
                    ->label('Featured Products'),

                Filter::make('active')
                    ->query(fn(Builder $query): Builder => $query->where('status', true))
                    ->label('Active Products'),

                Filter::make('inactive')
                    ->query(fn(Builder $query): Builder => $query->where('status', false))
                    ->label('Inactive Products'),

                Filter::make('out_of_stock')
                    ->query(fn(Builder $query): Builder => $query->where('quantity', '<=', 0))
                    ->label('Out of Stock'),

                Filter::make('low_stock')
                    ->query(fn(Builder $query): Builder => $query->whereBetween('quantity', [1, 10]))
                    ->label('Low Stock (1-10)'),

                Filter::make('has_sale_price')
                    ->query(fn(Builder $query): Builder => $query->whereNotNull('sale_price')->where('sale_price', '>', 0))
                    ->label('On Sale'),

                Filter::make('variable_products')
                    ->query(fn(Builder $query): Builder => $query->where('is_variable_product', true))
                    ->label('Variable Products'),

                Filter::make('offers')
                    ->query(fn(Builder $query): Builder => $query->where('is_offer', true))
                    ->label('Special Offers'),
                SelectFilter::make('parent_id')
                    ->label('Product Type')
                    ->options([
                        'parent' => 'Parent Products',
                        'child' => 'Child Products (Variations)',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return match ($data['value'] ?? null) {
                            'parent' => $query->whereNull('parent_id'),
                            'child' => $query->whereNotNull('parent_id'),
                            default => $query,
                        };
                    }),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->icon('heroicon-o-eye'),
                    Tables\Actions\EditAction::make()
                        ->icon('heroicon-o-pencil'),
                    Tables\Actions\ReplicateAction::make()
                        ->icon('heroicon-o-document-duplicate')
                        ->excludeAttributes(['slug', 'sku'])
                        ->beforeReplicaSaved(function (Product $replica): void {
                            // Modify name and generate new slug
                            $replica->name = $replica->name . ' (Copy)';
                            $replica->slug = Str::slug($replica->name);
                            $replica->sku = null; // Clear SKU to avoid conflicts

                            // Ensure shop_id is set to current user's shop
                            $user = Auth::user();
                            if ($user && $user->shop) {
                                $replica->shop_id = $user->shop->id;
                            }
                        })
                        ->afterReplicaSaved(function (Product $replica, Product $original): void {
                            // Copy the many-to-many relationship (categories)
                            if ($original->prodcats()->exists()) {
                                $categoryIds = $original->prodcats()->pluck('prodcats.id')->toArray();
                                $replica->prodcats()->sync($categoryIds);
                            }
                        }),
                    Tables\Actions\DeleteAction::make()
                        ->icon('heroicon-o-trash'),
                ])
                    ->iconButton()
                    ->tooltip('Actions')
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->icon('heroicon-o-trash'),
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Activate Selected')
                        ->icon('heroicon-o-check-circle')
                        ->action(fn($records) => $records->each(fn($record) => $record->update(['status' => true])))
                        ->color('success')
                        ->requiresConfirmation(),
                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Deactivate Selected')
                        ->icon('heroicon-o-x-circle')
                        ->action(fn($records) => $records->each(fn($record) => $record->update(['status' => false])))
                        ->color('danger')
                        ->requiresConfirmation(),
                    Tables\Actions\BulkAction::make('mark_featured')
                        ->label('Mark as Featured')
                        ->icon('heroicon-o-star')
                        ->action(fn($records) => $records->each(fn($record) => $record->update(['featured' => true])))
                        ->color('warning')
                        ->requiresConfirmation(),
                    Tables\Actions\BulkAction::make('unmark_featured')
                        ->label('Remove from Featured')
                        ->icon('heroicon-o-star')
                        ->action(fn($records) => $records->each(fn($record) => $record->update(['featured' => false])))
                        ->color('gray')
                        ->requiresConfirmation(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->defaultPaginationPageOption(25)
            ->paginationPageOptions([10, 25, 50, 100])
            ->striped()
            ->persistSortInSession()
            ->persistSearchInSession()
            ->persistFiltersInSession();
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
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        try {
            $user = Auth::user();
            if (!$user || !$user->shop) {
                return null;
            }

            // DIRECT QUERY - DON'T USE getEloquentQuery()
            $count = Product::where('shop_id', $user->shop->id)
                ->whereNull('parent_id')
                ->count();
            return $count > 0 ? (string) $count : null;
        } catch (\Exception $e) {
            Log::error('Navigation badge error: ' . $e->getMessage());
            return null;
        }
    }

    public static function shouldRegisterNavigation(): bool
    {
        $user = Auth::user();
        if (!$user || !$user->shop) {
            return false;
        }
        return $user->shop->status == 1;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        try {
            $user = Auth::user();
            if (!$user || !$user->shop) {
                return 'primary';
            }

            // SIMPLIFIED: Use direct query instead of static::getModel()
            $lowStockCount = Product::where('shop_id', $user->shop->id)
                ->where('quantity', '<=', 10)
                ->count();
            return $lowStockCount > 0 ? 'warning' : 'primary';
        } catch (\Exception $e) {
            return 'primary';
        }
    }
}

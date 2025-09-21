<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\FilamentProduct;
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
use Filament\Forms\Components\CheckboxList;
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
use Filament\Forms\Components\Fieldset;

use Filament\Support\Enums\FontWeight;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = FilamentProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'Inventory';
    protected static ?string $navigationLabel = 'Products';
    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Product Details')
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

                                                Select::make('parent_id')
                                                    ->label('Parent Product')
                                                    ->relationship('parentproduct', 'name')
                                                    ->searchable()
                                                    ->nullable()
                                                    ->getSearchResultsUsing(fn(string $search): array => Product::where('name', 'like', "%{$search}%")->limit(50)->pluck('name', 'id')->toArray())
                                                    ->getOptionLabelUsing(fn($value): ?string => Product::find($value)?->name)
                                                    ->helperText('Optional. Select if this is a variation of another product (e.g., different size or color of the same item).')
                                                    ->columnSpan(2),
                                                Select::make('shop_id')
                                                    ->label('Shop')
                                                    ->relationship('shop', 'name')
                                                    ->required()
                                                    ->searchable()
                                                    ->columnSpan(1)
                                                    ->getSearchResultsUsing(fn(string $search): array => Shop::where('name', 'like', "%{$search}%")->limit(50)->pluck('name', 'id')->toArray())
                                                    ->getOptionLabelUsing(fn($value): ?string => Shop::find($value)?->name),

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


                                                    ->columnSpan(1),

                                                TextInput::make('sale_price')
                                                    ->label('Sale Price')
                                                    ->numeric()
                                                    ->prefix('$')
                                                    ->maxValue(999999.99)
                                                    ->nullable()
                                                    ->reactive()

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

                                                    ->required()

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
                                        Forms\Components\Grid::make(4)
                                            ->schema([
                                                TextInput::make('weight')
                                                    ->label('Weight')
                                                    ->numeric()
                                                    ->step(0.01)
                                                    ->helperText('Enter product weight and select unit.')
                                                    ->columnSpan(1),

                                                Select::make('weight_unit')
                                                    ->label('Weight Unit')
                                                    ->options([
                                                        'kg' => 'Kilograms (kg)',
                                                        'g' => 'Grams (g)',
                                                        'lb' => 'Pounds (lb)',
                                                        'oz' => 'Ounces (oz)',
                                                    ])
                                                    ->default('kg')
                                                    ->required()
                                                    ->helperText('Select the unit for product weight.')
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
                                                    // ->visibility('public')
                                                    // ->maxSize(2048)
                                                    ->disk('public')
                                                    // ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/jpg', 'image/gif', 'image/svg+xml', 'image/avif'])
                                                    ->helperText('Upload a high-quality image that represents your product. This will be the main image displayed.')
                                                    ->columnSpan(1),

                                                FileUpload::make('images')
                                                    ->label('Gallery Images')
                                                    ->image()
                                                    ->multiple()
                                                    ->directory('products')
                                                    ->imagePreviewHeight('120')
                                                    // ->visibility('public')
                                                    // ->maxSize(2048)
                                                    ->maxFiles(10)
                                                    ->disk('public')
                                                    // ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/jpg', 'image/gif', 'image/svg+xml', 'image/avif'])
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
                                            ->placeholder('A brief summary for product listings')
                                            ->helperText('Brief product summary. This appears in product listings and search results to give customers a quick overview.')
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
                        Tabs\Tab::make('Shipping')
                            ->icon('heroicon-o-truck')
                            ->schema([
                                Section::make('Parcels')
                                    ->schema([
                                        Repeater::make('parcels')
                                            ->schema([
                                                Fieldset::make('Safety & Restrictions')
                                                    ->schema([
                                                        Toggle::make('contains_battery_pi966')->label('Battery PI966'),
                                                        Toggle::make('contains_battery_pi967')->label('Battery PI967'),
                                                        Toggle::make('contains_liquids')->label('Liquids'),
                                                    ])
                                                    ->columns(3),

                                                Fieldset::make('Basic Info')
                                                    ->schema([
                                                        TextInput::make('description')->label('Description')->required(),
                                                        Select::make('category_id')
                                                            ->label('Category')
                                                            ->options(function () {
                                                                $response = Http::get(config('app.url') . '/api/eash-ship')->json();

                                                                return collect($response['item_categories'] ?? [])
                                                                    ->pluck('name', 'id');
                                                            })
                                                            ->searchable()
                                                            ->required(),

                                                        TextInput::make('origin_country_alpha2')->label('Origin Country (ISO-2)')->maxLength(2),

                                                    ])
                                                    ->columns(3),

                                                Fieldset::make('Dimensions (cm)')
                                                    ->schema([
                                                        TextInput::make('length')->numeric()->label('Length'),
                                                        TextInput::make('width')->numeric()->label('Width'),
                                                        TextInput::make('height')->numeric()->label('Height'),
                                                    ])
                                                    ->columns(3),

                                                Fieldset::make('Weight & Value')
                                                    ->schema([
                                                        TextInput::make('actual_weight')->numeric()->label('Weight (kg)'),
                                                        // TextInput::make('declared_customs_value')->numeric()->label('Customs Value'),
                                                    ])
                                                    ->columns(2),
                                            ])
                                            ->columns(1)
                                            ->collapsible()
                                            ->itemLabel(fn(array $state): ?string => $state['description'] ?? 'Parcel'),
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
                                                                    // ->visibility('public')
                                                                    ->disk('public')
                                                                    // ->maxSize(2048)
                                                                    // ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/jpg', 'image/gif', 'image/svg+xml', 'image/avif'])
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
            ->recordUrl(null) // Disable record URLs to prevent issues
            ->columns([
                ImageColumn::make('image')
                    ->label('Image')
                    ->circular()
                    ->size(60)
                    ->defaultImageUrl(url('/assets/images/default-product.png')),
                TextColumn::make('name')
                    ->label('Product Name')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary')
                    ->weight(FontWeight::Medium)
                    ->limit(30)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 30 ? $state : null;
                    }),
                TextColumn::make('prodcats.name')
                    ->label('Categories')
                    ->badge()
                    ->separator(',')
                    ->limit(20)
                    ->icon('heroicon-o-tag')
                    ->toggleable()
                    ->formatStateUsing(function ($state) {
                        if (is_array($state)) {
                            return collect($state)->take(3)->implode(', ');
                        }
                        return $state;
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
                    ->toggleable()
                    ->placeholder('N/A'),
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
                    // Tables\Actions\ViewAction::make()
                    //     ->label('View Product')
                    //     ->icon('heroicon-o-eye'),
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
        // SIMPLIFIED QUERY - Remove complex with() and select() to prevent memory exhaustion
        return parent::getEloquentQuery();
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
            // 'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        // TEMPORARILY DISABLED FOR DEBUGGING
        return null;

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

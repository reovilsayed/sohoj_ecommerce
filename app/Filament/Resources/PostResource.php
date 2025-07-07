<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Str;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use App\Models\Category;

class PostResource extends Resource

{
    protected static ?string $model = Post::class;

    protected static ?string $navigationGroup = 'Blog';
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationLabel = 'Post';
    protected static ?string $modelLabel = 'Post';
    protected static ?string $slug = 'Post';
    protected static ?int $navigationSort = 2;


public static function form(Form $form): Form
{
    return $form
        ->schema([
            Tabs::make('Page Details') // Main Tabs Title (optional)
                ->tabs([
                    Tabs\Tab::make('Basic Information') // Tab 1 Title
                        ->schema([
                            Section::make('Page Title & Slug') // Section Title
                                ->description('Add the page title and slug. Slug will be auto-generated from title.')
                                ->schema([
                                    Forms\Components\Hidden::make('author_id')
                                            ->default(function () {
                                                $user = \Illuminate\Support\Facades\Auth::user();
                                                    return $user ? $user->id : null;}),

                                    Select::make('category_id')
                                        ->label('Category Name')
                                        ->relationship('category', 'name')
                                        ->searchable(),

                                    Forms\Components\TextInput::make('title')
                                        ->required()
                                        ->maxLength(255)
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn (string $context, $state, callable $set) =>
                                            $context === 'create' ? $set('slug', Str::slug($state)) : null
                                        ),
                                    Forms\Components\TextInput::make('slug'),
                                ])->columns(2),

                            Section::make('Page Content') // Section Title
                                ->description('Add the main content, excerpt, and an optional featured image.')
                                ->schema([
                                    Forms\Components\Textarea::make('excerpt')
                                        ->columnSpanFull(),
                                    Forms\Components\Textarea::make('body')
                                        ->required()
                                        ->columnSpanFull(),
                                    Forms\Components\FileUpload::make('image')
                                        ->image()
                                        ->directory('pages')
                                        ->required(),
                                ]),
                        ]),

                    Tabs\Tab::make('SEO & Settings') // Tab 2 Title
                        ->schema([
                            Section::make('SEO Information') // Section Title
                                ->description('Improve search engine visibility with meta data.')
                                ->schema([
                                    Forms\Components\Textarea::make('seo_title')
                                        ->label('SEO Title')
                                        ->columnSpanFull(),
                                    Forms\Components\Textarea::make('meta_description')
                                        ->label('Meta Description')
                                        ->columnSpanFull(),
                                    Forms\Components\Textarea::make('meta_keywords')
                                        ->label('Meta Keywords ')
                                        ->columnSpanFull(),
                                ]),

                            Section::make('Page Settings') // Section Title
                                ->description('Additional page settings including featured status and publishing status.')
                                ->schema([
                                    Forms\Components\Toggle::make('featured')
                                        ->required()
                                        ->label('Featured Page'),
                                    Section::make('Publishing Status')
                                        ->schema([
                                            Select::make('status')
                                                ->options([
                                                    'PUBLISHED' => 'Published',
                                                    'DRAFT' => 'Draft',
                                                    'PENDING' => 'Pending',
                                                ])
                                                ->required()
                                                ->label('Status'),
                                        ]),
                                ]),
                        ]),
                ])->columnSpanFull(),
        ]);
}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('author_id')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

               
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category Name')
                    ,

                Tables\Columns\TextColumn::make('slug')
                    ->toggleable(isToggledHiddenByDefault: false),

                Tables\Columns\TextColumn::make('seo_title')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),

                Tables\Columns\ImageColumn::make('image'),

                Tables\Columns\TextColumn::make('excerpt')
                    ->formatStateUsing(fn ($state) => Str::words($state, 7)),

                Tables\Columns\TextColumn::make('meta_description')
                    ->formatStateUsing(fn ($state) => Str::words($state, 7)),

                Tables\Columns\TextColumn::make('status'),

                Tables\Columns\IconColumn::make('featured')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([

                Tables\Filters\Filter::make('created_today')
                    ->label('Created Today')
                    ->query(fn (Builder $query): Builder =>
                        $query->whereDate('created_at', today())
                    ),

                Tables\Filters\Filter::make('Status')
                ->label('Status Pending')
                    ->query(fn (Builder $query): Builder =>
                        $query->where( 'status', 'PENDING',  )
                    ),

                Tables\Filters\Filter::make('Featured')
                ->label('Active Featured')
                    ->query(fn (Builder $query): Builder =>
                        $query->where( 'featured', 1  )
                    ),


            ])
            ->actions([

                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),

                        // Change Status (with dropdown form)

                    Tables\Actions\Action::make('change_status')
                        ->label('Change Status')
                        ->icon('heroicon-o-adjustments-horizontal')
                        ->color('warning')
                        ->form([
                            Forms\Components\Select::make('status')
                                ->label('Select Status')
                                ->required()
                                ->options([
                                    'PUBLISHED' => 'Published',
                                    'DRAFT' => 'Draft',
                                    'PENDING' => 'Pending',
                                ]),
                        ])

                        ->action(fn ($record, array $data) =>
                            $record->update(['status' => $data['status']])
                        ),

                      ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index'    => Pages\ListPosts::route('/'),
            'create'   => Pages\CreatePost::route('/create'),
            'view'     => Pages\ViewPost::route('/{record}'),
            'edit'     => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}

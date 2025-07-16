<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Filament\Resources\SliderResource\RelationManagers;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo'; // Use a valid icon name

    protected static ?string $navigationLabel = 'Sliders'; // Added navigation label
    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 2; // Optional: Set navigation order

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Slider Image')
                    ->icon('heroicon-o-photo')
                    ->description('Upload a high-quality image for the homepage slider.')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Slider Image')
                            ->image()
                            ->imagePreviewHeight('120')
                            ->directory('sliders')
                            ->required()
                            ->helperText('Recommended size: 1200x400px. JPG or PNG.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 ImageColumn::make('image')
                ->disk('public')
                ->label('Slider Image'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }

    public static function getSlides(): array
    {
        return static::$model::all()->toArray();
    }
}

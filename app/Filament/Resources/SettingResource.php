<?php

namespace App\Filament\Resources;

use App\Models\Setting;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Site Settings';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('key')->required()->unique(ignoreRecord: true),
            Forms\Components\TextInput::make('display_name')->label('Display Name'),
            Forms\Components\Textarea::make('value')->label('Value'),
            Forms\Components\Textarea::make('details')->label('Details'),
            Forms\Components\TextInput::make('type')->label('Type'),
            Forms\Components\TextInput::make('order')->numeric()->default(0),
            Forms\Components\TextInput::make('group')->label('Group'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')->sortable(),
            TextColumn::make('key')->searchable()->sortable(),
            TextColumn::make('display_name')->label('Display Name')->searchable(),
            TextColumn::make('value')->limit(40),
            TextColumn::make('type')->sortable(),
            TextColumn::make('group')->sortable(),
            TextColumn::make('order')->sortable(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('group')->options(
                fn () => Setting::query()->pluck('group', 'group')->filter()->toArray()
            ),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => SettingResource\Pages\ListSettings::route('/'),
            'create' => SettingResource\Pages\CreateSetting::route('/create'),
            'edit' => SettingResource\Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VerificationResource\Pages;
use App\Filament\Resources\VerificationResource\RelationManagers;
use App\Models\Verification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\{TextColumn, BooleanColumn, ImageColumn};
use Filament\Forms\Components\{TextInput, DatePicker, FileUpload, Toggle, Select};
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VerificationResource extends Resource
{
    protected static ?string $model = Verification::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),

                TextInput::make('phone')->required(),
                TextInput::make('paypal_email')->email()->required(),
                DatePicker::make('dob')->required(),
                TextInput::make('tax_no')->label('Tax Number')->required(),
                TextInput::make('card_no')->label('Card Number')->required(),

                FileUpload::make('govt_id_front')
                    ->label('Government ID Front')
                    ->directory('verifications')
                    ->image()
                    ->required(),

                FileUpload::make('govt_id_back')
                    ->label('Government ID Back')
                    ->directory('verifications')
                    ->image()
                    ->required(),

                TextInput::make('bank_ac')->label('Bank Account')->required(),
                TextInput::make('ac_holder_name')->label('Account Holder Name')->required(),
                TextInput::make('address')->required(),
                TextInput::make('rtn')->label('Routing Number')->required(),

                Toggle::make('ismonthly_charge')
                    ->label('Monthly Charge Enabled')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('User')->sortable()->searchable(),
                TextColumn::make('phone')->sortable()->searchable(),
                TextColumn::make('paypal_email')->label('PayPal Email')->sortable()->searchable(),
                TextColumn::make('dob')->label('Date of Birth')->sortable()->searchable(),
                TextColumn::make('tax_no')->label('Tax Number')->sortable()->searchable(),
                TextColumn::make('card_no')->label('Card Number')->sortable()->searchable(),
                ImageColumn::make('govt_id_front')->label('Government ID Front')->sortable()->searchable(),
                ImageColumn::make('govt_id_back')->label('Government ID Back')->sortable()->searchable(),
                TextColumn::make('bank_ac')->label('Bank Account')->sortable()->searchable(),
                TextColumn::make('ac_holder_name')->label('Account Holder Name')->sortable()->searchable(),
                TextColumn::make('address')->sortable()->searchable(),
                TextColumn::make('rtn')->label('Routing Number')->sortable()->searchable(),
                BooleanColumn::make('ismonthly_charge')->label('Monthly Charge Enabled')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListVerifications::route('/'),
            'create' => Pages\CreateVerification::route('/create'),
            'edit' => Pages\EditVerification::route('/{record}/edit'),
        ];
    }
}

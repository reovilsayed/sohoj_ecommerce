<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouponResource\Pages;
use App\Filament\Resources\CouponResource\RelationManagers;
use App\Models\Coupon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CouponResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $model = Coupon::class;
    protected static ?string $navigationGroup = 'Business';

    public static function form(Form $form): Form
    {
        return $form
        
            ->schema([
                
                TextInput::make('code')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(50),

                TextInput::make('discount')
                    ->numeric()
                    ->minValue(1)
                    ->required(),

                DatePicker::make('expire_at')
                    ->required(),

                TextInput::make('limit')
                    ->numeric()
                    ->minValue(1)
                    ->required(),

                TextInput::make('minimum_cart')
                    ->numeric()
                    ->minValue(0)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')->sortable()->searchable()->toggleable(),
                TextColumn::make('discount')->label('Discount (%)')->sortable()->toggleable(),
                TextColumn::make('minimum_cart')->label('Min Cart')->sortable()->toggleable(),
                TextColumn::make('limit')->label('Usage Limit')->sortable()->toggleable(),
                TextColumn::make('expire_at')->date('F j, Y')->sortable()->toggleable(),
                TextColumn::make('created_at')->label('Created')->date('F j, Y')->toggleable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('expired')
                    ->label('Expired Coupons')
                    ->query(fn (Builder $query): Builder => $query->where('expire_at', '<', now())),

                Tables\Filters\Filter::make('active')
                    ->label('Active Coupons')
                    ->query(fn (Builder $query): Builder => $query->where('expire_at', '>=', now())),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
        ];
    }
    
    public static function getNavigationBadge(): ?string
    {
        return static::$model::count();
    }
}

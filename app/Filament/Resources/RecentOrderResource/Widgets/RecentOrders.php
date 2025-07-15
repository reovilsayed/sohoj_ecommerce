<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;

class RecentOrders extends BaseWidget
{
    protected int|string|array $columnSpan = 'full'; // can also use '1/2', '2/3', etc.

    protected function getTableQuery(): Builder
    {
        return Order::where('created_at', '>=', now()->subDays(7))->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')->label('Order ID')->sortable(),
            TextColumn::make('user.name')->label('Customer')->sortable()->searchable(),
            TextColumn::make('total')->label('Total')->money('usd')->sortable(),
            BadgeColumn::make('status')
                ->label('Status')
                ->formatStateUsing(fn ($state) => match ($state) {
                    0 => 'Pending',
                    1 => 'Paid',
                    2 => 'On Its Way',
                    3 => 'Cancelled',
                    4 => 'Delivered',
                    default => 'Unknown',
                })
                ->colors([
                    'secondary' => 0,
                    'success' => 1,
                    'warning' => 2,
                    'danger' => 3,
                    'primary' => 4,
                ]),
            TextColumn::make('created_at')->label('Created')->dateTime('F j, Y'),
        ];
    }
}

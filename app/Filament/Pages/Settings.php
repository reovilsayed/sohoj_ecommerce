<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;
       protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static string $view = 'filament.pages.settings';
    protected static ?string $navigationLabel = 'Site Settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'site_name' => Settings::get('site_name'),
            'site_email' => Settings::get('site_email'),
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('site_name')
                ->label('Site Name')
                ->required(),

            TextInput::make('site_email')
                ->label('Site Email')
                ->email()
                ->required(),
        ];
    }

    protected function getFormModel(): string
    {
        return static::class;
    }

    public function submit(): void
    {
        Settings::set('site_name', $this->form->getState()['site_name']);
        Settings::set('site_email', $this->form->getState()['site_email']);
        $this->notify('success', 'Settings saved successfully!');
    }
}

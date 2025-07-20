<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms;
use Filament\Pages\Page;
use Illuminate\Support\Arr;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $title = 'Settings';
    protected static string $view = 'filament.pages.settings';

    public $data = [];

    public function mount(): void
    {
        $this->data = Setting::all()->pluck('value', 'key')->toArray();
    }

    public function save()
    {
        foreach ($this->data as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }
        session()->flash('success', 'Settings updated successfully!');
    }

    protected function getFormSchema(): array
    {
        $groups = Setting::all()->groupBy('group');
        $tabs = [];
        foreach ($groups as $group => $settings) {
            $fields = [];
            foreach ($settings as $setting) {
                $fieldType = match($setting->type) {
                    'text' => Forms\Components\TextInput::class,
                    'textarea' => Forms\Components\Textarea::class,
                    'image' => Forms\Components\FileUpload::class,
                    default => Forms\Components\TextInput::class,
                };
                $fields[] = $fieldType::make('data.' . $setting->key)
                    ->label(ucwords(str_replace('_', ' ', $setting->display_name)))
                    ->default($setting->value);
            }
            $tabs[] = Forms\Components\Tabs\Tab::make($group ?: 'General')->schema($fields);
        }
        return [
            Forms\Components\Tabs::make('Settings Tabs')
            ->tabs($tabs)
        ];
    }
}

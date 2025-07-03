<?php

namespace App\Filament\Vendor\Pages;

use Filament\Forms\Components\Grid;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Navigation\NavigationItem;

class OfferBannerPage extends Page
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.vendor.pages.offer-banner-page';
    protected static ?string $title = '';

    // Declare your data array (public so Livewire sees it)
    public array $data = [];

    public static function getNavigationItems(): array
    {
        return [
            NavigationItem::make('Offer Banners')
                ->url(fn() => route('filament.vendor.pages.offer-banner-page'))
                ->badge(fn() => 'New')
                ->icon('heroicon-o-photo')
                ->sort(5),
        ];
    }

    public function mount(): void
    {
        // initialize the form state
        $this->form->fill([
            'title1' => '',
            'category1' => '',
            'image1' => '',
            'link1' => '',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data') // this binds to $this->data

            ->schema([
                Grid::make('3')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('title1')
                            ->label('Banner Title')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('E.g. Summer Sale'),
                        \Filament\Forms\Components\TextInput::make('category1')
                            ->label('Category')
                            ->required()
                            ->maxLength(50)
                            ->placeholder('E.g. Electronics'),

                        \Filament\Forms\Components\TextInput::make('link1')
                            ->label('Banner URL')
                            ->required()
                            ->url(),
                    ]),
                \Filament\Forms\Components\FileUpload::make('image1')
                    ->label('Banner Image')
                    ->required()
                    ->image()
                    ->disk('public')
                    ->directory('offer-banners'),

            ]);
    }

    public function submit()
    {
        foreach ($this->data['image1'] as $image) {
            $this->data['image1'] = $image;
        }
        $shop = auth()->user()->shop;

        $data = $this->data;

        if (isset($data['image1']) && $data['image1'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
            $data['image1'] = $data['image1']->store('metas', 'public');
        }

        $data = $shop->createMetas($data);
        // dd($data);
    }
}

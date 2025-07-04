<?php

namespace App\Filament\Vendor\Pages;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Navigation\NavigationItem;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;

class VendorProfilePage extends Page
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static string $view = 'filament.vendor.pages.vendor-profile-page';
    protected static ?string $title = 'Profile Settings';

    public array $data = [];
    public array $shopData = [];

    public static function getNavigationItems(): array
    {
        return [
            NavigationItem::make('Profile')
                ->url(fn() => route('filament.vendor.pages.vendor-profile-page'))
                ->icon('heroicon-o-user-circle')
                ->sort(1),
        ];
    }

    public function mount(): void
    {
        $user = Auth::user();
        $shop = $user->shop;

        // Fill user data
        $this->form->fill([
            'name' => $user->name,
            'l_name' => $user->l_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'birth_date' => $user->birth_date,
            'tax_no' => $user->tax_no,
            'nid' => $user->nid,
            'address' => $user->address,
        ]);

        // Fill shop data
        $this->form->fill([
            'data' => [
                'name' => $user->name,
                'l_name' => $user->l_name,
                'email' => $user->email,
                'phone' => $user->phone,
                'birth_date' => $user->birth_date,
                'tax_no' => $user->tax_no,
                'nid' => $user->nid,
                'address' => $user->address,
            ],
            'shopData' => [
                'name' => $shop->name ?? '',
                'description' => $shop->description ?? '',
                'logo' => $shop->logo ?? '',
                'banner' => $shop->banner ?? '',
                'phone' => $shop->phone ?? '',
                'email' => $shop->email ?? '',
                'address' => $shop->address ?? '', // This will use the magic method from HasMeta
                'post_code' => $shop->post_code ?? '',
                'city' => $shop->city ?? '',
                'state' => $shop->state ?? '',
                'country' => $shop->country ?? '',
                'facebook' => $shop->facebook,
                'linkedin' => $shop->linkedin,
                'instagram' => $shop->instagram,
                'twitter' => $shop->twitter,
            ]
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Personal Information')
                    ->description('Update your personal details and contact information')
                    ->icon('heroicon-o-user')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('data.name')
                                    ->label('First Name')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('data.l_name')
                                    ->label('Last Name')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('data.email')
                                    ->label('Email Address')
                                    ->email()
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('data.phone')
                                    ->label('Phone Number')
                                    ->tel()
                                    ->maxLength(20),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('data.birth_date')
                                    ->label('Date of Birth')
                                    ->type('date'),
                                TextInput::make('data.tax_no')
                                    ->label('Tax ID Number')
                                    ->maxLength(50),
                            ]),
                        TextInput::make('data.nid')
                            ->label('National ID')
                            ->maxLength(50),
                        Textarea::make('data.address')
                            ->label('Address')
                            ->rows(3)
                            ->maxLength(500),
                    ]),

                Section::make('Security Settings')
                    ->description('Change your password and security preferences')
                    ->icon('heroicon-o-shield-check')
                    ->schema([
                        TextInput::make('data.current_password')
                            ->label('Current Password')
                            ->password()
                            ->dehydrated(false),
                        TextInput::make('data.new_password')
                            ->label('New Password')
                            ->password()
                            ->minLength(8)
                            ->dehydrated(false),
                        TextInput::make('data.confirm_password')
                            ->label('Confirm New Password')
                            ->password()
                            ->dehydrated(false)
                            ->same('data.new_password'),
                    ]),

                Section::make('Shop Information')
                    ->description('Manage your shop details and branding')
                    ->icon('heroicon-o-building-storefront')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('shopData.name')
                                    ->label('Shop Name')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('shopData.phone')
                                    ->label('Shop Phone')
                                    ->tel()
                                    ->maxLength(20),
                            ]),
                        TextInput::make('shopData.email')
                            ->label('Shop Email')
                            ->email()
                            ->maxLength(255),
                        Textarea::make('shopData.description')
                            ->label('Shop Description')
                            ->rows(3)
                            ->maxLength(1000),
                        Grid::make(2)
                            ->schema([
                                FileUpload::make('shopData.logo')
                                    ->label('Shop Logo')
                                    ->image()
                                    ->disk('public')
                                    ->directory('shop-logos')
                                    ->maxSize(2048),
                                FileUpload::make('shopData.banner')
                                    ->label('Shop Banner')
                                    ->image()
                                    ->disk('public')
                                    ->directory('shop-banners')
                                    ->maxSize(5120),
                            ]),
                    ]),

                Section::make('Location Information')
                    ->description('Set your shop location and address')
                    ->icon('heroicon-o-map-pin')
                    ->schema([
                        Textarea::make('shopData.address')
                            ->label('Shop Address')
                            ->rows(2)
                            ->maxLength(500),
                        Grid::make(3)
                            ->schema([
                                TextInput::make('shopData.city')
                                    ->label('City')
                                    ->maxLength(100),
                                TextInput::make('shopData.state')
                                    ->label('State/Province')
                                    ->maxLength(100),
                                TextInput::make('shopData.post_code')
                                    ->label('Postal Code')
                                    ->maxLength(20),
                            ]),
                        TextInput::make('shopData.country')
                            ->label('Country')
                            ->maxLength(100),
                    ]),

                Section::make('Social Media')
                    ->description('Connect your social media accounts')
                    ->icon('heroicon-o-share')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('shopData.facebook')
                                    ->label('Facebook URL')
                                    ->url()
                                    ->prefix('https://facebook.com/'),
                                TextInput::make('shopData.instagram')
                                    ->label('Instagram URL')
                                    ->url()
                                    ->prefix('https://instagram.com/'),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('shopData.twitter')
                                    ->label('Twitter URL')
                                    ->url()
                                    ->prefix('https://twitter.com/'),
                                TextInput::make('shopData.linkedin')
                                    ->label('LinkedIn URL')
                                    ->url()
                                    ->prefix('https://linkedin.com/in/'),
                            ]),
                    ]),
            ]);
    }

    public function submit()
    {
        $user = Auth::user();
        $shop = $user->shop;

        // Update user data
        $user->update([
            'name' => $this->data['name'],
            'l_name' => $this->data['l_name'],
            'email' => $this->data['email'],
        ]);

        // Update user meta data
        $user->createMeta('phone', $this->data['phone']);
        $user->createMeta('birth_date', $this->data['birth_date']);
        $user->createMeta('tax_no', $this->data['tax_no']);
        $user->createMeta('nid', $this->data['nid']);
        $user->createMeta('address', $this->data['address']);

        // Handle password change
        if (!empty($this->data['current_password']) && !empty($this->data['new_password'])) {
            if (!Hash::check($this->data['current_password'], $user->password)) {
                Notification::make()
                    ->title('Error')
                    ->body('Current password is incorrect.')
                    ->danger()
                    ->send();
                return;
            }

            $user->update([
                'password' => Hash::make($this->data['new_password'])
            ]);
        }

        // Update shop data
        if ($shop) {
            $shop->update([
                'name' => $this->shopData['name'],
                'description' => $this->shopData['description'],
                'phone' => $this->shopData['phone'],
                'email' => $this->shopData['email'],
                'post_code' => $this->shopData['post_code'],
                'city' => $this->shopData['city'],
                'state' => $this->shopData['state'],
                'country' => $this->shopData['country'],
            ]);

            // Store address as meta data since it's not a direct column
            $shop->createMeta('address', $this->shopData['address']);

            // Handle file uploads
            if (isset($this->shopData['logo']) && $this->shopData['logo'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
                $shop->update(['logo' => $this->shopData['logo']->store('shop-logos', 'public')]);
            }

            if (isset($this->shopData['banner']) && $this->shopData['banner'] instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
                $shop->update(['banner' => $this->shopData['banner']->store('shop-banners', 'public')]);
            }

            // Update shop meta data
            $shop->createMeta('facebook', $this->shopData['facebook']);
            $shop->createMeta('linkedin', $this->shopData['linkedin']);
            $shop->createMeta('instagram', $this->shopData['instagram']);
            $shop->createMeta('twitter', $this->shopData['twitter']);
        }

        Notification::make()
            ->title('Success')
            ->body('Profile updated successfully!')
            ->success()
            ->send();
    }
} 
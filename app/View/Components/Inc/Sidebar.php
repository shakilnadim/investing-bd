<?php

namespace App\View\Components\Inc;

use App\Consts\Roles;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public array $items = [
        [
            'name' => 'Dashboard',
            'link' => 'admin.dashboard',
            'icon' => '<svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" /></svg>',
        ],
        [
            'name' => 'News',
            'link' => 'admin.news',
            'icon' => '<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>',
        ],
    ];

    public function __construct(private Request $request)
    {
        $this->addItems();
    }

    public function addItems() : void
    {
        $this->addCategory()->addUser()->addAdvertisement();
    }

    private function addCategory() : Sidebar
    {
        $category = [
            'name' => 'Categories',
            'link' => 'admin.categories',
            'icon' => '<svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" /></svg>'
        ];
        $this->addItem($category, Category::class);
        return $this;
    }

    private function addUser() : Sidebar
    {
        $user = [
            'name' => 'Users',
            'link' => 'admin.users',
            'icon' => '<svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" /></svg>'
        ];
        $this->addItem($user, User::class);
        return $this;
    }

    private function addAdvertisement() : Sidebar
    {
        $advertisement = [
            'name' => 'Advertisements',
            'link' => 'admin.advertisements',
            'icon' => '<svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 512 512" fill="currentColor"><path d="M157.52 272h36.96L176 218.78 157.52 272zM352 256c-13.23 0-24 10.77-24 24s10.77 24 24 24 24-10.77 24-24-10.77-24-24-24zM464 64H48C21.5 64 0 85.5 0 112v288c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM250.58 352h-16.94c-6.81 0-12.88-4.32-15.12-10.75L211.15 320h-70.29l-7.38 21.25A16 16 0 0 1 118.36 352h-16.94c-11.01 0-18.73-10.85-15.12-21.25L140 176.12A23.995 23.995 0 0 1 162.67 160h26.66A23.99 23.99 0 0 1 212 176.13l53.69 154.62c3.61 10.4-4.11 21.25-15.11 21.25zM424 336c0 8.84-7.16 16-16 16h-16c-4.85 0-9.04-2.27-11.98-5.68-8.62 3.66-18.09 5.68-28.02 5.68-39.7 0-72-32.3-72-72s32.3-72 72-72c8.46 0 16.46 1.73 24 4.42V176c0-8.84 7.16-16 16-16h16c8.84 0 16 7.16 16 16v160z"></path></svg>'
        ];
        $this->addItem($advertisement, Advertisement::class);
        return $this;
    }

    private function addItem(array $item, string $model) : void
    {
        if (auth()->user()->can('view-list', $model)) {
            array_push($this->items, $item);
        }
    }

    public function isActive($routeName) : bool
    {
        return str_starts_with($this->request->url(), route($routeName));
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inc.sidebar');
    }
}

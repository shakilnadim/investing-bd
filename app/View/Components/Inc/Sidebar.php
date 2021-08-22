<?php

namespace App\View\Components\Inc;

use App\Consts\Roles;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(private Request $request)
    {
        //
    }

    public function items() : array
    {
        $items = [
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

        $items = $this->addCategory($items);
        $items = $this->addUser($items);
        return $items;
    }

    private function addCategory(array $items) : array
    {
        $category = [
            'name' => 'Categories',
            'link' => 'admin.categories',
            'icon' => '<svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" /></svg>'
        ];
        return $this->addItem($items, $category, Category::class);
    }

    private function addUser(array $items) : array
    {
        $user = [
            'name' => 'Users',
            'link' => 'admin.users',
            'icon' => '<svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" /></svg>'
        ];
        return $this->addItem($items, $user, User::class);
    }

    private function addItem(array $items, array $item, string $model) : array
    {
        if (auth()->user()->can('view-list', $model)) {
            array_push($items, $item);
        }
        return $items;
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

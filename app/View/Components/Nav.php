<?php

namespace App\View\Components;

use Illuminate\Routing\Route;
use Illuminate\View\Component;


class Nav extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $items;
    // public $active;
    public function __construct()
    {
        $this->items = config('nav');
        // $this->active = Route::currentRouteName();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nav');
    }
}
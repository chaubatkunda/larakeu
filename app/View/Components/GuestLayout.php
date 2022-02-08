<?php

namespace App\View\Components;

use Illuminate\View\Component;


class GuestLayout extends Component
{
    public $title;
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function __construct($title = null)
    {
        $this->title = $title ?? config('app.name');
    }
    public function render()
    {
        return view('layouts.guest');
    }
}

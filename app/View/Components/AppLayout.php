<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppLayout extends Component
{
    public $title;
    /**
     * Create a new component instance.
     */
    public function __construct($title = "Default Title")
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.app', [
            "categories" => Category::query()->select("name", "slug")->whereHas('articles')->get(),
        ]);
    }
}

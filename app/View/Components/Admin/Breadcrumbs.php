<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumbs extends Component
{
    public $title, $currentActive, $addLink;

    /**
     * Create a new component instance.
     */
    public function __construct($title, $currentActive, $addLink = [])
    {
        $this->title = $title;
        $this->currentActive = $currentActive;
        $this->addLink = $addLink;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.breadcrumbs');
    }
}

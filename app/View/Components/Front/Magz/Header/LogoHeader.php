<?php

namespace App\View\Components\Front\Magz\Header;

use Illuminate\View\Component;

class LogoHeader extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.front.magz.header.logo-header');
    }
}

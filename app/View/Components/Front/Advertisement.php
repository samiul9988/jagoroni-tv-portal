<?php

namespace App\View\Components\Front;

use App\Models\Advertisement as AdvertisementModel;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Advertisement extends Component
{
    public function __construct(public string $position)
    {
    }

    public function render(): View
    {
        return view('components.front.advertisement', [
            'advertisements' => AdvertisementModel::query()
                ->where('position', $this->position)
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderByDesc('id')
                ->get(),
        ]);
    }
}

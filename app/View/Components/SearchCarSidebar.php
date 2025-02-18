<?php

namespace App\View\Components;

use App\Models\CarType;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\State;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchCarSidebar extends Component
{
    public $makers;
    public $states;
    public $types;
    public $fuelTypes;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->makers = Maker::all();
        $this->states = State::all();
        $this->types = CarType::all();
        $this->fuelTypes = FuelType::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.search-car-sidebar');
    }
}

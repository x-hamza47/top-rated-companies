<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ServiceTag extends Component
{

    public $slug;
    public $icon;
    public $label;

    /**
     * Create a new component instance.
     */
    public function __construct($slug, $icon, $label)
    {
        $this->slug = $slug;
        $this->icon = $icon;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.service-tag');
    }
}

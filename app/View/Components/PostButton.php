<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostButton extends Component
{
    public string $url;
    public string $label;
    public string $class;

    /**
     * Create a new component instance.
     */
    public function __construct(string $url, string  $label = 'Submit' , string $class = "connect-btn")
    {
        $this->url = $url;
        $this->label = $label;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post-button');
    }
}

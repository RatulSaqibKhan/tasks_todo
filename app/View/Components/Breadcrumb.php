<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    /**
     * Breadcrumb Title
     */
    public $title;
    /**
     * Current Page Name
     */
    public $pageName;
     /**
     * Button Classes
     */
    public $buttonClass;
     /**
     * Button Link
     */
    public $buttonLink;
     /**
     * Button Name
     */
    public $buttonName;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = null, $pageName = null, $buttonLink = null, $buttonName = null, $buttonClass = null)
    {
        $this->title = $title;
        $this->pageName = $pageName;
        $this->buttonClass = $buttonClass;
        $this->buttonLink = $buttonLink;
        $this->buttonName = $buttonName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.breadcrumb');
    }
}

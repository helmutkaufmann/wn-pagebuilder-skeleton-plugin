<?php namespace Mercator\Pagebuilder\Components;

use Cms\Classes\ComponentBase;

class PageBuilder extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'PageBuilder Component',
            'description' => 'Drag and drop where you want the content of your page to appear.'
        ];
    }

    public function defineProperties()
    {
        return [];
    }
}

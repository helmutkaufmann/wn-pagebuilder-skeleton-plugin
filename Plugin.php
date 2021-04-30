<?php namespace Mercator\PageBuilder;

use System\Classes\PluginBase;
use Cms\Classes\Theme;
use Yaml;

/**
 * PageBuilder Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Mercator Page Builder',
            'description' => 'An Extensible Page Builder for WinterCMS',
            'author'      => 'Helmut Kaufmann',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
public function boot()
    {
     
    \Event::listen('backend.form.extendFields', function(\Backend\Widgets\Form $widget) {
    if (
        $widget
        && (($widget->getController() instanceof \Winter\Pages\Controllers\Index && $widget->model instanceof \Winter\Pages\Classes\Page) || ($widget->model instanceof \Cms\Models))
        && !$widget->isNested
    ) {
    
        $widget->addSecondaryTabFields([
            'viewBag[pagebuilder]' => [
                'tab' => 'Page Builder',
                'type' => 'repeater',
                'prompt' => "Add Page Builder Compoenent",
                "groups" => dirname(__FILE__) . '/components/partials/_pagebuilder.yaml']
        ]);
    
    }
    
    
});
    }
    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        // return []; // Remove this line to activate

        return [
            'Mercator\PageBuilder\Components\PageBuilder' => 'PageBuilder',
      ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
 public function registerPermissions()
    {
        return [
            'mercator.pagebuilder.pagebuilder' => [
                'tab' => 'Page Builder Extensions',
                'label' => 'Permission for Page Builder Extensions',
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'pagebuilder' => [
                'label'       => 'PageBuilder',
                'url'         => Backend::url('mercator/pagebuilder/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['mercator.pagebuilder.*'],
                'order'       => 500,
            ],
        ];
    }
    
	public function registerSettings()
    {
         return [
        'settings' => [
            'label'       => 'Page Builder Extensions',
            'description' => 'Configuration/Defaults',
            'category'    => 'Page Builder',
            'icon'        => 'icon-cog',
            'class'       => 'Mercator\PageBuilder\Models\Settings',
            'order'       => 500,
            'keywords'    => 'TPage Builder Extensions',
            'permissions' => ['mercator.pagebuilder.pagebuilder']
        ]
    ];


}
}

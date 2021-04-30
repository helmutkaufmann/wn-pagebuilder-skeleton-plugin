<?php namespace  Mercator\PageBuilder\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'mercator_pagebuilder_settings';

    // Reference to field configuration
    public $settingsFields = 'pagebuilder.yaml';
}

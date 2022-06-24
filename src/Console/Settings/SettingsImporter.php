<?php
namespace Noesis\Console\Settings;

trait SettingsImporter
{
    /**
     * Dictates any settings that a class may need access to
     *
     * @return array
     */
    public function settings()
    {
        return [];
    }

    /**
     * Import the setting into the class
     *
     * @param \Noesis\Console\Settings\SettingsInterface $setting
     */
    public function importSetting($setting)
    {
        $short_name = basename(str_replace('\\', '/', get_class($setting)));

        $method = 'importSetting' . $short_name;

        if (method_exists($this, $method)) {
            $this->$method($setting);
        }
    }
}

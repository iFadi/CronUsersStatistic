<?php

/**
 * This file is part of ILIAS, a powerful learning management system
 * published by ILIAS open source e-Learning e.V.
 *
 * ILIAS is licensed with the GPL-3.0,
 * see https://www.gnu.org/licenses/gpl-3.0.en.html
 * You should have received a copy of said license along with the
 * source code, too.
 *
 * If this is not the case or you just want to try ILIAS, you'll find
 * us at:
 * https://www.ilias.de
 * https://github.com/ILIAS-eLearning
 *
 ********************************************************************
 */


class ilCronUsersStatisticPlugin extends ilCronHookPlugin
{
    const PLUGIN_ID = 'cronusersstatistic';
    const PLUGIN_NAME = 'CronUsersStatistic';

    private static ?ilCronUsersStatisticPlugin $instance = null;

    public static function getInstance(): ilCronUsersStatisticPlugin
    {
        global $DIC;
        if (isset(self::$instance)) {
            return self::$instance;
        }
        /** @var ilComponentFactory $component_factory */
        $component_factory = $DIC["component.factory"];
        /** @var ilCronUsersStatisticPlugin $plugin */
        $plugin = $component_factory->getPlugin(self::PLUGIN_ID);
        return $plugin;
    }

    public function getPluginName(): string
    {
        return self::PLUGIN_NAME;
    }

    public function getPluginId(): string
    {
        return self::PLUGIN_ID;
    }

    public function getCronJobInstances(): array
    {
        return array(new ilCronUsersStatisticCronJob());
    }

    public function getCronJobInstance(string $jobId) : ilCronUsersStatisticCronJob
    {
        return new ilCronUsersStatisticCronJob($this);
    }

    /**
     * Delete the database tables, which were created for the plugin, when the plugin became uninstalled
     */
    protected function afterUninstall() : void
    {
        global $ilDB;

        if ($ilDB->tableExists('crn_usr_statistics')) {
            $ilDB->dropTable("crn_usr_statistics");
        }

        if ($ilDB->tableExists('crn_usr_settings')) {
            $ilDB->dropTable("crn_usr_settings");
        }
    }
}

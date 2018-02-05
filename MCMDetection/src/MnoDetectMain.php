<?php
/**
 * Created by PhpStorm.
 * User: kylepretorius
 * Date: 02/02/2018
 * Time: 11:14
 */


namespace MCM\MCMDetection;


use MCM\MCMDetection\Libs\MnoLoader;
use MCM\MCMDetection\Libs\MnoDBConnection;

/**
 * The core plugin class.
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
**/

class MnoDetectMain
{

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @var $loader Maintains and registers all hooks for the plugin.
     */
    protected $loader;
    /**
     * The unique identifier of this plugin.
     *
     * @var string $plugin_name The string used to uniquely identify this plugin.
     */
    protected $plugin_name;
    /**
     * The current version of the plugin.
     *
     * @var string $version The current version of the plugin.
     */
    protected $version;


    protected $dbConnection;


    public function __construct()
    {
        if (defined('HYVE_MNO_DETECT_VERSION')) {
            $this->version = HYVE_MNO_DETECT_VERSION;
        } else {
            $this->version = '2.1.2';
        }

        if (defined('HYVE_MNO_DETECT_PLUGIN_NAME')) {
            $this->plugin_name = HYVE_MNO_DETECT_VERSION;
        } else {
            $this->plugin_name = 'Hyve-MNO-Detection-Library';
        }


        /** Load the arguments */
        //$this->loader = new MnoLoader();


        /** Establish connection to the database */
        $this->dbConnection = new MnoDBConnection();

    }

    public function testConnection()
    {
        $testData = $this->dbConnection->query("SELECT * FROM wp_msisdn_store");

        var_dump($testData);
    }

}
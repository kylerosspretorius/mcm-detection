<?php
/**
 * Created by PhpStorm.
 * User: kylepretorius
 * Date: 02/02/2018
 * Time: 11:14
 */


namespace MCM\MCMDetection;


use MCM\MCMDetection\Libs\MnoDetectMcrypt;
use MCM\MCMDetection\Libs\MnoDetectHeaderEnrichment;
use MCM\MCMDetection\Libs\MnoDetectIPChecker;
use MCM\MCMDetection\Libs\MnoLoader;
use MCM\MCMDetection\Libs\MnoDBConnection;

use MCM\MCMDetection\Adapters\Http\HttpAdapter;

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


    private $httpAdapter;
    private $dbConnection;
    private $ipChecker;
    private $headerChecker;
    private $mcyptChecker;

    public function __construct(array $args)
    {

        /**
         * Automatically assign all variables from main class file on initialization
         */
        foreach ( array_merge($args['config'], $args['adapters'], $args['helpers']) as $key => $val ) {
            $this->{$key} = $val;
        }

        if (empty($this->version)) {
            $this->version = '2.0.1';
        }

        if (empty($this->version)) {
            $this->plugin_name = 'Hyve-MNO-Detection-Library';
        }

    }

    /**
     * Setting http adapter for Guzzle
     */
    public function getHttpAdapter() : HttpAdapter
    {
        return $this->httpAdapter;
    }

    /**
     * Establish connection to the database
     */
    public function getDbConnection() : MnoDBConnection
    {
        return $this->dbConnection;
    }

    /**
     * @return MnoDetectIPChecker
     * Class to include methods to extract the IP address
     */
    public function getIPChecker() : MnoDetectIPChecker
    {
        return $this->ipChecker;
    }

    /**
     * @return MnoDetectHeaderEnrichment
     * Class to include methods to extract msisdn from enriched header
     */
    public function getHeaderChecker() : MnoDetectHeaderEnrichment
    {
        return $this->headerChecker;
    }

    /**
     * @return MnoDetectCrypt
     * Class to include methods to extract msisdn from slingshot
     * Applies to Cellc only (for now) - 07-02-18
     */
    public function getMCryptChecker() : MnoDetectMcrypt
    {
        return $this->mcyptChecker;
    }

}
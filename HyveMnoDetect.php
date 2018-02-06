<?php
/**
 * Created by PhpStorm.
 * User: kylepretorius
 * Date: 01/02/2018
 * Time: 07:11
 */



require_once "vendor/autoload.php";

use MCM\MCMDetection\MnoDetectMain as MnoMain;
use MCM\MCMDetection\Libs\MnoDBConnection as DBConnection;

use MCM\MCMDetection\Adapters\Http\Guzzle as MNOGuzzle;


class HyveMnoDetect {


    CONST HYVE_MNO_DETECT_VERSION = '2.0.1';
    CONST HYVE_MNO_DETECT_PLUGIN_NAME = 'Hyve-MNO-Detection-Library';

    CONST MNO_DB_USER = 'ubuntu';
    CONST MNO_DB_PASSWORD = '';
    CONST MNO_DB_DATABASE = 'MCMCampaign';
    CONST MNO_DB_SERVER = 'localhost';

    protected $package_name;

    protected $version;

    public $mno_package;

    /**
     * @var HyveMnoDetect
     */
    private $client;


    public function __construct()
    {

        $this->client = new MnoMain([
            'config' => [
                'db_username' => SELF::MNO_DB_USER,
                'db_password' => SELF::MNO_DB_PASSWORD,
                'db_database' => SELF::MNO_DB_DATABASE,
                'db_server' => SELF::MNO_DB_SERVER,
            ],
            'adapters' => [
                'httpAdapter' => new MNOGuzzle(),
            ],
            'helpers' => [
                'MnoConnection' => new DBConnection(),
            ]
        ]);

        $this->client->detect($payload);

    }


}
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
use MCM\MCMDetection\Libs\MnoDetectIPChecker as IPChecker;
use MCM\MCMDetection\Libs\MnoDetectHeaderEnrichment as HeaderChecker;

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
            ],
            'adapters' => [
                'httpAdapter' => new MNOGuzzle(),
            ],
            'helpers' => [
                'dbConnection' => new DBConnection(
                    SELF::MNO_DB_USER,
                    SELF::MNO_DB_PASSWORD,
                    SELF::MNO_DB_DATABASE,
                    SELF::MNO_DB_SERVER
                ),
                'ipchecker' => new IPChecker(),
                'headerChecker' => new HeaderChecker()
            ]
        ]);
    }

    public function detect($payload = null) : array
    {

        /**
         * Run through test case scenarios
         * Steps 1-4
         */
        if(empty($payload))
        {
            throw new Exception('No payload was provided!');
        }

        /** Go through header enrichment */
        $headerChecker = $this->client->getHeaderChecker();
        $msisdnResult = $headerChecker->getHeaderEnrichedMsisdn($payload);


        /** Go through MCrypt */
        if(empty($msisdnResult))
        {
            $mcryptChecker = $this->client->getMCryptChecker();
            $msisdnResult = $mcryptChecker->somefunction();
        }

        /** Grab IP Address */
        $ipChecker = $this->client->getIPChecker();
        $ipResults = $ipChecker->check($payload);

        /** If previous return null - user has to input msisdn */
        if(empty($msisdnResult) && empty($ipResults))
        {
            return null;
        }

        return array (
            'msisdn' => $msisdnResult,
            'ipaddress' => $ipResults
        );

    }


}
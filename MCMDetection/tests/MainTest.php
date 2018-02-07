<?php
/**
 * Created by PhpStorm.
 * User: kylepretorius
 * Date: 29/01/2018
 * Time: 10:58
 */

namespace MCM\MCMDetection\Tests;

use PHPUnit\Framework\TestCase;

use MCM\MCMDetection\MnoDetectMain as MnoMain;
use MCM\MCMDetection\Libs\MnoDBConnection as DBConnection;
use MCM\MCMDetection\Libs\MnoDetectIPChecker as IPChecker;
use MCM\MCMDetection\Libs\MnoDetectHeaderEnrichment as HeaderChecker;

use MCM\MCMDetection\Adapters\Http\Guzzle as MNOGuzzle;

class MainTest extends TestCase {

    CONST HYVE_MNO_DETECT_VERSION = '2.0.1';
    CONST HYVE_MNO_DETECT_PLUGIN_NAME = 'Hyve-MNO-Detection-Library';

    CONST MNO_DB_USER = 'ubuntu';
    CONST MNO_DB_PASSWORD = '';
    CONST MNO_DB_DATABASE = 'MCMCampaign';
    CONST MNO_DB_SERVER = 'localhost';

    private $client;

    public function testMustMatch()
    {

        $this->client = new MnoMain([
                            'config' => [
                                'db_username' => SELF::MNO_DB_USER,
                            ],
                            'adapters' => [
                                'httpAdapter' => new MNOGuzzle(),
                            ],
                            'helpers' => [
                                'dbConnection' => new DBConnection(SELF::MNO_DB_USER, SELF::MNO_DB_PASSWORD, SELF::MNO_DB_DATABASE, SELF::MNO_DB_SERVER),
                                'ipchecker' => new IPChecker(),
                                'headerChecker' => new HeaderChecker()
                            ]
                        ]);

        $payload = 'testpayload';

        //$testcase1  = $this->client->getDbConnection()->query('SELECT * FROM wp_msisdn_store');



        var_dump($payload);

//        $this->assertEquals(
//            'working!',
//            $testcase1
//        );
    }



}
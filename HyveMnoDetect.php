<?php
/**
 * Created by PhpStorm.
 * User: kylepretorius
 * Date: 01/02/2018
 * Time: 07:11
 */


define('HYVE_MNO_DETECT_VERSION', '2.0.1');
define('HYVE_MNO_DETECT_PLUGIN_NAME', 'Hyve-MNO-Detection-Library');

define('MNO_DB_USER', "ubuntu"); // db user
define('MNO_DB_PASSWORD', ""); // db password (mention your db password here)
define('MNO_DB_DATABASE', "MCMCampaign"); // database name
define('MNO_DB_SERVER', "localhost"); // db server



require_once "vendor/autoload.php";

use MCM\MCMDetection\MnoDetectMain as MnoMain;


class HyveMnoDetect {


    protected $package_name;

    protected $version;

    public $mno_package;


    public function __construct() {

        $mno_package = new MnoMain();

        $mno_package->testConnection();

    }


}
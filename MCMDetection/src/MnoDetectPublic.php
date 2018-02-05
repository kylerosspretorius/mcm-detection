<?php
/**
 * Created by PhpStorm.
 * User: kylepretorius
 * Date: 29/01/2018
 * Time: 09:42
 */

namespace MCM\MCMDetection;

class MnoDetectPublic {


    /**
     * API retries
     */
    const API_TIMEOUT_ERROR = "/^Operation timed out after [0-9]{4} milliseconds with 0 bytes received$/";
    /**
     *
     */
    const API_RETRIES = 3;
    /**
     * @var int
     */
    private $retries;
    /**
     * The ID of this plugin.
     *
     * @var string $plugin_name The ID of this plugin.
     */
    private $plugin_name;
    /**
     * Plugin Version
     *
     * @var string $version The current version of this plugin.
     */
    private $version;
    /**
     * API Information
     *
     * @var string $api_url      The API URL for Hyve API
     * @var array  $api_defaults Predefined credentials for Hyve API
     */
    private
        $api_url = 'http://hyvesdp.com/api',  // Live
        $api_version = 'v2',
        $api_defaults = [
        'username' => 'onnet',
        'password' => 'onnetportal',
        'version'  => '1.0',
    ];
    /**
     * NPD API Details
     *
     * @var string $npd_api_url
     */
    private $npd_api_url = 'http://npd.hyve.co.za/api/1.0/msisdn/';
    /**
     * Template Statuses
     * See @function get_template_status_slug() for template names
     */
    const
        STATUS_PROCESS = 1,
        STATUS_INTERNAL_DOI = 1.1,
        STATUS_SUCCESS = 2,
        STATUS_SUCCESS_USSD = 2.1,
        STATUS_ERROR = 3,
        STATUS_FORBIDDEN = 3.1,
        STATUS_DECLINED = 3.2,
        STATUS_DISABLE_WIFI = 3.3,
        STATUS_THANK_YOU = 4,
        STATUS_THANK_YOU_FORCED = 4.1,
        STATUS_ALREADY_SUBSCRIBED = 4.2,
        STATUS_DUPLICATE_REQUEST = 4.3,
        STATUS_THANK_YOU_CROSS_SELL = 4.4;
    /**
     *
     */
    const
        DOI_ACTION_TEXT = 'textdoi',
        DOI_ACTION_WAP = 'wapdoi',
        DOI_ACTION_USSD = 'ussddoi';
    /**
     * Auto detection types
     */
    const
        USER_INPUT = 1,
        NETWORK_INPUT = 2;
    /**
     * @var int $input_type
     */
    private $input_type;

    public function __construct($package_name = 'MCMDetection', $version = 1) {

        $this->package_name = $package_name;
        $this->version = $version;

    }

    public function test()
    {

        return "working!";

    }




}
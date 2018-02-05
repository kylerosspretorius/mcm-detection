<?php
/**
 * Created by PhpStorm.
 * User: kylepretorius
 * Date: 31/01/2018
 * Time: 14:22
 */


class Sanitizer {


    protected $api_url;

    protected $api_version;


    /**
     * Santize the Hyve API url
     *
     * @param array  $args     required endpoint arguments
     * @param string $endpoint the endpoint to call starting with a slash /
     * @param bool   $api_version
     *
     * @return array
     */
    public function sanitize_hyve_url($args = [], $endpoint = '', $api_version = false)
    {
        // Base URL
        $url = $this->api_url;

        // Decide the version
        if ($api_version === false) {
            $url .= DIRECTORY_SEPARATOR . $this->api_version;
        }
        if (!empty($api_version)) {
            $url .= DIRECTORY_SEPARATOR . $api_version;
        }

        // Add the endpoint
        //$url = add_query_arg(wp_parse_args($args, $this->api_defaults), $url . $endpoint);

        return $url = '';
    }

    /**
     * Sanitize the msisdn according to country
     *
     * @param string $uid
     *
     * @return string
     */
    public function sanitize_uid($uid = '')
    {
        try {
            $msisdn = trim($uid);
            $phoneNumberUtil = PhoneNumberUtil::getInstance();
            $phoneNumber = $phoneNumberUtil->parse($msisdn, get_country_code_iso(), null, true);
            $validNumber = $phoneNumberUtil->isValidNumber($phoneNumber);

            if (!$validNumber) {
                throw new Exception('Not valid MSISDN');
            }

            // Format MSISDN
            $formatNumber = $phoneNumberUtil->format($phoneNumber, PhoneNumberFormat::E164);
            $msisdn = str_replace("+", "", $formatNumber);

            return $msisdn;
        } catch (Exception $e) {
            mcm_log('Failed Sanitize UID', [
                'log'     => 'Failed Sanitize UID',
                'code'    => $e->getCode(),
                'message' => $e->getMessage(),
            ]);

            return false;
        }
    }

}
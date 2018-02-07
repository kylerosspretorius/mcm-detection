<?php
/**
 * Created by PhpStorm.
 * User: kylepretorius
 * Date: 02/02/2018
 * Time: 10:50
 */

namespace MCM\MCMDetection\Libs;

class MnoDetectHeaderEnrichment {


    private $possibleHeaders;


    public function __construct()
    {

    }

    public function detectHeaderEnrichment()
    {
        $possible_headers = [
            'HTTP_MSISDN',
            'HTTP_IMISDN',
            'HTTP_X_MSISDN',
            'HTTP_Y_MSISDN',
            'HTTP_X_NETWORK_INFO',
            'HTTP_X_WAP_MSISDN',
            'HTTP_X_BAM_MSISDN',
            'HTTP_X_NOKIA_BEARER',
            'HTTP_X_NOKIA_GATEWAY_ID',
            'HTTP_X_NOKIA_IPADDRESS',
            'HTTP_X_NOKIA_MSISDN',
            'HTTP_X_UP_CALLING_LINE_ID',
            'HTTP_X_WAP_NETWORK_CLIENT_MSISDN',
            'HTTP_X_MSP_MSISDN',
        ];

        // Check the headers
        foreach ($possible_headers as $network) {
            if (isset($_SERVER[$network]) && !empty($_SERVER[$network])) {
                return $_SERVER[$network];
            }
        }

        return false;
    }

    /**
     * Return the MSISDN from the enriched header if it's available.
     *
     * @param string $msisdn
     *
     * @return string msisdn
     */
    public function getHeaderEnrichedMsisdn($msisdn = '')
    {
        // Check for an MSISDN
        if (empty($msisdn)) {
            $enriched_msisdn = $this->detectHeaderEnrichment();
            $msisdn = apply_filters('friendly_uid', $enriched_msisdn);
        }

        if (isset($_COOKIE['wp_mcm_msisdn_hash'])) {
            // Decode the MSISDN from the cookie
            $encrypt = new \JaegerApp\Encrypt();
            $encrypt->setKey(AUTH_SALT);
            $decoded_msisdn = $encrypt->decode($_COOKIE['wp_mcm_msisdn_hash']);
            $enriched_msisdn = $this->detectHeaderEnrichment();

            // Invalid encryption
            if (false === $decoded_msisdn) {
                setcookie('wp_mcm_msisdn_hash', null, time() + -1);
            }

            // Invalid match from header enrichment
            if (!empty($enriched_msisdn) && $enriched_msisdn !== $decoded_msisdn) {

                if (!headers_sent()) {
                    setcookie('wp_mcm_msisdn_hash', null, time() + -1);
                    setcookie('wp_mcm_msisdn_hash', $encrypt->encode($enriched_msisdn), time() + (60 * 60 * 24 * 31), '/');
                }

                $msisdn = $enriched_msisdn;
            }

            // Use this msisdn
            if (empty($enriched_msisdn) && !empty($decoded_msisdn)) {
                $msisdn = $decoded_msisdn;
            }
        }

        return $msisdn;
    }




}
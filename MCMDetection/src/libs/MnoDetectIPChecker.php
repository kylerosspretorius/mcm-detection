<?php
/**
 * Created by PhpStorm.
 * User: kylepretorius
 * Date: 07/02/2018
 * Time: 10:29
 */
namespace MCM\MCMDetection\Libs;

class MnoDetectIPChecker {

    private $ipRanges;

    public function __construct($payload = null)
    {
        if(!empty($payload))
        {
            $split = explode("\n", $payload);
            $this->ipRanges = array();

            foreach ($split as $row)
            {
                $content = trim($row);
                if (!empty($content))
                {
                    $rangeSplit = explode('/', $content);
                    $this->ipRanges[] = array('netAddr' => trim($rangeSplit[0]), 'netMask' => trim($rangeSplit[1]));
                }
            }
        }
    }

    public function check($ip)
    {
        if (empty($this->ipRanges))
        {
            return false;
        }
        foreach ($this->ipRanges as $range)
        {
            if ($this->ipInNetwork($ip, $range['netAddr'], $range['netMask'])) {
                return true;
            }
        }

        return false;
    }

    private function ipInNetwork($ip, $netAddr, $netMask)
    {
        if ($netMask <= 0) {
            return false;
        }
        $ipBinaryString = sprintf("%032b", ip2long($ip));
        $netBinaryString = sprintf("%032b", ip2long($netAddr));

        return (substr_compare($ipBinaryString, $netBinaryString, 0, $netMask) === 0);
    }


}
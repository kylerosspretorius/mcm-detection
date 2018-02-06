<?php
/**
 * Created by PhpStorm.
 * User: kylepretorius
 * Date: 05/02/2018
 * Time: 10:53
 */

namespace MCM\MCMDetection\Libs;

use HyveMnoDetect;

class MnoDBConnection
{

    private $host;
    private $user;
    private $pass;
    private $db;

    public $connection;

    function __construct()
    {
        $this->connect();
    }

    function __destruct()
    {
        $this->close();
    }

    function connect()
    {

        $this->host = empty(defined('MNO_DB_SERVER')) ? 'localhost' : defined('MNO_DB_SERVER');
        $this->user = empty(defined('MNO_DB_USER')) ? 'ubuntu' : defined('MNO_DB_USER');
        $this->pass = empty(defined('MNO_DB_PASSWORD')) ? '' : defined('MNO_DB_PASSWORD');
        $this->db = empty(defined('MNO_DB_DATABASE')) ? 'MCMCampaign' : defined('MNO_DB_DATABASE');

        var_dump($this->host . ' ' .  $this->user . ' ' .  $this->pass . ' ' . $this->db);
        try {

            $this->connection = new \mysqli( $this->host, $this->user, $this->pass, $this->db );


        } catch (\Exception $e){
            $error = $e->getMessage();
            return $error;
        }

        return $this->connection;
    }

    public function get_results($query)
    {
        return $this->connection->query($query);
    }

    function close()
    {
        try {
            mysqli_close( $this->connection );

        } catch (\Exception $e){
            $error = $e->getMessage();
            return $error;
        }
    }
}
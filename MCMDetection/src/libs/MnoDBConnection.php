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

    function __construct($user, $password, $database, $host = 'localhost')
    {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $password;
        $this->db = $database;


        /** EXAMPLE OF USAGE
         * $db = new DB('root', '', 'test');
         * print_r($db->select('SELECT * FROM objects WHERE ID = ?', array(10), array('%d')));
         */
    }

    function __destruct()
    {
        $this->close();
    }

    function connect()
    {

        try {

            $this->connection = new \mysqli( $this->host, $this->user, $this->pass, $this->db );

        } catch (\Exception $e){
            $error = $e->getMessage();
            return $error;
        }


        return $this->connection;
    }

    public function query($query)
    {
        $db = $this->connect();

        $result = $db->query($query);

        while ( $row = $result->fetch_object() )
        {
            $results[] = $row;
        }

        return $results;
    }

    public function select($query, $data = null, $format = null)
    {
        // Connect to the database
        $db = $this->connect();

        //Prepare our query for binding
        $stmt = $db->prepare($query);

        //Normalize format
        $format = implode('', $format);
        $format = str_replace('%', '', $format);

        // Prepend $format onto $values
        array_unshift($data, $format);

        //Dynamically bind values
        call_user_func_array( array( $stmt, 'bind_param'), $this->ref_values($data));

        //Execute the query
        $stmt->execute();

        //Fetch results
        $result = $stmt->get_result();

        //Create results object
        while ($row = $result->fetch_object()) {
            $results[] = $row;
        }
        return $results;
    }

    public function delete($table, $id) {
        // Connect to the database
        $db = $this->connect();

        // Prepary our query for binding
        $stmt = $db->prepare("DELETE FROM {$table} WHERE ID = ?");

        // Dynamically bind values
        $stmt->bind_param('d', $id);

        // Execute the query
        $stmt->execute();

        // Check for successful insertion
        if ( $stmt->affected_rows ) {
            return true;
        }
    }
    private function prep_query($data, $type='insert')
    {
        // Instantiate $fields and $placeholders for looping
        $fields = '';
        $placeholders = '';
        $values = array();

        // Loop through $data and build $fields, $placeholders, and $values
        foreach ( $data as $field => $value ) {
            $fields .= "{$field},";
            $values[] = $value;

            if ( $type == 'update') {
                $placeholders .= $field . '=?,';
            } else {
                $placeholders .= '?,';
            }

        }

        // Normalize $fields and $placeholders for inserting
        $fields = substr($fields, 0, -1);
        $placeholders = substr($placeholders, 0, -1);

        return array( $fields, $placeholders, $values );
    }

    private function ref_values($array)
    {
        $refs = array();
        foreach ($array as $key => $value)
        {
            $refs[$key] = &$array[$key];
        }
        return $refs;
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
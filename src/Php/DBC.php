<?php 

namespace Nefuzz\Php;

class DBC { 
    private $db;
    private $errors;

    function __construct() {
        include("dbinfo.php");
        $mysqli = new mysqli($DBservername, $DBusername, $DBpassword, $DBname);
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            $this->db = null;
            exit();
        }
        $this->errors = "";
        $this->db = $mysqli;
    }

    function refValues($arr){
        if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
        {
            $refs = array();
            foreach($arr as $key => $value)
                $refs[$key] = &$arr[$key];
            return $refs;
        }
        return $arr;
    }

    function query($statement, $types = "" , $arguments = [], $verbose = false) {
        if($verbose){
            mysqli_report(MYSQLI_REPORT_ALL);
            error_reporting(E_ALL);
            var_dump($statement);
            echo '<br/>';
            var_dump($types);
            echo '<br/>';
            var_dump($arguments);
        }
        if (!empty($arguments)) {
            $stmt = $this->db->prepare($statement);
            if ($stmt !== FALSE) {
                call_user_func_array(array($stmt, 'bind_param'), $this->refValues(array_merge([$types], $arguments)));
                $worked = $stmt->execute();
                if (!$worked) {
                    $this->errors .= $stmt->error;
                    return false;
                }
                $this->errors .= $stmt->error;
                $results = $stmt->get_result();
                if (!$results) {
                    $results = $worked; 
                }
                $stmt->close();
            } else {
                $this->errors .= $this->db->error;
                return false;
            }
         } else {
            $results = $this->db->query($statement);
            $this->errors .= $this->db->error;
        }
        return $results;
    }

    function get_insert_id() {
        return $this->db->insert_id;
    }

    function query_to_array($statement, $types = "" , $arguments = [], $verbose = false) {
        if($verbose){
            mysqli_report(MYSQLI_REPORT_ALL);
            var_dump($statement);
            echo '<br/>';
            var_dump($types);
            echo '<br/>';
            var_dump($arguments);
        }
        if (!empty($arguments)) {
            if ($stmt = $this->db->prepare($statement)) {
                call_user_func_array(array($stmt, 'bind_param'), $this->refValues(array_merge([$types], $arguments)));
                if (!$stmt->execute()) {
                    $this->errors .= $stmt->error;
                    return false;
                }
                $results = $stmt->get_result();
                $stmt->close();
            } else {
                return false;
            }
         } else {
            $results = $this->db->query($statement);
        }
        $this->errors .= $this->db->error;
        $array = array();
        while($row = $results->fetch_assoc())
            array_push($array, $row);
        return $array;
    }

    function quit() {
        $this->db->close();
    }

    function get_errors() {
        return $this->errors;
    }
} 

?>
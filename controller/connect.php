<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DB {

    protected $dbName = 'album';
    protected $dbUser = 'root';
    protected $dbPass = '';
    protected $dbHost = 'localhost';

    //Constructor for connection
    public function __construct() {
        $this->conn = new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);

//      Check connection
        if ($this->conn->connect_error) {

            die("Connection failed: " . $this->conn->connect_error);
        }
    }

//For Show the all user
    public function selectQuery($columnName, $tableName, $condition, $extra) {
        $sql = "SELECT " . $columnName . " FROM " . $tableName . " " . $condition . " " . $extra;
       // echo $sql;
//        exit;
        $result = $this->conn->query($sql);
                //echo $result;
       // exit;
        return $result;
    }


//    //For Create new user
    function createQuery($tableName, $attributes, $values) {
//        echo "INSERT INTO $tableName ($attributes) VALUES ($values)";
//        exit;
        $insert = $this->conn->query("INSERT INTO $tableName ($attributes) VALUES ($values)");
        // echo $insert;exit;
        return $insert;
    }


//    //For Update a user
    function updateQuery($tableName, $values) {

        return $this->conn->query("UPDATE $tableName SET $values");

    }

//    //For Delete a user
    function deleteQuery($tableName, $id) {
//        echo "DELETE FROM  $tableName  WHERE id = ".$id;
//        exit;
        return $this->conn->query("DELETE FROM  $tableName  WHERE id = ".$id);
    }
    //$this->conn->close();
//End of Class
}

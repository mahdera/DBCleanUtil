<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DBConnection
 *
 * @author Mahder
 */
class DBConnection {//make sure the server doesnot have a password and the user is the default 'root'
    private $host;
    private $username;
    private $password;
    private $port;
    
    public function __construct($host, $username, $password, $port) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->port = $port;
    }
    
    public function getHost() {
        return $this->host;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getPort() {
        return $this->port;
    }

    public function setHost($host) {
        $this->host = $host;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setPort($port) {
        $this->port = $port;
    }

    
    public function connect(){        
        $connection = mysql_pconnect($this->host, $this->username, $this->password);        
        return $connection;
    }

    public function executeQuery($databaseName, $query){
        $dbConnection = $this->connect();        
        mysql_select_db($databaseName, $dbConnection);
        $result = mysql_query($query);
        return $result;
    }

    public function readFromDatabase($query){    	  
        $result = $this->executeQuery($query);
        return $result;
    }
    
    public function getListOfDatabasesFromTheConnection(){
        $query = "select schema_name from information_schema.schemata";
        $dbConnection = $this->connect();
        mysql_select_db('information_schema', $dbConnection);
        $result = mysql_query($query);
        return $result;
    }
    
    public function getListOfTablesFromDatabase($database){
        $query = "show tables from $database";
        $dbConnection = $this->connect();
        mysql_select_db($database, $dbConnection);
        $result = mysql_query($query);
        return $result;
    }
    
    public function getListOfColumnsFromTable($database, $table){
        $query = "describe " . $database . "." .$table;
        $dbConnection = $this->connect();
        mysql_select_db($database, $dbConnection);
        $result = mysql_query($query);
        return $result;
    }
}//end class
?>

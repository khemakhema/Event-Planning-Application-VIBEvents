<?php
abstract class db {

protected $connection;

public function __construct($host, $username, $password, $db_name = NULL) {
$this->connection = new mysqli($host, $username, $password, $db_name);
}

public function select_db($db_name) {
$this->$connection->select_db($db_name);
}


}
class RateClass extends db {
public function __construct($host, $username, $password, $db_name) {
        parent::__construct($host, $username, $password, $db_name);
        
    }



 
}

?>
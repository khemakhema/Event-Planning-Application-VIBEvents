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

class CreateLocation extends db {
private $locationName;
private $address;
private $email;
private $maxAttendess;
private $description;
private $owner;
private $v;
    public function __construct($host, $username, $password, $db_name, $LocationName, $Address, $Email, $Owner, $MaxAttendess, $Description, $V) {
        parent::__construct($host, $username, $password, $db_name);
        $this->locationName = $this->connection->real_escape_string($LocationName);
        $this->address = $this->connection->real_escape_string($Address);
        $this->email = $this->connection->real_escape_string($Email);
        $this->maxAttendess = $this->connection->real_escape_string($MaxAttendess);
        $this->description = $this->connection->real_escape_string($Description);
        $this->owner = $this->connection->real_escape_string($Owner);
$this->v = $V;
    }
    
    
    public function insertLocations() {
        $query = "INSERT INTO Location (location_name, address, email, owner, max_attendees, description) VALUES ('$this->locationName', '$this->address', '$this->email', '$this->owner', '$this->maxAttendess', '$this->description')";
        
if(!$this->connection->query($query)) return false;

        $query1 = "INSERT INTO LocationData (location_name, datesTaken, eventTypesSponsored) VALUES ('$this->locationName', '', '$this->v')";
        if($this->connection->query($query1)) {
            return true;
        }
 return false;

    }
   
 

}


?>
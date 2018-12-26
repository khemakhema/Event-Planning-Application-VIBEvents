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

class Manage extends db {

    public function __construct($host, $username, $password, $db_name) {
        parent::__construct($host, $username, $password, $db_name);
    }
    
    public function createEvent() {
        
    }
    
    public function displayAllLocations() {
        $query = "SELECT location_name, address, max_attendees, rating FROM Location";
        $result = $this->connection->query($query);
        
         if(mysqli_num_rows($result)>=1) {
             echo "<select class='form-control' name='locations'>";
            while ($row = $result->fetch_assoc()) {
                echo '<option> Location ' . $row["location_name"] . ' Address:' .  $row["address"]. ' Max Attendees: ' . $row['max_attendees'] . ' Rating:' . $row["rating"] . '</option>';
  
            }
             echo "</select>";
    }
    
   
    
    
    
   
    
}

}


?>
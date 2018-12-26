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
class Profile extends db {
public function __construct($host, $username, $password, $db_name) {
        parent::__construct($host, $username, $password, $db_name);
        
    }
    
    
    public function getProfileInformation($Username) {
$Username = $this->connection->real_escape_string($Username);
        $query = "SELECT username, email, firstname, lastname, phoneNumber,homeAddress FROM Users WHERE username = '$Username'";
        $spaceDelmittedInfo = "";
           $result = $this->connection->query($query);
        
         if(mysqli_num_rows($result)>=1) {
            
            while ($row = $result->fetch_assoc()) {
                $spaceDelmittedInfo .= $row["username"] . " ";
                $spaceDelmittedInfo .= $row["email"] . " ";
                $spaceDelmittedInfo .= $row["firstname"] . " ";
                $spaceDelmittedInfo .= $row["lastname"] . " ";
                $spaceDelmittedInfo .= $row["phoneNumber"] . " ";
                $spaceDelmittedInfo .= $row["homeAddress"];
            }
            
    }
        return $spaceDelmittedInfo;
    }

 
}

?>
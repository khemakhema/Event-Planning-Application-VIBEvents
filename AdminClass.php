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

class Admin extends db {
    private $username;
    private $email;
    private $firstName;
    private $lastName;
    private $password;
    private $phoneNumber;
    private $homeAddress;
    
    public function __construct($host, $username, $password, $db_name, $Username, $Email, $FirstName, $Password, $LastName, $PhoneNumber, $HomeAddress) {
        parent::__construct($host, $username, $password, $db_name);
        $this->username = $this->connection->real_escape_string($Username);
        $this->email = $this->connection->real_escape_string($Email);
        $this->firstName = $this->connection->real_escape_string($FirstName);
        $this->password = password_hash($Password, PASSWORD_DEFAULT);
        $this->lastName = $this->connection->real_escape_string($LastName);
        $this->phoneNumber = $this->connection->real_escape_string($PhoneNumber);
        $this->homeAddress = $this->connection->real_escape_string($HomeAddress);
    }
    
    
    public function createUserTable() {
        $query = "CREATE TABLE Users (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        firstname VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        lastname VARCHAR(255) NOT NULL,
        phoneNumber VARCHAR(255) NOT NULL,
        homeAddress VARCHAR(255) NOT NULL
        )";
        $this->connection->query($query);
    }
    
    
    public function insertData() {
        $query = "INSERT INTO Users (username, email, firstname, password, lastname, phoneNumber, homeAddress) VALUES('$this->username', '$this->email', '$this->firstName', '$this->password', '$this->lastName', '$this->phoneNumber', '$this->homeAddress')";
        if($this->connection->query($query)) {
            echo "<div class='text-primary' style = 'text-align:center; font-size: 150%;font-weight: 600;'>You Have Successfully Registered</div>";
        }
    }
    
    
    public function checkEmailExists($email) {
        $query = "SELECT email FROM Users WHERE email='$email'";
        $sql = $this->connection->query($query);
        if(mysqli_num_rows($sql)>=1)
   {
    echo"<div class='text-danger' style = 'text-align:center; font-size: 150%;font-weight: 600;'>Email already exists</div>";
            return true;
   }
 else
    {
   return false;
    }
    }
    
       public function checkUserNameExists($username) {
        $query = "SELECT username FROM Users WHERE username='$username'";
        $sql = $this->connection->query($query);
        if(mysqli_num_rows($sql)>=1)
   {
    echo"<div class='text-danger' style = 'text-align:center; font-size: 150%;font-weight: 600;'>Username already exists</div>";
            return true;
   }
 else
    {
   return false;
    }
    }
    
    
    public function insertDataMobile() {
 $query = "INSERT INTO Users (username, email, firstname, password, lastname, phoneNumber, homeAddress) VALUES('$this->username', '$this->email', '$this->firstName', '$this->password', '$this->lastName', '$this->phoneNumber', '$this->homeAddress')";
        if($this->connection->query($query)) {
            
        }
    }
   
    
}



?>
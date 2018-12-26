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

class User extends db {
    private $username;
    private $email;
    private $firstName;
    private $lastName;
    private $password;
    private $phoneNumber;
    private $homeAddress;
    
    public function __construct($host, $username, $password, $db_name, $Username, $Email, $FirstName, $Password, $LastName, $PhoneNumber, $HomeAddress) {
        parent::__construct($host, $username, $password, $db_name);
        $this->username = htmlspecialchars($this->connection->real_escape_string($Username));
        $this->email = htmlspecialchars($this->connection->real_escape_string($Email));
        $this->firstName = htmlspecialchars($this->connection->real_escape_string($FirstName));
        $this->password = password_hash(htmlspecialchars($this->connection->real_escape_string($Password)), PASSWORD_DEFAULT);
        $this->lastName = htmlspecialchars($this->connection->real_escape_string($LastName));
        $this->phoneNumber = htmlspecialchars($this->connection->real_escape_string($PhoneNumber));
        $this->homeAddress = htmlspecialchars($this->connection->real_escape_string($HomeAddress));
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


public function insertResetTable() {
$un = $this->uniqidReal();
$query = "INSERT INTO resetPasswordTable (usernameOrCompanyName, type, resetLink) VALUES ('$this->username', 'user', '$un')";
$this->connection->query($query);
}

function uniqidReal($lenght = 13) {
    // uniqid gives 13 chars, but you could adjust it to your needs.
    if (function_exists("random_bytes")) {
        $bytes = random_bytes(ceil($lenght / 2));
    } elseif (function_exists("openssl_random_pseudo_bytes")) {
        $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
    } else {
        throw new Exception("no cryptographically secure random function available");
    }
    return substr(bin2hex($bytes), 0, $lenght);
}
   
    
}



?>
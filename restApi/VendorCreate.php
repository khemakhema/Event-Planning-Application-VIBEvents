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

class VendorCreate extends db {
    private $companyName;
    private $email;
    private $password;
    private $description;
    
    public function __construct($host, $username, $password, $db_name, $CompanyName, $Email, $Password, $Description) {
        parent::__construct($host, $username, $password, $db_name);
        $this->companyName = $CompanyName;
        $this->email = $Email;
        $this->password = password_hash($Password, PASSWORD_DEFAULT);
        $this->description = $Description;
    }
    
    public function insertVendor() {
          $query = "INSERT INTO Vendor (companyName, password, email, description) VALUES('$this->companyName', '$this->password', '$this->email', '$this->description')";
        if($this->connection->query($query)) {
            echo "<div class='text-primary' style = 'text-align:center; font-size: 150%;font-weight: 600;'>You Have Successfully Registered</div>";
        }
        else {
            echo "<div class='text-danger' style = 'text-align:center; font-size: 150%;font-weight: 600;'>Something Went Wrong Try Again Later</div>";
        }
        }

 public function insertVendorMobile() {
          $query = "INSERT INTO Vendor (companyName, password, email, description) VALUES('$this->companyName', '$this->password', '$this->email', '$this->description')";
        if($this->connection->query($query)) {
            return true;
        }
        else {
            return false;
        }
        }
    
    
    
    public function createVendorTable() {
        $query = "CREATE TABLE Vendor(
        companyName VARCHAR(255) PRIMARY KEY,
        password VARCHAR(255) NOT NULL,
        rating DECIMAL(3,2) DEFAULT 5.00,
        email VARCHAR(255) NOT NULL,
        description VARCHAR(255) NOT NULL
        )";
        $this->connection->query($query);
    }


public function insertResetTable() {
$un = $this->uniqidReal();
$query = "INSERT INTO resetPasswordTable (usernameOrCompanyName, type, resetLink) VALUES ('$this->companyName', 'company', '$un')";
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
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
class UserLogin extends db {
public function __construct($host, $username, $password, $db_name) {
        parent::__construct($host, $username, $password, $db_name);
        
    }

 public function login($username, $password) {
$username = $this->connection->real_escape_string($username);
$password =$this->connection->real_escape_string($password);
        $query = "SELECT username, password FROM Users WHERE username = '$username'";
        $result = $this->connection->query($query);
    
        if(mysqli_num_rows($result)>=1) {
            while ($row = $result->fetch_assoc()) {
                if($row["username"] === $username && password_verify($password, $row["password"])) {
                    echo "<div class='text-primary' style = 'text-align:center; font-size: 150%;font-weight: 600;'>You have been sucessfully logged in</div>";
                    session_start();
                    $_SESSION["username"] = $row["username"];
                    header("Location: Home.php");
                }
                else {
                     echo"<div class='text-danger' style = 'text-align:center; font-size: 150%;font-weight: 600;'>Invalid Username and Password Combination</div>";
                }
            }
        }
        else {
            echo"<div class='text-danger' style = 'text-align:center; font-size: 150%;font-weight: 600;'>There is no Such User</div>";
        }
    }
}

?>
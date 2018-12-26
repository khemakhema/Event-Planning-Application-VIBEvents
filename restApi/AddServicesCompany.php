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

class AddServices extends db {
    private $companyName;
    private $e1;
    private $s1;
    public function __construct($host, $username, $password, $db_name, $CompanyName, $E1, $S1) {
        parent::__construct($host, $username, $password, $db_name);
        $this->companyName = $this->connection->real_escape_string($CompanyName);
        $this->e1 = $E1;
        $this->s1 = $S1;
    }
    
    public function createVendorDataTable() {
        $query = "CREATE TABLE VendorData (
        companyName VARCHAR(255) NOT NULL,
        eventsServiced VARCHAR(255),
        servicesOffered VARCHAR(255),
        FOREIGN KEY (companyName) REFERENCES Vendor(companyName)
        )";
        $this->connection->query($query);
    }
    
    public function insertService($data) {
$data = $this->connection->real_escape_string($data);

        
        $query = "INSERT INTO VendorData (companyName, eventsServiced, servicesOffered) VALUES('$this->companyName', '$this->e1', '$this->s1')";
        if($this->connection->query($query)) return true;
return false;

    }
    
    public function insertEvent($data) {
$data = $this->connection->real_escape_string($data);
        $query = "INSERT INTO VendorData (companyName, eventsServiced, servicesOffered) VALUES('$this->companyName', '$data', '')";
        $this->connection->query($query);
    }
    
    public function insert() {
       
            $this->insertService($data);
        
        
        
    }
    
    
    
    
   
    
}



?>
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

class Event extends db {
    
    private $manage;
    public function __construct($host, $username, $password, $db_name) {
        parent::__construct($host, $username, $password, $db_name);
       
    }
    
        public function displayAllLocations($type) {
$type = $this->connection->real_escape_string($type);
        $query = "SELECT DISTINCT l.location_name, l.address, l.max_attendees, l.rating FROM Location l, LocationData ld WHERE l.location_name = ld.location_name AND ld.eventTypesSponsored = '$type'";
        $result = $this->connection->query($query);
        
         if(mysqli_num_rows($result)>=1) {
             echo "Locations:<select class='form-control' name='locations'>";
            while ($row = $result->fetch_assoc()) {
                echo '<option> Location ' . $row["location_name"] . ' Address:' .  $row["address"]. ' Max Attendees: ' . $row['max_attendees'] . ' Rating:' . $row["rating"] . '</option>';
  
            }
             echo "</select>";
    }
    
   
    
    
    
   
    
}

public function displayAllLocationMobile($type) {
$type = $this->connection->real_escape_string($type);
        $query = "SELECT DISTINCT l.location_name, l.address, l.max_attendees, l.rating FROM Location l, LocationData ld WHERE l.location_name = ld.location_name AND ld.eventTypesSponsored = '$type'";
        $result = $this->connection->query($query);
        
         if(mysqli_num_rows($result)>=1) {
             $data = array('data' => $result->fetch_assoc());
return $data;

          
             
    }
    

}
    
    
    public function createLocationTable() {
        $query = "CREATE TABLE Location(
        location_name VARCHAR(255) PRIMARY KEY,
        address VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        owner VARCHAR(255) NOT NULL,
        max_attendees INT(11),
        description VARCHAR(255) NOT NULL,
        rating DECIMAL(3,2) DEFAULT 5.00
        )";
        $this->connection->query($query);
    }
    
    public function createLocationDataTable() {
        $query = "CREATE TABLE LocationData(
        location_name VARCHAR(255),
        datesTaken DATE NOT NULL,
        eventTypesSponsored VARCHAR(255) NOT NULL,
        FOREIGN KEY (location_name) REFERENCES Location(location_name)
        )";
        $this->connection->query($query);
    }
    
    public function createEventTable() {
        $query = "CREATE TABLE Event(
        location_name VARCHAR(255),
        dateOfEvent DATE NOT NULL,
        type VARCHAR(255) NOT NULL,
        uniqueLink VARCHAR(255) NOT NULL,
        FOREIGN KEY (location_name) REFERENCES Location(location_name)
        )";
        $this->connection->query($query);
    }
    
    //generates a Javascript array of which dates are taken for a particular event
    public function generateInvalidDates($locationName) {
        $locationName = $this->connection->real_escape_string($locationName);
       //echo $locationName;
        //echo strcmp($locationName,"McDonalds");
    $dates = "";
       //echo strlen($locationName);
        $query = "SELECT datesTaken FROM LocationData WHERE location_name = '$locationName'";
        $result = $this->connection->query($query);
        
         if(mysqli_num_rows($result)>=1) {
            // echo 'var takenDates = ';
              
            while ($row = $result->fetch_assoc()) {
                $dates .= $date = '"' . date("Y-m-d",strtotime($row["datesTaken"])) . '"' . ",";
               
            }
         }
        $dates = substr($dates, 0, -1);
        return $dates;
    }
    
    public function parseLocation($fullString) {
        $location = explode('Address', $fullString);
        $addressVal = explode('Location', $location[0]);
        //address name
        //echo $addressVal[1];
        $addressVal[1] = substr($addressVal[1], 0, -1);
        $addressVal[1] = substr($addressVal[1], 1);
        return $addressVal[1];
    }
    
    

    public function insertEvent($locationName, $dateOfEvent, $type, $username) {
        $locationName = $this->connection->real_escape_string($locationName);
$dateOfEvent = $this->connection->real_escape_string($dateOfEvent);
$type = $this->connection->real_escape_string($type);
$username = $this->connection->real_escape_string($username);
        $date = date('Y-m-d', strtotime(str_replace('-', '/', $dateOfEvent)));
        
        //$date = $date->format('Y-m-d');
                
        $query = "INSERT INTO Event (location_name, dateOfEvent, type, uniqueLink, username) VALUES ('$locationName','$date','$type','','$username')";
        $query1 = "INSERT INTO LocationData (location_name, datesTaken, eventTypesSponsored) VALUES ('$locationName','$date','$type')";
        $result = $this->connection->query($query);
        $result1 = $this->connection->query($query1);
         if($result) {
             return true;
         }
        return false;
    }

public function selectAllEventsBasedOnUsername($username) {
$username = $this->connection->real_escape_string($username);
$query = "SELECT * FROM Event WHERE username = '$username'";
$result = $this->connection->query($query);
        
         if(mysqli_num_rows($result)>=1) {
            
              
            while ($row = $result->fetch_assoc()) {
echo "<div class = container style = margin-bottom:40px;text-align:center;background-color:#d3d3d3;border-radius:25px;padding-top:20px;padding-bottom:20px;>";
                echo "<a href = ViewAllEvents.php?place={$row["location_name"]}&date={$row["dateOfEvent"]}>" . "<div class = col-sm-12>Location of the Event:<br>{$row["location_name"]}<br></div>" . " " . "<div class = col-sm-12>Date Of The Event: <br>{$row["dateOfEvent"]}<br></div>" . " " . "<div class = col-sm-12>Type Of Event <br> {$row["type"]}<br></div>" . " " . "generate unique link later" . " " . "<div class = col-sm-12>Username Hosting: <br>{$row["username"]}</div>" . "<div class = col-sm-12> Services At This Event: {$this->showYourServices($row["location_name"], $row["dateOfEvent"])}<br></div>";
               echo " </div></a>";
               
            }
         }


}

public function selectType($location, $date) {
$location = $this->connection->real_escape_string($location);
$date = $this->connection->real_escape_string($date);
$query = "SELECT type FROM Event WHERE location_name = '$location' AND dateOfEvent = '$date'";

$result = $this->connection->query($query);
        
         if(mysqli_num_rows($result)>=1) {
            
              
            while ($row = $result->fetch_assoc()) {
              return $row["type"];
            }
         }
return "";
}

public function selectVendor($location, $type, $services = "") {
$location = $this->connection->real_escape_string($location);
$services = $this->connection->real_escape_string($services);
if($services === "") {
$query = "SELECT * FROM VendorData WHERE companyName = (SELECT DISTINCT owner FROM Location WHERE location_name = '$location') AND eventsServiced='$type'";

}
else {
$query = "SELECT * FROM VendorData WHERE companyName = (SELECT DISTINCT owner FROM Location WHERE location_name = '$location') AND eventsServiced='$type' AND servicesOffered='$services'";

}
$result = $this->connection->query($query);
        
         if(mysqli_num_rows($result)>=1) {
            
              echo   '<form method = "POST" action = "">
<div class="form-group col-md-4 col-md-offset-4">
    <label for="formGroupExampleInput2">Vendors & Services Offered</label>
    <select name="selection" size="3" multiple="multiple" class="form-control">';
            while ($row = $result->fetch_assoc()) {
               echo '<option>' . $row["companyName"] . ":" . $row["servicesOffered"] . "</option>";
echo "<br>";

            }
echo "</select></div>";
echo ' <div class="form-group col-md-4 col-md-offset-4">
<input style = "padding-left: 25px; padding-right: 25px; font-weight: 600" type = "submit" class="btn btn-primary" value = "Select Your Vendor">
              </div>
</form>';
         }
}

public function insertVendorForEvent($location, $date, $service) {
$query = "INSERT INTO VendorsForEvent (location_name, dateOfEvent, servicesOffered) VALUES ('$location', '$date', '$service')";
$result = $this->connection->query($query);
        
         if($result) return true;
return false;
}

public function showYourServices($location, $date) {
$query = "SELECT servicesOffered FROM VendorsForEvent WHERE location_name = '$location' AND dateOfEvent = '$date'";
$result = $this->connection->query($query);
$s = "";
if(mysqli_num_rows($result)>=1) {
            
              
            while ($row = $result->fetch_assoc()) {
               $s .= $row["servicesOffered"] . ", ";
            }
         }
if($s === "") return "No Services Offered Currently. Click to Add Some!";
$s = substr($s, 0, -2);
return $s;
}
    
   
    
}



?>
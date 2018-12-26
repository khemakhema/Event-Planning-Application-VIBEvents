<?php  
    /* Start the session if the session is active via the user logging in */
    if (session_status() !== "") {
    session_start(); 
    }

    ?>

<!DOCTYPE HTML>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="homepage.css">
<link href="https://fonts.googleapis.com/css?family=Lato|Spectral" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">  

<link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet"> 
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>About</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<style>

</style>
</head>
<body>
<script>
    
</script>
    
    
    
<nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="">VibEvents</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="Home.php">Home</a></li>
              <li class="active"><a href="About.php">About</a></li>
              <li><a href="ViewAllEvents.php">View All Your Events</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
           
          if (!isset($_SESSION["username"]) && !isset($_SESSION["companyName"])) {
                echo '<li><a href="Login.php">Login</a></li>
              <li><a href="Signup.php">Sign Up</a></li>';
              echo '<li><a href="VendorSignup.php">Vendor Sign Up</a></li>';
              echo '<li><a href="VendorLogin.php">Vendor Log In</a></li>';
            }
            
                if (isset($_SESSION["username"])) {
                echo '<li><a href="ProfilePage.php">Welcome ' . $_SESSION["username"] . '</a></li>';
                echo '<li><a href="CreateEvent.php">Create An Event ' . '</a></li>';
                echo '<li><a href="Signout.php">Sign Out</a></li>';
                }
                
                if(isset($_SESSION["companyName"])) {
                    echo '<li><a href="ProfilePage.php">Welcome ' . $_SESSION["companyName"] . '</a></li>';
                echo '<li><a href="Signout.php">Sign Out</a></li>';
                    
                
                }
                
               
            
          
          ?>
              
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
 
       <?php
       require_once'Mail.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mail = new Mail('localhost','vibeven2_alexgronowski1','testPW','vibeven2_vibevents');
if(!empty($_GET["type"])) {
    
if($_GET["type"] === "user") {
echo "<div class='text-primary' style = 'text-align:center; font-size: 150%;font-weight: 600;'>" . $mail->resetPassword($_POST["username"], "user")  . "</div>";
}
    
else if($_GET["type"] === "company") {
echo "<div class='text-primary' style = 'text-align:center; font-size: 150%;font-weight: 600;'>" . $mail->resetPassword($_POST["username"], "company") . "</div>";

}
}
}

if(!empty($_GET["reset"])) {

if(isset($_POST["resetpass"])) {

echo "<div class='text-primary' style = 'text-align:center; font-size: 150%;font-weight: 600;'>" . $mail->resetPasswordAndUpdate($_GET["reset"], $_POST["password"]) . "</div>";
}


echo '   <form method = "POST" action = "">

     <div class="form-group col-md-4 col-md-offset-4">
    <label for="formGroupExampleInput2">Password</label>
    <input pattern=".{5,10}" required title="5 to 10 characters" name = "password" type="password" class="form-control" placeholder="Enter your Password (5 to 10 Characters)" required>
  </div>
   
        
        <div class="form-group col-md-4 col-md-offset-4">
<input style = "padding-left: 25px; padding-right: 25px; font-weight: 600" type = "submit" class="btn btn-primary" value = "Reset Your Password" name = "resetpass">
              </div>
</form>';
}
    

    ?>
    <?php
if(empty($_GET["reset"])) {
echo '
    <form method = "POST" action = "">

  <div class="form-group col-md-4 col-md-offset-4">
    <label for="formGroupExampleInput">Enter Username or Company Name</label>
    <input name = "username" type="text" class="form-control" placeholder="Enter Your Username or Company Name" required>
  </div>
   
        
        <div class="form-group col-md-4 col-md-offset-4">
<input style = "padding-left: 25px; padding-right: 25px; font-weight: 600" type = "submit" class="btn btn-primary" value = "Reset Password">
              </div>
</form>
';
}
?>
    
</body>
</html>
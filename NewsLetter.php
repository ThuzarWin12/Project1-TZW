<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
.create {color:#000;}
</style>
</head>
<body>  

<?php

// define variables and set to empty values
$nameErr = $emailErr = "";
$name = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }
    
$name = $_POST["name"];
$email = $_POST["email"];
$servername="localhost";
$username="root";
$password="";
$dbname="mysql";

// Create Connection 
$conn = new mysqli($servername,$username,$password,$dbname);

// Check Connection
if ($conn->connect_error)
{ die ("Connection Failed".$conn->connect_error);
}
//echo " myql DB Connected Successfully !!!";


// Check the email is already in the database
$sql="SELECT * FROM newsletter WHERE email='$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0)
{
	$msg_to_user="<h4><span class='error'>". $email." is already in the system.</span></h4>";
	  
}
else {
$sql = "INSERT INTO newsletter (id,name,email,dateTime,received) VALUES (1,'$name','$email',now(),'1')";
if($conn->query($sql)== TRUE) 
{
  $msg_to_user ="<h4><span class='create'>" .$name . " and ". $email . " is created successfully. </span></h4>";

}


}


$conn->close(); 
 
 
  

  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>NewsLetters Subscription</h2>
<p><span class="error">* required field</span></p>
<form style="width:440px" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
<fieldset style="text-align:left;padding:24px;">
<legend> Subscribe to Our Newsletter &nbsp; </legend>
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
 
  <input type="submit" name="submit" value="Submit">  
  </fieldset>
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $msg_to_user;
$name="";
$email="";
$msg_to_user="";
?>

</body>
</html>
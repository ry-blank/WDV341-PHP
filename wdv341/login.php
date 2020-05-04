<?php
session_cache_limiter('none');			//This prevents a Chrome error when using the back button to return to this page.
session_start();

$msg = "";
$username = "";
$password = "";

  if ($_SESSION['validUser'] == true) //is this already a valid user?
  {
        //User is already signed on.  Skip the rest.
        $msg = "Welcome back " . $_SESSION['user']; //Create greeting for VIEW area
  } 
  else 
  {
      if(isset($_POST['submit']))  //Was this page called from a submitted form?
      {
        $username = $_POST['inName'];     //pull the username from the form
        $password = $_POST['inPassword']; //pull the username from the form

        require "dbConnection.php"; //Connect to the database

        $sql = "SELECT event_user_name, event_user_password
                FROM event_user
                WHERE event_user_name='$username'";

        $stmt = $conn->prepare($sql);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);            
            
        if($username == $row['event_user_name'] && $password == $row['event_user_password']) //If this is a valid user there should be ONE row only
        {
            $_SESSION['validUser'] = true; //this is a valid user so set your SESSION variable
            $_SESSION['user'] = $username;
            $msg .= "Welcome back $username";
            //Valid User can do the following things:
        }
        else
        {
            //error in processing login.  Logon Not Found...
            $_SESSION['validUser'] = false;
            $msg .= "Invalid username or password";
        }

        $conn = null;

    } //end if submitted
    else 
    { 
        //user needs to see form
    }//end if submitted

} //end else valid user

//turn off PHP and turn on HTML
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP - Login and Control Page</title>
</head>

<body>

<h1>WDV341 Intro PHP</h1>

<h2>Presenters Admin System Example</h2>

<h2><?php echo $msg;?></h2>

<?php
    if ($_SESSION['validUser'] == true) //This is a valid user.  Show them the Administrator Page
    {

//turn off PHP and turn on HTML
?>

        <h3>Presenters Administrator Options</h3>
        <p><a href="selectEvents.php">See All Events</a></p>
        <p><a href="eventsForm.php">Add event</a></p>
        <p><a href="logout.php">Logout</a></p>

<?php 
    } 
    else //The user needs to log in.  Display the Login Form
    { 
?>
            <h2>Please login to the Administrator System</h2>
                <form method="post" name="loginForm" action="login.php">
                <p>Username: <input name="inName" type="text" value="<?php echo $username?>"/></p>
                <p>Password: <input name="inPassword" type="password"/></p>
                <p><input type="submit" value="Login" name="submit"></p>
            </form>

<?php //turn off HTML and turn on PHP
	}//end of checking for a valid user
			
//turn off PHP and begin HTML			
?>

</body>
</html>
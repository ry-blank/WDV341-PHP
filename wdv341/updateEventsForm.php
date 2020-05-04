<?php
session_cache_limiter('none');			//This prevents a Chrome error when using the back button to return to this page.
session_start();

date_default_timezone_set('America/Chicago');

$eventNameErrMsg = "";
$eventDescriptionErrMsg = "";
$eventPresenterErrMsg = "";
$errorMessage = "";

$validForm = false;

$eventName = "";
$eventDescription = "";
$eventPresenter = "";
$eventDate = "";
$eventTime = "";

$errorMessage = "";

function validateName()
{
	global $eventName, $validForm, $eventNameErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
	$eventNameErrMsg = "";								//Clear the error message. 
	if($eventName=="")
	{
		$validForm = false;					//Invalid name so the form is invalid
		$eventNameErrMsg = "Name is required";	//Error message for this validation	
	}
    elseif (!preg_match("/^[a-z0-9A-Z]*$/",$eventName)) 
    {
		$eventNameErrMsg = "Only letters, numbers, and white space allowed";
	}
}

function validateDescription()
{
	global $eventDescription, $validForm, $eventDescriptionErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
	$eventDescriptionErrMsg = "";								//Clear the error message. 
	if($eventDescription=="")
	{
		$validForm = false;					//Invalid name so the form is invalid
		$eventDescriptionErrMsg = "Name is required";	//Error message for this validation	
	}
    elseif (!preg_match("/^[a-z0-9A-Z]*$/",$eventDescription)) 
    {
		$eventDescriptionErrMsg = "Only letters, numbers, and white space allowed";
	}
}

function validatePresenter()
{
	global $eventPresenter, $validForm, $eventPresenterErrMsg;		//Use the GLOBAL Version of these variables instead of making them local
	$eventPresenterErrMsg = "";								//Clear the error message. 
	if($eventPresenter=="")
	{
		$validForm = false;					//Invalid name so the form is invalid
		$eventPresenterErrMsg = "Name is required";	//Error message for this validation	
	}
    elseif (!preg_match("/^[a-z0-9A-Z]*$/",$eventPresenter)) 
    {
		$eventPresenterErrMsg = "Only letters, numbers, and white space allowed";
	}
}

if ($_SESSION['validUser'] == true) {
    require "dbConnection.php";

    //refill form
    if(isset($_POST["submit"])) 
    {
        $eventName = $_POST["nameText"];
        $eventDescription = $_POST["descText"];
        $eventPresenter = $_POST["presenterText"];
        $eventDate = $_POST["date"];
        $eventTime = $_POST["time"];

        validateName();
        validateDescription();
        validatePresenter();

        if($validForm = true) 
        {
            //do stuff with data

            echo($eventName . "  " . $eventDescription . "  " . $eventPresenter . "  " . $eventDate . "  " . $eventTime . "  " . $errorMessage);
            try {
                $stmt = $conn->prepare("UPDATE wdv341_event
            SET event_name='$eventName', 
            event_description='$eventDescription', 
            event_presenter='$eventPresenter', 
            event_date='$eventDate', 
            event_time='$eventTime'
            WHERE event_id='" . $_GET['id'] . "';");

                $stmt->execute();

                echo("<h1>The event was sucessfully edited.</h1>");
            } catch (PDOException $ex) {
                $errorMessage = $ex->getMessage();
            } 
        }
    } 
    else 
    { //Submit was not clicked
        if(isset($_GET['id']))
         {
            try 
            {
                $id = $_GET['id'];

                $sql = "SELECT event_id, event_name, event_description, event_presenter, DATE_FORMAT(event_date, 'm-d-Y') AS date, event_time
                FROM wdv341_event
                WHERE event_id = $id";

                $stmt = $conn->prepare($sql);

                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $eventName = $row['event_name'];
                $eventDescription = $row['event_description'];
                $eventPresenter = $row['event_presenter'];
                $eventDate = $row['date'];
                $eventTime = $row['event_time'];

            } 
            catch (PDOException $ex) 
            {
                $errorMessage = $ex->getMessage();
                header( "refresh:3;url=selectEvents.php" );
                echo"Unexpected error: <a href='selectEvents.php'>Click here if you are not redirected to the previous page in 3 seconds.</a>";                
            }
        } 
        else 
        {
            header( "refresh:5;url=selectEvents.php" );
            echo"Unable to locate record. <a href='selectEvents.php'>Click here if you are not redirected to the previous page in 3 seconds.</a>";            
        }
    }

    if(isset($_POST["reset"])) 
    {
        if(isset($_GET['id'])) 
        {
            try 
            {
                $id = $_GET['id'];

                $sql = "
                SELECT event_id, event_name, event_description, event_presenter, DATE_FORMAT(event_date, '%Y-%c-%e') AS date, event_time
                FROM wdv341_event
                WHERE event_id = $id";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $eventName = $row['event_name'];
                $eventDescription = $row['event_description'];
                $eventPresenter = $row['event_presenter'];
                $eventDate = $row['date'];
                $eventTime = $row['event_time'];
            } 
            catch (PDOException $ex) 
            {
                $errorMessage = $ex->getMessage();
                header( "refresh:5;url=selectEvents.php" );
                echo"Unexpected error: <a href='selectEvents.php'>Click here if you are not redirected to the previous page in 3 seconds.</a>";
            }
        } 
        else 
        {
            header ( "refresh:5;url=selectEvents.php" );
            echo "Unable to locate record. <a href='selectEvents.php'>Click here if you are not redirected to the previous page in 3 seconds.</a>"; 
        }
    }
} 
else 
{
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update an Event</title>
    </head>

    <body>
        <h1>WDV341</h1>
        <h2>Update fields below with new information.</h2><br>

        <a href="selectEvents.php">Return to Events page</a><br>

        <form name="eventsForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id=" . $_GET['id'] ?>">
            <p>
                <label for="nameText">Event Name:</label>
                <input type="text" name="nameText" id="nameText" value="<?php echo "$eventName" ?>">
            </p>
            <p>
                <label for="descText">Event Description:</label>
                <input type="text" name="descText" id="descText" value="<?php echo "$eventDescription" ?>">
            </p>
            <p>
                <label for="presenterText">Event Presenter:</label>
                <input type="text" name="presenterText" id="presenterText" value="<?php echo "$eventPresenter" ?>">
            </p>

            <p>
                <label for="date">Event date:</label>
                <input type="date" name="date" id="date" value="<?php echo "$eventDate" ?>">
            </p>

            <p>
                <label for="time">Event time:</label>
                <input type="time" name="time" id="time" value="<?php echo "$eventTime" ?>">
            </p>
            <?php echo "<p class='error'> $errorMessage </p>"?>
            <p>
                <input type="submit" name="submit" id="submit" value="Update">
                <input type="submit" name="reset" id="reset" value="Reset">
            </p>
        </form>

    </body>
</html>
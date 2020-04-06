<?php

  //Setup the variables used by the page
    //assign a default value to input fields and error messages
    $inEventName = "";
    $inEventPresenter = "";
    $inEventDate = "";
    $inEventTime = "";
    $inEventDescription = "";

    //error messages
    $eventNameErrorMsg = "";
    $eventPresenterErrorMsg = "";
    $eventDateErrorMsg = "";
    $eventTimeErrorMsg = "";
    $eventDescriptionErrorMsg = "";
  
  if(isset($_POST["eventSubmit"]))

    //The form has been submitted and needs to be processed
  {
    echo "<h1>Thank you for submitting this form.</h1>";

    $inEventName = $_POST["eventName"];
    $inEventPresenter = $_POST["eventPresenter"];
    $inEventDate = $_POST["eventDate"];
    $inEventTime = $_POST["eventTime"];
    $inEventDescription = $_POST["eventDescription"];
  

    echo "<p>eventName: $inEventName";

    // PHP Validations go here
    $validForm = true; //sets a flag/switch to make sure form data is valid

    if($validForm) {
      // Yes, good data - Do database stuff here
      
      try {
        
        require 'dbConnection.php'; //access and run this external file

          $eventName = $_POST['eventName'];
          $eventPresenter = $_POST['eventPresenter'];
          $eventDate = $_POST['eventDate'];
          $eventTime = $_POST['eventTime'];
          $eventDescription = $_POST['eventDescription'];
        
      // PDO Prepared Statements        
        
      // Prepare the SQL Statement
        
        // 1. create the SQL statement wiht name placeholders
          $sql = "INSERT INTO wdv341_event (event_name, event_description, event_presenter, event_date, event_time)
          VALUES (:eventName, :eventDescription, :eventPresenter, :eventDate, :eventTime)";
        
        // 2. create the prepared statement object
          $stmt = $conn->prepare($sql); //creates the prepared statement object
        
        // 3. bind the parameters to the prepared statement object, one line for each parameter
          $stmt->bindParam(':eventName', $eventName);
          $stmt->bindParam(':eventDescription', $eventDescription);
          $stmt->bindParam(':eventPresenter', $eventPresenter);
          $stmt->bindParam(':eventDate', $eventDate);
          $stmt->bindParam(':eventTime', $eventTime);
        
        // 4. Execute the Prepared Statement 
          $stmt->execute();

      }
      catch(PDOException $e)
       {
        $message = "There has been a problem. The system administrator has been contacted. Please try again later.";

        error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
        error_log(var_dump(debug_backtrace()));
         
        //Clean up any variables or connections that have been left hanging by this error.		
			
				header('Location: files/505_error_response_page.php');	//sends control to a User friendly page
        
       }
      
    }
    else {
      $message = "Something went wrong";
      // Bad data, display error messages, display form to user
      //1. Bad name
            //put data on the form
              //load error variable
            //put error message on form
              $eventNameErrorMsg = "Invalid event name field";
              $eventPresenterErrorMsg = "Invalid presenter name field";
              $eventDescriptionErrorMsg = "Invalid description name field";
            //$validForm=false
      //2. Bad date
              $eventDateErrorMsg = "Invalid date";
      //3. Bad time
              $eventTimeErrorMsg = "Invalid time";
    }
  }
  else
  {
    echo "<h1>Please enter your information</h1>";
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Events Form</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<h2>Events Forms</h2>

<form id="form1" name="form1" method="post" action="processEvents.php">
  <p>
  <label for="eventName">Event Name:</label><br>
  <input type="text" id="eventName" name="eventName" value="<?php echo $inEventName ?>"><br>
  </p>

  <p>
  <label for="eventPresenter">Event Presenter:</label><br>
  <input type="text" id="eventPresenter" name="eventPresenter"  value="<?php echo $inEventPresenter ?>"><br>
  </p>

  <p>
  <label for="eventDate">Event Event Date:</label><br>
  <input type="date" id="eventDate" name="eventDate"  value="<?php echo $inEventDate ?>"><br>
  </p>

  <p>
  <label for="eventTime">Event Time:</label><br>
  <input type="time" id="eventTime" name="eventTime"  value="<?php echo $inEventTime ?>"><br>
  </p>

  <p>
  <label for="eventDescription">Event Description:</label><br>
  <input type="text" id="eventDescription" name="eventDescription"  value="<?php echo $inEventDescription ?>"><br><br>
  </p>
  
  <div class="g-recaptcha" data-sitekey="6LfRZ98UAAAAAHxPaq7uXv7bOsfXglV8-KpVGbHa"></div><br><br>

  <input type="submit" name="eventSubmit" id="eventSubmit" value="Submit">
  <input type="reset" name="Reset" id="button" value="Reset">
</form> 
</body>
</html>
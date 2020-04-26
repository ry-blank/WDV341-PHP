<?php
    //Get the Event data from the server.
    require 'dbConnection.php';	//CONNECT to the database
    date_default_timezone_set("America/Chicago");

    try {

        //Create the SQL command string
        $sql = "SELECT event_id, event_name, event_description, event_presenter, DATE_FORMAT(event_date, '%Y, %m') as event_date, event_time
                FROM wdv341_event
                ORDER BY event_name DESC";
        
        //PREPARE the SQL statement
        $stmt = $conn->prepare($sql);
        
        //EXECUTE the prepared statement
        $stmt->execute();		
        
        //Prepared statement result will deliver an associative array
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
    }
    
    catch(PDOException $e)
    {
        $message = "There has been a problem. The system administrator has been contacted. Please try again later.";
  
        error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
        error_log($e->getLine());
        error_log(var_dump(debug_backtrace()));
    
        //Clean up any variables or connections that have been left hanging by this error.		
    
        header('Location: files/505_error_response_page.php');	//sends control to a User friendly page					
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>WDV341 Intro PHP  - Display Events Example</title>
    <style>
		.eventBlock{
			width:500px;
			margin-left:auto;
			margin-right:auto;
			background-color:#CCC;	
		}
		
		.displayEvent{
			text_align:left;
			font-size:18px;	
		}
		
		.displayDescription {
			margin-left:100px;
		}

        .futureDateFontStyle {
            font-style:italic;
        }

        .currentDateFontStyle {
            font-style:bold;
            color:red;
        }
	</style>
</head>
<body>
    <h1>WDV341 Intro PHP</h1>
    <h2>Example Code - Display Events as formatted output blocks</h2>   

<?php

try {
    $sql = "SELECT event_date FROM wdv341_event";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
    $todaysDate = date("Y, m");
    $i = 0;
    foreach ($statement->fetchAll() as $v) {
      $eventDate = date_create($v['event_date']);
      if ($todaysDate <= $eventDate) {
        $i++;
      }
  }  
}
  catch(PDOException $e) {
    echo "Process Failed: " . $e->getMessage();
  }

  echo "<h3>$i Events are available today.</h3>";


  //Display each row as formatted output in the div below   
    foreach ($stmt->fetchAll() as $v) {
        
        $todaysDate = date("Y, m");
        $myDateTime = DateTime::createFromFormat('H:i:s', $v['event_time']);
        $formattedEventTime = $myDateTime->format('g:i A');
        $eventNameStyle = "";

        if ($todaysDate < $v['event_date']) {
            $eventNameStyle = "futureDateFontStyle";
        }
        else {
            $eventNameStyle = "currentDateFontStyle";
        }

      echo "<p>
			  <div class='eventBlock'>	
				  <div>
            <span class='displayEvent " . $eventNameStyle . "'>Event:" . $v['event_name'] . "</span>
					  <span>Presenter:" . $v['event_presenter'] . "</span>
				  </div>
				  <div>
					  <span class='displayDescription'>Description:" . $v['event_description'] . "</span>
			  	</div>
			  	<div>
					  <span class='displayTime'>Time:" . $formattedEventTime . "</span>
				  </div>
				  <div>
					  <span class='displayDate'>Date:" . $v['event_date'] . "</span>
				  </div>
			  </div>
		  </p>";

    }
    //Close the database connection	
    $conn=null;
?>

</div>	
</body>
</html>
<?php
    // This PHP file will connect to the wdv341 database
    // It will pull the form data from the $_POST variable
    // It will format an INSERT SQL statemnet
    // It will create a Prepared Statement
    // It will bind the parameters to the Prepared Statement
    // It will ecevute the preated statement to insert into the database
    // It will displat a success/failure message to the user. 

if(isset($_POST['g-recaptcha-response'])){
        $captcha=$_POST['g-recaptcha-response'];
}
  
if(!$captcha){
      echo '<h2>Please check the Captcha box.</h2>';
      exit;
}
    $secretKey = "6LfRZ98UAAAAAOhJiN0uMlxhKFZSSMAJBvjgAAJf";
    $ip = $_SERVER['REMOTE_ADDR'];
    // post request to server
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
    $response = file_get_contents($url);
    $responseKeys = json_decode($response,true);
    // should return JSON with success as true
if($responseKeys["success"]) {
            echo '<h2>reCAPTCHA was successful.</h2>';
} else {
            header('It appears you may be a spammer...');
}


require 'dbConnection.php'; //access and run this external file

try {
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
catch(PDOException $e) {
    echo "WARNING WARNING WARNING";
}

$conn = null; // close your connection object

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Thank you for your order</h2>
</body>
</html>
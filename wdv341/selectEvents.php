<?php
session_cache_limiter('none');			//This prevents a Chrome error when using the back button to return to this page.
session_start();

if ($_SESSION['validUser'] == true) 
{
    require_once("dbConnection.php");

    $errorMessage = "";
   
        if(empty($errorMessage)) 
        {
            try 
            {
                $sql = "SELECT first_name, last_name, user_email, from_state, team_picked
                FROM favorite_team";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
            } 
            catch (PDOException $ex) 
            {
                $errorMessage = $ex->getMessage();
            } 
        }  
} 
else 
{
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP - Events Page</title>

<style>

.button {
  text-align: center;
  cursor: pointer;
  margin-left: 25px;
  margin-top: 10px;
}

</style>
</head>

<body>

<h1>WDV341</h1>

<a href="login.php">Presenters Administrator Options</a><br>

<h2>Select an event below to update or delete.</h2>
        
<table>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>From</th>
        <th>Favorite Team</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>
<?php 
    if(isset($sql)) { //prepared statement was run
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td style='width:150px;border:1px solid black;'>" . $row['first_name'] . "</td>
                    <td style='width:150px;border:1px solid black;'>" . $row['last_name'] . "</td>
                    <td style='width:150px;border:1px solid black;'>" . $row['from_state'] . "</td>
                    <td style='width:150px;border:1px solid black;'>" . $row['team_picked'] . "</td>
                    <td style='width:150px;border:1px solid black;'>
                        <form name='editForm' method='get' action='updateEventsForm.php'>
                        <button type='submit' name='id' value='".$row['event_id'] ."' class='button'>Update</button></form>
                    </td>
                    <td style='width:150px;border:1px solid black;'>
                        <form name='deleteForm' method='get' action='deleteEvent.php'>
                        <button type='submit' name='id' value='".$row['event_id'] ."' class='button'>Delete</button></form>
                    </td>
                </tr>";
        }
    }
?>
</table>
</body>
</html>
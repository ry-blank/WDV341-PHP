<?php
session_cache_limiter('none');			//This prevents a Chrome error when using the back button to return to this page.
session_start();

if ($_SESSION['validUser'] == true)
{
    if(isset($_GET['id'])) 
    {
        try 
        {
            require "dbConnection.php";
            $id = $_GET['id'];

            $sql = "DELETE
                FROM wdv341_event
                WHERE event_id = $id";

            $stmt = $conn->prepare($sql);

            $stmt->execute();

            header('refresh:3;url=selectEvents.php');
            echo"Record deleted.";

        } 
        catch (PDOException $ex) 
        {
            $errorMessage = $ex->getMessage();
            header('refresh:3;url=selectEvents.php');
            echo"Record was NOT deleted.";
        }
    } 
    else 
    {
        header( "refresh:3;url=selectEvents.php" );
        echo"Record was NOT deleted.";
    }
} 
else 
{
    header("Location: login.php");
}
?>
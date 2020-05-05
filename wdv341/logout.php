<?php
session_cache_limiter('none');			//This prevents a Chrome error when using the back button to return to this page.
session_start();	//provide access to the current session


$_SESSION['validUser'] = false;
session_unset();	//remove all session variables related to current session
session_destroy();	//remove current session

header('Location: favoriteTeamEntry.php');


?>
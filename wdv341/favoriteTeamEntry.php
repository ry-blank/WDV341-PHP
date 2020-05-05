<?php
//set default values
$inFirstName = "";
$inLastName = "";
$inEmail = "";
$inLiveInState = "";
$inFavoriteTeam = "";

//set error messages
$inFirstNameErrMsg = "";
$inLastNameErrMsg = "";
$inEmailErrMsg = "";
$inLiveInStateErrMsg = "";
$inFavoriteTeamErrMsg = "";

$validForm = "" ;
$inInRobotest = "";

function validateFirstName() {

	//required & valid first name should only include letters, numbers, and spaces 
	global $inFirstName,$inFirstNameErrMsg,$validForm;
	$inFirstNameErrMsg="";
	
	if(empty($inFirstName))
	{ 
		$validForm = "false";
		$inFirstNameErrMsg = "First Name is required";
	}
	else
	{
		if(!preg_match("/([a-zA-Z0-9 ])/",$inFirstName))
		{
			$validForm = "false";
			$inFirstNameErrMsg = "Only include letters, numbers and spaces in First Name";
		}
	}
}

function validateLastName() {

	//required & valid last name should only include letters, numbers and spaces
	global $inLastName,$inLastNameErrMsg,$validForm;
	$inLastNameErrMsg="";
	
	if(empty($inLastName)) 
	{
		$validForm = "false";
		$inLastNameErrMsg = "Last Name is required";
	}
	else
	{
		if(!preg_match("/([a-zA-Z0-9 ])/",$inLastName)){
			$validForm = "false";
			$inLastNameErrMsg = "Only include letters, numbers and spaces in Last Name";
		}
	}
}


function validateEmail() {

	global $inEmail,$inEmailErrMsg,$validForm;
	$inEmailErrMsg="";
	
	if (!filter_var($inEmail, FILTER_VALIDATE_EMAIL)) 
	{
		$validForm = "false";
		$inEmailErrMsg = "Invalid Email";
	}
}

function validateLiveInState() {

	//required & valid name should only include letters, numbers, spaces, and commas
	global $inLiveInState,$inLiveInStateErrMsg,$validForm;
	$inLiveInStateErrMsg="";
	
	if(empty($inLiveInState))
	{
		$validForm = "false";
		$inLiveInStateErrMsg = "The state you live in is required";
	}
	if(!preg_match("/([a-zA-Z0-9, ])/",$inLiveInState))
	{
		$validForm = "false";
		$inLiveInStateErrMsg = "Only include letters and spaces for the state you live in.";
	}
}

function validateFavoriteTeam() {

	//required & valid name should only include letters, numbers, spaces, and commas
	global $inFavoriteTeam,$inFavoriteTeamErrMsg,$validForm;
	$inLiveInStateErrMsg="";
	
	if(empty($inFavoriteTeam))
	{
		$validForm = "false";
		$inFavoriteTeamErrMsg = "The state you live in is required";
	}
	if(!preg_match("/([a-zA-Z0-9, ])/",$inFavoriteTeam))
	{
		$validForm = "false";
		$inFavoriteTeamErrMsg = "Only include letters and spaces for the state you live in.";
	}
}	

if(isset($_POST['submitForm']) )
{
	echo "<h1>Thank you for completing the survey.</h1>";

	$inFirstName = $_POST['firstName'];
	$inLastName = $_POST['lastName'];	
	$inEmail = $_POST['email'];	
	$inLiveInState = $_POST['liveInState'];	
	$inFavoriteTeam = $_POST['favoriteTeam'];	

	// Input Field validations. 
	validateFirstName();
	validateLastName();	
	validateEmail();
	validateLiveInState();	
	validateFavoriteTeam();
	
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
			echo '<h2>reCAPTCHA was NOT successful.</h2>';
	}
			
	if(!$validForm == true) //Check the form flag.  If it is still true all the data is valid and the form is ready to process
	{
		// The form  data is valid and can be processed into your database.

		try {

			$inFirstName = $_POST['firstName'];
			$inLastName = $_POST['lastName'];	
			$inEmail = $_POST['email'];	
			$inLiveInState = $_POST['liveInState'];	
			$inFavoriteTeam = $_POST['favoriteTeam'];				
			
			// PDO Prepared Statements
		
		
			// Prepare the SQL Statement
		
			// 1. create the SQL statement wiht name placeholders
			$sql = "INSERT INTO favorite_team (first_name, last_name, user_email, from_state, team_picked)
			VALUES (:firstName, :lastName, :email, :liveInState, :favoriteTeam)";
		
			// 2. create the prepared statement object
			$stmt = $conn->prepare($sql); //creates the prepared statement object
		
			// 3. bind the parameters to the prepared statement object, one line for each parameter
			$stmt->bindParam(':firstName', $firstName);
			$stmt->bindParam(':lastName', $lastName);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':liveInState', $liveInState);
			$stmt->bindParam(':favoriteTeam', $favoriteTeam);
		
			// 4. Execute the Prepared Statement 
			$stmt->execute();
			}
		catch(PDOException $e) {
			echo "WARNING WARNING WARNING";
		}


		$conn = null; // close your connection object
		
		echo "<h1>Thank you for completing the survey.</h1>";
		echo "<p>You will recieve an email confirmation delivered to $inEmail.</p>";
		echo "</body></html>";

	
		exit();		//Finishes the page so it does not display the form again.
	}
	else			//The form has at least one invalid field.  It may have more.  All will be displayed.
	{
		//Load the original formdata back into the fields
		//Load the error messages onto the form.  Only invalid fields will have an error message.  Others will be blank.
		//Display the form back to the user for corrections.   The page will continue process from this point, displaying the updated form.
	}

	
} else 
{
	echo "<h1>Please complete the form below to see which team has the most fans.</h1>";
}
	

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>SurveyHippo - Favorite NFL Team</title>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

	<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
	
<script>
	
	$(document).ready(function(){

		if( $("select[name=program]	option:selected").val() == "webDevelopment")
		{
			$(".secondWeb").css("display", "inline");
		}
		else
		{
			$(".secondWeb").css("display", "none");
		}
		
		$("select#program").change(function(){
			if( $("select#program option:checked").val() == "webDevelopment")
			{
				$(".secondWeb").css("display", "inline");
			}
			else
			{
				$(".secondWeb").css("display", "none");
			}
		});

		$("#resetForm").on("click", (function(){
			
			$("#firstNameError").html("");
			$("#lastNameError").html("");
			$("#emailError").html("");
			$("#liveInStateError").html("");
			$("#favortieTeamError").html("");

		}));
	});
	
</script>
  
  <style>
	body{
		background-image: url("bodacious.png");
		margin: 1.5em;
	}
	
	.main {
		padding: 1em;
		background-color: white;
	}
	form{
		text-align: center;
	}
	h1 {
		text-align: center;
	}

	h2 {
		text-align: center;
	}
	.robotic{
		display: none;
	}

	.form {
		background-color:white;
		padding-left: 5em;
	}
	p {
		align:left;
	}	
	.secondWeb{
		display: none;
	}
	table{
		margin: auto;
	}
	table td{
		padding-bottom: .75em;
	}
	.error{
		font-style: italic;
		color: #d42a58;
		font-weight: bold;
	}

@media only screen and (max-width:620px) {
  /* For mobile phones: */
  .form {
	width:100%; 
	padding-left: .1em;
	padding-top: .1em;
  }
  .secondWeb{
		display: none;
	}  
  table{
		margin: auto;
	}
  table td{
		padding-bottom: .5em;
	}
}
	
  </style>
    
</head>


<body>

	<div class="main form">
	
	<h2></h2>
	

	</table>
	<!--<form id="portfolioBioForm" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"-->
	<form id="portfolioBioForm" method="post" action="favoriteTeamEntry.php">

	<h3><a href="login.php">Admin Login</a></h3>
		
		<table>
			<tr>
				<td>First Name:<br> <input type="text" id="firstName" name="firstName" value="<?php echo $inFirstName; ?>"/><br>
				<span class="error" id="firstNameError"><?php echo $inFirstNameErrMsg;?></span></td>
			</tr>

			<tr>
				<td>Last Name:<br> <input type="text" id="lastName" name="lastName" value="<?php echo $inLastName; ?>" /><br>
				<span class="error" id="lastNameError"><?php echo $inLastNameErrMsg;?></span></td>
			</tr>			
		
			<tr>
				<td>Email:<br><input type="text" id="email" name="email" value="<?php echo $inEmail; ?>" /><br>
				<span class="error" id="emailError"><?php echo $inEmailErrMsg;?></span></td>
			</tr>		
			
			<tr>
				<td>What state do you live in?:<br> <input type="text" id="liveInState" name="liveInState" value="<?php echo $inLiveInState; ?>"/><br>
				<span class="error" id="liveInStateError"><?php echo $inLiveInStateErrMsg;?></span></td>
			</tr>	

			<tr>
				<td>What is your favorite NFL team?:<br> <input type="text" id="favoriteTeam" name="favoriteTeam" value="<?php echo $inFavoriteTeam; ?>"/><br>
				<span class="error" id="liveInStateError"><?php echo $inFavoriteTeamErrMsg;?></span></td>
			</tr>	
		
			<tr>		
			<p class="robotic" id="pot">
				<label>Leave Blank</label>
				<input type="hidden" name="inRobotest" id="inRobotest" class="inRobotest" />
			</p>

				<input type="hidden" id="submitConfirm" name="submitConfirm" value="submitConfirm"/>

			</tr>

			<tr>
				<td class="g-recaptcha" data-sitekey="6LfRZ98UAAAAAHxPaq7uXv7bOsfXglV8-KpVGbHa"></td>
			</tr>

			<tr>
				<td><input type="submit" id="submitForm" name="submitForm" value="Submit Form" /></td>
			</tr>

			<tr>
				<td><input type="reset" id="resetForm" name="resetForm" value="Reset Form" onClick="this.form.reset()" /></td> 
			</tr>

		</table>
	</form>
	
	</div>
</body>

</html>
	
	<?php

		if(!$validForm && (!empty($validForm))){			

			try {		

				$message = "";
				$inEmail = $_POST['email'];	
				$fromEmail = "ry_blank@hotmail.com";
				$emailSubject = "And the favorite NFL team is...";
	
				require 'Emailer.php'; //access the class file
	
				$emailTest = new Emailer(); //instantiate a new Emailer object
	
				$emailTest->setMessage($message);
	
				$emailTest->setRecipientEmail($inEmail);
	
				$emailTest->setSenderEmail($fromEmail);
	
				$emailTest->setSubject($emailSubject);
	
				echo $emailTest->getMessage(); //return email address
	
				echo $emailTest->getRecipientEmail(); //return email address
	
				echo $emailTest->getSenderEmail(); //return email address
			
				echo $emailTest->getSubject(); //return email address
	
				echo $emailTest->sendEmail(); //send email to SMTP server	
	 
			}
			catch(PDOException $e) {
				echo "WARNING WARNING WARNING";
			}
	?>

		<h3>Thank You!</h3>
		<p>An email has been sent to <?php echo $inEmail; ?> with the pooled results.</p>

	<?php
		}	
		else
		{	
	?>	
	<?php
  }	
    
?>
<?php

if(!$validForm && (!empty($validForm))){
	try {		

		$message = "";
		$inEmail = $_POST['email'];	
		$fromEmail = "ry_blank@hotmail.com";
		$emailSubject = "And the favorite NFL team is...";

		require 'Emailer.php'; //access the class file

		$emailTest = new Emailer(); //instantiate a new Emailer object

		$emailTest->setMessage($message);

		$emailTest->setRecipientEmail($inEmail);

		$emailTest->setSenderEmail($fromEmail);

		$emailTest->setSubject($emailSubject);

		echo $emailTest->getMessage(); //return email address

		echo $emailTest->getRecipientEmail(); //return email address

		echo $emailTest->getSenderEmail(); //return email address
	
		echo $emailTest->getSubject(); //return email address

		echo $emailTest->sendEmail(); //send email to SMTP server	

	}
	catch(PDOException $e) {
		echo "WARNING WARNING WARNING";
	}
}
else
{

}

?>

<?php
//set default values
$inEmailToLogin = "";
$inFirstName = "";
$inLastName = "";
$inProgram = "";
$inProgram2 = "";
$inWebsiteAddress = "";
$inEmail = "";
$inLinkedIn = "";
$inWebsiteAddress2 = "";
$inHometown = "";
$inCareerGoals = "";
$inThreeWords = "";

//set error messages
$inEmailToLoginErrMsg = "";
$inFirstNameErrMsg = "";
$inLastNameErrMsg = "";
$inProgramErrMsg = "";
$inProgram2ErrMsg = "";
$inWebsiteAddressErrMsg = "";
$inEmailErrMsg = "";
$inLinkedInErrMsg = "";
$inWebsiteAddress2ErrMsg = "";
$inHometownErrMsg = "";
$inCareerGoalsErrMsg = "";
$inThreeWordsErrMsg = "";
$validForm = "" ;
$inInRobotest = "";

function validateFirstName(){
	//required & valid first name should only include letters, numbers, and spaces 
	global $inFirstName,$inFirstNameErrMsg,$validForm;
	$inFirstNameErrMsg="";
	
	if(empty($inFirstName)){ 
		$validForm = "false";
		$inFirstNameErrMsg = "First Name is required";
	}else{
		if(!preg_match("/([a-zA-Z0-9 ])/",$inFirstName)){
			$validForm = "false";
			$inFirstNameErrMsg = "Only include letters, numbers and spaces in First Name";
		}
	}
}

function validateLastName(){
	//required & valid last name should only include letters, numbers and spaces
	global $inLastName,$inLastNameErrMsg,$validForm;
	$inLastNameErrMsg="";
	
	if(empty($inLastName)){
		$validForm = "false";
		$inLastNameErrMsg = "Last Name is required";
	}else{
		if(!preg_match("/([a-zA-Z0-9 ])/",$inLastName)){
			$validForm = "false";
			$inLastNameErrMsg = "Only include letters, numbers and spaces in Last Name";
		}
	}
}
function validateProgram(){
	//valid program must not be default options
	global $inProgram,$inProgramErrMsg,$validForm;
	$inProgramErrMsg="";
	
	if($inProgram == "default"){
		$validForm = "false";
		$inProgramErrMsg = "Program must be selected";
	}
}
function validateWebsiteAddress(){
	//valid URL format
	global $inWebsiteAddress,$inWebsiteAddressErrMsg,$validForm;
	$inWebsiteAddressErrMsg="";

	if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$inWebsiteAddress)) {
		$validForm = "false";
		$inWebsiteAddressErrMsg = "Invalid URL";
	}	
}
function validateWebsiteAddress2(){
	//valid URL format	
	global $inWebsiteAddress2,$inWebsiteAddress2ErrMsg,$validForm;
	$inWebsiteAddress2ErrMsg="";
	
	if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$inWebsiteAddress2)) {
		$validForm = "false";
		$inWebsiteAddress2ErrMsg = "Invalid URL";
	}
}
function validateLinkedIn(){
	//valid URL to linkedin.com_address
	global $inLinkedIn,$inLinkedInErrMsg,$validForm;
	$inLinkedInErrMsg="";
	
	if(!preg_match("/(linkedin.com)/",$inLinkedIn)){
		$validForm = "false";
		$inLinkedInErrMsg = "Invalid LinkedIn Profile";
	}
}
function validateEmail(){
	//valid email should be in a proper format  
	//Matches: bob@aol.com | bob@wrox.co.uk | bob@domain.info |123@123.123
	//Non-Matches: a@b | notanemail | bob@@.
	global $inEmail,$inEmailErrMsg,$validForm;
	$inEmailErrMsg="";
	
	if (!filter_var($inEmail, FILTER_VALIDATE_EMAIL)) {
		$validForm = "false";
		$inEmailErrMsg = "Invalid Email";
	}
}
function validateHometown(){
	//required & valid name should only include letters, numbers, spaces, and commas
	global $inHometown,$inHometownErrMsg,$validForm;
	$inHometownErrMsg="";
	
	if(empty($inHometown)){
		$validForm = "false";
		$inHometownErrMsg = "Hometown is required";
	}
	if(!preg_match("/([a-zA-Z0-9, ])/",$inHometown)){
		$validForm = "false";
		$inHometownErrMsg = "Only include letters, numbers, spaces, and commas in Hometown";
	}
}
function validateCareerGoals(){
	//valid career goals should include only numbers, letters, spaces, and basic punctuation
	global $inCareerGoals,$inCareerGoalsErrMsg,$validForm;
	$inCareerGoalsErrMsg="";
	
	if(!preg_match("/([a-zA-Z0-9,.'?! ])/",$inCareerGoals)){
		$validForm = "false";
		$inCareerGoalsErrMsg = "Only include letters, numbers, spaces and basic punctuation (,.'?!) in Career Goals";
	}
}	
function validateThreeWords(){
	//valid three-words should include only numbers, letters, spaces, and basic punctuation
	global $inThreeWords,$inThreeWordsErrMsg,$validForm;
	$inThreeWordsErrMsg="";
	
	if(!preg_match("/([a-zA-Z0-9,.'?! ])/",$inThreeWords)){
		$validForm = "false";
		$inThreeWordsErrMsg = "Only include letters, numbers, spaces and basic punctuation (,.'?!) in Three Words";
	}	
}

if(isset($_POST['submitBio']) )
{
	echo "<h1>Thank you for submitting this form.</h1>";

	$inEmailToLogin = $_POST['emailToLogin'];       
	$inFirstName = $_POST['firstName'];
	$inLastName = $_POST['lastName'];
	$inProgram = $_POST['program'];
	$inProgram2 = $_POST['program2'];
	$inWebsiteAddress = $_POST['websiteAddress'];
	$inEmail = $_POST['email'];
	$inLinkedIn = $_POST['linkedIn'];
	$inProgram = $_POST['program'];
	$inWebsiteAddress2 = $_POST['websiteAddress2'];
	$inHometown = $_POST['hometown'];
	$inCareerGoals = $_POST['careerGoals'];
	$inThreeWords = $_POST['threeWords'];

	// Input Field validations. 
	validateFirstName();
	validateLastName();
	validateProgram();
	validateWebsiteAddress();
	validateLinkedIn();
	validateEmail();
	validateHometown();
	validateCareerGoals();
	validateThreeWords();

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
			
	if(!$validForm) //Check the form flag.  If it is still true all the data is valid and the form is ready to process
	{
		// The form  data is valid and can be processed into your database.
		echo "<h1>Thank you for your order.</h1>";
		echo "<p>Your order will be processed</p>";
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
	echo "<h1>Please enter your information</h1>";
}
	

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>DMACC Portfolio Day Bio Form</title>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

<!--  <link href="css/normalize.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  


<script src="css3-mediaqueries.js"></script>-->
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<!--<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>-->

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

		$("#resetBio").on("click", (function(){
			
			$("#firstNameError").html("");
			$("#lastNameError").html("");
			$("#programError").html("");
			$("#program2Error").html("");
			$("#websiteAddressError").html("");
			$("#websiteAddress2Error").html("");
			$("#emailError").html("");
			$("#hometownError").html("");
			$("#careerGoalsError").html("");
			$("#linkedInError").html("");
			$("#threeWordsError").html("");
			
		}));
	});
	
</script>
  
  <style>
	img{
		display: block;
		margin: 0 auto;
	}
	.frame{
		background-image: url("orange popsicle.jpg");
		padding: 1em;	
	}
	.frame2{
		background-image: url("citrus.jpg");
		padding: 1.3em;	
	}	
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
	.citrus{
		margin: auto;
		background-image: url("raspberry.jpg");
		padding: 1.3em;	
		width: 70%;
	}
	.bamboo{
		background-image: url("bamboo.jpg");
		padding: 1em;	
	}	
	.violet{
		background-image: url("ultra violet.png");
		padding: .5em;	
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
  img {
    width:100%;
  }
  .form {
	width:100%; 
	padding-left: .1em;
	padding-top: .1em;
  }
  .citrus {
	background-image:none;  
  }
  .bamboo {
	background-image:none;  
  } 
  .violet {
	background-image:none;  
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

<section class="orange">
<body>

<div class="frame2">
<div class="frame">

  <div class="main">
  <div><img src="madonna.gif" alt="Mix gif" ></div>
  <br>

<!--<a href = 'dmaccPortfolioDayLogout.php'>Log Out</a>-->

<section class="citrus">
<section class="bamboo">
<section class="violet">

	<div class="main form">
	
	<h2></h2>
	

	</table>
	<!--<form id="portfolioBioForm" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"-->
	<form id="portfolioBioForm" method="post" action="studentInfoForm.php">
		
		<table>
		<tr>
		<td>Login Email:<br> <input type="text" id="emailToLogin" name="emailToLogin" value="<?php echo $inEmailToLogin; ?>"/></td>
		</tr>
		<tr>
		<td>First Name:<br> <input type="text" id="firstName" name="firstName" value="<?php echo $inFirstName; ?>"/><br>
			<span class="error" id="firstNameError"><?php echo $inFirstNameErrMsg;?></span></td>
		</tr>
		<tr>
		<td>Last Name:<br> <input type="text" id="lastName" name="lastName" value="<?php echo $inLastName; ?>" /><br>
			<span class="error" id="lastNameError"><?php echo $inLastNameErrMsg;?></span></td>
		</tr>
		<tr>
		<td >Program:<br> 
		  <select id="program" name="program">
			<option value="default" <?php if (isset($inProgram) && $inProgram =="none") echo "selected";?>>---Select Your Program---</option>
			<option value="animation" <?php if (isset($inProgram) && $inProgram =="animation") echo "selected";?>>Animation</option>
			<option value="graphicDesign" <?php if (isset($inProgram) && $inProgram =="graphicDesign") echo "selected";?>>Graphic Design</option>
			<option value="photography" <?php if (isset($inProgram) && $inProgram =="photography") echo "selected";?>>Photography</option>
			<option value="videoProduction" <?php if (isset($inProgram) && $inProgram =="videoProduction") echo "selected";?>>Video Production</option>
			<option value="webDevelopment" <?php if (isset($inProgram) && $inProgram =="webDevelopment") echo "selected";?>>Web Development</option>
		  </select><br><span class="error" id="programError"><?php echo $inProgramErrMsg;?></span><td>
		</tr>
		<tr>
		<td >Secondary Program:<br> 
		  <select id="program2" name="program2">
			<option value="none" <?php if (isset($inProgram2) && $inProgram2 =="none") echo "selected";?> >---No Secondary Program---</option>
			<option value="animation" <?php if (isset($inProgram2) && $inProgram2 =="animation") echo "selected";?> >Animation</option>
			<option value="graphicDesign" <?php if (isset($inProgram2) && $inProgram2 =="graphicDesign") echo "selected";?> >Graphic Design</option>
			<option value="photography" <?php if (isset($inProgram2) && $inProgram2 =="photography") echo "selected";?> >Photography</option>
			<option value="videoProduction" <?php if (isset($inProgram2) && $inProgram2 =="videoProduction") echo "selected";?> >Video Production</option>
			<option value="webDevelopment" <?php if (isset($inProgram2) && $inProgram2 =="webDevelopment") echo "selected";?> >Web Development</option>
		  </select><br>
			
	<!--		<script type="text/javascript">
				document.getElementById('program2'.value = "<?php echo $_GET['program2']; ?>";
			</script>
	-->
			<span class="error" id="program2Error"></span><td>
		</tr>
		<tr>
		<td>Website Address:<br> <input type="text" id="websiteAddress" name="websiteAddress" value="<?php echo $inWebsiteAddress; ?>"/><br>
			<span class="error" id="websiteAddressError"><?php echo $inWebsiteAddressErrMsg;?></span></td>
		</tr>
		<tr>
		<td>Personal Email:<br><input type="text" id="email" name="email" value="<?php echo $inEmail; ?>" /><br>
			<span class="error" id="emailError"><?php echo $inEmailErrMsg;?></span></td>
		</tr>
		<tr>
		<td>LinkedIn Profile:<br><input type="text" id="linkedIn" name="linkedIn" value="<?php echo $inLinkedIn; ?>" /><br>
			<span class="error" id="linkedInError"><?php echo $inLinkedInErrMsg;?></span></td>
		<tr>
		<td><span class="secondWeb">Secondary Website Address (git repository, etc.):<br> 
			<input type="text" id="websiteAddress2" name="websiteAddress2" value="<?php echo $inWebsiteAddress2; ?>"/><br>
			<?php echo $inWebsiteAddress2ErrMsg;?><span class="error" id="websiteAddress2Error"></span></span></td>
		</tr>
		<tr>
		<td>Hometown:<br> <input type="text" id="hometown" name="hometown" value="<?php echo $inHometown; ?>"/><br>
			<span class="error" id="hometownError"><?php echo $inHometownErrMsg;?></span></td>
		</tr>
		<tr>
		<td>Career Goals:<br> <textarea id="careerGoals" name="careerGoals"><?php echo $inCareerGoals; ?></textarea><br>
			<span class="error" id="careerGoalsError"><?php echo $inCareerGoalsErrMsg;?></span></td>
		</tr>
		<tr>
		<td>3 Words that Describe You:<br> <input type="text" id="threeWords" name="threeWords" value="<?php echo $inThreeWords; ?>"/>
			<br><span class="error" id="threeWordsError"><?php echo $inThreeWordsErrMsg;?></span></td>
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
		<td><input type="submit" id="submitBio" name="submitBio" value="Submit Bio" /></td>
		</tr>
		<tr>
		<td><input type="reset" id="resetBio" name="resetBio" value="Reset Bio" onClick="this.form.reset()" /></td> 
		</tr>
		</table>
	</form>
	
	</div>
	

</section>	
</section>
</section>
  
</div>

</body>
</section>

</html>
		<?php
	
		if(!$validForm && (!empty($validForm))){
	?>
		<h3>Thank You!</h3>
		<p>Your order has been processed. An email has been sent to <?php echo $inEmail; ?> for your records.</p>

	<?php
		}	
		else
		{	
	?>	
	<?php
  }	
?>
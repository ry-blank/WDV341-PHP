<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Functions</title>
</head>
<body>

<?php
date_default_timezone_set ( "America/Chicago" );
$timeOfDay = date('h:i:s');
echo $timeOfDay;
?>
<h1>PHP Functions</h1>
<p>Create a PHP page that will process and display the following pieces of information.  Use a combination of custom PHP functions and functions from the PHP API as needed. </p>

<p>Your page should do the following:</p>
<br>
<p>Create a function that will accept a date input and format it into mm/dd/yyyy format.</p>
    <?php
        function standardDate() // used to create standard date format to month, day, year.
        {
            $date='2020-01-31';
            echo date('m/d/Y',strtotime($date));
	    }
    ?>

</p><?php standardDate();?></p>


<p>Create a function that will accept a date input and format it into dd/mm/yyyy format to use when working with international dates.</p>
    <?php
        function internationalDate() // used to create international date format to day, month, year.
        {
            $date=date_create("31-01-2020");
            echo date_format($date,"d/m/Y");
	    }
    ?>

</p><?php internationalDate();?></p>
    
    
<p>Create a function that will accept a string input.  It will do the following things to the string:</p>
    <?php
        function simpleString($stringInput)
        {
            $characterLength=strlen($stringInput);
            $trimString=trim($stringInput);
            $lowercareString=strtolower($stringInput);
            $containsDMACC=strpos($stringInput, "dmacc");
            echo "The string is " . '<strong>' . $stringInput . '</strong>' . " It has " . $characterLength . "characters and 
            will display if DMACC is in string. Is DMACC in the string? ";
            if ($containsDMACC == true){
                echo "Yes, it is.";
            }
            else {
                echo "No, it is not.";
            }
        }
    ?>
        <p>Display the number of characters in the string</p>
        <p>Trim any leading or trailing whitespace</p>
        <p>Display the string as all lowercase characters</p>
        </p><?php echo strtolower(" Chiefs win the Superbowl! ")?></p>
        <p>Will display whether or not the string contains "DMACC" either upper or lowercase</p>

        </p><?php simpleString(" Chiefs win the Superbowl! ")?></p>
               

<p>Create a function that will accept a number and display it as a formatted number.   Use 1234567890 for your testing.</p>
    <?php
        function numberFormat() // used to create international date format to day, month, year.
        {
            echo number_format("1234567890");
	    }
    ?>

</p><?php numberFormat();?></p>


<p>Create a function that will accept a number and display it as US currency.  Use 123456 for your testing.</p>
    <?php
        function currencyFormat() // used to create international date format to day, month, year.
        {
            echo '$' .number_format("123456",2);
	    }
    ?>

</p><?php currencyFormat();?></p>

</body>
</html>
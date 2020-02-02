<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Basics</title>
</head>

<body>

<h1>PHP Basics</h1>

<p>Create a PHP page for this assignment. Use a combination of PHP, HTML and Javascript to perform the following processes.</p>

<p>1. Create a variable called yourName.  Assign it a value of your name.</p>
<?php
	$yourName = "Ryan Blankenship";
?>

<p>2. Display the assignment name in an h1 element on the page. Include the elements in your output. </p>
    <?php echo '<h1>' . $yourName . '</h1>'; ?>

<p>3. Use HTML to put an h2 element on the page. Use PHP to display your name inside the element using the variable.</p>
    <h2><?php echo $yourName ?></h2>

<p>4. Create the following variables:  number1, number2 and total.  Assign a value to them.  </p>
<?php
    $number1 = "5";
    $number2 = "10";
    $total = "15";
?>

<p>5. Display the value of each variable and the total variable when you add them together. </p>
    <p>First number: <?php echo $number1 ?></p>
    <p>Second number: <?php echo $number2 ?></p>
    <p>Adding <?php echo $number1 ?> + <?php echo $number2 ?> equals: <?php echo $total ?></p>

<p>Use PHP to create a Javascript array with the following values: PHP,HTML,Javascript.  Output this array using PHP.  
Create a script that will display the values of this array on your page.  NOTE:  Remember PHP is building the array not running it.</p>
<?php
    $devTools = array("PHP", "HTML", "Javascript");
    echo "Some Web Developer tools are " . $devTools[0] . ", " . $devTools[1] . " and " . $devTools[2] . ".";
?> 

</body>
</html>
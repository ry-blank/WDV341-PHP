<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Emailer</title>
</head>
<body>
    <?php
        require 'Emailer.php'; //access the class file

        $emailTest = new Emailer(); //instantiate a new Emailer object

        $emailTest->setMessage("Message: Hello World!");

        $emailTest->setRecipientEmail("Recipient Email: ry_blank@hotmail.com");

        $emailTest->setSenderEmail("Sender Email: ry_blank@hotmail.com");

        $emailTest->setSubject("Subject: Emailer Class");

        echo $emailTest->getMessage(); //return email address

        echo $emailTest->getRecipientEmail(); //return email address

        echo $emailTest->getSenderEmail(); //return email address
        
        echo $emailTest->getSubject(); //return email address

        echo $emailTest->sendEmail(); //send email to SMTP server

    ?>
</body>
</html>
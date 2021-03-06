<?php

class Emailer {
    //this class will process a PHP email and send it.
    
    //property declaration

    //access identifier property name
    //private means you cannot access the property outside the object

    private $message = ""; //
    private $inEmail = ""; //
    private $fromEmail = ""; //
    private $emailSubject = ""; //

    //constructor method
    //1. DOES NOT make a new object
    //2. initializes the new object default values

    public function __construct() {

    }

    //methods

        //setter methods - used to set property values into the object
        //      one method per property
        //setters are going to be public, means global access

        public function setMessage($inVal) {
            $this->message = $inVal; //assign input to message
        }

        public function setRecipientEmail($inVal) {
            $this->inEmail = $inVal; //assign input to message
        }

        public function setSenderEmail($inVal) {
            $this->fromEmail = $inVal; //assign input to message
        }

        public function setSubject($inVal) {
            $this->emailSubject = $inVal; //assign input to message
        }

        //getter methods - used to return the value from the property object
        //      one method per property

        public function getMessage() {
            return $this->message;
        }
        public function getRecipientEmail() {
            return $this->inEmail;
        }
        public function getSenderEmail() {
            return $this->fromEmail;
        }
        public function getSubject() {
            return $this->emailSubject;
        }

        //processing methods - everything else

        public function sendEmail() {
            //this will format and send an email to the SMTP Server
            //it will use the PHP mail()

            $to = $this->getRecipientEmail();
            $subject = $this->getSubject();
            $message = $this->getMessage();
            $headers = 'From: <ry_blank@hotmail.com>';


            mail($to, $subject, $message, $headers); //PHP Function
        }

}
?>
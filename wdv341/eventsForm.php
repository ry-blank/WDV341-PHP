<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Events Form</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<h2>Events Forms</h2>

<form id="form1" name="form1" method="post" action="insertEvents.php">
  <label for="eventName">Event Name:</label><br>
  <input type="text" id="eventName" name="eventName"><br><br>

  <label for="eventPresenter">Event Presenter:</label><br>
  <input type="text" id="eventPresenter" name="eventPresenter"><br><br>

  <label for="eventDate">Event Event Date:</label><br>
  <input type="date" id="eventDate" name="eventDate"><br><br>

  <label for="eventTime">Event Time:</label><br>
  <input type="time" id="eventTime" name="eventTime"><br><br>

  <label for="eventDescription">Event Description:</label><br>
  <input type="text" id="eventDescription" name="eventDescription"><br><br>

  <div class="g-recaptcha" data-sitekey="6LfRZ98UAAAAAHxPaq7uXv7bOsfXglV8-KpVGbHa"></div><br><br>

  <input type="submit" value="Submit">
</form> 
</body>
</html>
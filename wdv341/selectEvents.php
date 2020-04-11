<?php
echo "<table style='border: solid 1px black;'>";
echo "<tr>
      <th>Event ID</th>  
      <th>Event Name</th>
      <th>Event Description</th>
      <th>Event Presenter</th>
      <th>Event Date</th>
      <th>Event Presenter</th>
      </tr>";

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
}

require 'dbConnection.php'; //access and run this external file

try {
    $stmt = $conn->prepare("SELECT event_id, event_name, event_description, event_presenter, event_date, event_time
                            FROM wdv341_event");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?> 
<html>
<head>
<Title>Search form</Title>
<style type="text/css">
    body { background-color: #fff; border-top: solid 10px #000;
        color: #333; font-size: .85em; margin: 20; padding: 20;
        font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
    }
    h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
    h1 { font-size: 2em; }
    h2 { font-size: 1.75em; }
    h3 { font-size: 1.2em; }
    table { margin-top: 0.75em; }
    th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
    td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
</style>
</head>
<body>
<h1>Search here! test</h1>
<p>Do a search!</p>
<form method="get" action="page2.php" enctype="multipart/form-data" >
      Name to search for  <input type="text" name="name" id="name"/></br>
      <input type="submit" name="submit" value="Submit" />
</form>

<form action="http://localhost/registration/page2.php">
    <input type="submit" value="Go to Search Page">
</form>


<?php
    // DB connection info
    //TODO: Update the values for $host, $user, $pwd, and $db
    //using the values you retrieved earlier from the portal.
    $host = "us-cdbr-azure-east2-d.cloudapp.net";
    $user = "bd817b0d6a7ca7";
    $pwd = "fc36d3c6";
    $db = "coursewAeRbCRZJu";
    // Connect to database.
    try {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e){
        die(var_dump($e));
    }
    // Insert registration info

  
    if(!empty($_GET)) {
    try {
        $name = $_GET['name'];
        $searched = True; 
        
    }
    catch(Exception $e) {
        die(var_dump($e));
    }

    }
    if ($searched == TRUE) {

    // Retrieve data
    $sql_select = "SELECT * FROM registration_tbl
    WHERE name LIKE '%$name%'";

    $stmt = $conn->query($sql_select);
    $registrants = $stmt->fetchAll(); 
    if(count($registrants) > 0) {
        echo "<h2>Results of the search</h2>";
        echo "<table>";
        echo "<tr><th>Company Name</th>";
        echo "<th>Name</th>";
        echo "<th>Email</th>";
        echo "<th>Date</th></tr>";

        foreach($registrants as $registrant) {
            echo "<tr><td>".$registrant['company']."</td>";
            echo "<td>".$registrant['name']."</td>";
            echo "<td>".$registrant['email']."</td>";
            echo "<td>".$registrant['date']."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h3>There were no results</h3>";
  }  }
?>
</body>
</html>
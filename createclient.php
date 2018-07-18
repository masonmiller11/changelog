<?php

//This script uses an INSERT query to add records to the users table.
$page_title = "Html Check";
include('includes/header.html');

if ($_SERVER['REQUEST_METHOD']=='POST') {
  $client = trim($_POST['client']);
  require('../changelog_mysqli_connect.php'); //Let's open the database...
  $q = "INSERT INTO clients (client_name)
  VALUES ('$client')";
  $r = @mysqli_query($dbc,$q);
  if($r) { //So if the query returned true (which means it ran).
    echo '<h1>Thank You!</h1>
    <p>Client is registered</p>
    </p><p><br></p>';
  } else {
    echo '<h1>Ahhhhhhh Shiittttttttt</h1>
    <p>There was some issue with submitting your information. Go get Mason and tell him what it says below.</p>';
    echo'<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';
    ;
  }
} ?>
<h1>Add This Client to Changelog</h1>
<form action="createclient.php" method="post">
<p>Client: <input type="text" name="client" size="15" maxlength="100" value=""></p>
</form>

<?php include('includes/footer.html'); ?>

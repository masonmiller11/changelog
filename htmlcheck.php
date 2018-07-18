<?php

//This script uses an INSERT query to add records to the users table.
$page_title = "Html Check";
include('includes/header.html');


if ($_SERVER['REQUEST_METHOD']=='POST') {
  $page_title = trim($_POST['pt']);
  $url = trim($_POST['url']);
  $platform = trim($_POST['platform']);
  $client_id = trim($_POST['client']);
  $form = trim($_POST['form']);
  $page_content = file_get_contents($url);
  $page_content = preg_replace('/\PL/u', '', $page_content);
  echo "<h1>Below is the page content for $url</h1></p>$$page_content</p>";
  require('../changelog_mysqli_connect.php'); //Let's open the database...
  $q = "INSERT INTO content (html_content, page_url, page_title, client_id, platform, form)
  VALUES ('$page_content', '$url', '$page_title', '$client_id', '$platform', '$form')";
  $r = @mysqli_query($dbc,$q);
  if($r) { //So if the query returned true (which means it ran).
    echo '<h1>Thank You!</h1>
    <p>Content is registered</p>
    </p><p><br></p>';
  } else {
    echo '<h1>Ahhhhhhh Shiittttttttt</h1>
    <p>There was some issue with submitting your information. Go get Mason and tell him what it says below.</p>';
    echo'<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';
    ;
  }
} ?>
<h1>Add This URL to Changelog</h1>
<form action="htmlcheck.php" method="post">
<p>URL: <input type="text" name="url" size="15" maxlength="100" value=""></p>
<p>Page Title: <input type="text" name="pt" size="15" maxlength="100" value=""></p>
<p>Platform:</p><select name="platform">
  <option value="AdWords">AdWords</option>
  <option value="Facebook">Facebook</option>
  <option value="Email">Email</option>
  <option value="FTP Site">FTP Site</option>
  <option value="Internal">Internal</option>
  <option value="Misc">Other</option>
</select>
<p>Does This Page Have A Form?</p><select name="form">
  <option value="yes">Yes</option>
  <option value="no">No</option>
</select>
<p>Client:</p>
<?php
require('../changelog_mysqli_connect.php');
$result = $dbc->query("SELECT client_id, client_name FROM clients");
  echo "<select name='client'>";
  while ($row = $result->fetch_assoc()) {
                unset($id, $name);
                $id = $row['client_id'];
                $name = $row['client_name'];
                echo '<option value="'.$id.'">'.$name.'</option>';
}
  echo "</select>";
?>
<p><input type="submit" name="submit" value="Register"></p>
</form>
<?php include('includes/footer.html'); ?>

<?php

//This script uses an INSERT query to add records to the users table.
$page_title = "Html Check";
include('includes/header.html');
if ($_SERVER['REQUEST_METHOD']=='POST') {
  require('../changelog_mysqli_connect.php');
  $result = $dbc->query("SELECT * FROM content");
  while ($content_info = $result->fetch_assoc()) {
          $html_content = $content_info['html_content'];
          $client = $content_info['client_id'];
          $page_url = $content_info['page_url'];
          $page_title = $content_info['page_title'];
          $new_content = file_get_contents($page_url);
          $new_content = preg_replace('/\PL/u', '', $new_content);
            if(strcmp($new_content, $html_content) == 0) {
              echo '<p>Does not look like there was any changes for this page<br>Client: ' . $client .
              ' Page URL: ' . $page_url . ' Page Title: ' . $page_title . '</p>';
            } else {
              echo '<p>Something has changed on this page<br>Client: ' . $client .
              ' Page URL: ' . $page_url . ' Page Title: ' . $page_title . '</p>' . $new_content;
            }
          }
        }
?>
<form action="runchangelog.php" method="post">
<p><input type="submit" name="run" value="Run Changelog!"></p>
</form>
<?php include('includes/footer.html'); ?>

<?php
  require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if($conn->connect_error) die("Fatal Error");

  if(isset($_POST['delete']) && isset($_POST['twitter']))
  {
    $twitter = get_post($conn, 'twitter');
    $query = "DELETE FROM btftest WHERE twitter='$twitter'";
    $result = $conn->query($query);
    if(!$result) echo "DELETE failed<br><br>";
  }

  if(isset($_POST['twitter']) &&
     isset($_POST['instagram']) &&
     isset($_POST['section']))
  {
    $twitter = get_post($conn, 'twitter');
    $instagram = get_post($conn, 'instagram');
    $section = get_post($conn, 'section');
    $id = null;
    $query = "INSERT INTO btftest VALUES" . " ('$twitter', '$instagram', '$section', '$id')";
    $result = $conn->query($query);
    if(!$result) echo "INSERT failed<br><br>";
  }

  echo <<<_END
  <form action="sqltest.php" method="post"><pre>
  Twitter <input type="text" name="twitter">
  Instagram <input type="text" name="instagram">
  Section <input type="text" name="section">
  <input type="submit" value="ADD RECORD">
  </pre></form>
_END;

  $query = "SELECT * FROM btftest";
  $result = $conn->query($query);
  if (!result) die("Database access failed");

  $rows = $result->num_rows;

  for($j = 0 ; $j < $rows ; ++$j)
  {
    $row = $result->fetch_array(MYSQLI_ASSOC);

    $r0 = htmlspecialchars($row['twitter']);
    $r1 = htmlspecialchars($row['instagram']);
    $r2 = htmlspecialchars($row['section']);

    echo <<<_END
  <pre>
    Twitter $r0
    Instagram $r1
    Section $r2
  </pre>
  <form action='sqltest.php' method='post'>
  <input type='hidden' name='delete' value='yes'>
  <input type='hidden' name='twitter' value='$r0'>
  <input type='submit' value='DELETE RECORD'></form>
_END;
  }

  $result->close();
  $conn->close();

  function get_post($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }
?>

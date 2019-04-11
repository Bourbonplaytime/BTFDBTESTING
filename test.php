<?php
  require_once 'login.php';
  $connection = new mysqli($hn, $un, $pw, $db);

  if ($connection->connect_error) die("fatal error");

  $query = "SELECT * FROM btftest";
  $result = $connection->query($query);

  if (!$result) die("fatal error");

  $rows = $result->num_rows;

  for ($j = 0 ; $j < $rows ; ++$j)
  {
    $row = $result->fetch_array(MYSQLI_ASSOC);
    echo 'Twitter ' . htmlspecialchars($row['twitter']) . '<br>';
    echo 'Instagram ' . htmlspecialchars($row['instagram']) . '<br>';
    echo 'Section ' . htmlspecialchars($row['section']) . '<br><br>';
  }

  $result->close();
  $connection->close();
?>

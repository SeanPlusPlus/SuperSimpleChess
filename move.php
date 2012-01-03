<?
$db = new PDO('sqlite:chess.db');
$result = $db->query('SELECT * FROM moves');
$moveNumber = 0;
$displayNumber = 0;
foreach($result as $row)
{
  if ($row[0] & 1) {
    $displayNumber = $displayNumber + 1;
    print "\t  ".$displayNumber.". ".$row['move'];
  }
  else {
    print " ".$row['move']."\n";

  }
  $moveNumber = $moveNumber + 1;
}

if (($_POST['move'])  ) {
  $num = $moveNumber + 1;
  $move = htmlspecialchars($_POST['move']);
  $db->query("INSERT INTO moves (id, move) VALUES ('$num','$move')");
  $db = NULL;
  echo"<script>window.location.reload();</script>";
}

$db = NULL;
?>

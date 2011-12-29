<?
if (($_POST['move']) == 'e5') {
  $num = $moveNumber + 1;
  $move = $_POST['move'];
  $db->query("INSERT INTO moves (id, move) VALUES ('$num','$move')");
}
?>

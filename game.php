<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Super Simple Chess</title>
  <link rel="stylesheet" href="stylesheets/main.css" type="text/css" media="screen" title="no title" charset="utf-8">
  <link rel="stylesheet" href="stylesheets/chess.css" type="text/css" media="screen" title="no title" charset="utf-8">
  <script src="javascripts/jquery-1.7.min.js" type="text/javascript"></script>
  <script src="javascripts/jchess-0.1.0.js" type="text/javascript"></script>
  <script src="javascripts/getInputs.js" type="text/javascript"></script>
</head>
<body>
  <div id="wrapper">
    <div id="game">
      <h1>Super Simple Chess</h1>
      <div id='exitStatus'></div>
      <div id="board3" class="board"></div>
      <p class="annot"></p>
      <form name="move" method="post">
        <input type="text" name="move" id="myMove"/>
        <input type="submit" value="Submit"/>
      </form>
      <pre id="game0001">
      <!-- stoke to begin hacks -->
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
      </pre>

      <div id="controls">
        <a class="back" href="#">&#171; back</a>
        <a class="next" href="#">next &#187;</a>
      </div>
    </div>

  </div>

<script type="text/javascript">
jQuery(function($) {
  function loadChessGame(container, options, callback) {
    var chess = $('.board', container).chess(options);
    $('.back', container).click(function() {
      chess.transitionBackward();
      $('.annot', container).text( chess.annotation() );
      return false;
    });
    $('.next', container).click(function() {
      chess.transitionForward();
      $('.annot', container).text( chess.annotation() );
      return false;
    });
    $('.flip', container).click(function() {
      chess.flipBoard();
      return false;
    });
    if ( typeof callback != "undefined" ) { callback(chess) };
  }

  try {
    <?
      if($moveNumber>0) {
        echo "loadChessGame( '#game', { pgn : $('#game0001').html() }, function(chess) { chess.transitionTo($moveNumber) });";
      }
      else {
        echo "loadChessGame( '#game', {} );";
      }
    ?>
  }
  catch(e) {
    $('#game').hide();
    $('#myErr').show();
    <?
    if (($_POST['undo'])) {
      $db = new PDO('sqlite:chess.db');
      $db->query("DELETE FROM moves WHERE id=$moveNumber");
      $db = NULL;
      echo "window.location.reload();";
    }
    ?>
  }

});
</script>

  <form id='myErr' name='undo' method='post'><input type='submit' value='ILLEGAL MOVE UNDO' name='undo' /></form>

<script type="text/javascript">
  jQuery('#myErr').hide();
</script>
</body>
</html>

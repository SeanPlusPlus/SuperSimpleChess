<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

  <title>jChess Examples</title>
  <link rel="stylesheet" href="stylesheets/main.css" type="text/css" media="screen" title="no title" charset="utf-8">
  <link rel="stylesheet" href="stylesheets/chess.css" type="text/css" media="screen" title="no title" charset="utf-8">
  <script src="javascripts/jquery-1.7.min.js" type="text/javascript"></script>
  <script src="javascripts/jchess-0.1.0.js" type="text/javascript"></script>
</head>
<body>

  <div id="wrapper">

    <div id="game">
      <h1>Super Simple Chess</h1>
      <div>
        <a class="back" href="#">Back</a>
        <a class="next" href="#">Next</a>
      </div>
      <div id="board3" class="board"></div>
      <p class="annot"></p>
      <form>
        <input type="text" name="Move" />
        <input type="submit" value="Submit" />
      </form>
      <pre id="game0001">
<?php
$db = new PDO('sqlite:chess.db');
$result = $db->query('SELECT * FROM moves');
$moveNumber = 0;
foreach($result as $row)
{
  if ($row[0] & 1) {
    $moveNumber = $moveNumber + 1;
    print "\t".$moveNumber.". ".$row['move'];
  } 
  else {
    print " ".$row['move']."\n";
  }
}
$db = NULL;
?>
      </pre>
    </div>

  </div>
</body>

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

  loadChessGame( '#game', { pgn : $('#game0001').html() }, function(chess) {
    chess.transitionTo(<?php print ($moveNumber*2) ?>)
  });
});
</script>

</html>

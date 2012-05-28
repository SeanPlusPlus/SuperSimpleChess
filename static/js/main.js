$( document ).ready( function() {
  $.getJSON( '/js/data.json', function( data ) {

    // default config
    var playerColor = 0,
        black = false;

    if ( black ) {
      playerColor = 1;
    }

    function renderGame() {
      drawBoard( playerColor );
      placeFigures();
      moveFigures();
    }

    function drawBoard(order) {
      $( 'tr' ).remove();

      if( order == 1 ) {
        var overRide = 0;
      }

      for ( i = 8 ; i > 0 ; i-- ) {
        var rank = i ;
        if( order == 1 ) {
          var rank = ( overRide += 1 ) ;
        }
        var row = "<tr>";
        if ( rank%2 == order ) {
          var primary = "light";
          var secondary = "dark";
        }
        else {
          var primary = "dark";
          var secondary = "light";
        }
        var files = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'];
        for ( file = 0 ; file < 4 ; file++ ) {
          row += "<td id='" + files[0] + rank + "'  class='" + primary + "'></td>";
          files.splice( 0,1 );
          row += "<td id='" + files[0] + rank + "' class='" + secondary + "'></td>";
          files.splice( 0,1 );
        }
        row += "</tr>";
        $( 'table' ).append( row );
      }
    };

    function placeFigures() {
      $.each( data, function( position, figure ) {
        $( '#' + position ).html(
          "<a class='figure' href='#'>" + figure[0] + "</a>"
        );
      });
    };

    function moveFigures() {
      var figureClicked = false,
          clickCount = 0,
          source,
          destination;
      $( 'td' ).click( function() {
        // you first need to click a figure, and a <td> will
        // only have a child element if there's a figure on it
        if( $( this ).children().length > 0 ){
          figureClicked = true;
        }
        if( figureClicked && ( clickCount < 2 ) ) {
          clickCount += 1;
          $( this ).css( 'background-color','yellow' );
          // source square
          if ( clickCount == 1 ) {
            source = $( this );
            sourceId = this.id;
          }
          // destination square
          if ( clickCount == 2 ) {
            destination = $( this );
            destinationId = ( this.id );
            $( this ).html( source.children( 'a' ) );
            source.html();
          }
        }
      });
    };

    renderGame();

    $( '#cancelMove' ).click( function() {
      renderGame();
    });

    $( '#submitMove' ).click( function() {
      console.log( data );
      console.log( sourceId );
      console.log( destinationId );
    });

  });
});

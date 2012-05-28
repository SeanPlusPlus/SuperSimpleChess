$( document ).ready( function() {
  $.getJSON( '/js/figures.json', function( data ) {

    // draw the board
    for ( rank = 8 ; rank > 0 ; rank-- ) {
      var row = "<tr>";
      if ( rank%2 == 0  ) {
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

    // place the figures on the board
    $.each( data, function( position, figure ) {
      $( '#' + position ).html(
        "<a class='figure' href='#'>" + figure[0] + "</a>"
      );
    });

    // move the figures around
    var figureClicked = false,
        clickCount = 0,
        source,
        destination;
    $( 'td' ).click( function() {
      // you first need to click a figure, and a <td> will
      // only have a child element if there's a figure on it
      if( $( this ).children().length  > 0 ){
        figureClicked = true;
      }
      if( figureClicked && ( clickCount < 2 ) ) {
        clickCount += 1;
        $( this ).css( 'background-color','yellow' );
        // source square
        if ( clickCount == 1 ) {
          source = $( this );
          console.log( source );
        }
        // destination destination
        if ( clickCount == 2 ) {
          destination = $( this );
          console.log( destination );
          $( this ).html( source.children( 'a' ) );
          source.html();
        }
      }
    });
  });
});

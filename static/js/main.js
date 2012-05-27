$( document ).ready( function() {
  var dataSet = {};
  $.getJSON( '/js/figures.json', function( data ) {
    var items = [];
    dataSet = data;

    // place the figures on the board
    $.each( dataSet, function( position, figure ) {
      $( '#' + position ).html(
        "<a class='figure' href='#'>" + figure[0] + "</a>"
      );
    });

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

        // source
        if ( clickCount == 1 ) {
          source = $( this );
          console.log( source );
        }

        // destination
        if ( clickCount == 2 ) {
          // remove figure from source

          // place figure on destination
          destination = $( this );
          console.log( destination );
          $( this ).html( source.children( 'a' ) );
          source.html();
        }
      }
    });
  });
});

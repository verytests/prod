
// GRADIENT LETTER


$( document ).ready(function() {
 	gradientLetter();
});


function gradientLetter(){

  $('.gradientLetter').each(function(i, obj) {

    var gradientLetter = $(this);
    
    var textValue = gradientLetter.text();
    var array = textValue.split("");  
    gradientLetter.text("");

    jQuery.each( array, function( i, val ) {
        var span = $('<span />').attr({'class':'gradientLetter-span'});
        span.text(val);
        gradientLetter.append(span);
    });

  });

}


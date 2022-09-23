$('#open').submit(function(event) {
    event.preventDefault();

    let data = $('#open').serialize();

    $.ajax({
        type:   "POST",
        url:    "../app/php/vraag.verwerk.php",
        data:   data,
        success: function(response) {
            $(".vraag-form")[0].reset();
            $(".vraag-form").hide();
        
        
            $('.msg').html(response);
            $('.msg').fadeIn();
            showMsg();
        },
        error: function(request, error) {
            console.log("FOUT: " + error);
        }
    });

});

$('#meerkeuze').submit(function(event) {
    event.preventDefault();
    let data = $('#meerkeuze').serialize();

    $.ajax({
        type:   "POST",
        url:    "../app/php/vraag.verwerk.php",
        data:   data,
        success: function(response) {
            $(".vraag-form")[0].reset();
            $(".vraag-form").hide();
        
        
            $('.msg').html(response);
            $('.msg').fadeIn();
            showMsg();
        },
        error: function(request, error) {
            console.log("FOUT: " + error);
        }
    });
});



$('#show1').click(function() {
    $('#open').hide();
    $('#meerkeuze').show();
}); 

$('#show2').click(function() {
    $('#open').show();
    $('#meerkeuze').hide();
}); 



function showMsg() {
    setTimeout(function() {
        $(".msg").fadeOut();
    }, 3000);
}

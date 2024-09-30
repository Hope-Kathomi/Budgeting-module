//var funders_currency;
$(document).ready(function(){
    console.log("Document ready");
    $('#currency_next_button').on('click', function(){
        var funders_currency = $('#funders_currency').val();
        var exchange_rate = $('#exchange_rate').val();

        console.log(funders_currency);
        console.log(exchange_rate);


        $.ajax({
            type: 'post',
            url: 'session_variables.php',
            data: {
                funders_currency: funders_currency, exchange_rate:exchange_rate
            },
            success: function(response){
                console.log(response);
                setTimeout(function(){
                    window.location.href = 'Personnel.php';
                },800);
                
            },
            error: function(xhr, status, error){
                console.error('AJAX error: ', error);
            }
        });
        
    });
});
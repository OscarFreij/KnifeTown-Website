function sendMessage()
{
    if (document.querySelector("#email").value.length > 0 && document.querySelector("#message").value.length > 0)
    {
        $d1 = document.querySelector("#email").value;
        $d2 = document.querySelector("#phone").value;
        $d3 = document.querySelector("#message").value;
        $d4 = document.querySelector("#type").value;
        $.post( "callback.php", { email: $d1, phone: $d2, message: $d3 , type: $d4} );
        alert("Meddelandet är nu skickat till oss!");
    }
    else
    {
        alert("Det saknas antingen mejladress eller ett meddelande. Försök igen!");
    }
    
}
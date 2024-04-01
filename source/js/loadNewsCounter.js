////////// Globale Variablen //////////
var counter = 1;
///////////////////////////////////////

function getCounter() {
    $.ajax({
        type: "GET",
        url: "/source/php/getNewsCounter.php",
        datatype: "json",
        success: function(data) {
            data = JSON.parse(data);
            if(data != false){    
                counter = data;
                console.log ("getCounter: " + counter + " Seiten");
                setCounter();
            }

        },
    });
}


//Starter für Funktionen
$(document).ready(function() {
    getCounter();
});
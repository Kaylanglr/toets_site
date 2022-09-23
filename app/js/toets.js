let aantalVragen = 0;
let current = 0;
let vraagCount = 0;

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
let toetsID = urlParams.get('toets');


function startToets() {
    $(".confirm").hide();
    $(".toets-form").removeClass('hidden');
    $.ajax({
        type:       "GET",
        url:        "../app/php/get.toets.php",
        data:       {"id": toetsID},
        dataType:   "JSON",
        success: function (array) {
            showToets(array);
        },
        error: function (request, error) {
            console.log ("FOUT:" + error);
        }
    }); 
}

function showToets(toetsData) {
    for(i=0; i < toetsData.length; i++) {
        aantalVragen++;
        vraagCount++;
        if(toetsData[i]['type'] == 'open') {
            $('.vragen').append(
            `<div class='vraag hidden' id="vraag${vraagCount}">
                <p class="count">${vraagCount}/${toetsData.length}</p>
                <h2>${toetsData[i]['vraag']}</h2>   
                <input type="text" name="antwoorden[]">
            </div>`
            ); 
        }
        else if (toetsData[i]['type'] == 'meerkeuze') {
            $('.vragen').append(
            `<div class='vraag hidden' id="vraag${vraagCount}">
                <p class="count">${vraagCount}/${toetsData.length}</p>
                <h2>${toetsData[i]['vraag']}</h2>    
                <div class="opties">
                    <input type="radio" id="a" name="antwoorden[]" value="A">
                    <label for="a">${toetsData[i]['opties']['optieA']}</label> <br>
                    <input type="radio" id="b" name="antwoorden[]" value="B">
                    <label for="b">${toetsData[i]['opties']['optieB']}</label> <br>
                    <input type="radio" id="c" name="antwoorden[]" value="C">
                    <label for="c">${toetsData[i]['opties']['optieC']}</label> <br>
                    <input type="radio" id="d" name="antwoorden[]" value="D">
                    <label for="d">${toetsData[i]['opties']['optieD']}</label>
                </div>
            </div>`
            ); 
        }
    }
    current++;
    $("#vraag1").removeClass('hidden');
}


function next() {
    $("#vraag"+current).addClass('hidden');
    current++;
    $("#vraag"+current).removeClass('hidden');

    if (current == aantalVragen) {
        $(".next").html('submit');
    }

    if (current > aantalVragen) {
        $(".toets-form").addClass('hidden');
        $(".finish").removeClass('hidden');
    }

}


function prev() {
    if (current > 1) {
        $(".next").html('Volgende');
        $("#vraag"+current).addClass('hidden');
        current--;
        $("#vraag"+current).removeClass('hidden');

    }
}

function finish() {
    $("#toets").submit();
}

function goBack() {
    current = aantalVragen;
    $("#vraag"+current).removeClass('hidden');
    $(".finish").addClass('hidden');
    $(".toets-form").removeClass('hidden');
}


$('#toets').submit(function(event) {
    event.preventDefault();
    
    let data = $('#toets').serialize();

    $.ajax({
        type:   "POST",
        url:    "../app/php/toets.verwerk.php",
        data:   data,
        success: function(resultaat) {
            $(".finish").addClass('hidden');
            $(".result").append(resultaat);
            $(".result").removeClass('hidden');            
        },
        error: function(request, error) {
            console.log("FOUT: " + error);
        }
    });

}); 
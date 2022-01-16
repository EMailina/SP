function pridajKomentar(id, autor) {
    var comment = document.getElementById('komentar').value;
    $.ajax({
        url: '?c=portfolio&a=addComment&id=' + id + '&comment=' + comment,
        method: 'POST',
        success: function (result) {
            let html = "";
            html += "<div class=\"card\"><div class=\"card-body\"><p class=\"card-text\">" + comment +
                "</p><p class=\"card-text\" style=\"text-align: right\"><small class=\"text-muted\">"
                + autor + "</small></p></div></div>";

            $("#cardDeck").append(html);
            document.getElementById('form').reset();
        }, error: function () {

        }

    });
    return false;
}

function pridajRating(id, pocet, pocetHodnoteni, sum) {
    sum += pocet;
    pocetHodnoteni += 1;
    $.ajax({
        url: '?c=portfolio&a=addRating&id=' + id + '&rating=' + pocet,
        method: 'POST',
        success: function (result) {
            zobrazHviezdy(pocet);
            document.getElementById("rating").innerHTML = getPriemer(pocetHodnoteni, sum);


        }, error: function () {

        }

    });
    return false;
}

function getPriemer(pocet, sum) {
    return (Math.round(sum *100.0/ parseFloat(pocet))/100).toFixed(2);

}

function zobrazRating(pocet, sum){
    document.getElementById("rating").innerHTML = getPriemer(pocet, sum);
}

function zobrazHviezdy(pocet) {
    zhasniRating();
    if (pocet === 1) {
        document.getElementById('star1').classList.add("stars");
    } else if (pocet === 2) {
        document.getElementById('star1').classList.add("stars");
        document.getElementById('star2').classList.add("stars");
    } else if (pocet === 3) {
        document.getElementById('star1').classList.add("stars");
        document.getElementById('star2').classList.add("stars");
        document.getElementById('star3').classList.add("stars");
    } else if (pocet === 4) {
        document.getElementById('star1').classList.add("stars");
        document.getElementById('star2').classList.add("stars");
        document.getElementById('star3').classList.add("stars");
        document.getElementById('star4').classList.add("stars");
    } else if (pocet === 5) {
        document.getElementById('star1').classList.add("stars");
        document.getElementById('star2').classList.add("stars");
        document.getElementById('star3').classList.add("stars");
        document.getElementById('star4').classList.add("stars");
        document.getElementById('star5').classList.add("stars");
    }

}

function zhasniRating() {
    document.getElementById('star1').classList.remove("stars");
    document.getElementById('star2').classList.remove("stars");
    document.getElementById('star3').classList.remove("stars");
    document.getElementById('star4').classList.remove("stars");
    document.getElementById('star5').classList.remove("stars");
}

function deleteFromPortfolio(id, stranka) {
    $.ajax({
        url: '?c=portfolio&a=deleteImage&id=' + id,
        method: 'GET',
        success: function (response) {
            $(stranka).closest('.box').remove();
        },
        error: function () {
            alert("Pri vymazaní portfólia sa vyskytla chyba, skúste ešte raz.");
        }
    });
}

function deletePortfolio(id, stranka) {
    $.ajax({
        url: '?c=portfolio&a=deleteProject&id=' + id,
        method: 'GET',
        success: function (response) {
            $(stranka).closest('.box').remove();
        },
        error: function () {
            alert("Pri vymazaní portfólia sa vyskytla chyba, skúste ešte raz.");
        }
    });
}

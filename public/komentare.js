
function pridajKomentar(id, autor) {
    var comment = document.getElementById('komentar').value;
    $.ajax({
        url: '?c=portfolio&a=addComment&id=' + id+'&comment='+comment,
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

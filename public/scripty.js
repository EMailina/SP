var menuIcon = document.getElementById('menuIcon');
var nav = document.getElementsByClassName('navigation')[0];

function menu() {
    nav.classList.toggle('active');

}

function successRegistration(text, email) {
    text = text + ' ' + email + '!';
    swal("Skvelé", text, "success");
}


function rating(hodnota){

if(hodnota === 5)
    document.getElementsByClassName('hviezda')[0].classList.toggle('stars5');
    document.getElementsByClassName('hviezda')[1].classList.toggle('stars5');
    document.getElementsByClassName('hviezda')[2].classList.toggle('stars5');
    document.getElementsByClassName('hviezda')[3].classList.toggle('stars5');
    document.getElementsByClassName('hviezda')[4].classList.toggle('stars5');
}
//aktivne stranky
/*let stranky = document.getElementsByClassName("navigation")[0];
let linky = stranky.getElementsByClassName("moj-link");


for (var i = 0; i < linky.length; i++) {
    linky[i].addEventListener("click", function () {
        let current = document.getElementsByClassName("aktivne");

        if (current.length > 0) {
            current[0].className = current[0].className.replace(" aktivne", "");
        }
        this.className += " aktivne";
    });
}*/
/*function pridajZnacku(par){
    document.getElementById(par).className+=' aktivne';
}*/



passwd = document.getElementById('passwd');
passwd.addEventListener('input', hesloKontrola);

function hesloKontrola(e) {
    if (passwd.value.length !== 0) {
        document.getElementById("info").innerHTML = "";
        if (containsNumber(passwd.value) === true) {
            if (containsUpper(passwd.value) === true) {
                if (containsLower(passwd.value) === true) {

                    document.getElementById("warningHeslo").style.display = 'none';
                    return true;
                } else {
                    zobrazUpozornenie();
                    document.getElementById("info").innerHTML = "Heslo neobsahuje malé písmeno!";
                    return false;
                }
            } else {
                zobrazUpozornenie();
                document.getElementById("info").innerHTML = "Heslo neobsahuje veľké písmeno!";
                return false;
            }

        } else {
            document.getElementById("info").innerHTML = "Heslo neobsahuje číslo!";
            zobrazUpozornenie();
            return false;
        }
    } else {
        zobrazUpozornenie();
        document.getElementById("info").innerHTML = "Vyplňte heslo!";
        return false;
    }
}

function zobrazUpozornenie(){
    document.getElementById("warningHeslo").style.display = 'block';
}

function containsNumber(passwd) {
    return /\d/.test(passwd);
}

function containsUpper(passwd) {
    return /[A-Z]/.test(passwd);
}

function containsLower(passwd) {
    return (/[a-z]/.test(passwd));
}


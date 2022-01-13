var menuIcon = document.getElementById('menuIcon');
var nav = document.getElementsByClassName('navigation')[0];

function menu() {
    nav.classList.toggle('active');

}

function successRegistration(text, email) {
    text = text + ' ' + email + '!';
    swal("Skvelé", text, "success");
}

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

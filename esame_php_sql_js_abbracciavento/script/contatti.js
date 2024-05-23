// In questa pagina mi occupo della validazione js del form contatti 


document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.twopage > form').addEventListener('submit', function(event) {

        //definisco gli elementi del form
        let nomeInput = document.getElementById('nome');
        let nomeValue = nomeInput.value;
        let cognomeInput = document.getElementById('cognome');
        let cognomeValue = cognomeInput.value;
        let textarea = document.getElementById('messaggio');
        let textareaValue = textarea.value;
        let email = document.getElementById('email');
        let emailValue = email.value;
        let telefono = document.getElementById('tel');
        let telefonoValue = telefono.value;
        let selectEm = document.getElementById('argomento');
        let selectEmValue = selectEm.value;
        let accettazione = document.getElementById('accettazione');

        // Reset delle classi per evitare duplicazioni
        document.querySelectorAll('.twopage > form label')[0].classList.remove('labelTwoEr');
        document.querySelectorAll('.twopage > form input')[0].classList.remove('inpTwoEr');
        document.querySelectorAll('.twopage > form label')[1].classList.remove('labelTwoEr');
        document.querySelectorAll('.twopage > form input')[1].classList.remove('inpTwoEr');
        document.querySelectorAll('.twopage > form textarea')[0].classList.remove('txtDueEr');
        document.querySelectorAll('.twopage > form label')[5].classList.remove('labelTwoEr');
        document.querySelectorAll('.twopage > form input')[2].classList.remove('inpTwoEr');
        document.querySelectorAll('.twopage > form label')[2].classList.remove('labelTwoEr');
        document.querySelectorAll('.twopage > form input')[3].classList.remove('inpTwoEr');
        document.querySelectorAll('.twopage > form label')[3].classList.remove('labelTwoEr');
        document.querySelectorAll('.twopage > form select')[0].classList.remove('selectEr');
        document.querySelectorAll('.twopage > form label')[4].classList.remove('labelTwoEr');

        // Reset dei messaggi di errore
        document.getElementById('unoH').className = 'formErHid';
        document.getElementById('dueH').className = 'formErHid';
        document.getElementById('treH').className = 'formErHid';
        document.getElementById('quattroH').className = 'formErHid';
        document.getElementById('cinqueH').className = 'formErHid';
        document.getElementById('seiH').className = 'formErHid';
        document.getElementById('setteH').className = 'formErHid';
        document.getElementById('ottoH').className = 'formErHid';
        document.getElementById('noveH').className = 'formErHid';
        document.getElementById('dieciH').className = 'formErHid';
        document.getElementById('undiciH').className = 'formErHid';
        document.getElementById('dodiciH').className = 'formErHid';

        // Validazione del nome
        if (!checkStringRange(nomeValue, 2, 20)) {
            document.querySelectorAll('.twopage > form label')[0].classList.add('labelTwoEr');
            document.querySelectorAll('.twopage > form input')[0].classList.add('inpTwoEr');
            if (nomeValue.length === 0) {
                document.getElementById('unoH').className = 'formEr';
            } else {
                document.getElementById('dueH').className = 'formEr';
            }
            event.preventDefault();
        }

        // Validazione del cognome
        if (!checkStringRange(cognomeValue, 2, 20)) {
            document.querySelectorAll('.twopage > form label')[1].classList.add('labelTwoEr');
            document.querySelectorAll('.twopage > form input')[1].classList.add('inpTwoEr');
            if (cognomeValue.length === 0) {
                document.getElementById('treH').className = 'formEr';
            } else {
                document.getElementById('quattroH').className = 'formEr';
            }
            event.preventDefault();
        }

        // Validazione del testo della textarea
        if (!checkStringRange(textareaValue, 2, 600)) {
            document.querySelectorAll('.twopage > form label')[5].classList.add('labelTwoEr');
            document.querySelectorAll('.twopage > form textarea')[0].classList.add('txtDueEr');
            if (textareaValue.length === 0) {
                document.getElementById('cinqueH').className = 'formEr';
            } else {
                document.getElementById('seiH').className = 'formEr';
            }
            event.preventDefault();
        }

        // Validazione dell'email
        if (emailValue.length === 0) {
            document.querySelectorAll('.twopage > form label')[2].classList.add('labelTwoEr');
            document.querySelectorAll('.twopage > form input')[2].classList.add('inpTwoEr');
            document.getElementById('setteH').className = 'formEr';
            event.preventDefault();
        } else if (!checkStringRange(emailValue, 8, 55)) {
            document.querySelectorAll('.twopage > form label')[2].classList.add('labelTwoEr');
            document.querySelectorAll('.twopage > form input')[2].classList.add('inpTwoEr');
            document.getElementById('ottoH').className = 'formEr';
            event.preventDefault();
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailValue)) {
            document.querySelectorAll('.twopage > form label')[2].classList.add('labelTwoEr');
            document.querySelectorAll('.twopage > form input')[2].classList.add('inpTwoEr');
            document.getElementById('noveH').className = 'formEr';
            event.preventDefault();
        }

        //validazione telefono
        if (telefonoValue.length != 0) {
            if (!checkStringRange(telefonoValue, 7, 17)) {
                document.querySelectorAll('.twopage > form label')[3].classList.add('labelTwoEr');
                document.querySelectorAll('.twopage > form input')[3].classList.add('inpTwoEr');
                document.getElementById('dieciH').className = 'formEr';
                event.preventDefault();
            } else if (!/^[+]?[\d\s()-]+$/.test(telefonoValue)) {
                document.querySelectorAll('.twopage > form label')[3].classList.add('labelTwoEr');
                document.querySelectorAll('.twopage > form input')[3].classList.add('inpTwoEr');
                document.getElementById('undiciH').className = 'formEr';
                event.preventDefault();
            }
        }

        // Validazione della selezione dell'argomento
        if (selectEmValue === "") {
            document.querySelectorAll('.twopage > form label')[4].classList.add('labelTwoEr');
            document.querySelectorAll('.twopage > form select')[0].classList.add('selectEr');
            document.getElementById('dodiciH').className = 'formEr';
            event.preventDefault();
        }

        //validazione check box
        if (!accettazione.checked) {
            document.querySelector('.checkmarkTwo').classList.add('checkmarkTwoEr');
            document.getElementById('trediciH').className = 'formEr';
            event.preventDefault();
        } else {
            document.querySelector('.checkmarkTwo').classList.remove('checkmarkTwoEr');
            document.getElementById('trediciH').className = 'formErHid';
        }

        // vengo riportato sopra al pulsante se qualcosa è andato storto
        if (event.defaultPrevented) {
            document.querySelector('.twopage').scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }


    });
});




/**
     * Il metodo riportato sotto è usato per controllare la grandezza minima e massima di un valore inviato dall'utente all'interno di un form. 
     * @param string $stringa valore inserito dall'utente
     * @param int $min valore numerico sotto al quale il dato non deve scendere
     * @param int $max Valore numerico sopra al quale il dato non deve salire
     * @return boolean 
     */
function checkStringRange(string, min = null, max = null) {
    let errors = 0;
    const length = string.length;
    if (min !== null && length < min) {
        errors++;
    }
    if (max !== null && length > max) {
        errors++;
    }
    return errors === 0;
}
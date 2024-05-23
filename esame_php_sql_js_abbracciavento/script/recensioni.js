// In questa pagina mi occupo della validazione js del form recensioni 


document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.formTwo');
    if (form) { 
        //definisco gli elementi del form se esiste(scompare dopo l'invio della pagina e mi da errore in console)
        form.addEventListener('submit', function(event) {
        let nomeInputRe = document.getElementById('nomeRe');
        let nomeValueRe = nomeInputRe.value;
        let firstInput = document.querySelectorAll('.formTwo input')[0];

        let testoInputRe = document.getElementById('commentoRe');
        let testoValueRe = testoInputRe.value;
        let firstText = document.querySelectorAll('.formTwo textarea')[0];

        let socialSel = document.getElementById('social').value; 
        let socialImp = document.getElementById('socialImp').value; 
        let labelSocial = document.getElementById('labelS');


        let fileRe = document.getElementById('foto');
        const maxFileSize = 4 * 1024 * 1024; // 4 MB
        const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; //file permessi


        // Rimuovi le classi di errore e di default
        firstInput.classList.remove('inpOneEr');
        firstInput.classList.remove('inpOne');
        firstText.classList.remove('txtOneEr');
        firstText.classList.remove('txtOne');

        labelSocial.classList.remove('labRecEr');
        document.getElementById('socialImp').classList.remove('inpOneEr');
        document.getElementById('social').classList.remove('selectEr');
        document.getElementById('hOtto').className = 'formErHid';
        document.getElementById('hNove').className = 'formErHid';

        // Reset dei messaggi di errore
        document.getElementById('hUno').className = 'formErHid';
        document.getElementById('hDue').className = 'formErHid';
        document.getElementById('hTre').className = 'formErHid';
        document.getElementById('hQuattro').className = 'formErHid';
        document.getElementById('hCinque').className = 'formErHid';
        document.getElementById('hSette').className = 'formErHid';
        document.getElementById('hSei').className = 'formErHid';


        //validazione file (foto)
        if (fileRe.files.length > 0) {
            let file = fileRe.files[0];
            let fileName = file.name;
            let fileExtension = fileName.split('.').pop().toLowerCase();
            if (!allowedExtensions.includes(fileExtension)) { // controllo estensioni
                document.getElementById('hOtto').className = 'formEr';
                document.querySelectorAll('.formTwo label')[0].classList.remove('labRec');
                document.querySelectorAll('.formTwo label')[0].classList.add('labRecEr');
                document.querySelectorAll('.formTwo input')[1].classList.remove('inpOne');
                document.querySelectorAll('.formTwo input')[1].classList.add('inpOneEr');
                event.preventDefault();
            } else if (file.size > maxFileSize) { // controllo grandezza
                document.getElementById('hNove').className = 'formEr';
                document.querySelectorAll('.formTwo label')[0].classList.remove('labRec');
                document.querySelectorAll('.formTwo label')[0].classList.add('labRecEr');
                document.querySelectorAll('.formTwo input')[1].classList.remove('inpOne');
                document.querySelectorAll('.formTwo input')[1].classList.add('inpOneEr');
                event.preventDefault();
            } else {
                document.querySelectorAll('.formTwo label')[0].classList.remove('labRecEr');
                document.querySelectorAll('.formTwo label')[0].classList.add('labRec');
                document.querySelectorAll('.formTwo input')[1].classList.remove('inpOneEr');
                document.querySelectorAll('.formTwo input')[1].classList.add('inpOne');
            }
        }



        // Gestione degli errori di social
        if (socialSel !== "0" && socialImp.length === 0) {
            document.getElementById('hSette').className = 'formEr';
            labelSocial.classList.add('labRecEr');
            document.getElementById('socialImp').classList.add('inpOneEr');
            event.preventDefault();
        } else if (socialSel === "0" && socialImp.length > 0) {
            document.getElementById('hCinque').className = 'formEr';
            labelSocial.classList.add('labRecEr');
            document.getElementById('social').classList.add('selectEr');
            event.preventDefault();
        } else if (socialSel !== "0" && socialImp.length > 0 && socialImp.length < 7) {
            document.getElementById('hSei').className = 'formEr';
            labelSocial.classList.add('labRecEr');
            document.getElementById('socialImp').classList.add('inpOneEr');
            event.preventDefault();
        }

        // Validazione del nome
        if (!checkStringRange(nomeValueRe, 2, 20)) {
            firstInput.classList.add('inpOneEr');

            if (nomeValueRe.length === 0) {
                document.getElementById('hUno').className = 'formEr';
            } else {
                document.getElementById('hDue').className = 'formEr';
            }
            event.preventDefault();
        } else {
            firstInput.classList.add('inpOne');
        }

        //  Validazione del testo della textarea
        if (!checkStringRange(testoValueRe, 2, 600)) {
            firstText.classList.add('txtOneEr');
            if (testoValueRe.length === 0) {
                document.getElementById('hTre').className = 'formEr';
            } else {
                document.getElementById('hQuattro').className = 'formEr';
            }
            event.preventDefault();
        } else {
            firstText.classList.add('txtOne');
        }

        // validazione checkbox
        if (!accettazione.checked) {
            document.querySelector('.checkmark').classList.add('checkmarkEr');
            document.getElementById('cheRecH').className = 'formEr';
            event.preventDefault();
        } else {
            document.querySelector('.checkmark').classList.remove('checkmarkEr');
            document.getElementById('cheRecH').className = 'formErHid';
        }


        //scrollo in alto se qualcosa non va
        if (event.defaultPrevented) {
            window.scrollTo({
                top: document.body.scrollHeight * 0.55,
                behavior: 'smooth'
            });
        }
    });
};
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
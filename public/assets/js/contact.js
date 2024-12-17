let nom = document.getElementsByName('nom')[0];
let prenom = document.getElementsByName('prenom')[0];
let zipcode = document.getElementsByName('zipcode')[0];
let ville = document.getElementsByName('ville')[0];
let email = document.getElementsByName('email')[0];
let message = document.getElementsByName('message')[0];

function checkNom() {
    let nomValue = nom.value;
    if (nomValue.length < 2 || !nomValue.match(/^[\p{L}\p{M}-]{2,}$/u)) {
        nom.classList.add('invalid');
        nom.classList.remove('valid');
    }
    else {
        nom.classList.remove('invalid');
        nom.classList.add('valid');
    }
}

function checkPrenom() {
    let prenomValue = prenom.value;
    if (prenomValue.length < 2 || !prenomValue.match(/^[\p{L}\p{M}-]{2,}$/u)) {
        prenom.classList.add('invalid');
        prenom.classList.remove('valid');
    }
    else {
        prenom.classList.remove('invalid');
        prenom.classList.add('valid');
    }
}

function checkZipcode() {
    let zipcodeValue = zipcode.value;
    if (!zipcodeValue.match(/^[0-9]{5}$/)) {
        zipcode.classList.add('invalid');
        zipcode.classList.remove('valid');
    } else {
        zipcode.classList.remove('invalid');
        zipcode.classList.add('valid');
    }
}

function checkVille() {
    let villeValue = ville.value;
    if (villeValue.length < 2 || !villeValue.match(/^[\p{L}\p{M}-]{2,}$/u)) {
        ville.classList.add('invalid');
        ville.classList.remove('valid');
    } else {
        ville.classList.remove('invalid');
        ville.classList.add('valid');
    }
}

function checkEmail() {
    let emailValue = email.value;
    if (!emailValue.match(/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/u)) {
        email.classList.add('invalid');
        email.classList.remove('valid');
    } else {
        email.classList.remove('invalid');
        email.classList.add('valid');
    }
}

function checkMessage() {
    let messageValue = message.value;
    if (messageValue.length < 32) {
        message.classList.add('invalid');
        message.classList.remove('valid');
    } else {
        message.classList.remove('invalid');
        message.classList.add('valid');
    }
}
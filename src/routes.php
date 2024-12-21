<?php
/**
 * @file     routes.php
 * @author   Estéban DESESSARD
 * @brief
 * @details
 * @date     14/12/2024
 * @version  0.0
 */

global $loader, $twig;
use PHPMailer\PHPMailer\PHPMailer;

$router = Router::getInstance();

$router->get('/', function () use ($loader, $twig) {
    echo $twig->render('home.twig');
    exit;
});

$router->get('/offres', function () use ($loader, $twig) {
    echo $twig->render('offres.twig');
    exit;
});

$router->get('/services', function () use ($loader, $twig) {
    echo $twig->render('services.twig');
    exit;
});

$router->get('/about', function () use ($loader, $twig) {
    echo $twig->render('about.twig');
    exit;
});

$router->get('/faq', function () use ($loader, $twig) {
    $questions = json_decode(file_get_contents(__DIR__ . '/data/faq.json'), true);
    echo $twig->render('faq.twig', [
        'questions' => $questions['faq']
    ]);
    exit;
});

$router->get('/contact', function () use ($loader, $twig) {
    echo $twig->render('contact.twig');
    exit;
});

$router->post('/contact', function () use ($loader, $twig) {
    if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['zipcode']) || empty($_POST['ville']) || empty($_POST['email']) || empty($_POST['message'] || !isset($_POST['accept']))) {
        echo $twig->render('contact.twig', ['error' => 'Tous les champs sont obligatoires.']);
        exit;
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo $twig->render('contact.twig', ['error' => 'L\'adresse email n\'est pas valide.']);
        exit;
    }
    if (strlen($_POST['message']) < 32) {
        echo $twig->render('contact.twig', ['error' => 'Le message doit contenir au moins 32 caractères.']);
        exit;
    }
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = 'partage.univ-pau.fr';
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['MAIL_USER'];
    $mail->Password = $_ENV['MAIL_PASS'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';

    $mail->setFrom('edesessard@univ-pau.fr', $_POST['nom'] . ' ' . $_POST['prenom']);
    $mail->addAddress('edesessard@iutbayonne.univ-pau.fr', 'Estéban DESESSARD');
    $mail->isHTML(true);
    $mail->Subject = "Nouveau message depuis le formulaire de contact";
    $mail->Body = "Message reçu de : " . $_POST['nom'] . " " . $_POST['prenom'] . " (" . $_POST['email'] . ")<br>Code postal : " . $_POST['zipcode'] . ", Ville : " . $_POST['ville'] . "<br><br>" . nl2br(htmlspecialchars($_POST['message'] ));
    $mail->setLanguage('fr', './vendor/phpmailer/phpmailer/language/phpmailer.lang-fr.php');

    $mailConfirm = new PHPMailer();
    $mailConfirm->isSMTP();
    $mailConfirm->SMTPDebug = 0;
    $mailConfirm->Host = 'partage.univ-pau.fr';
    $mailConfirm->SMTPAuth = true;
    $mailConfirm->Username = $_ENV['MAIL_USER'];
    $mailConfirm->Password = $_ENV['MAIL_PASS'];
    $mailConfirm->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mailConfirm->Port = 465;
    $mailConfirm->CharSet = 'UTF-8';
    $mailConfirm->Encoding = 'base64';

    $mailConfirm->setFrom('edesessard@univ-pau.fr', 'Estéban DESESSARD');
    $mailConfirm->addAddress($_POST['email']);
    $mailConfirm->isHTML(true);
    $mailConfirm->Subject = "Confirmation de l'envoi de votre message";
    $mailConfirm->Body = "Bonjour " . $_POST['prenom'] . ",<br><br>Nous avons bien reçu votre message et nous vous remercions de nous avoir contacté. Nous vous recontacterons dans les plus brefs délais.<br><br>Cordialement,<br>Expenergie";

    if ($mail->send() && $mailConfirm->send()) {
        echo $twig->render('contact.twig', ['success' => 'Votre message a bien été envoyé. Nous vous recontacterons dans les plus brefs délais.']);
    }
    else {
        echo $twig->render('contact.twig', ['error' => 'Une erreur est survenue lors de l\'envoi du message. Merci de nous contacter directement à l\'adresse e-mail sebastien.desessard@expenergie.fr']);
    }
    exit;
});

$router->get('/installations', function () use ($twig, $loader) {
   echo $twig->render('/installations.twig');
   exit;
});
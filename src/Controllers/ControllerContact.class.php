<?php
/**
 * @file     ControllerContact.class.php
 * @author   Estéban DESESSARD
 * @brief
 * @details
 * @date     23/12/2024
 * @version  1.0
 */

namespace Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use QuestionDAO;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ControllerContact extends Controller
{
    public function __construct(FilesystemLoader $loader, Environment $twig)
    {
        parent::__construct($loader, $twig);
    }

    public function showContactPage() {
        echo $this->getTwig()->render('contact.twig');
    }

    public function sendContactForm() {
        if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['zipcode']) || empty($_POST['ville']) || empty($_POST['email']) || empty($_POST['message'] || !isset($_POST['accept']))) {
            echo $this->getTwig()->render('contact.twig', ['error' => 'Tous les champs sont obligatoires.']);
            exit;
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo $this->getTwig()->render('contact.twig', ['error' => 'L\'adresse email n\'est pas valide.']);
            exit;
        }
        if (strlen($_POST['message']) < 32) {
            echo $this->getTwig()->render('contact.twig', ['error' => 'Le message doit contenir au moins 32 caractères.']);
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
        $mailConfirm->Body = "Bonjour " . $_POST['prenom'] . ",<br><br>Nous avons bien reçu votre message et nous vous remercions de nous avoir contactés. Nous vous recontacterons dans les plus brefs délais.<br><br>Cordialement,<br>Expenergie";

        if ($mail->send() && $mailConfirm->send()) {
            echo $this->getTwig()->render('contact.twig', ['success' => 'Votre message a bien été envoyé. Nous vous recontacterons dans les plus brefs délais.']);
        }
        else {
            echo $this->getTwig()->render('contact.twig', ['error' => 'Une erreur est survenue lors de l\'envoi du message. Merci de nous contacter directement à l\'adresse e-mail sebastien.desessard@expenergie.fr']);
        }
        exit;
    }
}
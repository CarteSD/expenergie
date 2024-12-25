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

use Controllers\ControllerFactory;
use PHPMailer\PHPMailer\PHPMailer;

$router = Router::getInstance();

$router->get('/', function () use ($loader, $twig) {
    ControllerFactory::getController("home", $loader, $twig)->call("showHomePage");
    exit;
});

$router->get('/offres', function () use ($loader, $twig) {
    ControllerFactory::getController("offres", $loader, $twig)->call("showOffersPage");
    exit;
});

$router->get('/services', function () use ($loader, $twig) {
    ControllerFactory::getController("services", $loader, $twig)->call("showServicesPage");
    exit;
});

$router->get('/about', function () use ($loader, $twig) {
    ControllerFactory::getController("about", $loader, $twig)->call("showAboutPage");
    exit;
});

$router->get('/faq', function () use ($loader, $twig) {
    ControllerFactory::getController("faq", $loader, $twig)->call("showFaqPage");
    exit;
});

$router->get('/contact', function () use ($loader, $twig) {
    ControllerFactory::getController("contact", $loader, $twig)->call("showContactPage");
    exit;
});

$router->post('/contact', function () use ($loader, $twig) {
    ControllerFactory::getController("contact", $loader, $twig)->call("sendContactForm");
    exit;
});

$router->get('/installations', function () use ($twig, $loader) {
    ControllerFactory::getController("installation", $loader, $twig)->call("showInstallationsPage");
    exit;
});

$router->get('/login', function () use ($twig, $loader) {
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
        header('Location: /office');
        exit;
    }
    ControllerFactory::getController("office", $loader, $twig)->call("showLoginPage");
    exit;
});

$router->post('/login', function () use ($twig, $loader) {
    ControllerFactory::getController("office", $loader, $twig)->call("signIn");
    exit;
});

$router->get('/office', function () use ($twig, $loader) {
    if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
        header('Location: /login');
        exit;
    }
    ControllerFactory::getController("office", $loader, $twig)->call("showOfficePage");
    exit;
});

$router->get('/logout', function () {
    session_unset();
    session_destroy();
    header('Location: /login');
    exit;
});

$router->delete('/office/question/delete/:idQuestion', function ($idQuestion) use ($twig, $loader) {
    if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
        header('Location: /login');
        exit;
    }
    ControllerFactory::getController("office", $loader, $twig)->call("deleteQuestion", [$idQuestion]);
    exit;
});

$router->get('/office/question/get/:idQuestion', function ($idQuestion) use ($twig, $loader) {
    if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
        header('Location: /login');
        exit;
    }
    ControllerFactory::getController("office", $loader, $twig)->call("getQuestion", [$idQuestion]);
    exit;
});

$router->post('/office', function () use ($twig, $loader) {
    if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
        header('Location: /login');
        exit;
    }
    if (isset($_POST['titleQuestionEdit']) && $_POST['titleQuestionEdit'] != "" && isset($_POST['answerQuestionEdit']) && $_POST['answerQuestionEdit'] != "") {
        ControllerFactory::getController("office", $loader, $twig)->call("editQuestion", [$_POST['idQuestionEdit'], $_POST['titleQuestionEdit'], $_POST['answerQuestionEdit'], $_POST['linkQuestionEdit']]);
    }
    exit;
});

$router->delete('/office/installation/delete/:idInstallation', function ($idInstallation) use ($twig, $loader) {
    if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
        header('Location: /login');
        exit;
    }
    ControllerFactory::getController("office", $loader, $twig)->call("deleteInstallation", [$idInstallation]);
    exit;
});
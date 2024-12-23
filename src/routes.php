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
    $installations = json_decode(file_get_contents(__DIR__ . '/data/installations.json'), true);
    echo $twig->render('/installations.twig', [
        "installations" => $installations['installations'],
    ]);
    exit;
});
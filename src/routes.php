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

$router->get('/contact', function () use ($loader, $twig) {
    echo $twig->render('contact.twig');
    exit;
});
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
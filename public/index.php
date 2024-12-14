<?php
/**
 * @file     index.php
 * @author   Estéban DESESSARD
 * @brief
 * @details
 * @date     14/12/2024
 * @version  0.0
 */

global $router;

require __DIR__ . '/../include.php';
require __DIR__ . '/../src/routes.php';

try {
    $router->matchRoute();
} catch (Exception $e) {
    echo $e->getCode() . " : " . $e->getMessage();
    exit;
}
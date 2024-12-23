<?php
/**
 * @file     Controller.class.php
 * @author   Estéban DESESSARD
 * @brief
 * @details
 * @date     23/12/2024
 * @version  1.0
 */

use Controllers\Controller;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ControllerFactory {
    public static function getController(string $controller, FilesystemLoader $loader, Environment $twig): Controller
    {
        $controllerName = 'Controller' . ucfirst($controller);

        if (!class_exists($controllerName)) {
            throw new Exception('Controller ' . $controllerName . ' not found');
        }
        return new $controllerName($loader, $twig);
    }
}
<?php

namespace Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ControllerFactory {
    /**
     * @brief La méthode getController permet de récupérer un contrôleur
     * @param string $controller Le nom du contrôleur
     * @param FilesystemLoader $loader Le loader de Twig
     * @param Environment $twig L'environnement de Twig
     * @return Controller Objet retourné par la méthode, ici un contrôleur général
     * @throws ControllerNotFoundException Exception levée dans le cas où le contrôleur n'est pas trouvé
     */
    public static function getController(string $controller, FilesystemLoader $loader, Environment $twig): Controller
    {
        $controllerName = 'ComusParty\Controllers\Controller' . ucfirst($controller);

        if (!class_exists($controllerName)) {
            throw new ControllerNotFoundException('Controller ' . $controllerName . ' not found');
        }
        return new $controllerName($loader, $twig);
    }
}
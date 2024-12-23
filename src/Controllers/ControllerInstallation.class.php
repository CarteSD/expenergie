<?php
/**
 * @file     ControllerInstallation.class.php
 * @author   Estéban DESESSARD
 * @brief
 * @details
 * @date     23/12/2024
 * @version  1.0
 */

namespace Controllers;

use InstallationDAO;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ControllerInstallation extends Controller
{
    public function __construct(FilesystemLoader $loader, Environment $twig)
    {
        parent::__construct($loader, $twig);
    }

    public function showInstallationsPage() {
        $installationManager = new InstallationDAO($this->getPdo());
        $installations = $installationManager->findAll();
        echo $this->getTwig()->render('installations.twig', [
            'installations' => $installations
        ]);
    }
}
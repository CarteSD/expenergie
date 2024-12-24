<?php
/**
 * @file     ControllerOffice.class.php
 * @author   Estéban DESESSARD
 * @brief
 * @details
 * @date     24/12/2024
 * @version  1.0
 */

namespace Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ControllerOffice extends Controller
{
    public function __construct(FilesystemLoader $loader, Environment $twig)
    {
        parent::__construct($loader, $twig);
    }

    public function showLoginPage() {
        echo $this->getTwig()->render('login.twig');
    }

    public function signIn() {
        $identifiant = $_POST['identifiant'];
        $password = $_POST['password'];

        if ($identifiant === OFFICE_ID && password_verify($password, OFFICE_PSD)) {
            $_SESSION['loggedIn'] = true;
            header('Location: /office');
        } else {
            echo $this->getTwig()->render('login.twig', ['error' => 'Identifiant ou mot de passe incorrect']);
        }
    }

    public function showOfficePage() {
        echo $this->getTwig()->render('office.twig');
    }
}
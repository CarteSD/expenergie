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

use Exception;
use Installation;
use InstallationDAO;
use Question;
use QuestionDAO;
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
        $questionManager = new QuestionDAO($this->getPdo());
        $questions = $questionManager->findAll();
        $installationManager = new InstallationDAO($this->getPdo());
        $installations = $installationManager->findAll();
        echo $this->getTwig()->render('office.twig', [
            'questions' => $questions,
            'installations' => $installations
        ]);
    }

    public function deleteQuestion($id) {
        $questionManager = new QuestionDAO($this->getPdo());
        if ($questionManager->delete($id)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }

    public function getQuestion($id) {
        $questionManager = new QuestionDAO($this->getPdo());
        $question = $questionManager->findById($id);
        echo json_encode([
            'id' => $question->getId(),
            'title' => $question->getTitle(),
            'answer' => $question->getAnswer(),
            'link' => $question->getLink()
        ]);
    }

    public function editQuestion($id, $title, $answer, $link) {
        $questionManager = new QuestionDAO($this->getPdo());
        $question = $questionManager->findById($id);
        $question->setTitle($title);
        $question->setAnswer($answer);
        $question->setLink($link);
        if ($questionManager->update($question)) {
            header('Location: /office');
            exit;
        }
    }

    public function deleteInstallation($id) {
        $installationManager = new InstallationDAO($this->getPdo());
        if ($installationManager->delete($id)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }

    public function addQuestion($title, $answer, $link) {
        $questionManager = new QuestionDAO($this->getPdo());
        $question = new Question(null, $title, $answer, $link);
        if ($questionManager->add($question)) {
            header('Location: /office');
            exit;
        }
    }

    public function getInstallation($id) {
        $installationManager = new InstallationDAO($this->getPdo());
        $installation = $installationManager->findById($id);
        echo json_encode([
            'id' => $installation->getId(),
            'title' => $installation->getTitle(),
            'description' => $installation->getDescription(),
            'details' => $installation->getDetails(),
            'imgPath' => $installation->getImgPath()
        ]);
    }

    public function editInstallation($id, $title, $description, $details, $img) {
        $installationManager = new InstallationDAO($this->getPdo());
        $installation = $installationManager->findById($id);
        $imgPath = $installation->getImgPath();

        var_dump($img);

        if ($img && $img['error'] === UPLOAD_ERR_OK) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($img['type'], $allowedTypes)) {
                throw new Exception('Type de fichier non autorisé');
            }
            if ($img['size'] > 5 * 1024 * 1024) {
                throw new Exception('Fichier trop volumineux');
            }
            $extension = pathinfo($img['name'], PATHINFO_EXTENSION);
            $newFileName = uniqid() . '.' . $extension;
            $uploadDir = 'assets/img/';

            $newFilePath = $uploadDir . $newFileName;

            if ($imgPath && file_exists($imgPath) && $imgPath !== 'default.png') {
                unlink($imgPath);
            }

            if (!move_uploaded_file($img['tmp_name'], $newFilePath)) {
                throw new Exception('Erreur lors du téléchargement de l\'image');
            } else {
                $imgPath = $newFileName;
            }
        }

        $installation->setTitle($title);
        $installation->setDescription($description);
        $installation->setDetails($details);
        $installation->setImgPath($imgPath);

        if ($installationManager->update($installation)) {
            header('Location: /office');
            exit;
        }
    }

    public function addInstallation($title, $description, $details, $img) {
        $installationManager = new InstallationDAO($this->getPdo());
        $imgPath = '';

        if ($img && $img['error'] === UPLOAD_ERR_OK) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($img['type'], $allowedTypes)) {
                throw new Exception('Type de fichier non autorisé');
            }
            if ($img['size'] > 5 * 1024 * 1024) {
                throw new Exception('Fichier trop volumineux');
            }
            $extension = pathinfo($img['name'], PATHINFO_EXTENSION);
            $newFileName = uniqid() . '.' . $extension;
            $uploadDir = 'assets/img/';

            $newFilePath = $uploadDir . $newFileName;

            if (!move_uploaded_file($img['tmp_name'], $newFilePath)) {
                throw new Exception('Erreur lors du téléchargement de l\'image');
            } else {
                $imgPath = $newFileName;
            }
        }

        $installation = new Installation(null, $title, $description, $details, $imgPath);
        if ($installationManager->add($installation)) {
            header('Location: /office');
            exit;
        }
    }
}
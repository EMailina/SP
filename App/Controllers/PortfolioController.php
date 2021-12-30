<?php

namespace App\Controllers;

use App\Core\AControllerBase;

use App\Auth;
use App\Config\Configuration;
use App\Models\Comment;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Rating;
use App\Models\Registration;
use App\Portfolio;
use http\Client\Curl\User;

class PortfolioController extends AControllerRedirect
{
    public function index()
    {
        return $this->html(
            [
                'meno' => 'študent'
            ]);
    }


    public function portfolio()
    {
        $projects = Project::getAll();
        return $this->html(
            [
                'projects' => $projects
            ]);
    }

    public function moje()
    {
        if (!Auth::isLogged()) {
            $this->redirect('home');
        }
        $projects = Project::getAll("user_id like '" . $_SESSION['id'] . "'");
        return $this->html(
            [
                'projects' => $projects, 'success' => $this->request()->getValue('success'),
                'error' => $this->request()->getValue('error'),
                'successReg' => $this->request()->getValue('successReg')
            ]);

    }

    public function mojProjektUprava()
    {
        if (!Auth::isLogged()) {
            $this->redirect('home');
        }
        $projectImages = ProjectImage::getAll("id_project = '" . $_GET['id'] . "'");
        $comments = Comment::getAll("project_id = '" . $_GET['id'] . "'");
        return $this->html(
            [
                'comments' => $comments, 'projectImages' => $projectImages, 'id' => $this->request()->getValue('id'), 'error' => $this->request()->getValue('error'), 'success' => $this->request()->getValue('success')
            ]);

    }

    public function ukazkaProjektu()
    {
        $projectImages = ProjectImage::getAll("id_project = '" . $_GET['id'] . "'");
        $comments = Comment::getAll("project_id = '" . $_GET['id'] . "'");
        if (Auth::isLogged())
            $rating = Rating::getAll('id_user like "' . $_SESSION['id'] . '" and id_project like "' . $_GET['id'] . '"');
        else
            $rating=0;
        if ($rating != null)
            $rating = $rating[0]->getRating();

        return $this->html(
            [
                'projectImages' => $projectImages, 'comments' => $comments, 'id' => $this->request()->getValue('id'),
                'error' => $this->request()->getValue('error'),
                'rating' => $rating
            ]);

    }


    public function addProject()
    {
        if (!Auth::isLogged()) {
            $this->redirect('home');
        }
        if (!Auth::isLogged()) {
            $this->redirect('home');
        }
        return $this->html(['error' => $this->request()->getValue('error')]);
    }

    public function deleteImage()
    {
        if (!Auth::isLogged()) {
            $this->redirect('home');
        } else {
            $id = $this->request()->getValue('id');
            $hodnota = Portfolio::deleteFromProject($id);
            if (is_int($hodnota)) {
                $this->redirect('portfolio', 'mojProjektUprava', ['id' => $hodnota, 'success' => 'Obrázok v portfóliu bol vymazaný']);
            } else {
                $this->redirect('portfolio', 'moje', ['error' => $hodnota]);
            }
        }
    }

    public function deleteProject()
    {
        if (!Auth::isLogged()) {
            $this->redirect('home');
        } else {
            $id = $this->request()->getValue('id');
            $hodnota = Portfolio::deleteProject($id);
            if ($hodnota === true) {
                $this->redirect('portfolio', 'moje', ['success' => 'Portfólio vymazané']);
            } else {
                $this->redirect('portfolio', 'moje', ['error' => $hodnota]);
            }
        }
    }


    public function upload()
    {
        if (!Auth::isLogged()) {
            $this->redirect("home");
        } else {
            $name = $this->request()->getValue('name');
            $text = $this->request()->getValue('text');
            $hodnota = Portfolio::createProject($name, $text);
            if ($hodnota === true) {
                $this->redirect('portfolio', 'moje', ['success' => 'Portfólio úspešne vytvorené']);
            } else {
                $this->redirect('portfolio', 'addProject', ['error' => $hodnota]);
            }
        }
    }


    public function saveChange()
    {
        if (!Auth::isLogged()) {
            $this->redirect('home');
        } else {
            $name = $this->request()->getValue('name');
            $text = $this->request()->getValue('text');
            $hodnota = Portfolio::updateProject($name, $text);
            if ($hodnota === true) {
                $this->redirect('portfolio', 'mojProjektUprava', ['id' => $_GET['id'], 'success' => 'Vaše zmeny sa uložili.']);

            } else {
                $this->redirect('portfolio', 'mojProjektUprava', ['error' => $hodnota, 'id' => $_GET['id']]);
            }
        }
    }

    public function uploadIntoProject()
    {
        if (!Auth::isLogged()) {
            $this->redirect("home");
        } else {
            $name = $this->request()->getValue('name');

            $hodnota = Portfolio::addToProject($name);
            if ($hodnota === true) {
                $this->redirect('portfolio', 'mojProjektUprava', ['id' => $_GET['id'], 'success' => 'Obrázok sa nahral do portfólia.']);

            } else {
                $this->redirect('portfolio', 'mojProjektUprava', ['id' => $_GET['id'], 'error' => $hodnota]);
            }
        }
    }

    public function addComment()
    {
        if (!Auth::isLogged()) {
            $this->redirect('portfolio', 'ukazkaProjektu', ['id' => $_GET['id'], 'error' => 'Pre komentovanie sa musite prihlasit']);
        } else {
            $text = $this->request()->getValue('comment');

            $hodnota = Portfolio::addComment($text);
            if ($hodnota === true) {
                $this->redirect('portfolio', 'ukazkaProjektu', ['id' => $_GET['id']]);

            } else {
                $this->redirect('portfolio', 'ukazkaProjektu', ['id' => $_GET['id'], 'error' => 'Nastala chyba s komentárom.']);
            }
        }
    }

    public function addRating()
    {
        if (!Auth::isLogged()) {
            $this->redirect('portfolio', 'ukazkaProjektu', ['id' => $_GET['id'], 'error' => 'Pre hodnotenie sa musite prihlasit']);
        } else {
            $hodnota = $_GET['rating'];

            $podariloSa = Portfolio::addRating($hodnota);
            if ($podariloSa === true) {
                $this->redirect('portfolio', 'ukazkaProjektu', ['id' => $_GET['id'], 'rating' => intval($hodnota)]);
            } else {
                $this->redirect('portfolio', 'ukazkaProjektu', ['id' => $_GET['id']]);

            }
            /*if ($hodnota === true) {
                $this->redirect('portfolio', 'ukazkaProjektu', ['id' => $_GET['id']]);

            } else {
                $this->redirect('portfolio', 'ukazkaProjektu', ['id' => $_GET['id'], 'error' => 'Nastala chyba s komentárom.']);
            }*/
        }
    }
}
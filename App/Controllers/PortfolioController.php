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
        $projects = Project::getAll("user_id like ?", [$_SESSION['id']]);
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
        $projectImages = ProjectImage::getAll("project_id = ?", [$_GET['id']]);
        $comments = Comment::getAll("project_id = ?", [$_GET['id']]);
        return $this->html(
            [
                'comments' => $comments, 'projectImages' => $projectImages, 'id' => $this->request()->getValue('id'), 'error' => $this->request()->getValue('error'), 'success' => $this->request()->getValue('success')
            ]);

    }

    public function ukazkaProjektu()
    {
        $projectImages = ProjectImage::getAll("project_id = ?", [$_GET['id']]);
        $comments = Comment::getAll("project_id = ?", [$_GET['id']]);
        if (Auth::isLogged())
            $rating = Rating::getAll("user_id like ? and project_id like ?", [$_SESSION['id'], $_GET['id']]);
        else
            $rating = 0;
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
            $hodnota = $this->deleteFromProject($id);
            if (is_int($hodnota)) {
                $this->redirect('portfolio', 'mojProjektUprava', ['id' => $hodnota, 'success' => 'Obrázok v portfóliu bol vymazaný']);
            } else {
                $this->redirect('portfolio', 'moje', ['error' => $hodnota]);
            }
        }
    }

    private function deleteFromProject($id): int|string
    {
        if ($id != null) {
            $image = ProjectImage::getOne($id);
            $stranka = $image->getIdProject();
            $image->delete();
            return $stranka;
        } else {
            return 'Nepodarilo sa vymazať portfólio.';
        }
    }

    public function deleteProject()
    {
        if (!Auth::isLogged()) {
            $this->redirect('home');
        } else {
            $id = $this->request()->getValue('id');
            $hodnota = $this->deleteOneProject($id);
            if ($hodnota === true) {
                $this->redirect('portfolio', 'moje', ['success' => 'Portfólio vymazané']);
            } else {
                $this->redirect('portfolio', 'moje', ['error' => $hodnota]);
            }
        }
    }

    public static function deleteOneProject(mixed $id): bool|string
    {
        if ($id != null) {
            $projekt = Project::getOne($id);
            $obrazky = ProjectImage::getAll("project_id = ?", [$id]);
            foreach ($obrazky as $obrazok) {
                $obrazok->delete();
            }

            $comments = Comment::getAll("project_id = ?", [$id]);
            foreach ($comments as $comment) {
                $comment->delete();
            }

            $ratings = Rating::getAll("project_id = ?", [$id]);
            foreach ($ratings as $rating) {
                $rating->delete();
            }

            $projekt->delete();

            return true;
        } else {
            return 'Nepodarilo sa vymazať projekt.';
        }
    }


    public function upload()
    {
        if (!Auth::isLogged()) {
            $this->redirect("home");
        } else {
            $name = $this->request()->getValue('name');
            $text = $this->request()->getValue('text');
            $hodnota = $this->createProject($name, $text);
            if ($hodnota === true) {
                $this->redirect('portfolio', 'moje', ['success' => 'Portfólio úspešne vytvorené']);
            } else {
                $this->redirect('portfolio', 'addProject', ['error' => $hodnota]);
            }
        }
    }

    /**
     * @param $name
     * @param $text
     * @return bool|string
     * @throws \Exception
     */
    private function createProject(mixed $name, mixed $text): bool|string
    {
        if (isset($_FILES['titleImage'])) {
            if ($_FILES["titleImage"]["error"] == UPLOAD_ERR_OK) {
                $nameImg = date('Y-m-d-H-i-s_') . $_FILES['titleImage']['name'];
                move_uploaded_file($_FILES['titleImage']['tmp_name'], Configuration::UPLOAD_DIR . "$nameImg");

                $pocetZnakovName = strlen($name);
                $pocetZnakovText = strlen($text);
                if ($name != null && $text != null  && $pocetZnakovName > 0 && $pocetZnakovText > 0) {
                    $newPr = new Project(user_id: $_SESSION['id'], image: $nameImg, name: $name, text: $text);

                    $newPr->save();


                    return true;
                } else {
                    return 'Meno alebo text neboli zadané alebo sú krátke.';
                }
            } else {
                return 'Musite pridať aj obrázok';
            }
        } else {
            return 'Musíte pridať aj obrázok';
        }
    }


    public function saveChange()
    {
        if (!Auth::isLogged()) {
            $this->redirect('home');
        } else {
            $name = $this->request()->getValue('name');
            $text = $this->request()->getValue('text');
            $img = $this->request()->getValue('titleImage');

            $hodnota = $this->updateProject($name, $text);

            if ($hodnota === true) {
                $this->redirect('portfolio', 'mojProjektUprava', ['id' => $_GET['id'], 'success' => 'Vaše zmeny sa uložili.']);

            } else {
                $this->redirect('portfolio', 'mojProjektUprava', ['error' => $hodnota, 'id' => $_GET['id']]);
            }
        }
    }

    private function updateProject($name, $text): bool|string
    {
        if ($name != null && $name != "" && $text != null && $text != "" && strlen($text) > 0 && strlen($name) > 0) {
            $p = Project::getOne($_GET['id']);
            $p->setName($name);
            $p->setText($text);

            if (isset($_FILES['projectImage'])) {

                if ($_FILES["projectImage"]["error"] == UPLOAD_ERR_OK) {
                    $nameImg = date('Y-m-d-H-i-s_') . $_FILES['projectImage']['name'];
                    move_uploaded_file($_FILES['projectImage']['tmp_name'], Configuration::UPLOAD_DIR . "$nameImg");
                    $p->setImage($nameImg);
                }
            }
            $p->save();
            return true;
        } else {
            return 'Nezadali ste názov alebo popis portfólia';
        }
    }

    public function uploadIntoProject()
    {
        if (!Auth::isLogged()) {
            $this->redirect("home");
        } else {
            $name = $this->request()->getValue('name');

            $hodnota = $this->addToProject($name);
            if ($hodnota === true) {
                $this->redirect('portfolio', 'mojProjektUprava', ['id' => $_GET['id'], 'success' => 'Obrázok sa nahral do portfólia.']);

            } else {
                $this->redirect('portfolio', 'mojProjektUprava', ['id' => $_GET['id'], 'error' => $hodnota]);
            }
        }
    }

    private function addToProject($name): bool|string
    {
        if (isset($_FILES['titleImage'])) {
            if ($_FILES["titleImage"]["error"] == UPLOAD_ERR_OK) {
                $nameImg = date('Y-m-d-H-i-s_') . $_FILES['titleImage']['name'];
                move_uploaded_file($_FILES['titleImage']['tmp_name'], Configuration::UPLOAD_DIR . "$nameImg");

                $newPrImage = new ProjectImage(project_id: $_GET['id'], image: $nameImg, name: $name);
                $newPrImage->save();
                return true;
            }
        }
        return 'Musíte pridať aj obrázok';
    }

    private
    function addComm(mixed $text)
    {
        if ($text != null && $text != "") {
            $comment = new Comment(project_id: $_GET['id'], text: $text, user_id: $_SESSION['id']);
            $comment->save();
            return true;
        } else {
            return false;
        }
    }

    public
    function addComment()
    {
        if (!Auth::isLogged()) {
            //$this->redirect('portfolio', 'ukazkaProjektu', ['id' => $_GET['id'], 'error' => 'Pre komentovanie sa musite prihlasit']);
        } else {
            $text = $this->request()->getValue('comment');

            $hodnota = $this->addComm($text);
            if ($hodnota === true) {
                $this->redirect('portfolio', 'ukazkaProjektu', ['id' => $_GET['id']]);
            } else {
                $this->redirect('portfolio', 'ukazkaProjektu', ['id' => $_GET['id'], 'error' => 'Nastala chyba s komentárom.']);
            }
        }
    }

    public
    function addRating()
    {
        if (!Auth::isLogged()) {
            $this->redirect('portfolio', 'ukazkaProjektu', ['id' => $_GET['id'], 'error' => 'Pre hodnotenie sa musite prihlasit']);
        } else {
            $hodnota = $_GET['rating'];

            $podariloSa = $this->addOneRating($hodnota);
            if ($podariloSa === true) {
                $this->redirect('portfolio', 'ukazkaProjektu', ['id' => $_GET['id'], 'rating' => intval($hodnota)]);
            } else {
                $this->redirect('portfolio', 'ukazkaProjektu', ['id' => $_GET['id']]);

            }

        }
    }

    private function addOneRating($hodnota)
    {
        if ($hodnota != null) {
            $found = Rating::getAll("user_id like ? and project_id like ?", [$_SESSION['id'], $_GET['id']]);
            if ($found == null) {
                $rating = new Rating(project_id: $_GET['id'], user_id: $_SESSION['id'], rating: intval($hodnota));
                $rating->save();
                return true;
            } else {
                foreach ($found as $rating) {
                    $rating->setRating(intval($hodnota));
                    $rating->save();
                }
                return true;
            }
        }
        return false;
    }

    public function aktualizujObrazok()
    {
        if (!Auth::isLogged()) {
            $this->redirect('home');
        }
        $id = $this->request()->getValue('id');
        $found = ProjectImage::getOne($id);
        return $this->html(
            [
                'project' => $found, 'success' => $this->request()->getValue('success'),
                'error' => $this->request()->getValue('error'),

            ]);
    }

    public function aktualizujObrazokVPortfoliu()
    {
        if (!Auth::isLogged()) {
            $this->redirect('home');
        }
        $id = $this->request()->getValue('id');
        $name = $this->request()->getValue('name');

        $podariloSa = $this->upravObrazok($id, $name);

        if ($podariloSa === true) {
            $this->redirect('portfolio', 'aktualizujObrazok', ['id' => $id, 'success' => 'Obrazok sa aktualizoval']);
        } else {
            $this->redirect('portfolio', 'aktualizujObrazok', ['error' => $podariloSa]);

        }

    }

    private function upravObrazok($id, $name)
    {
        if ($id != null) {
            $found = ProjectImage::getOne($id);
            $found->setName($name);

            if (isset($_FILES['titleImage'])) {

                if ($_FILES["titleImage"]["error"] == UPLOAD_ERR_OK) {
                    $nameImg = date('Y-m-d-H-i-s_') . $_FILES['titleImage']['name'];
                    move_uploaded_file($_FILES['titleImage']['tmp_name'], Configuration::UPLOAD_DIR . "$nameImg");
                    $found->setImage($nameImg);
                }
            }
            $found->save();
            return true;
        } else {
            return 'Nastala chyba pri hladaní obrázka';
        }
    }


}
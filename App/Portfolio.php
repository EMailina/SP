<?php

namespace App;


use App\Config\Configuration;
use App\Models\Comment;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Rating;

class Portfolio
{
    public static function createProject($name, $text): bool|string
    {
        if (isset($_FILES['titleImage'])) {
            if ($_FILES["titleImage"]["error"] == UPLOAD_ERR_OK) {
                $nameImg = date('Y-m-d-H-i-s_') . $_FILES['titleImage']['name'];
                move_uploaded_file($_FILES['titleImage']['tmp_name'], Configuration::UPLOAD_DIR . "$nameImg");

                if ($name != null && $text != null) {
                    $newPr = new Project(user_id: $_SESSION['id'], image: $nameImg, name: $name, text: $text);

                    $newPr->save();


                    return true;
                } else {
                    return 'Meno alebo text neboli zadané.';
                }
            } else {
                return 'Musite pridať aj obrázok';
            }
        } else {
            return 'Musíte pridať aj obrázok';
        }
    }

    public static function deleteProject($id)
    {
        if ($id != null) {
            $projekt = Project::getOne($id);
            $obrazky = ProjectImage::getAll("id_project = '" . $id . "'");
            foreach ($obrazky as $obrazok) {
                $obrazok->delete();
            }

            $comments = Comment::getAll("project_id = '" . $id . "'");
            foreach ($comments as $comment) {
                $comment->delete();
            }

            $projekt->delete();

            return true;
        } else {
            return 'Nepodarilo sa vymazať projekt.';
        }

    }


    public static function addToProject($name): bool|string
    {
        if (isset($_FILES['titleImage'])) {
            if ($_FILES["titleImage"]["error"] == UPLOAD_ERR_OK) {
                $nameImg = date('Y-m-d-H-i-s_') . $_FILES['titleImage']['name'];
                move_uploaded_file($_FILES['titleImage']['tmp_name'], Configuration::UPLOAD_DIR . "$nameImg");

                $newPrImage = new ProjectImage(id_project: $_GET['id'], image: $nameImg, name: $name);
                $newPrImage->save();
                return true;
            }
        }
        return 'Musíte pridať aj obrázok';
    }

    public static function deleteFromProject($id): int|string
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

    public static function addComment($text): bool
    {
        if ($text != null && $text != "") {
            $comment = new Comment(project_id: $_GET['id'], text: $text, user_id: $_SESSION['id']);
            $comment->save();
            return true;
        } else {
            return false;
        }
    }

    public static function addRating($hodnota)
    {
        if ($hodnota != null) {
            $found = Rating::getAll('id_user like "' . $_SESSION['id'] . '" and id_project like "' . $_GET['id'] . '"');
            if ($found == null) {
                $rating = new Rating(id_project: $_GET['id'], id_user: $_SESSION['id'], rating: intval($hodnota));
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

    public static function updateProject($name, $text): bool|string
    {
        if ($name != null && $name != "") {
            $p = Project::getOne($_GET['id']);
            $p->setName($name);
            $p->setText($text);
            $p->save();
            return true;
        } else {
            return 'Nezadali ste názov portfólia';
        }
    }

    /**
     * @return float
     * @throws \Exception
     */
    public static function getPriemerRating(): float|string
    {
        $rating = Rating::getAll('id_project like "' . $_GET['id'] . '"');
        $sum = 0;
        $pocet = 0;
        foreach ($rating as $hodnota) {
            $sum += $hodnota->getRating();
            $pocet += 1;
        }
        if ($pocet == 0) {
            return "Zatiaľ nehodnotené";
        }
        return number_format((float)($sum / $pocet), 2, '.', '');

    }

}
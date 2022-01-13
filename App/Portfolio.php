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
        /* if (isset($_FILES['titleImage'])) {
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
         }*/
    }

    public static function deleteProject($id)
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

            $ratings = Rating::getAll("project_id = ?", [$id] );
            foreach ($ratings as $rating) {
                $rating->delete();
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

                $newPrImage = new ProjectImage(project_id: $_GET['id'], image: $nameImg, name: $name);
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
            $found = Rating::getAll("user_id like ? and project_id like ?",[$_SESSION['id'],$_GET['id']]);
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

    public static function updateProject($name, $text): bool|string
    {
        if ($name != null && $name != "") {
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
            return 'Nezadali ste názov portfólia';
        }
    }

    /**
     * @return float
     * @throws \Exception
     */
    public static function getPriemerRating(): float|string
    {
        $rating = Rating::getAll("project_id like ?",[ $_GET['id']] );
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

    public static function upravObrazok($id, $name)
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
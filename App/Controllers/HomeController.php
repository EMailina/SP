<?php

namespace App\Controllers;

use App\Core\AControllerBase;

use App\Auth;
use App\Config\Configuration;
use App\Models\Comment;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Registration;
use http\Client\Curl\User;

/**
 * Class HomeController
 * Example of simple controller
 * @package App\Controllers
 */
class HomeController extends AControllerRedirect
{

    public function index()
    {
        return $this->html(
            [
                'meno' => 'študent'
            ]);
    }

    public function contact()
    {
        return $this->html(
            []
        );
    }

    public function about()
    {
        return $this->html(
            []
        );
    }
}
/*
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

        $projects = Project::getAll("user_id like '" . $_SESSION['id'] . "'");
        return $this->html(
            [
                'projects' => $projects, 'success'=>$this->request()->getValue('success')
            ]);

    }

    public function mojProjektUprava()
    {

        $projectImages = ProjectImage::getAll("id_project = '" . $_GET['id'] . "'");
        $comments = Comment::getAll("project_id = '" . $_GET['id'] . "'");
        return $this->html(
            [
                'comments' => $comments,  'projectImages' => $projectImages, 'id'=>$this->request()->getValue('id'),'error'=>$this->request()->getValue('error'),'success'=>$this->request()->getValue('success')
            ]);

    }

    public function ukazkaProjektu()
    {

        $projectImages = ProjectImage::getAll("id_project = '" . $_GET['id'] . "'");
        $comments = Comment::getAll("project_id = '" . $_GET['id'] . "'");
        return $this->html(
            [
                'projectImages' => $projectImages,'comments' => $comments, 'id'=>$this->request()->getValue('id'),'error'=>$this->request()->getValue('error')
            ]);

    }


    public function addProject()
    {
        if (!Auth::isLogged()) {
            $this->redirect('home');
        }
        return $this->html();
    }

    public function deleteImage(){
        $id = $this->request()->getValue('id');
        if($id != null){
            $image = ProjectImage::getOne($id);
            $stranka = $image->getIdProject();
            $image->delete();
            $this->redirect('home', 'mojProjektUprava' ,['id' =>  $stranka, 'success'=> 'Obrázok v portfóliu bol vymazaný']);
        }else {
            $this->redirect('home', 'moje');
        }
    }

    public function deleteProject(){
        $id = $this->request()->getValue('id');

        if($id != null){
            $projekt = Project::getOne($id);
            $obrazky = ProjectImage::getAll("id_project = '" . $id . "'");
            foreach ($obrazky as $obrazok){
                $obrazok->delete();
            }

            $comments = Comment::getAll("project_id = '" . $id . "'");
            foreach ($comments as $comment){
                $comment->delete();
            }

            $projekt->delete();

            $this->redirect('home', 'moje' , ['success'=> 'Portfólio vymazané']);
        }else {
            $this->redirect('home', 'moje');
        }
    }


    public function upload()
    {
        if (!Auth::isLogged()) {
            $this->redirect("home");
        }
        if (isset($_FILES['titleImage'])) {
            if ($_FILES["titleImage"]["error"] == UPLOAD_ERR_OK) {
                $nameImg = date('Y-m-d-H-i-s_') . $_FILES['titleImage']['name'];
                move_uploaded_file($_FILES['titleImage']['tmp_name'], Configuration::UPLOAD_DIR . "$nameImg");
                $name = $this->request()->getValue('name');
                $text = $this->request()->getValue('text');
                if ($name != null && $text != null) {
                    $newPr = new Project(user_id: $_SESSION['id'], image: $nameImg, name: $name, text: $text);

                    $newPr->save();
                    $this->redirect('home', 'mojProjektUprava&id=' . $newPr->getId(), ['error' => 'Nezadali ste názov portfólia!', 'id'=> $newPr->getId()]);
                }else{
                    $this->redirect('home', 'moje');
                }
            }else{
                $this->redirect('home', 'moje');
            }
        }else{
            $this->redirect('home', 'moje');
        }
        $this->redirect('home', 'moje');
    }


    public function saveChange()
    {
        $name = $this->request()->getValue('name');
        $text = $this->request()->getValue('text');
        if ($name != null && $name != "") {
            $p = Project::getOne($_GET['id']);
            $p->setName($name);
            $p->setText($text);
            $p->save();
            $this->redirect('home', 'mojProjektUprava&id=' . $_GET['id'], ['success'=> 'Vaše zmeny sa uložili.']);

        } else {
            $this->redirect('home', 'mojProjektUprava' , ['error' => 'Nezadali ste názov portfólia!', 'id'=> $_GET['id']]);
        }
    }

    public function uploadIntoProject()
    {
        if (isset($_FILES['titleImage'])) {
            if ($_FILES["titleImage"]["error"] == UPLOAD_ERR_OK) {
                $nameImg = date('Y-m-d-H-i-s_') . $_FILES['titleImage']['name'];
                move_uploaded_file($_FILES['titleImage']['tmp_name'], Configuration::UPLOAD_DIR . "$nameImg");
                $name = $this->request()->getValue('name');

                if($name != null ) {
                $newPrImage = new ProjectImage(id_project: $_GET['id'], image: $nameImg, name: $name);


                 }
            }
        }
        $this->redirect('home', 'mojProjektUprava' ,['id'=> $_GET['id'], 'success' => 'Obrázok sa nahral do portfólia.']);
    }
    public function addComment()
    {
        if (!Auth::isLogged()) {
            $this->redirect('home', 'ukazkaProjektu', ['id' => $_GET['id'], 'error'=> 'Pre komentovanie sa musite prihlasit']);
        }else {
            $text = $this->request()->getValue('comment');
            if ($text != null && $text != "") {
                $comment = new Comment(project_id: $_GET['id'], text: $text, user_id: $_SESSION['id']);
                $comment->save();

                $this->redirect('home', 'ukazkaProjektu', ['id' => $_GET['id']]);

            }
        }
    }

}*/
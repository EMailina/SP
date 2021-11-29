<?php
namespace App\Controllers;
use App\Controllers\AControllerRedirect;
use App\Core\AControllerBase;

use App\Auth;
use App\Config\Configuration;
use App\Models\Comment;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Registration;
use http\Client\Curl\User;

class AboutController extends AControllerRedirect
{

    public function index()
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
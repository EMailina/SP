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

    public function index(): \App\Core\Responses\ViewResponse|\App\Core\Responses\Response
    {
        return $this->html(
            [
                'meno' => 'študent'
            ]);
    }


}

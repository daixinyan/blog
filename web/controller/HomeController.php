<?php
/**
 * Created by PhpStorm.
 * User: darxan
 * Date: 2016/9/24
 * Time: 15:31
 */

namespace web\controller;


use core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $this->jump(HOME_PAGE);
    }

    public function admin()
    {
        $this->jump(ADMIN_PAGE);
    }
}
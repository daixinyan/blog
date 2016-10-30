<?php
/**
 * Created by PhpStorm.
 * User: darxan
 * Date: 2016/9/24
 * Time: 14:55
 */

namespace core;



class Controller
{
    protected $model ;

    protected function show($content){
        echo json_encode($content);
//        exit();
        Model::delete();
    }

    protected function jump($url)
    {
        header('Location: '.$url);
        exit;
    }

}
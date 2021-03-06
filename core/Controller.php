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

    /**
     * @var Model
     */
    protected $model ;
    /**
     * @var Auth
     */
    protected $auth ;

    protected $mapper;
    /**
     * @param $auth
     */
    public function setAuth($auth)
    {
        $this->auth = $auth;
    }
    /**
     * @param $model Model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    public function setMapper($mapper)
    {
        $this->mapper = $mapper;
    }

    protected function std_show($result=true,$content=null){

        $response = [
            'result'=>$result===true||$result==='success'?'success':'failed',
            'auth'=>$this->convertAllForHtml($this->auth->currentUserInfo()),
            'main'=>$this->convertAllForHtml($content),
        ];
        echo json_encode($response);
        Model::delete();
        exit(0);
    }


    protected function show($content){
        echo json_encode($content);
//        exit();
        Model::delete();
    }

    protected function header($url)
    {
        header('Location: '.$url);
        exit(0);
    }

    protected function jump($url)
    {
        header('Location: '.$url);
        exit(0);
    }

    /**
     * if without login, print message and exit;
     */
    protected function checkLogin()
    {
        if(!$this->auth->check())
        {
            $this->showResult('login first');
            exit(0);
        }
    }


    protected function convertAllForHtml(&$variables)
    {
        if(is_array($variables))
        {
            foreach ($variables as $key=>$variable)
            {
                if (isset($this->mapper[$key]))
                {
                    $variables[$this->mapper[$key]] = $variable;
                    unset($variables[$key]);
                }
            }
        }
        return $variables;
    }
}
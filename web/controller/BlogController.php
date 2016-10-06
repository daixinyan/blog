<?php
/**
 * Created by PhpStorm.
 * User: darxan
 * Date: 2016/9/25
 * Time: 10:40
 */

namespace web\controller;


use core\Controller;
use core\Request;
use web\model\BlogModel;


class BlogController extends Controller
{


    public function __construct()
    {
        $this->model = new BlogModel();
    }

    public function search(Request $request){

        $success = $request->validate(
            [
                'bound'=>['integer'],
                'order'=>['enum:asc|desc'],
                'key'=>[],
                'category'=>[],
            ]
        );
        list($bound,$desc, $key, $category) = array_values($success);
        $this->show( $this->model->search($bound, $desc=='desc', $key, $category) );
    }

    public function detail(Request $request){

        $id = current( $request->validate(['id'=>['integer']]) );
        $blog_detail = ( $this->model->details($id));
        $blog_next = ( $this->model->search($id, false, null, null, 1) );
        $blog_last = ( $this->model->search($id, true,  null, null, 1) );
        $this->show([
            'detail'=>$blog_detail?$blog_detail[0]:'notExist',
            'next'=>$blog_next?$blog_next[0]:'notExist',
            'last'=>$blog_last?$blog_last[0]:'notExist',
        ]);
    }


    public function post(Request $request){
        $success_parameters = $request->validate(
            [
                'category'=>[],
                'title'=>[],
                'content'=>[],
                'created_at'=>['set_value:'. getCurrentDateTime()],
                'updated_at'=>['set_value:'.getCurrentDateTime()],
            ]
        );
//        var_dump($success_parameters);
        $this->show($this->model->save($success_parameters));
    }
}
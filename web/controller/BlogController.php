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


    public function __construct(){}

    public function search(Request $request){

        $success = $request->validate(
            [
                'bound'=>['integer'],
                'order'=>['enum:asc|desc'],
                'key'=>[],
                'category'=>[],
            ]
        );
        list($bound,$order, $key, $category) = array_values($success);
        $desc = $order=='desc';

        if($bound=='-1'||$bound<0)
        {
            if($desc)
            {
                $bound = PHP_INT_MAX;
            }else
            {
                $bound = 0;
            }
        }

        $list = $this->model->search($bound, $desc, $key, $category, PAGE_SIZE);

        if($list)
        {
            if($desc)
            {
                $bound = $list[0]['id'];
            }else
            {
                $bound = end($list)['id'];
            }
        }
        $this->show(
            [
                'bound'=>$bound,
                'list'=>$list,
                'isEnd'=>count($list)<PAGE_SIZE,
            ]
        );
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
        $this->show($this->model->save($success_parameters));
    }

    public function update(Request $request){
        $success_parameters = $request->validate(
            [
                'id'=>[],
                'category'=>[],
                'title'=>[],
                'content'=>[],
                'updated_at'=>['set_value:'.getCurrentDateTime()],
            ]
        );
        $result = $this->model->update_by_assoc($success_parameters, ['id'=>$success_parameters['id']]);
        $this->show(['result'=>$result]);
    }

    public function category(Request $request){
        $category = $this->model->distinct('category');
        array_unshift($category, 'all');
        $this->show($category);
    }
}
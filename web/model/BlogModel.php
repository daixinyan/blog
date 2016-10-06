<?php

/**
 * Created by PhpStorm.
 * User: darxan
 * Date: 2016/9/29
 * Time: 10:24
 */
namespace web\model;


use core\Model;

class BlogModel extends Model
{

    protected $table = 'blog';
    public function search($bound=0,$desc=true,$key=null, $category=null,$page_size=PAGE_SIZE){

        if ($desc){
            $order = 'desc';
            $where = 'id<?';
        }else{
            $order = 'asc';
            $where = 'id>?';
        }
        $parameters = [$bound,];
        if($category){
            $where.= ' AND category = ? ';
            $parameters[] = $category;
        }if ($key){
            $where.=' AND title LIKE ? ';
            $parameters[] = "%$key%";
        }
        $query =" SELECT title,created_at,category,id FROM $this->table WHERE $where  ORDER BY id $order LIMIT $page_size";
        
        $blogDetailStatement = Model::getPDO()->prepare($query);
        $blogDetailStatement->execute($parameters);
        return ($blogDetailStatement->fetchAll()) ;
    }



    

    public function details($id){
        $blogDetailStatement = Model::getPDO()->prepare(" SELECT * FROM $this->table WHERE id=? ");
        $blogDetailStatement->execute([$id]);
        $detail = ($blogDetailStatement->fetchAll()) ;
        return $detail;
    }


}
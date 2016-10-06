<?php
/**
 * Created by PhpStorm.
 * User: darxan
 * Date: 2016/9/29
 * Time: 11:22
 */

namespace core;


class Request extends MyArray
{

    public function __construct($parameters)
    {
        $this->data = array_merge($parameters?:[],$_POST);
    }

    /**
     * @var Validator
     */
    protected $validator = null;


    /**
     * @param $rules
     * @return array
     * @throws \Exception
     */
    public function validate($rules){

        if(!$this->validator){
            $this->validator = new Validator();
        }
        if($this->validator->validate($this,$rules)){
            return $this->validator->getSuccessValues();
        }else{
            throw new \Exception();
        }
    }

}
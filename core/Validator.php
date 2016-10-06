<?php
/**
 * Created by PhpStorm.
 * User: darxan
 * Date: 2016/9/29
 * Time: 16:36
 */

namespace core;


class Validator
{
    protected $failed = [];
    protected $success = [];

    /**
     * @param Request $data
     * @param $rules
     * @return bool return true if $this->failed empty
     */
    public function validate(Request $data, $rules){

        foreach ($rules as $key=>$rule){
            $value = $data->offsetGet($key);
            $result = $this->validateValue($rule,$value);
            if($result===false){
                $this->failed[] = $key;
            }else{
                $this->success[$key] = $result;
            }
        }
        return !$this->failed;
    }


    public function getSuccessValues(){
        return $this->success;
    }


    public function getFailedKeys(){
        return $this->failed;
    }

    /**
     * @param $rule
     * @param $value $value is according value in request.
     * @return bool if success return value or else return false
     */
    protected function validateValue($rule, $value){
        $result = $value;
        foreach ($rule as $rule_item){
            $rule_exploded = explode(':',$rule_item,2);
            $method = $rule_exploded[0];
            if(isset($rule_exploded[1])){
                $result =  $this->$method($value,$rule_exploded[1]);
            }else{
                $result = $this->$method($value);
            }
            if($result===false){
                return false;
            }
        }
        return $result;
    }

    /**
     * @param $value
     * @param $parameter
     * @return mixed if not found return false | or else return the value
     */
    protected function enum($value, $parameter){
        $parameters = explode('|',$parameter);
        return array_search($value, $parameters)===false?false:$value;
    }


    protected function integer($value){
        return filter_var($value, FILTER_VALIDATE_INT);
    }

    protected function not_null($value){
        return $value===null?false:$value;
    }

    protected function default_value($value,$parameter){
        return $value?:$parameter;
    }
    protected function set_value($value,$parameter){
        return $parameter;
    }

    protected function longest($value,$parameter){

    }
    protected function shortest($value,$parameter){

    }
}
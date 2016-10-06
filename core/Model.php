<?php
/**
 * Created by PhpStorm.
 * User: darxan
 * Date: 2016/9/24
 * Time: 14:55
 */

namespace core;

use \PDO;

class Model
{
    /**
     * @var PDO
     */
    protected static $pdo = null;

    protected static function connect(){
        if(self::$pdo){
            return;
        }
        try {
            $config = require 'config/database.php';
            $config_server = $config['SEVER'];
            $config_database = $config['DATABASE'];
            $config_username = $config['USERNAME'];
            $config_password = $config['PASSWORD'];
            $dsn = "mysql:host=$config_server;dbname=$config_database";
            self::$pdo = new PDO($dsn, $config_username, $config_password,
                [
                    PDO::ATTR_PERSISTENT => true,
                    PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8',
                ]
            );
            self::$pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//设置以异常的形式报错
            self::$pdo ->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC );//设置fetch时返回数据形式为数组
            self::$pdo ->query("set character set 'utf8'");
            self::$pdo ->query("SET NAMES utf8");
        }
        catch(PDOException $e)
        {
            exit($e->getMessage());
        }
    }

    public static function getPDO(){
        self::connect();
        return self::$pdo;
    }

    public static function delete(){
        self::$pdo = null;
    }



    protected $table ;
    protected function getTableName(){
        return $this->table?:strtolower(substr(__CLASS__ ,0,-5));
    }


    public function save($values){



        $fields = join(',',array_keys($values));
        $values = join("','",array_values($values));


        $sql = "INSERT INTO $this->table ( $fields ) VALUES ( '$values' )";


        var_dump($sql);

        $pdo = Model::getPDO();
        $pdo->exec($sql);
        return $pdo->lastInsertId();
    }

}
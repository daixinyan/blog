<?php
/**
 * Created by PhpStorm.
 * the unique entrance of php project.
 * User: darxan
 * Date: 2016/9/24
 * Time: 11:32
 */
// 应用目录为当前目录
define('APP_PATH', __DIR__.'/');
require_once APP_PATH.'core/autoload.php';
require_once APP_PATH.'core/function.php';
require_once APP_PATH.'core/constant.php';
\core\App::run();
<?php
/**
 * Created by PhpStorm.
 * User: darxan
 * Date: 2016/9/29
 * Time: 9:41
 */
define('PAGE_SIZE',20);
define('KEY_REQUEST_METHOD',0);
define('KEY_ROUTER',1);
define('KEY_AUTH',2);

/***
 * prefix means: such as alias in apache "/blog",
 * if none: ''
 */
//define('WEB_PREFIX','/blog');
//define('DOCUMENT_PREFIX','/blog');
define('WEB_PREFIX','');
define('DOCUMENT_PREFIX','');

/**
 * page location constant
 */
define('WEB_HTML_ROOT',WEB_PREFIX.'/');
define('HOME_PAGE',WEB_HTML_ROOT.'index.html');
define('ADMIN_PAGE',WEB_HTML_ROOT.'admin/index.html');
define('EDIT_PAGE',WEB_HTML_ROOT.'admin/edit.html');
define('UPLOAD_PAGE',WEB_HTML_ROOT.'admin/upload.html');
define('LOGIN_PAGE',WEB_HTML_ROOT.'login.html');
define('REGISTER_PAGE',WEB_HTML_ROOT.'register.html');
define('',WEB_HTML_ROOT.'.html');

define('CURRENT_LOGIN_VERIFIED','CURRENT_LOGIN_VERIFIED');
define('CURRENT_LOGIN_NAME','CURRENT_LOGIN_NAME');
define('CURRENT_LOGIN_PHONE','CURRENT_LOGIN_PHONE');
define('CURRENT_LOGIN_AVATAR','CURRENT_LOGIN_AVATAR');
define('CURRENT_LOGIN_ID','CURRENT_LOGIN_ID');

define('ACCESS_COUNT','ACCESS_COUNT');
define('ACCESS_LAST_TIME','ACCESS_LAST_TIME');
define('ACCESS_TIME_INTERVAL',0);
define('ACCESS_FREQUENCY_LIMIT',100);


define('TRANSACTION_STARTED',0);
define('TRANSACTION_CONFIRM',1);
define('TRANSACTION_REFUSED',2);


define('DEFAULT_AVATAR','/avatar.jpg');

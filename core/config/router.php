<?php
/**
 * Created by PhpStorm.
 * User: darxan
 * Date: 2016/9/29
 * Time: 20:04
 */

return [

    '/list'=>[
        ['POST'],  ['blog','search'],[]
    ],

    '/search/:bound/:order/:key/:category'=>[
        ['GET'],  ['blog','search'],[]
    ],

    '/detail/:id'=>[
        ['GET','POST'], ['blog','detail'],[]
    ],
    '/category'=>[
        ['GET','POST'], ['blog','category'],[]
    ],

    '/post'=>[
        ['POST'],['blog','post'],[]
    ],

    '/update'=>[
        ['POST'],['blog','update'],[]
    ],
    '/admin'=>[
        ['GET','POST'], ['home','admin'],[]
    ],

    '/upload'=>[
        ['GET','POST'], ['home','upload'],[]
    ],

    '/edit'=>[
        ['GET','POST'], ['home','edit'],[]
    ],

    '/index'=>[
        ['GET','POST'], ['home','index'],[]
    ],
];
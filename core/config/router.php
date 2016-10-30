<?php
/**
 * Created by PhpStorm.
 * User: darxan
 * Date: 2016/9/29
 * Time: 20:04
 */

return [

    '/list'=>[
        ['POST'],  ['blog','search']
    ],
    '/search/:bound/:order/:key/:category'=>[
        ['GET'],  ['blog','search']
    ],

    '/detail/:id'=>[
        ['GET','POST'], ['blog','detail']
    ],

    '/post'=>[
        ['POST'],['blog','post']
    ],

    '/admin'=>[
        ['GET','POST'], ['home','admin']
    ],
];
<?php

return [
    //Maincontroller
	'' => [
		'controller' => 'main',
		'action' => 'index',
	],
    'main/index/{page:\d+}' => [
        'controller' => 'main',
        'action' => 'index',
    ],

    'about' => [
        'controller' => 'main',
        'action' => 'about',
    ],

    'contact' => [
        'controller' => 'main',
        'action' => 'contact',
    ],

    'post/{id:\d+}' => [
        'controller' => 'main',
        'action' => 'post',
    ],


    //admincontroller

    'admin/login' => [
		'controller' => 'admin',
		'action' => 'login',
	],

	'admin/logout' => [
		'controller' => 'admin',
		'action' => 'logout',
	],

    'admin/add' => [
        'controller' => 'admin',
        'action' => 'add',
    ],

    'admin/edit/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'edit',
    ],

    'admin/posts/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'posts',
    ],
    'admin/posts' => [
        'controller' => 'admin',
        'action' => 'posts',
    ],

    'admin/delete/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'delete',
    ],
    //accountcontroller

    'account/login' => [
        'controller' => 'account',
        'action' => 'login',
    ],

    'account/logout' => [
        'controller' => 'account',
        'action' => 'logout',
    ],

    'account/register' => [
        'controller' => 'account',
        'action' => 'register',
    ],

    'account/list' => [
        'controller' => 'account',
        'action' => 'list',
    ],

    'account/add' => [
        'controller' => 'account',
        'action' => 'add',
    ],

    'account/delete/{id:\d+}' => [
        'controller' => 'account',
        'action' => 'delete',
    ],

    //jsoncontroller

    'iosjson' => [
        'controller' => 'json',
        'action' => 'iosjson',
    ],

    'androidjson/login&{login:\w+}&{password:\w+}' => [
        'controller' => 'json',
        'action' => 'androidjson',
    ],

    'androidjson/idlist&{uid:\w+}' => [
        'controller' => 'json',
        'action' => 'androidjson',
    ],

    'androidjson/addproduct&{uid:\w+}&{name:\w+}' => [
        'controller' => 'json',
        'action' => 'androidjson',
    ],

    'androidjson/deleteproduct&{id:\w+}' => [
        'controller' => 'json',
        'action' => 'androidjson',
    ],

    'maphere/view' => [
        'controller' => 'maphere',
        'action' => 'view',
    ],
];
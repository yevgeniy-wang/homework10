<?php

use Illuminate\Events\Dispatcher;

$request = \Illuminate\Http\Request::createFromGlobals();
function request()
{
    global $request;

    return $request;
}

$dispatcher = new Dispatcher();
$container = new \Illuminate\Container\Container();
$router = new \Illuminate\Routing\Router($dispatcher, $container);
function router()
{
    global $router;

    return $router;
}

$router->get('/', '\Hillel\Homework10\Controller\HomeController@index');
$router->get('/categories', '\Hillel\Homework10\Controller\CategoryController@list');
$router->get('/categories/create', '\Hillel\Homework10\Controller\CategoryController@create');
$router->post('/categories/create', '\Hillel\Homework10\Controller\CategoryController@store');
$router->get('/categories/{id}/edit', '\Hillel\Homework10\Controller\CategoryController@edit');
$router->post('/categories/{id}/edit', '\Hillel\Homework10\Controller\CategoryController@update');
$router->get('/categories/{id}/edit', '\Hillel\Homework10\Controller\CategoryController@edit');
$router->post('/categories/{id}/edit', '\Hillel\Homework10\Controller\CategoryController@update');
$router->get('/categories/{id}/delete', '\Hillel\Homework10\Controller\CategoryController@destroy');

$router->get('/tags', '\Hillel\Homework10\Controller\TagController@list');
$router->get('/tags/create', '\Hillel\Homework10\Controller\TagController@create');
$router->post('/tags/create', '\Hillel\Homework10\Controller\TagController@store');
$router->get('/tags/{id}/edit', '\Hillel\Homework10\Controller\TagController@edit');
$router->post('/tags/{id}/edit', '\Hillel\Homework10\Controller\TagController@update');
$router->get('/tags/{id}/edit', '\Hillel\Homework10\Controller\TagController@edit');
$router->post('/tags/{id}/edit', '\Hillel\Homework10\Controller\TagController@update');
$router->get('/tags/{id}/delete', '\Hillel\Homework10\Controller\TagController@destroy');

$router->get('/posts', '\Hillel\Homework10\Controller\PostController@list');
$router->get('/posts/create', '\Hillel\Homework10\Controller\PostController@create');
$router->post('/posts/create', '\Hillel\Homework10\Controller\PostController@store');
$router->get('/posts/{id}/edit', '\Hillel\Homework10\Controller\PostController@edit');
$router->post('/posts/{id}/edit', '\Hillel\Homework10\Controller\PostController@update');
$router->get('/posts/{id}/edit', '\Hillel\Homework10\Controller\PostController@edit');
$router->post('/posts/{id}/edit', '\Hillel\Homework10\Controller\PostController@update');
$router->get('/posts/{id}/delete', '\Hillel\Homework10\Controller\PostController@destroy');



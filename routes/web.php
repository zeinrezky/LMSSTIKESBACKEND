<?php

/** @var \Laravel\Lumen\Routing\Router $router */
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
// Auth
$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('/login', 'AuthController@auth');
    $router->get('/login', 'AuthController@auth');
});
// main
$router->group(
    ['middleware' => 'jwt.auth'], 
    function() use ($router) {
        // Home
        $router->get('/home', 'HomeController@index');
        // Schedule
        $router->get('/schedule', 'ScheduleController@list');
        // Course
        $router->get('/course', 'CourseController@list');
        // Exam
        $router->get('/exam', 'ExamController@list');
        // Session
        $router->get('/session', 'SessionController@list');
        // Topic
        $router->get('/topic', 'TopicController@list');
        // Topic
        $router->get('/topics', 'TopicController@list');
        // Knowledge
        $router->group(['prefix' => 'knowledge'], function () use ($router) {
            $router->get('/list', 'KnowledgeController@list');
            $router->get('/detail', 'KnowledgeController@detail');
        });
        // Whatson
        $router->group(['prefix' => 'whatson'], function () use ($router) {
            $router->get('/list', 'WhatsonController@list');
            $router->get('/detail', 'WhatsonController@detail');
        });
        // Campus
        $router->group(['prefix' => 'campus'], function () use ($router) {
            $router->get('/list', 'CampusController@list');
            $router->get('/detail', 'CampusController@detail');
        });
        // Thread
        $router->group(['prefix' => 'thread'], function () use ($router) {
            $router->get('/list', 'ThreadController@list');
            $router->post('/create', 'ThreadController@create');
            $router->post('/update', 'ThreadController@update');
            $router->post('/delete', 'ThreadController@delete');
        });
        // Attendance
        $router->group(['prefix' => 'attendance'], function () use ($router) {
            $router->get('/list', 'AttendanceController@list');
        });
        // Score
        $router->group(['prefix' => 'score'], function () use ($router) {
            $router->get('/list', 'ScoreController@list');
        });
    }
);
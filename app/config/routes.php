<?php

use app\controllers\HomeController;
use app\controllers\ArticleController;
use app\controllers\AuthController;
use app\controllers\DashboardController;
use app\controllers\back\AdminDashboardController;
use app\controllers\front\UserDashboardController;

return [
    // Public routes
    '' => ['app\controllers\HomeController', 'index'],
    'articles' => ['app\controllers\ArticleController', 'index'],
    'articles/{id}' => ['app\controllers\ArticleController', 'show'],
    'login' => ['app\core\Auth', 'login'],
    'register' => ['app\core\Auth', 'register'],
    'logout' => ['app\core\Auth', 'logout'],
    
    // User dashboard routes
    'dashboard' => ['app\controllers\front\UserDashboardController', 'index'],
    'dashboard/create-article' => ['app\controllers\front\UserDashboardController', 'createArticle'],
    'dashboard/articles/edit/{id}' => ['app\controllers\ArticleController', 'edit'],
    'dashboard/articles/delete/{id}' => ['app\controllers\ArticleController', 'delete'],
  
];
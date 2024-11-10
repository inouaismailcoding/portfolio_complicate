<?php

ini_set("display_errors",1);
use Router\Router; // On importe Router car c'est qu'on a ecrit dans le composer
use  Core\Exceptions\NotFoundException;
use  Core\CSRFProtection;
 
require "../vendor/autoload.php";
define('VIEWS',dirname(__DIR__).DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR);
define('SCRIPTS',dirname($_SERVER['SCRIPT_NAME']).DIRECTORY_SEPARATOR);
define('ASSETS',dirname(__DIR__).DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR);
// Les Variable constante de connection
define('DB_HOST','localhost');
define('DB_NAME','portfolio');
define('DB_USER','root');
define('DB_PASS','');
define('HTDOCS',basename(dirname(__DIR__)));
// config.php
define('ERROR_LOG_PATH', '/'.HTDOCS.'/logs/site_errors.log');
define('SQL_LOG_PATH', '/'.HTDOCS.'/logs/sql_queries.log');

$token= new CSRFProtection();
$csrf=new  CSRFProtection();
        $token = $_SESSION['csrf_token'] ?? '';
        if ($csrf->verifyToken($token)===false) {
            die("Erreur : Le token CSRF est invalide ou a expiré.");
        }

$router=new Router($_GET['url']);
// Roouter pour la welcome
$router->get('/','User\Controllers\UserController@welcome');
$router->get('/brouillon','User\Controllers\brouillon@brouillon');


$router->get('/admin','User\Controllers\UserController@listUser');
$router->get('/admin/create','User\Controllers\UserController@createUser');
$router->get('/dashboard','User\Controllers\UserController@dashboard');
$router->post('/admin','User\Controllers\UserController@loginStaffPost');
$router->post('/admin/create','User\Controllers\UserController@createUserPost');
// Router Pour ouvrir la page de modification d'un Utilisateur
$router->get('/admin/edit/:id','User\Controllers\UserController@editUser');

// Router Pour ouvrir la page de modification d'un Utilisateur
$router->get('/admin/view/:id','User\Controllers\UserController@viewUser');
// Router Pour ouvrir la page Pour mettre a jour les données d'un Utilisateur
$router->post('/admin/edit/:id','User\Controllers\UserController@updateUser');
// Router Pour ouvrir la page Pour mettre a jour les données d'un Utilisateur
$router->post('/admin/delete/:id','User\Controllers\UserController@destroyUser');

// Router Pour afficher et gerer les mails
$router->get('/mailer','User\Controllers\MailerController@index');
$router->post('/mailer','User\Controllers\MailerController@sendMail');
// Fin Routes gestion mails

//Debut Route Pour gerer  les services
$router->get('/service','App\Controllers\ServiceController@list');
$router->get('/service/details_service','App\Controllers\ServiceController@details');
// Fin Routes gestion Service

//Debut Route Pour gerer  les Teams
$router->get('/team','App\Controllers\TeamController@list');
$router->get('/team/details_team','App\Controllers\TeamController@details');
// Fin Routes gestion Teams

//Debut Route Pour gerer  le Blog
$router->get('/blog','App\Controllers\BlogController@list');
$router->get('/admin/posts/create','App\Controllers\admin\PostController@create');
$router->post('/admin/posts/create','App\Controllers\admin\PostController@createPost');

$router->get('/admin/posts/edit/:id','App\Controllers\admin\PostController@edit');
$router->post('/admin/posts/edit/:id','App\Controllers\admin\PostController@update');

$router->get('/blog/details_article','App\Controllers\BlogController@details');
// Fin Routes gestio Blog

//Debut Route Pour gerer  les Pricing
$router->get('/pricing','App\Controllers\PricingController@list');
$router->get('/pricing/details_pricing','App\Controllers\PricingController@details');
// Fin Routes gestion Pricing

//Debut Route Pour gerer  les project
$router->get('/project','App\Controllers\ProjectController@list');
$router->get('/project/details_project','App\Controllers\ProjectController@details');
// Fin Routes gestion project

//Debut Route Pour gerer  les portfolio
$router->get('/portfolio','App\Controllers\PortFolioController@list');
$router->get('/portfolio/details_portfolio','App\Controllers\PortFolioController@details');
// Fin Routes gestion portfolio

//Debut Route Pour gerer  les testimonial
$router->get('/testimonial','App\Controllers\TestimonialController@list');
$router->get('/testimonial/details_testimonial','App\Controllers\TestimonialController@details');
// Fin Routes gestion testimonial

//Debut Route Pour gerer  les testimonial
$router->get('/about','App\Controllers\AboutController@about');
// Fin Routes gestion testimonial

//Debut Route Pour gerer  les testimonial
$router->get('/contact','App\Controllers\ContactController@contact');
// Fin Routes gestion testimonial

// Rediriger vers la page de connection
$router->get('/login','User\Controllers\UserController@login');
// Valider le formulaire de connection
$router->post('/login','User\Controllers\UserController@loginPost');

// Rediriger vers la page d'inscription
$router->get('/signUp','User\Controllers\UserController@signUp');
// Valider le formulaire de connection
$router->post('/signUp','User\Controllers\UserController@signUpPost');



// se deconnecter
$router->get('/logout','User\Controllers\UserController@logout');

// On essai d'executer le router si erreur on renvoi la page 404 personnaliser
try{ $router->run();}catch(NotFoundException $e){return $e->error404();}
















?>
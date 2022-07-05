<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

//-------------------Login route
$routes->match(['get', 'post'], 'login', 'UserController::login', ["filter" => "noauth"]);
$routes->match(['get', 'post'], 'create_count', 'UserController::create_count');
$routes->get("delete_count", "UserController::delete_count");
$routes->get('logout', 'UserController::logout');

//-------------------Admin Routes
$routes->group("admin", ["filter" => "auth"], function ($routes) {

    // -- routes pour le controller admin
    $routes->get("/", "AdminController::index");
    $routes->match(['get', 'post'], "users", "AdminController::users");
    $routes->match(['get', 'post'], "user_active/(:num)", "AdminController::user_active/$1");
    $routes->match(['get', 'post'], "user_delete/(:num)", "AdminController::user_delete/$1");
    $routes->match(['get', 'post'], "user_add", "AdminController::user_add");
    $routes->match(['get', 'post'], "boutiques/(:num)", "AdminController::boutiques/$1");

    // -- routes pour le controller boutique
    $routes->match(['get', 'post'], "boutique_active/(:num)/(:num)", "BoutiqueController::boutique_active_admin/$1/$2");
    $routes->match(['get', 'post'], "boutique_view/(:num)/(:num)", "BoutiqueController::boutique_view_admin/$1/$2");
    $routes->match(['get', 'post'], "boutique_delete/(:num)/(:num)", "BoutiqueController::boutique_delete_admin/$1/$2");

    // -- routes pour le controller User
    $routes->match(['get', 'post'], "profil", "UserController::profil");
    $routes->match(['get', 'post'], "update_picture", "UserController::update_picture");

});
//--------------------Tenant routes
$routes->group("tenant", ["filter" => "auth"], function ($routes) {
    $routes->get("/", "TenantController::index");

    // -- routes pour le controller boutique
    $routes->match(['get', 'post'], "boutique", "BoutiqueController::index");
    $routes->match(['get', 'post'], "boutique_active/(:num)", "BoutiqueController::boutique_active/$1");
    $routes->match(['get', 'post'], "boutique_edit/(:num)", "BoutiqueController::boutique_edit/$1");
    $routes->match(['get', 'post'], "boutique_view/(:num)", "BoutiqueController::boutique_view/$1");
    $routes->match(['get', 'post'], "boutique_delete/(:num)", "BoutiqueController::boutique_delete/$1");
    
    // -- routes pour le controller produit
    $routes->match(['get', 'post'], "produit", "ProduitController::index");
    $routes->match(['get', 'post'], "produit_add/(:num)", "ProduitController::produit_add/$1");
    $routes->match(['get', 'post'], "produit_edit/(:num)/(:num)", "ProduitController::produit_edit/$1/$2");
    $routes->match(['get', 'post'], "produit_active/(:num)/(:num)", "ProduitController::produit_active/$1/$2");
    $routes->match(['get', 'post'], "produit_delete/(:num)/(:num)", "ProduitController::produit_delete/$1/$2");
    
    // -- routes pour le controller client
    $routes->match(['get', 'post'], "client", "ClientController::index");
    $routes->match(['get', 'post'], "client_add/(:num)", "ClientController::client_add/$1");
    $routes->match(['get', 'post'], "client_active/(:num)/(:num)", "ClientController::client_active/$1/$2");
    $routes->match(['get', 'post'], "client_delete/(:num)/(:num)", "ClientController::client_delete/$1/$2");

    // -- routes pour le controller User
    $routes->match(['get', 'post'], "profil", "UserController::profil");
    $routes->match(['get', 'post'], "update_picture", "UserController::update_picture");
    
});
//--------------------Client routes
$routes->group("client", ["filter" => "auth"], function ($routes) {
    $routes->get("/", "ClientController::index");
    $routes->get("add_boutique/(:num)", "ClientController::add_boutique/$1");
    $routes->get("view_produit/(:num)", "ClientController::view_produit/$1");
    $routes->match(['get', 'post'], "view_produit_client/(:num)", "ClientController::view_produit_client/$1");
    $routes->match(['get', 'post'], "boutique", "ClientController::boutique");
    
    // -- routes pour le controller panier
    $routes->match(['get', 'post'], "panier_client/(:num)", "PanierController::panier_client/$1");
    $routes->match(['get', 'post'], "panier_detail/(:num)/(:num)", "PanierController::panier_detail/$1/$2");
    $routes->get("panier_delete_produit/(:num)/(:num)/(:num)", "PanierController::panier_delete_produit/$1/$2/$3");
    $routes->get("valider_panier/(:num)/(:num)", "PanierController::valider_panier/$1/$2");
    $routes->get("panier", "PanierController::panier");

    // -- routes pour le controller User
    $routes->match(['get', 'post'], "profil", "UserController::profil");
    $routes->match(['get', 'post'], "update_picture", "UserController::update_picture");
});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

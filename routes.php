<?php

// register routes
$router->map('GET', '/register', 'Acme\Controllers\RegisterController@getShowRegisterPage', 'register');
$router->map('POST', '/register', 'Acme\Controllers\RegisterController@postShowRegisterPage', 'register_post');
$router->map('GET', '/verify-account', 'Acme\Controllers\RegisterController@getVerifyAccount', 'verify_account');

// testimonial routes
$router->map('GET', '/testimonials', 'Acme\Controllers\TestimonialController@getTestimonials', 'testimonials');


// logged in testimonial routes
if (Acme\auth\LoggedIn::user()) {
    $router->map('GET', '/add-testimonial', 'Acme\Controllers\TestimonialController@getShowAdd', 'add_testimonial');
    $router->map('POST', '/add-testimonial', 'Acme\Controllers\TestimonialController@postShowAdd', 'add_testimonial_post');
}

// login/logout routes
$router->map('GET', '/login', 'Acme\Controllers\AuthenticationController@getShowLoginPage', 'login');
$router->map('POST', '/login', 'Acme\Controllers\AuthenticationController@postShowLoginPage', 'login_post');
$router->map('GET', '/logout', 'Acme\Controllers\AuthenticationController@getLogout', 'logout');

if ((Acme\auth\LoggedIn::user()) && (Acme\auth\LoggedIn::user()->access_level == 20)) {
    $router->map('POST', '/admin/page/edit', 'Acme\Controllers\AdminController@postSavePage', 'save_pages');
    $router->map('GET', '/admin/page/add', 'Acme\Controllers\AdminController@getAddPage', 'add_pages');
}

// page routes
$router->map('GET', '/', 'Acme\Controllers\PageController@getShowHomePage', 'home');
$router->map('GET', '/[*]', 'Acme\Controllers\PageController@getShowPage', 'generic_page');

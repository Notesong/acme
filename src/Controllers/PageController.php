<?php
namespace Acme\Controllers;

use duncan3dc\Laravel\BladeInstance;

class PageController extends BaseController
{
    public function getShowHomePage()
    {
        //echo $this->twig->render('home.html');
        echo $this->blade->render("home");
    }
    public function getShowAboutPage()
    {
        //echo $this->twig->render('about.html');
        echo $this->blade->render("about");
    }
}

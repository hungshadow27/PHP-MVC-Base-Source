<?php
class App
{
    private $controller = 'Home';
    private $method = 'index';
    private function splitURL()
    {
        $URL =  $_GET['url'] ?? 'home';
        $URL = explode('/', trim($URL, "/"));
        return $URL;
    }

    public function loadController()
    {
        $URL = $this->splitURL();

        /*Select Controller*/
        $filename = "./src/Controllers/" . ucfirst($URL[0]) . "Controller.php";
        if (file_exists($filename)) {
            require $filename;
            $this->controller = ucfirst($URL[0]) . "Controller";
            unset($URL[0]);
        } else {
            $filename = "./src/Controllers/_404.php";
            require $filename;
            $this->controller = "_404";
        }
        $controller = new $this->controller;

        /*Select Method*/
        if (!empty($URL[1])) {
            if (method_exists($controller, str_replace('-', '', $URL[1]))) {
                $this->method = str_replace('-', '', $URL[1]);
                unset($URL[1]);
            }
        }

        call_user_func_array([$controller, $this->method], $URL);
    }
}

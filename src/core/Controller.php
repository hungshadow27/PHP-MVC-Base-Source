<?php
trait Controller
{
    public function view($name, $data = [])
    {
        if (!empty($data)) {
            extract($data);
        }
        $filename = "./src/Views/" . $name . ".php";
        if (file_exists($filename)) {
            require_once $filename;
        } else {
            $filename = "./src/Views/404.view.php";
            require $filename;
        }
    }
}

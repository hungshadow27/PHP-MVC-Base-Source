<?php
class LogoutController
{
    use Controller;
    public function index($a = '', $b = '', $c = '')
    {
        if (isset($_SESSION['USER'])) {
            unset($_SESSION['USER']);
            redirect('login');
            exit;
        }
    }
}

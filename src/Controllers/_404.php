<?php
class _404
{
    use Controller;
    public function index($a = '', $b = '', $c = '')
    {
        $this->view('404.view');
    }
}

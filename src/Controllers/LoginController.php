<?php
require "./src/Models/UserModel.php";
class LoginController
{
    use Controller;
    public function __construct()
    {
        if (isset($_SESSION['USER'])) {
            redirect('home');
            exit;
        }
    }
    public function index($a = '', $b = '', $c = '')
    {
        $this->view('login.view');
    }
    public function signin()
    {
        $data[] = '';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];

            $usermodel = new UserModel;
            $user = $usermodel->getUserByUsername($username);
            if ($user != null) {
                if ($user->username == $username && $user->password == $password) {
                    $_SESSION['USER'] = serialize($user);
                    redirect('home');
                    exit;
                }
            }
            $data['errors'] = "Thông tin tài khoản hoặc mật khẩu không chính xác!";
        }
        $this->view('login.view', $data);
    }
    public function signup()
    {
        $data[] = '';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $repassword = $_POST["repassword"];


            $usermodel = new UserModel;
            $user = $usermodel->getUserByUsername($username);
            if ($user != null) {
                $data['errors'] = "Tài khoản đã tồn tại!";
            } else if (strcmp($password, $repassword)) {
                $data['errors'] = "Mật khẩu nhập lại không khớp";
            } else {
                //create new user
                $usermodel->createNewUser($username, $password);
                //create new cart
                $user = $usermodel->getUserByUsername($username);
                //$cartmodel = new CartModel;
                //$cartmodel->createNewCart($user->getId());

                $data['errors'] = "Đăng ký thành công vui lòng đăng nhập!";
            }
        }
        $this->view('login.view', $data);
    }
}

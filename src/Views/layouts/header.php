<?php
require_once "./src/Models/UserEntity.php";
if (isset($_SESSION['USER'])) {
    $user = new UserEntity();
    $user = unserialize($_SESSION['USER']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hung Mobie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;600;700;900&display=swap" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Inter", sans-serif;
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        #dropdownmenu:hover>.dropdown-menu {
            display: block;
        }



        /* body::-webkit-scrollbar {
            display: none;
        } */
    </style>
</head>

<body>
    <header>
        <div class="container">
            <div class="top text-center">
                <img src="https://cdn2.cellphones.com.vn/x30,webp,q100/https://dashboard.cellphones.com.vn/storage/top-banner-chinh-sach-bao-hanh-doi-tra.png" alt="" />
                <img src="https://cdn2.cellphones.com.vn/x30,webp,q100/https://dashboard.cellphones.com.vn/storage/top-banner-chinh-hang-xuat-vat-day-du.png" alt="" />
                <img src="https://cdn2.cellphones.com.vn/x30,webp,q100/https://dashboard.cellphones.com.vn/storage/top-banner-giao-nhanh-mien-phi.png" alt="" />
            </div>
        </div>

        <div class="bottom bg-danger py-3">
            <div class="container row justify-content-center align-items-center mx-auto">
                <div class="logo col-lg-3 col-sm-12">
                    <a href="<?= ROOT ?>/home" class="text-white fs-4 fw-medium text-decoration-none">HungMobie</a>
                    <img style="width: 40px" src="https://upload.wikimedia.org/wikipedia/commons/2/2d/Mobile-Smartphone-icon.png" alt="" />
                </div>
                <div class="search col-lg-6 col-sm-12">
                    <div class="input-group">
                        <input type="text" class="form-control w-75" placeholder="Bạn cần tìm gì?" aria-label="Recipient's username" aria-describedby="basic-addon2" />
                        <button class="input-group-text" id="basic-addon2">
                            Tìm Kiếm
                        </button>
                    </div>
                </div>
                <div class="cart col-lg-3 col-sm-12 d-flex justify-content-end gap-4">
                    <a href="<?= ROOT ?>/cart" type="button" class="btn btn-outline-light position-relative">
                        Giỏ hàng
                        <span id="cartItemsNumber" class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-success">
                            <?= isset($_SESSION['CARTITEMS']) ? count($_SESSION['CARTITEMS']) : "0" ?>
                            <span class="visually-hidden">cart product number</span>
                        </span>
                    </a>
                    <?php if (!empty($user)) : ?>
                        <div class="dropdown" id="dropdownmenu">
                            <a href="<?= ROOT ?>/account" class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">
                                <?= $user->getUsername() ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="<?= ROOT ?>/account">Tài khoản của tôi</a></li>
                                <li><a class="dropdown-item" href="<?= ROOT ?>/account/orders">Đơn mua</a></li>
                                <li><a class="dropdown-item" href="<?= ROOT ?>/logout">Đăng xuất</a></li>
                            </ul>
                        </div>

                    <?php else : ?>
                        <a href="<?= ROOT ?>/login" type="button" class="btn btn-outline-light">
                            Đăng nhập
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
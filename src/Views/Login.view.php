<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;500;600;700;900&display=swap" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Inter", sans-serif;
        }
    </style>
</head>

<body style="background-color: #FEF3E2;">
    <div class="container">
        <form action="<?= ROOT ?>/login/signin" method="post" class="mt-5 text-center py-5" id="signin-form" style="display: block; transition: all 0.3s linear; background-color: white; border: 5px solid black; border-radius: 10px;">
            <h4 class="fw-bold">ĐĂNG NHẬP</h4>
            <?php if (!empty($errors)) : ?>
                <div class="alert alert-danger w-50 mx-auto" role="alert">
                    <?= $errors ?>
                </div>
            <?php endif; ?>
            <div class="w-50 mx-auto">
                <div class="input-group input-group-lg mb-3">
                    <span style="border: 5px solid black; border-radius: 10px;" class="input-group-text bg-danger text-white" id="inputGroup-sizing-lg">Username</span>
                    <input style="border: 5px solid black; border-radius: 10px;" type="text" name="username" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" required />
                </div>
                <div class="input-group input-group-lg mb-3">
                    <span style="border: 5px solid black; border-radius: 10px;" class="input-group-text bg-danger text-white" id="inputGroup-sizing-lg">Password</span>
                    <input style="border: 5px solid black; border-radius: 10px;" type="password" name="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" required />
                </div>
                <button style="border: 5px solid black; border-radius: 10px;" type="submit" class="btn btn-danger mb-3 btn-lg">
                    Đăng nhập
                </button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
<?php
if (isset($_POST["submit"])) {
    if (isset($_FILES['fileUpload'])) {
        //Thư mục bạn lưu file upload
        $target_dir = $target_dir = "C:/xampp/htdocs/electronic-store/Public/images/";
        //Đường dẫn lưu file trên server
        $target_file   = $target_dir . basename($_FILES["fileUpload"]["name"]);
        $allowUpload   = true;
        //Lấy phần mở rộng của file (txt, jpg, png,...)
        $fileType = pathinfo($target_file, PATHINFO_EXTENSION);
        //Những loại file được phép upload
        $allowtypes    = array('jpg', 'png');
        //Kích thước file lớn nhất được upload (bytes)
        $maxfilesize   = 10000000; //10MB

        //1. Kiểm tra file có bị lỗi không?
        if ($_FILES["fileUpload"]['error'] != 0) {
            echo "<br>The uploaded file is error or no file selected.";
            die;
        }

        //2. Kiểm tra loại file upload có được phép không?
        if (!in_array($fileType, $allowtypes)) {
            echo "<br>Only allow for uploading .jpg or .png files.";
            $allowUpload = false;
        }

        //3. Kiểm tra kích thước file upload có vượt quá giới hạn cho phép
        if ($_FILES["fileUpload"]["size"] > $maxfilesize) {
            echo "<br>Size of the uploaded file must be smaller than $maxfilesize bytes.";
            $allowUpload = false;
        }

        // //4. Kiểm tra file đã tồn tại trên server chưa?
        // if (file_exists($target_file)) {
        //     echo "<br>The file name already exists on the server.";
        //     $allowUpload = false;
        // }

        if ($allowUpload) {
            //Lưu file vào thư mục được chỉ định trên server
            if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
                echo "<br>File " . basename($_FILES["fileUpload"]["name"]) . " uploaded successfully.";
                echo "The file saved at " . $target_file;
            } else {
                echo "<br>An error occurred while uploading the file.";
            }
        }
    }
}

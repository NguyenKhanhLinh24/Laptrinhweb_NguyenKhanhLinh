<?php

$ho_ten = "";
$email = "";
$chu_de = "";
$noi_dung = "";
$thong_bao = "";
$danh_sach_loi = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ho_ten = trim($_POST["ho_ten"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $chu_de = $_POST["chu_de"] ?? "";
    $noi_dung = trim($_POST["noi_dung"] ?? "");


    if ($ho_ten == "") {
        $danh_sach_loi[] = "Họ tên không được để trống.";
    }


    if ($noi_dung == "") {
        $danh_sach_loi[] = "Nội dung không được để trống.";
    }



    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $danh_sach_loi[] = "Email không đúng định dạng.";
    }




    $do_dai_noi_dung = mb_strlen($noi_dung);

    if ($do_dai_noi_dung < 10 || $do_dai_noi_dung > 500) {
        $danh_sach_loi[] = "Nội dung phải từ 10 đến 500 ký tự.";
    }



  
    if (
        isset($_FILES["anh_dai_dien"]) &&
        $_FILES["anh_dai_dien"]["error"] != UPLOAD_ERR_NO_FILE
    ) {

       
        $ten_file = $_FILES["anh_dai_dien"]["name"];

        
        $duoi_file = strtolower(
            pathinfo($ten_file, PATHINFO_EXTENSION)
        );

       
        $dinh_dang_cho_phep = ["jpg", "jpeg", "png", "gif"];

       
        if (!in_array($duoi_file, $dinh_dang_cho_phep)) {
            $danh_sach_loi[] =
                "Ảnh phải có định dạng JPG, JPEG, PNG hoặc GIF.";
        }
    }


    if (empty($danh_sach_loi)) {

        $thong_bao = "Gửi liên hệ thành công!";

        $ho_ten = "";
        $email = "";
        $chu_de = "";
        $noi_dung = "";
    }
}

?>


<!DOCTYPE html>

<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Liên hệ</title>


    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f6f8;
        }

        .form-container {
            width: 650px;
            max-width: 90%;
            margin: 40px auto;
            padding: 35px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin: 0 0 12px;
            text-align: center;
            color: #31566f;
            font-size: 32px;
        }

        .mo-ta {
            margin-bottom: 30px;
            text-align: center;
            color: #777;
            font-size: 16px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }


        input[type="text"],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            font-family: Arial, sans-serif;
        }


        input[type="text"]:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #287db7;
        }


        .form-group {
            margin-bottom: 20px;
        }


        textarea {
            height: 140px;
            resize: vertical;
        }

        .ghi-chu {
            display: block;
            margin-top: 7px;
            color: #c55b5b;
            font-size: 14px;
        }


        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background: #fff;
            font-size: 15px;
        }

        .thong-bao {
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 6px;
            line-height: 1.5;
        }

        .thanh-cong {
            background: #dff5e5;
            color: #20733a;
            border: 1px solid #a7dfb5;
        }

        .bao-loi {
            background: #ffe4e4;
            color: #a22b2b;
            border: 1px solid #efaaaa;
        }

        button {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 6px;
            background: #287db7;
            color: white;
            font-size: 17px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #1f6899;
        }


        @media (max-width: 600px) {

            .form-container {
                padding: 25px;
                margin: 20px auto;
            }

            h1 {
                font-size: 28px;
            }
        }

    </style>

</head>


<body>


    <div class="form-container">


        <h1>Liên hệ</h1>

        <p class="mo-ta">
            Vui lòng nhập đầy đủ thông tin bên dưới.
        </p>


        <?php if ($thong_bao != ""): ?>

            <div class="thong-bao thanh-cong">

                <?php echo $thong_bao; ?>

            </div>

        <?php endif; ?>



        <?php if (!empty($danh_sach_loi)): ?>

            <div class="thong-bao bao-loi">

                <?php

                echo implode(
                    "<br>",
                    $danh_sach_loi
                );

                ?>

            </div>

        <?php endif; ?>

        <form
            method="POST"
            enctype="multipart/form-data"
        >


            <div class="form-group">

                <label for="ho_ten">
                    Họ tên
                </label>

                <input
                    type="text"
                    id="ho_ten"
                    name="ho_ten"
                    value="<?php echo htmlspecialchars($ho_ten); ?>"
                    placeholder="Nhập họ tên"
                >

            </div>

            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="text"
                    id="email"
                    name="email"
                    value="<?php echo htmlspecialchars($email); ?>"
                    placeholder="Nhập email"
                >

            </div>

            <div class="form-group">

                <label for="chu_de">
                    Chủ đề
                </label>

                <select
                    id="chu_de"
                    name="chu_de"
                >

                    <option value="">
                        -- Chọn chủ đề --
                    </option>

                    <option
                        value="Hỗ trợ kỹ thuật"
                        <?php
                        if ($chu_de == "Hỗ trợ kỹ thuật") {
                            echo "selected";
                        }
                        ?>
                    >
                        Hỗ trợ kỹ thuật
                    </option>

                    <option
                        value="Tư vấn"
                        <?php
                        if ($chu_de == "Tư vấn") {
                            echo "selected";
                        }
                        ?>
                    >
                        Tư vấn
                    </option>

                    <option
                        value="Góp ý"
                        <?php
                        if ($chu_de == "Góp ý") {
                            echo "selected";
                        }
                        ?>
                    >
                        Góp ý
                    </option>

                    <option
                        value="Khác"
                        <?php
                        if ($chu_de == "Khác") {
                            echo "selected";
                        }
                        ?>
                    >
                        Khác
                    </option>

                </select>

            </div>

            <div class="form-group">

                <label for="noi_dung">
                    Nội dung
                </label>

                <textarea
                    id="noi_dung"
                    name="noi_dung"
                    placeholder="Nhập nội dung liên hệ..."
                ><?php echo htmlspecialchars($noi_dung); ?></textarea>

                <small class="ghi-chu">
                    Nội dung phải từ 10 đến 500 ký tự.
                </small>

            </div>

            <div class="form-group">

                <label for="anh_dai_dien">
                    Ảnh đại diện
                </label>

                <input
                    type="file"
                    id="anh_dai_dien"
                    name="anh_dai_dien"
                    accept=".jpg,.jpeg,.png,.gif"
                >

            </div>

            <button type="submit">
                Gửi liên hệ
            </button>


        </form>

    </div>


</body>

</html>
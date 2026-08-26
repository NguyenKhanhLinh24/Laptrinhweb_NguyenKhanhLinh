<?php

$name = "";
$email = "";
$subject = "";
$content = "";

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $subject = $_POST["subject"] ?? "";
    $content = trim($_POST["content"] ?? "");

    if ($name === "") {
        $errors["name"] = "Họ tên không được để trống.";
    }

    if ($name === "") {
        $errors["name"] = "Họ tên không được để trống.";
    } elseif (!preg_match("/^[\p{L}\s]+$/u", $name)) {
        $errors["name"] = "Họ tên chỉ được chứa chữ cái.";
    }

    if ($email === "") {
        $errors["email"] = "Email không được để trống.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Email không đúng định dạng.";
    }

    if ($content === "") {
        $errors["content"] = "Nội dung không được để trống.";
    } elseif (strlen($content) < 10 || strlen($content) > 500) {
        $errors["content"] = "Nội dung phải từ 10 đến 500 ký tự.";
    }
    if (empty($errors)) {
        $success = "Gửi liên hệ thành công!";

        $name = "";
        $email = "";
        $subject = "";
        $content = "";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fa;
        }

        .container {
            width: 500px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .title {
            text-align: center;
            margin-bottom: 10px;
            color: #1f4e79;
        }

        .description {
            text-align: center;
            color: #777;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #1976d2;
        }

        textarea {
            min-height: 130px;
            resize: vertical;
        }

        .error {
            margin-top: 5px;
            color: #d93025;
            font-size: 13px;
        }

        .success {
            padding: 12px;
            margin-bottom: 20px;
            background: #dff5e3;
            color: #218838;
            border-radius: 5px;
        }

        .required {
            color: red;
        }

        .btn {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 5px;
            background: #1976d2;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background: #125ca1;
        }
    </style>
</head>

<body>

    <div class="container">

        <h1 class="title">Liên hệ</h1>

        <p class="description">
            Vui lòng nhập đầy đủ thông tin bên dưới.
        </p>

        <?php if ($success !== ""): ?>
            <div class="success">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label>
                    Họ tên
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    name="name"
                    value="<?= htmlspecialchars($name) ?>"
                    required>

                <?php if (isset($errors["name"])): ?>
                    <div class="error">
                        <?= htmlspecialchars($errors["name"]) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label>
                    Email
                    <span class="required">*</span>
                </label>

                <input
                    type="email"
                    name="email"
                    value="<?= htmlspecialchars($email) ?>"
                    required>

                <?php if (isset($errors["email"])): ?>
                    <div class="error">
                        <?= htmlspecialchars($errors["email"]) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label>Chủ đề</label>

                <select name="subject">
                    <option
                        value="support"
                        <?= $subject === "support" ? "selected" : "" ?>>
                        Hỗ trợ kỹ thuật
                    </option>

                    <option
                        value="feedback"
                        <?= $subject === "feedback" ? "selected" : "" ?>>
                        Góp ý
                    </option>

                    <option
                        value="other"
                        <?= $subject === "other" ? "selected" : "" ?>>
                        Khác
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label>
                    Nội dung
                    <span class="required">*</span>
                </label>

                <textarea
                    name="content"
                    required><?= htmlspecialchars($content) ?></textarea>

                <?php if (isset($errors["content"])): ?>
                    <div class="error">
                        <?= htmlspecialchars($errors["content"]) ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label>Ảnh đại diện</label>

                <input
                    type="file"
                    name="avatar"
                    accept="image/*">
            </div>

            <button type="submit" class="btn">
                Gửi liên hệ
            </button>

        </form>

    </div>

</body>

</html>
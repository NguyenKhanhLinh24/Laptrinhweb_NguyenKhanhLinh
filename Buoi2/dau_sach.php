<?php

$ten_sach = "";
$tac_gia = "";
$danh_muc = "";

$danh_sach_sach = [
    [
        "ten_sach" => "Nhà giả kim",
        "tac_gia" => "Paulo Coelho",
        "danh_muc" => "Văn học"
    ],
    [
        "ten_sach" => "Đắc nhân tâm",
        "tac_gia" => "Dale Carnegie",
        "danh_muc" => "Kỹ năng sống"
    ]
];
function kiemTraDauSach($ten_sach, $tac_gia, $danh_muc)
{
    if ($ten_sach == "" || $tac_gia == "" || $danh_muc == "") {
        return false;
    }

    return true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ten_sach = $_POST["ten_sach"];
    $tac_gia = $_POST["tac_gia"];
    $danh_muc = $_POST["danh_muc"];

    if (kiemTraDauSach($ten_sach, $tac_gia, $danh_muc)) {

        $danh_sach_sach[] = [
            "ten_sach" => $ten_sach,
            "tac_gia" => $tac_gia,
            "danh_muc" => $danh_muc
        ];

    } else {

        echo "Thông tin đầu sách không được để trống.";

    }
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý đầu sách</title>
</head>

<body>

    <h1>HỆ THỐNG QUẢN LÝ THƯ VIỆN MINI</h1>

    <h2>Thêm đầu sách</h2>

    <form method="POST" action="">

        <label>Tên sách:</label>
        <input type="text" name="ten_sach" required>
        <br><br>

        <label>Tác giả:</label>
        <input type="text" name="tac_gia" required>
        <br><br>

        <label>Danh mục:</label>
        <input type="text" name="danh_muc" required>
        <br><br>

        <button type="submit">Thêm sách</button>

    </form>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<h3>Thông tin sách vừa nhập:</h3>";
    echo "Tên sách: " . $ten_sach . "<br>";
    echo "Tác giả: " . $tac_gia . "<br>";
    echo "Danh mục: " . $danh_muc . "<br>";
}
?>

<h3>Danh sách đầu sách:</h3>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>Tên sách</th>
        <th>Tác giả</th>
        <th>Danh mục</th>
    </tr>

    <?php
    foreach ($danh_sach_sach as $sach) {
        echo "<tr>";
        echo "<td>" . $sach["ten_sach"] . "</td>";
        echo "<td>" . $sach["tac_gia"] . "</td>";
        echo "<td>" . $sach["danh_muc"] . "</td>";
        echo "</tr>";
    }
    ?>

</table>

</body>
</html>
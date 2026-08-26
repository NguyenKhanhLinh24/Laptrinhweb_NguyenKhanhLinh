<?php

require_once "book_model.php";


$danh_sach_sach = getAllBooks();


$sach_sua = null;

if (isset($_GET["edit"])) {

    $id = (int)$_GET["edit"];

    if ($id > 0) {

        $sach_sua = getBookById($id);
    }
}

$thong_bao = "";

if (isset($_GET["success"])) {

    if ($_GET["success"] == "them") {

        $thong_bao = "Thêm sách thành công.";

    } elseif ($_GET["success"] == "sua") {

        $thong_bao = "Cập nhật sách thành công.";
    }
}


if (isset($_GET["error"])) {

    if ($_GET["error"] == "ma_sach") {

        $thong_bao = "Mã sách đã tồn tại.";

    } elseif ($_GET["error"] == "isbn") {

        $thong_bao = "ISBN đã tồn tại.";
    }
}

?>

<!DOCTYPE html>

<html lang="vi">

<head>

<meta charset="UTF-8">

<title>Quản lý đầu sách</title>

<style>

* {
    box-sizing: border-box;
}

body {

    margin: 0;

    background: #f5f5f5;

    font-family: Arial, sans-serif;

    color: #222;
}


.tieu-de {

    text-align: center;

    margin: 35px 0 25px;

    font-size: 28px;
}


.thong-bao {

    width: 620px;

    margin: 20px auto;

    padding: 12px;

    background: #e8f5e9;

    border: 1px solid #81c784;

    color: #2e7d32;

    text-align: center;
}


.khung-form {

    width: 620px;

    margin: auto;

    background: white;

    border: 1px solid #999;

    border-radius: 20px;

    overflow: hidden;
}


.tieu-de-form {

    text-align: center;

    padding: 20px;

    border-bottom: 1px solid #999;

    font-size: 18px;

    font-weight: bold;
}


.noi-dung-form {

    padding: 30px 35px;
}


.truong {

    margin-bottom: 20px;
}


.nhan {

    display: block;

    margin-bottom: 8px;

    font-weight: bold;
}


.o-nhap {

    width: 100%;

    min-height: 45px;

    padding: 10px;

    border: 1px solid #888;

    border-radius: 4px;

    font-size: 15px;
}


textarea.o-nhap {

    height: 110px;

    resize: vertical;
}


.khu-vuc-nut {

    display: flex;

    justify-content: flex-end;

    gap: 10px;

    margin-top: 20px;
}


.nut {

    padding: 10px 20px;

    border: 1px solid #555;

    background: white;

    cursor: pointer;

    border-radius: 4px;

    text-decoration: none;

    color: #222;
}


.nut-them {

    background: #333;

    color: white;
}


.danh-sach {

    width: 1400px;

    margin: 40px auto;

    background: white;

    padding: 25px;

    border: 1px solid #ddd;

    border-radius: 10px;

    overflow-x: auto;
}


.danh-sach h2 {

    text-align: center;

    margin-top: 0;
}


table {

    width: 100%;

    min-width: 1350px;

    border-collapse: collapse;
}


th,
td {

    border: 1px solid #999;

    padding: 10px;

    vertical-align: top;
}


th {

    background: #eee;

    text-align: center;
}


td:last-child {

    text-align: center;
}


td:last-child form {

    display: flex;

    flex-wrap: wrap;

    gap: 5px;

    justify-content: center;
}


td:last-child button {

    padding: 7px 10px;

    cursor: pointer;
}


.hoat-dong {

    color: #2e7d32;

    font-weight: bold;
}


.da-khoa {

    color: #c62828;

    font-weight: bold;
}


@media (max-width: 1450px) {

    .khung-form,
    .thong-bao {

        width: 90%;
    }

    .danh-sach {

        width: 90%;
    }
}

</style>

</head>


<body>


<h1 class="tieu-de">

HỆ THỐNG QUẢN LÝ THƯ VIỆN MINI

</h1>


<?php if ($thong_bao != "") { ?>

<div class="thong-bao">

<?php echo htmlspecialchars($thong_bao); ?>

</div>

<?php } ?>


<div class="khung-form">


<div class="tieu-de-form">

<?php

if ($sach_sua) {

    echo "SỬA ĐẦU SÁCH";

} else {

    echo "THÊM ĐẦU SÁCH";
}

?>

</div>


<div class="noi-dung-form">


<form
    method="POST"
    action="book_action.php"
>


<?php if ($sach_sua) { ?>

<input
    type="hidden"
    name="id"
    value="<?php echo $sach_sua["id"]; ?>"
>

<?php } ?>


<div class="truong">

<label class="nhan">
Mã sách
</label>

<input
    class="o-nhap"
    type="text"
    name="ma_sach"
    required
    value="<?php
        echo htmlspecialchars(
            $sach_sua["ma_sach"] ?? ""
        );
    ?>"
>

</div>


<div class="truong">

<label class="nhan">
Tên sách
</label>

<input
    class="o-nhap"
    type="text"
    name="ten_sach"
    required
    value="<?php
        echo htmlspecialchars(
            $sach_sua["ten_sach"] ?? ""
        );
    ?>"
>

</div>


<div class="truong">

<label class="nhan">
Mã tác giả
</label>

<input
    class="o-nhap"
    type="text"
    name="ma_tac_gia"
    required
    value="<?php
        echo htmlspecialchars(
            $sach_sua["ma_tac_gia"] ?? ""
        );
    ?>"
>

</div>


<div class="truong">

<label class="nhan">
Tác giả
</label>

<input
    class="o-nhap"
    type="text"
    name="tac_gia"
    required
    value="<?php
        echo htmlspecialchars(
            $sach_sua["tac_gia"] ?? ""
        );
    ?>"
>

</div>


<div class="truong">

<label class="nhan">
Danh mục
</label>

<select
    class="o-nhap"
    name="danh_muc"
    required
>

<option value="">
-- Chọn danh mục --
</option>

<?php

$danh_muc_hien_tai =
    $sach_sua["danh_muc"] ?? "";

$danh_muc_list = [

    "Văn học",

    "Khoa học",

    "Giáo dục",

    "Kỹ năng",

    "Khác"
];

foreach ($danh_muc_list as $dm) {

?>

<option
    value="<?php echo htmlspecialchars($dm); ?>"
    <?php
    if ($danh_muc_hien_tai == $dm) {
        echo "selected";
    }
    ?>
>

<?php echo htmlspecialchars($dm); ?>

</option>

<?php } ?>

</select>

</div>


<div class="truong">

<label class="nhan">
Nhà xuất bản
</label>

<input
    class="o-nhap"
    type="text"
    name="nha_xuat_ban"
    required
    value="<?php
        echo htmlspecialchars(
            $sach_sua["nha_xuat_ban"] ?? ""
        );
    ?>"
>

</div>


<div class="truong">

<label class="nhan">
Năm xuất bản
</label>

<input
    class="o-nhap"
    type="number"
    name="nam_xuat_ban"
    required
    value="<?php
        echo htmlspecialchars(
            $sach_sua["nam_xuat_ban"] ?? ""
        );
    ?>"
>

</div>


<div class="truong">

<label class="nhan">
ISBN
</label>

<input
    class="o-nhap"
    type="text"
    name="isbn"
    required
    value="<?php
        echo htmlspecialchars(
            $sach_sua["isbn"] ?? ""
        );
    ?>"
>

</div>


<div class="truong">

<label class="nhan">
Giá sách (VNĐ)
</label>

<input
    class="o-nhap"
    type="number"
    name="gia_sach"
    min="1"
    required
    value="<?php
        echo htmlspecialchars(
            $sach_sua["gia_sach"] ?? ""
        );
    ?>"
>

</div>


<div class="truong">

<label class="nhan">
Mô tả
</label>

<textarea
    class="o-nhap"
    name="mo_ta"
><?php
echo htmlspecialchars(
    $sach_sua["mo_ta"] ?? ""
);
?></textarea>

</div>


<div class="khu-vuc-nut">


<?php if ($sach_sua) { ?>


<a
    href="books.php"
    class="nut"
>
Hủy
</a>


<button
    type="submit"
    name="cap_nhat_sach"
    class="nut nut-them"
>
Cập nhật sách
</button>


<?php } else { ?>


<button
    type="reset"
    class="nut"
>
Hủy
</button>


<button
    type="submit"
    name="them_sach"
    class="nut nut-them"
>
Thêm sách
</button>


<?php } ?>


</div>


</form>

</div>

</div>


<div class="danh-sach">


<h2>
DANH SÁCH ĐẦU SÁCH
</h2>


<table>


<tr>

<th>Mã sách</th>

<th>Tên sách</th>

<th>Mã tác giả</th>

<th>Tác giả</th>

<th>Danh mục</th>

<th>Nhà xuất bản</th>

<th>Năm xuất bản</th>

<th>ISBN</th>

<th>Giá sách</th>

<th>Mô tả</th>

<th>Trạng thái</th>

<th>Thao tác</th>

</tr>


<?php foreach ($danh_sach_sach as $sach) { ?>


<tr>


<td>
<?php
echo htmlspecialchars($sach["ma_sach"]);
?>
</td>


<td>
<?php
echo htmlspecialchars($sach["ten_sach"]);
?>
</td>


<td>
<?php
echo htmlspecialchars($sach["ma_tac_gia"]);
?>
</td>


<td>
<?php
echo htmlspecialchars($sach["tac_gia"]);
?>
</td>


<td>
<?php
echo htmlspecialchars($sach["danh_muc"]);
?>
</td>


<td>
<?php
echo htmlspecialchars($sach["nha_xuat_ban"]);
?>
</td>


<td>
<?php
echo htmlspecialchars($sach["nam_xuat_ban"]);
?>
</td>


<td>
<?php
echo htmlspecialchars($sach["isbn"]);
?>
</td>


<td>

<?php

echo number_format(
    $sach["gia_sach"],
    0,
    ",",
    "."
);

?>

 VNĐ

</td>


<td>
<?php
echo htmlspecialchars($sach["mo_ta"]);
?>
</td>


<td>

<?php if ($sach["trang_thai"] == "Hoạt động") { ?>

<span class="hoat-dong">
Hoạt động
</span>

<?php } else { ?>

<span class="da-khoa">
Đã khóa
</span>

<?php } ?>

</td>


<td>


<!-- SỬA -->

<form
    method="GET"
    action="books.php"
>

<button
    type="submit"
    name="edit"
    value="<?php
        echo $sach["id"];
    ?>"
>
Sửa
</button>

</form>


<!-- XÓA -->

<form
    method="POST"
    action="book_action.php"
>

<button
    type="submit"
    name="xoa_sach"
    value="<?php
        echo $sach["id"];
    ?>"
    onclick="return confirm('Bạn có chắc muốn xóa sách này không?');"
>
Xóa
</button>

</form>


<!-- KHÓA -->

<form
    method="POST"
    action="book_action.php"
>

<button
    type="submit"
    name="khoa_sach"
    value="<?php
        echo $sach["id"];
    ?>"
>

<?php

echo $sach["trang_thai"] == "Hoạt động"
    ? "Khóa"
    : "Mở khóa";

?>

</button>

</form>


</td>


</tr>


<?php } ?>


</table>


</div>


</body>

</html>
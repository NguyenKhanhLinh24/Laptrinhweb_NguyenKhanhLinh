<?php

require_once "book_model.php";


if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: books.php");

    exit;
}


if (isset($_POST["xoa_sach"])) {

    $id = (int)$_POST["xoa_sach"];

    if ($id > 0) {

        deleteBook($id);
    }

    header("Location: books.php");

    exit;
}


if (isset($_POST["khoa_sach"])) {

    $id = (int)$_POST["khoa_sach"];

    if ($id > 0) {

        toggleBookStatus($id);
    }

    header("Location: books.php");

    exit;
}

if (isset($_POST["them_sach"])) {

    $ma_sach = trim($_POST["ma_sach"] ?? "");
    $ten_sach = trim($_POST["ten_sach"] ?? "");
    $ma_tac_gia = trim($_POST["ma_tac_gia"] ?? "");
    $tac_gia = trim($_POST["tac_gia"] ?? "");
    $danh_muc = trim($_POST["danh_muc"] ?? "");
    $nha_xuat_ban = trim($_POST["nha_xuat_ban"] ?? "");
    $nam_xuat_ban = trim($_POST["nam_xuat_ban"] ?? "");
    $isbn = trim($_POST["isbn"] ?? "");
    $gia_sach = trim($_POST["gia_sach"] ?? "");
    $mo_ta = trim($_POST["mo_ta"] ?? "");


   if (isBookCodeExists($ma_sach)) {

    header("Location: books.php?error=ma_sach");

    exit;
}

if (isISBNExists($isbn)) {

    header("Location: books.php?error=isbn");

    exit;
}

if (!addBook(
    $ma_sach,
    $ten_sach,
    $ma_tac_gia,
    $tac_gia,
    $danh_muc,
    $nha_xuat_ban,
    $nam_xuat_ban,
    $isbn,
    $gia_sach,
    $mo_ta
)) {

    die("Thêm sách thất bại.");
}

header("Location: books.php?success=them");

exit;
}

if (isset($_POST["cap_nhat_sach"])) {

    $id = (int)($_POST["id"] ?? 0);

    $ma_sach = trim($_POST["ma_sach"] ?? "");
    $ten_sach = trim($_POST["ten_sach"] ?? "");
    $ma_tac_gia = trim($_POST["ma_tac_gia"] ?? "");
    $tac_gia = trim($_POST["tac_gia"] ?? "");
    $danh_muc = trim($_POST["danh_muc"] ?? "");
    $nha_xuat_ban = trim($_POST["nha_xuat_ban"] ?? "");
    $nam_xuat_ban = trim($_POST["nam_xuat_ban"] ?? "");
    $isbn = trim($_POST["isbn"] ?? "");
    $gia_sach = trim($_POST["gia_sach"] ?? "");
    $mo_ta = trim($_POST["mo_ta"] ?? "");


    if (isBookCodeExists($ma_sach, $id)) {

        header(
            "Location: books.php?edit=$id&error=ma_sach"
        );

        exit;
    }


    if (isISBNExists($isbn, $id)) {

        header(
            "Location: books.php?edit=$id&error=isbn"
        );

        exit;
    }


    updateBook(
        $id,
        $ma_sach,
        $ten_sach,
        $ma_tac_gia,
        $tac_gia,
        $danh_muc,
        $nha_xuat_ban,
        $nam_xuat_ban,
        $isbn,
        $gia_sach,
        $mo_ta
    );


    header("Location: books.php?success=sua");

    exit;
}


header("Location: books.php");

exit;

?>
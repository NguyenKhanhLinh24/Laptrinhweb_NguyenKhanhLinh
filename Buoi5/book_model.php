<?php

require_once "db.php";

function getAllBooks()
{
    global $conn;

    $sql = "SELECT * FROM books ORDER BY id DESC";

    $result = mysqli_query($conn, $sql);

    return $result;
}


function searchBooks($keyword)
{
    global $conn;

    $keyword = "%" . $keyword . "%";

    $sql = "SELECT * FROM books
            WHERE ma_sach LIKE ?
               OR ten_sach LIKE ?
               OR ma_tac_gia LIKE ?
               OR tac_gia LIKE ?
               OR isbn LIKE ?
            ORDER BY id DESC";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sssss",
        $keyword,
        $keyword,
        $keyword,
        $keyword,
        $keyword
    );

    mysqli_stmt_execute($stmt);

    return mysqli_stmt_get_result($stmt);
}


function getBookById($id)
{
    global $conn;

    $sql = "SELECT * FROM books WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $id
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($result);
}


function isBookCodeExists($ma_sach, $exclude_id = 0)
{
    global $conn;

    if ($exclude_id > 0) {

        $sql = "SELECT id
                FROM books
                WHERE ma_sach = ?
                AND id != ?";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "si",
            $ma_sach,
            $exclude_id
        );

    } else {

        $sql = "SELECT id
                FROM books
                WHERE ma_sach = ?";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $ma_sach
        );
    }

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    return mysqli_num_rows($result) > 0;
}

function isISBNExists($isbn, $exclude_id = 0)
{
    global $conn;

    if ($exclude_id > 0) {

        $sql = "SELECT id
                FROM books
                WHERE isbn = ?
                AND id != ?";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "si",
            $isbn,
            $exclude_id
        );

    } else {

        $sql = "SELECT id
                FROM books
                WHERE isbn = ?";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $isbn
        );
    }

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    return mysqli_num_rows($result) > 0;
}


function addBook(
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
) {
    global $conn;

    $sql = "INSERT INTO books
            (
                ma_sach,
                ten_sach,
                ma_tac_gia,
                tac_gia,
                danh_muc,
                nha_xuat_ban,
                nam_xuat_ban,
                isbn,
                gia_sach,
                mo_ta,
                trang_thai
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $trang_thai = "Hoạt động";

    $stmt = mysqli_prepare($conn, $sql);

   mysqli_stmt_bind_param(
    $stmt,
    "ssssssisdss",
        $ma_sach,
        $ten_sach,
        $ma_tac_gia,
        $tac_gia,
        $danh_muc,
        $nha_xuat_ban,
        $nam_xuat_ban,
        $isbn,
        $gia_sach,
        $mo_ta,
        $trang_thai
    );

    if (!mysqli_stmt_execute($stmt)) {
    die("Lỗi thêm sách: " . mysqli_stmt_error($stmt));
}

return true;
}

function updateBook(
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
) {
    global $conn;

    $sql = "UPDATE books SET
                ma_sach = ?,
                ten_sach = ?,
                ma_tac_gia = ?,
                tac_gia = ?,
                danh_muc = ?,
                nha_xuat_ban = ?,
                nam_xuat_ban = ?,
                isbn = ?,
                gia_sach = ?,
                mo_ta = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ssssssisdsi",
        $ma_sach,
        $ten_sach,
        $ma_tac_gia,
        $tac_gia,
        $danh_muc,
        $nha_xuat_ban,
        $nam_xuat_ban,
        $isbn,
        $gia_sach,
        $mo_ta,
        $id
    );

    return mysqli_stmt_execute($stmt);
}


function deleteBook($id)
{
    global $conn;

    $sql = "DELETE FROM books WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $id
    );

    return mysqli_stmt_execute($stmt);
}

function toggleBookStatus($id)
{
    global $conn;

    $sql = "UPDATE books
            SET trang_thai =
                CASE
                    WHEN trang_thai = 'Hoạt động'
                    THEN 'Đã khóa'
                    ELSE 'Hoạt động'
                END
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $id
    );

    return mysqli_stmt_execute($stmt);
}

?>
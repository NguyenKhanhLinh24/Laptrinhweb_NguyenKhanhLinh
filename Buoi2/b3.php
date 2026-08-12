<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bảng Điểm Sinh Viên</title>
    <style>
        /* CSS để trang trí cho bảng đẹp hơn */
        table {
            width: 60%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #333;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .dat { color: green; font-weight: bold; }
        .truot { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h2>Danh Sách Kết Quả Học Tập</h2>

    <?php
    // 1. Tạo mảng đa chiều $students gồm 3 sinh viên
    // Cố tình cho 1 tên chứa thẻ <script> để test thử tính năng mã hóa bảo mật
    $students = [
        ["name" => "Nguyễn Văn A", "midterm" => 7.5, "final" => 8.0],
        ["name" => "Trần Thị B", "midterm" => 4.0, "final" => 9.0],
        ["name" => "Lê Hoàng C", "midterm" => 3.0, "final" => 4.5]
    ];

    // 2. Viết hàm tính điểm trung bình
    function calculateAverage($diem_gk, $diem_ck) {
        $trung_binh = ($diem_gk + $diem_ck) / 2;
        return $trung_binh;
    }
    ?>

    <!-- Bắt đầu vẽ bảng HTML -->
    <table>
        <tr>
            <th>Tên Sinh Viên</th>
            <th>Giữa Kỳ</th>
            <th>Cuối Kỳ</th>
            <th>Điểm TB</th>
            <th>Kết Quả</th>
        </tr>

        <?php
        // 3. Dùng vòng lặp foreach để duyệt qua từng sinh viên trong mảng
        foreach ($students as $sv) {
            
            // Lấy điểm ra và gọi hàm calculateAverage để tính
            $dtb = calculateAverage($sv['midterm'], $sv['final']);
            
            // 4. Kiểm tra điều kiện >= 5
            if ($dtb >= 5) {
                $ket_qua = "<span class='dat'>Đạt</span>";
            } else {
                $ket_qua = "<span class='truot'>Chưa đạt</span>";
            }

            // 5. Mã hóa tên sinh viên bằng htmlspecialchars() trước khi in
            $ten_an_toan = htmlspecialchars($sv['name']);

            // In từng hàng dữ liệu của bảng (thẻ <tr> và <td>)
            echo "<tr>";
                echo "<td>" . $ten_an_toan . "</td>";
                echo "<td>" . $sv['midterm'] . "</td>";
                echo "<td>" . $sv['final'] . "</td>";
                echo "<td>" . $dtb . "</td>";
                echo "<td>" . $ket_qua . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>
</html>

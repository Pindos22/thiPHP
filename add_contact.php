<?php
// Kết nối với cơ sở dữ liệu
include 'db.php';

// Xử lý thêm liên hệ mới
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    if ($name && $phone) {
        // Chuẩn bị và thực thi câu lệnh SQL để thêm liên hệ mới
        $stmt = $pdo->prepare("INSERT INTO contacts (name, phone) VALUES (?, ?)");
        $stmt->execute([$name, $phone]);

        // Chuyển hướng về trang chính sau khi thêm liên hệ
        header('Location: index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Contact</title>
</head>

<body>
    <h1>Add New Contact</h1>

    <!-- Form thêm liên hệ mới -->
    <form method="POST" action="">
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="phone" placeholder="Phone Number" required>
        <button type="submit">Add</button>
    </form>
</body>

</html>
<?php
// Kết nối với cơ sở dữ liệu
include 'db.php';

// Kiểm tra xem có ID liên hệ không
if (!isset($_GET['id'])) {
    echo "Không có ID liên hệ!";
    exit();
}

$id = $_GET['id'];

// Lấy thông tin liên hệ từ cơ sở dữ liệu
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
    $stmt->execute([$id]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$contact) {
        echo "Không tìm thấy liên hệ!";
        exit();
    }
}

// Xử lý cập nhật liên hệ
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    if ($name && $phone) {
        // Chuẩn bị và thực thi câu lệnh SQL để cập nhật liên hệ
        $stmt = $pdo->prepare("UPDATE contacts SET name = ?, phone = ? WHERE id = ?");
        $stmt->execute([$name, $phone, $id]);

        // Chuyển hướng về trang chính sau khi cập nhật
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
    <title>Edit Contact</title>
</head>

<body>
    <h1>Edit Contact</h1>

    <!-- Form chỉnh sửa liên hệ -->
    <form method="POST" action="">
        <input type="text" name="name" value="<?php echo htmlspecialchars($contact['name']); ?>" required>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($contact['phone']); ?>" required>
        <button type="submit">Save</button>
    </form>
</body>

</html>
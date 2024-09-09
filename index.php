<?php
// Kết nối với cơ sở dữ liệu
include 'db.php';

// Xử lý thêm liên hệ mới
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    if ($name && $phone) {
        $stmt = $pdo->prepare("INSERT INTO contacts (name, phone) VALUES (?, ?)");
        $stmt->execute([$name, $phone]);
    }

    header('Location: index.php');
    exit();

}

// Xử lý xóa liên hệ
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ?");
    $stmt->execute([$delete_id]);

    // Chuyển hướng về trang chính sau khi xóa
    header('Location: index.php');
    exit();
}

// Lấy danh sách liên hệ
$stmt = $pdo->query("SELECT * FROM contacts");
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact List</title>
</head>

<body>
    <h1>Contact List</h1>

    <!-- Form thêm liên hệ mới -->
    <form method="POST" action="">
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="phone" placeholder="Phone" required>
        <button type="submit">Add Contact</button>
    </form>

    <h2>Contacts</h2>
    <ul>
        <?php foreach ($contacts as $contact): ?>
            <li>
                <?php echo htmlspecialchars($contact['name']); ?> -
                <?php echo htmlspecialchars($contact['phone']); ?>
                
                <!-- Nút chỉnh sửa -->
                <a href="edit_contact.php?id=<?php echo $contact['id']; ?>">Edit</a>

                <!-- Nút xóa -->
                <a href="?delete_id=<?php echo $contact['id']; ?>"
                    onclick="return confirm('Are you sure you want to delete this contact?');">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>
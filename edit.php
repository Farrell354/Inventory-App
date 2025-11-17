<?php
require 'config.php';

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM items WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if (!$item) {
    echo "Data tidak ditemukan!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $sku = $_POST['sku'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $update = $pdo->prepare("UPDATE items SET name=?, sku=?, quantity=?, price=? WHERE id=?");
    $update->execute([$name, $sku, $quantity, $price, $id]);

    header("Location: index.php?msg=update_success");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #eef1f7;
            font-family: "Segoe UI", sans-serif;
        }

        .navbar {
            background: #2f3e9e;
            padding: 18px 30px;
            color: white;
            font-size: 20px;
            font-weight: bold;
            box-shadow: 0 2px 10px rgba(0,0,0,0.15);
        }

        .container {
            width: 90%;
            max-width: 600px;
            margin: 45px auto;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        .card {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        label {
            font-weight: 600;
            display: block;
            margin-top: 15px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }

        .btn-save {
            width: 100%;
            margin-top: 25px;
            padding: 13px;
            border: none;
            background: #2f3e9e;
            color: white;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-save:hover {
            background: #1f2b6e;
        }

        .back-btn {
            display: block;
            margin-top: 18px;
            text-align: center;
            color: #2f3e9e;
            text-decoration: none;
            font-size: 14px;
        }

        .back-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="navbar">📦 Inventory App</div>

    <div class="container">
        <h2>Edit Data Barang</h2>

        <div class="card">
            <form action="" method="POST">

                <label>Nama Barang</label>
                <input type="text" name="name" value="<?= htmlspecialchars($item['name']); ?>" required>

                <label>SKU</label>
                <input type="text" name="sku" value="<?= htmlspecialchars($item['sku']); ?>" required>

                <label>Jumlah</label>
                <input type="number" name="quantity" value="<?= $item['quantity']; ?>" required>

                <label>Harga</label>
                <input type="number" name="price" value="<?= $item['price']; ?>" required>

                <button class="btn-save">Update Barang</button>
            </form>

            <a href="index.php" class="back-btn">← Kembali</a>
        </div>
    </div>

</body>
</html>

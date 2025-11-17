<?php
require 'config.php';

$stmt = $pdo->query('SELECT * FROM items ORDER BY id DESC');
$items = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Inventory — Daftar Barang</title>

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
            max-width: 1100px;
            margin: 35px auto;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin: 0 0 20px;
            color: #333;
            text-align: center;
            font-size: 28px;
            letter-spacing: 0.5px;
        }

        .btn-primary {
            background: #2f3e9e;
            color: white;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            transition: 0.25s;
        }

        .btn-primary:hover {
            background: #1f2b6e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th {
            background: #2f3e9e;
            color: white;
            padding: 12px;
            font-size: 14px;
            text-align: left;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        tr:hover {
            background: #f6f8fc;
            transition: 0.2s;
        }

        .actions a, .actions button {
            padding: 6px 12px;
            font-size: 12px;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            margin-right: 5px;
            cursor: pointer;
        }

        .edit-btn {
            background: #ffc107;
        }

        .edit-btn:hover { background: #d4a006; }

        .delete-btn {
            background: #e63946;
            border: none;
        }

        .delete-btn:hover { background: #b32430; }

        .empty {
            text-align: center;
            padding: 25px;
            font-size: 15px;
            color: #777;
        }

        /* Footer */
        .footer {
            margin-top: 50px;
            text-align: center;
            color: #666;
            font-size: 13px;
        }
    </style>
</head>

<body>

    <div class="navbar">📦 Inventory App</div>

    <div class="container">
        <div class="card">
            <h1>Daftar Barang</h1>

            <a href="create.php" class="btn-primary">+ Tambah Barang</a>

            <?php if (count($items) > 0): ?>
                <table>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>SKU</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>

                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?= $item['id']; ?></td>
                            <td><?= htmlspecialchars($item['name']); ?></td>
                            <td><?= htmlspecialchars($item['sku']); ?></td>
                            <td><?= $item['quantity']; ?></td>
                            <td>Rp <?= number_format($item['price'], 0, ',', '.'); ?></td>

                            <td class="actions">
                                <a href="edit.php?id=<?= $item['id']; ?>" class="edit-btn">Edit</a>

                                <form action="delete.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $item['id']; ?>">
                                    <button 
                                        onclick="return confirm('Yakin ingin menghapus barang ini?')" 
                                        class="delete-btn">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>

            <?php else: ?>
                <div class="empty">Belum ada data barang 😢</div>
            <?php endif; ?>

        </div>
    </div>

    <div class="footer">
        Inventory System © <?= date("Y"); ?>
    </div>

</body>
</html>

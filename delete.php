<?php
// delete.php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);

    if ($id > 0) {
        $stmt = $pdo->prepare('DELETE FROM items WHERE id = ?');
        $stmt->execute([$id]);
        header('Location: index.php?msg=Barang berhasil dihapus');
        exit;
    }
}

header('Location: index.php?msg=Gagal menghapus');
exit;
?>

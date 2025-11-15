<?php
session_start();

function kiem_tra_quyen($pdo, $id_chuc_nang)
{
    if (!isset($_SESSION['user'])) return false;

    $id_vai_tro = $_SESSION['user']['id_vai_tro'];

    $stmt = $pdo->prepare("
        SELECT * FROM VAITRO_CHUCNANG
        WHERE id_vai_tro = :vt AND id_chuc_nang = :cn AND quyen_truy_cap = 'Có'
    ");

    $stmt->execute([
        ':vt' => $id_vai_tro,
        ':cn' => $id_chuc_nang
    ]);

    return $stmt->fetch() ? true : false;
}

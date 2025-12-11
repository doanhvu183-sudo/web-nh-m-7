<?php 
// LOAD DB
if (!isset($conn)) {
    include_once __DIR__ . "/../includes/db.php";
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?? "Admin Panel"; ?></title>

    <link rel="stylesheet" href="/webnhom7/admin/assets/css/neo_admin.css?v=3001">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<?php include __DIR__ . "/sidebar.php"; ?>

<div class="main-content">
    <?php include __DIR__ . "/header.php"; ?>

    <div class="page-area">
        <?php include $view_file; ?>
    </div>
</div>

<script src="/webnhom7/admin/assets/js/admin.js?v=3001"></script>

</body>
</html>

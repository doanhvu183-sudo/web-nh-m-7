<?php
// layout_admin.php
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? "Quản trị" ?></title>

    <link rel="stylesheet" href="/webnhom7/admin/assets/css/neo_admin.css?v=6001">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- CHART JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <?php include __DIR__ . "/sidebar.php"; ?>

    <main id="mainContent" class="main-content">
        <?php include __DIR__ . "/header.php"; ?>

        <div class="page">
            <?php include $view_file; ?>
        </div>
    </main>

<script>
// SIDEBAR COLLAPSE
document.getElementById("btnSidebar").onclick = () => {
    let sb = document.getElementById("sidebar");
    let mc = document.getElementById("mainContent");

    sb.classList.toggle("collapsed");
    mc.classList.toggle("collapsed");

    localStorage.setItem("sidebar-collapsed", sb.classList.contains("collapsed"));
};

// LOAD SIDEBAR STATE
if (localStorage.getItem("sidebar-collapsed") === "true") {
    document.getElementById("sidebar").classList.add("collapsed");
    document.getElementById("mainContent").classList.add("collapsed");
}

// DARK MODE
document.getElementById("toggleDark").onclick = () => {
    document.body.classList.toggle("dark");
    localStorage.setItem("darkmode", document.body.classList.contains("dark"));
};
if (localStorage.getItem("darkmode") === "true") {
    document.body.classList.add("dark");
}
</script>

</body>
</html>

<?php
include_once __DIR__ . "/../../includes/db.php";

/* KPI */

/* Tổng đơn hàng */
$so_don = $conn->query("SELECT COUNT(*) FROM donhang")->fetchColumn();

/* Tổng doanh thu của đơn đã giao */
$doanh_thu = $conn->query("
    SELECT SUM(tong_tien) 
    FROM donhang 
    WHERE trang_thai='Đã giao'
")->fetchColumn();

/* Tổng khách hàng – Dựa trên số điện thoại (KHÔNG dùng email vì không tồn tại) */
$khach_hang = $conn->query("
    SELECT COUNT(DISTINCT so_dien_thoai_nhan) 
    FROM donhang
")->fetchColumn();

/* Đơn mới hôm nay */
$don_moi = $conn->query("
    SELECT COUNT(*) 
    FROM donhang 
    WHERE DATE(ngay_dat)=CURDATE()
")->fetchColumn();

?>

<div class="dash-wrap">

    <!-- KPI GRID -->
    <div class="kpi-row">

        <div class="kpi-card">
            <div class="kpi-icon icon-blue"><i class="fa-solid fa-file-invoice"></i></div>
            <div>
                <p>Tổng đơn hàng</p>
                <h3><?= number_format($so_don) ?></h3>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon icon-green"><i class="fa-solid fa-dollar-sign"></i></div>
            <div>
                <p>Doanh thu</p>
                <h3><?= number_format($doanh_thu) ?> đ</h3>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon icon-purple"><i class="fa-solid fa-users"></i></div>
            <div>
                <p>Khách hàng</p>
                <h3><?= number_format($khach_hang) ?></h3>
            </div>
        </div>

        <div class="kpi-card">
            <div class="kpi-icon icon-yellow"><i class="fa-solid fa-cart-plus"></i></div>
            <div>
                <p>Đơn mới hôm nay</p>
                <h3><?= number_format($don_moi) ?></h3>
            </div>
        </div>

    </div>

    <!-- 3 BIỂU ĐỒ -->
    <div class="chart-grid-3">
        <div class="chart-card">
            <h4>Đơn hàng 7 ngày</h4>
            <canvas id="chartDon"></canvas>
        </div>

        <div class="chart-card">
            <h4>Doanh thu 7 ngày</h4>
            <canvas id="chartDoanhThu"></canvas>
        </div>

        <div class="chart-card">
            <h4>Tỷ lệ trạng thái đơn</h4>
            <canvas id="chartTrangThai"></canvas>
        </div>
    </div>

    <!-- TOP SẢN PHẨM -->
    <div class="chart-card" style="margin-top:25px;">
        <h4>Top 5 sản phẩm bán chạy</h4>
        <canvas id="chartTopSP"></canvas>
    </div>

    <!-- MINI STAT CARDS -->
    <div class="mini-grid">

        <div class="mini-card">
            <h5>Đơn chờ xác nhận</h5>
            <p><?= $conn->query("SELECT COUNT(*) FROM donhang WHERE trang_thai='Chờ xác nhận'")->fetchColumn(); ?></p>
        </div>

        <div class="mini-card">
            <h5>Đơn đang giao</h5>
            <p><?= $conn->query("SELECT COUNT(*) FROM donhang WHERE trang_thai='Đang giao'")->fetchColumn(); ?></p>
        </div>

        <div class="mini-card">
            <h5>Đã giao (tháng này)</h5>
            <p><?= $conn->query("
                SELECT COUNT(*) 
                FROM donhang 
                WHERE trang_thai='Đã giao' 
                AND MONTH(ngay_dat)=MONTH(NOW())
            ")->fetchColumn(); ?></p>
        </div>

        <div class="mini-card">
            <h5>Đơn bị hủy</h5>
            <p><?= $conn->query("SELECT COUNT(*) FROM donhang WHERE trang_thai='Hủy'")->fetchColumn(); ?></p>
        </div>

    </div>

</div>

<!-- LOAD CHART SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="/webnhom7/admin/assets/js/chart_dashboard.js?v=1001"></script>

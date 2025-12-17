<?php
$title = "Dashboard Premium";
?>

<h2 class="page-title">Tổng quan hệ thống</h2>

<!-- KPI -->
<div class="kpi-row">
    <div class="kpi-card">
        <div class="kpi-title">Tổng đơn hàng</div>
        <div class="kpi-value" id="kpiDon">0</div>
    </div>

    <div class="kpi-card">
        <div class="kpi-title">Doanh thu</div>
        <div class="kpi-value" id="kpiDoanh">0 đ</div>
    </div>

    <div class="kpi-card">
        <div class="kpi-title">Đơn đã giao</div>
        <div class="kpi-value" id="kpiGiao">0</div>
    </div>
</div>

<!-- DASHBOARD GRID -->
<div class="dashboard-grid">

    <!-- CHARTS -->
    <div class="chart-section">

        <div class="chart-box">
            <h3>Đơn hàng theo ngày</h3>
            <canvas id="chartDon"></canvas>
        </div>

        <div class="chart-box">
            <h3>Doanh thu theo ngày</h3>
            <canvas id="chartDoanh"></canvas>
        </div>

        <div class="chart-box">
            <h3>Tỷ lệ trạng thái đơn</h3>
            <canvas id="chartStatus"></canvas>
        </div>

    </div>

    <!-- RECENT ORDERS -->
    <div class="recent-box">
        <h3>Đơn hàng mới nhất</h3>

        <div id="recentList"></div>
    </div>

</div>

<script src="/webnhom7/admin/assets/js/chart_dashboard.js?v=6003"></script>

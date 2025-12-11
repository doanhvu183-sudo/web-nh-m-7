/* =============================
   HÀM FORMAT SỐ & TIỀN
============================= */

function formatNumber(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function formatDate(d) {
    const date = new Date(d);
    return date.getDate() + "/" + (date.getMonth() + 1);
}

/* =============================
   GỌI API LẤY DỮ LIỆU DASHBOARD
============================= */

fetch("/webnhom7/admin/trang_chu/dashboard_data.php")
    .then(res => res.json())
    .then(data => {
        drawOrderChart(data.don);
        drawRevenueChart(data.doanh);
        drawStatusChart(data.status);
        drawTopSP(data.top_sp);
    });

/* =============================
   BIỂU ĐỒ 1 – ĐƠN THEO NGÀY
============================= */

function drawOrderChart(donData) {
    const labels = Object.keys(donData).map(d => formatDate(d));
    const values = Object.values(donData);

    new Chart(document.getElementById("chartDon"), {
        type: "line",
        data: {
            labels: labels,
            datasets: [{
                label: "Số đơn",
                data: values,
                borderColor: "#4f46e5",
                backgroundColor: "rgba(79,70,229,0.2)",
                borderWidth: 3,
                tension: 0.35,
                pointRadius: 4,
                pointBackgroundColor: "#4f46e5"
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
}

/* =============================
   BIỂU ĐỒ 2 – DOANH THU
============================= */

function drawRevenueChart(reData) {
    const labels = Object.keys(reData).map(d => formatDate(d));
    const values = Object.values(reData);

    new Chart(document.getElementById("chartDoanhThu"), {
        type: "bar",
        data: {
            labels: labels,
            datasets: [{
                label: "Doanh thu (đ)",
                data: values,
                backgroundColor: "rgba(16,185,129,0.6)",
                borderColor: "#10b981",
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { 
                y: { 
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return formatNumber(value) + " đ";
                        }
                    }
                }
            }
        }
    });
}

/* =============================
   BIỂU ĐỒ 3 – TỶ LỆ TRẠNG THÁI ĐƠN
============================= */

function drawStatusChart(statusData) {
    const labels = statusData.map(s => s.trang_thai);
    const values = statusData.map(s => s.so_luong);

    const colors = {
        "chờ xác nhận": "#f59e0b",
        "đã xác nhận": "#6366f1",
        "đang giao": "#3b82f6",
        "đã giao": "#10b981",
        "hủy": "#ef4444"
    };

    new Chart(document.getElementById("chartStatus"), {
        type: "doughnut",
        data: {
            labels: labels,
            datasets: [{
                data: values,
                backgroundColor: labels.map(l => colors[l] || "#999")
            }]
        },
        options: {
            plugins: {
                legend: { position: "bottom" }
            }
        }
    });
}

/* =============================
   BIỂU ĐỒ 4 – TOP 5 SẢN PHẨM BÁN CHẠY
============================= */

function drawTopSP(list) {
    new Chart(document.getElementById("chartTopSP"), {
        type: "bar",
        data: {
            labels: list.map(i => i.ten_san_pham),
            datasets: [{
                label: "Số lượng bán",
                data: list.map(i => i.so_luong),
                backgroundColor: "rgba(99,102,241,0.6)",
                borderColor: "#6366f1",
                borderWidth: 2
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
}

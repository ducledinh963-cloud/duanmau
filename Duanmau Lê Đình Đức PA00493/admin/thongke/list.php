<?php
// Trích xuất thống kê doanh thu
$total_orders = $revenue_stats['total_orders'] ?? 0;
$pending_orders = $revenue_stats['pending_orders'] ?? 0;
$shipping_orders = $revenue_stats['shipping_orders'] ?? 0;
$completed_orders = $revenue_stats['completed_orders'] ?? 0;
$canceled_orders = $revenue_stats['canceled_orders'] ?? 0;
$total_revenue = $revenue_stats['total_revenue'] ?? 0;

$revenue_formatted = number_format($total_revenue, 0, ',', '.') . ' ₫';
?>

<!-- Load Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="admin-container">
    <div style="margin-bottom: 25px;">
        <h2 style="font-size: 1.6rem; font-weight: 800; color: var(--dark-color);"><i class="fa-solid fa-square-poll-vertical"></i> BÁO CÁO & THỐNG KÊ DOANH SỐ</h2>
        <p style="color: #64748b; font-size: 0.95rem;">Tổng hợp báo cáo kinh doanh, thống kê sản phẩm và đơn hàng tự động từ cơ sở dữ liệu.</p>
    </div>

    <!-- METRICS CARDS GRID -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <!-- Card 1: Doanh thu -->
        <div style="background: linear-gradient(135deg, #15803d, #16a34a); color: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); display: flex; align-items: center; gap: 15px;">
            <div style="background-color: rgba(255,255,255,0.2); width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="fa-solid fa-coins"></i>
            </div>
            <div>
                <span style="font-size: 0.85rem; font-weight: 500; opacity: 0.9; text-transform: uppercase;">Doanh thu thành công</span>
                <div style="font-size: 1.5rem; font-weight: 800; margin-top: 2px;"><?= $revenue_formatted ?></div>
            </div>
        </div>

        <!-- Card 2: Tổng đơn hàng -->
        <div style="background-color: white; border: 1px solid var(--border-color); padding: 20px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 15px;">
            <div style="background-color: #f0fdf4; color: var(--primary-color); width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; border: 1px solid var(--border-color);">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
            <div>
                <span style="font-size: 0.85rem; font-weight: 600; color: #64748b; text-transform: uppercase;">Tổng số đơn hàng</span>
                <div style="font-size: 1.5rem; font-weight: 800; color: var(--dark-color); margin-top: 2px;"><?= $total_orders ?></div>
            </div>
        </div>

        <!-- Card 3: Đã hoàn thành -->
        <div style="background-color: white; border: 1px solid var(--border-color); padding: 20px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 15px;">
            <div style="background-color: #dcfce7; color: #16a34a; width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; border: 1px solid #bbf7d0;">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div>
                <span style="font-size: 0.85rem; font-weight: 600; color: #64748b; text-transform: uppercase;">Đơn hoàn thành</span>
                <div style="font-size: 1.5rem; font-weight: 800; color: #16a34a; margin-top: 2px;"><?= $completed_orders ?></div>
            </div>
        </div>

        <!-- Card 4: Tổng số khách hàng -->
        <div style="background-color: white; border: 1px solid var(--border-color); padding: 20px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 15px;">
            <div style="background-color: #e0f2fe; color: #0284c7; width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; border: 1px solid #bae6fd;">
                <i class="fa-solid fa-users"></i>
            </div>
            <div>
                <span style="font-size: 0.85rem; font-weight: 600; color: #64748b; text-transform: uppercase;">Tổng khách hàng</span>
                <div style="font-size: 1.5rem; font-weight: 800; color: #0284c7; margin-top: 2px;"><?= $total_customers ?></div>
            </div>
        </div>

        <!-- Card 5: Chờ xử lý / Đang xử lý -->
        <div style="background-color: white; border: 1px solid var(--border-color); padding: 20px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 15px;">
            <div style="background-color: #fef3c7; color: #d97706; width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; border: 1px solid #fde68a;">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
            <div>
                <span style="font-size: 0.85rem; font-weight: 600; color: #64748b; text-transform: uppercase;">Chờ xác nhận</span>
                <div style="font-size: 1.5rem; font-weight: 800; color: #d97706; margin-top: 2px;"><?= $pending_orders ?></div>
            </div>
        </div>
    </div>

    <!-- CHARTS AREA GRID -->
    <div style="display: grid; grid-template-columns: 1fr 1.3fr; gap: 30px; margin-bottom: 40px; flex-wrap: wrap;">
        <!-- Chart 1: Product share -->
        <div class="admin-card" style="margin-bottom: 0;">
            <div class="card-header" style="margin-bottom: 15px;">
                <h3 class="card-title" style="font-size: 1.05rem;"><i class="fa-solid fa-chart-pie"></i> Cơ cấu sản phẩm theo danh mục</h3>
            </div>
            <div style="width: 100%; height: 320px; display: flex; justify-content: center; align-items: center;">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>

        <!-- Chart 2: Prices boundaries -->
        <div class="admin-card" style="margin-bottom: 0;">
            <div class="card-header" style="margin-bottom: 15px;">
                <h3 class="card-title" style="font-size: 1.05rem;"><i class="fa-solid fa-chart-bar"></i> Phân khúc giá sản phẩm theo danh mục</h3>
            </div>
            <div style="width: 100%; height: 320px;">
                <canvas id="priceChart"></canvas>
            </div>
        </div>
    </div>

    <!-- TABLES AREA -->
    <div style="display: flex; flex-direction: column; gap: 30px; margin-top: 30px;">
        <!-- Table 1: Category stats -->
        <div class="admin-card" style="margin-bottom: 0;">
            <div class="card-header">
                <h3 class="card-title"><i class="fa-solid fa-table-list"></i> BẢNG THỐNG KÊ SẢN PHẨM THEO DANH MỤC</h3>
            </div>
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th style="width: 100px; text-align: center;">Mã DM</th>
                            <th>Tên danh mục</th>
                            <th style="text-align: center; width: 150px;">Số sản phẩm</th>
                            <th style="text-align: right; width: 180px;">Giá thấp nhất</th>
                            <th style="text-align: right; width: 180px;">Giá cao nhất</th>
                            <th style="text-align: right; width: 180px;">Giá trung bình</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_sp = 0;
                        if (isset($listthongke) && is_array($listthongke) && count($listthongke) > 0) {
                            foreach ($listthongke as $tk) {
                                extract($tk);
                                $total_sp += $countsp;
                                $min_formatted = number_format($minprice, 0, ',', '.') . ' ₫';
                                $max_formatted = number_format($maxprice, 0, ',', '.') . ' ₫';
                                $avg_formatted = number_format($avgprice, 0, ',', '.') . ' ₫';
                                ?>
                                <tr>
                                    <td style="text-align: center; font-weight: 600; color: var(--primary-color);">DM-<?= $iddm ?></td>
                                    <td style="font-weight: 700; color: var(--dark-color);"><?= htmlspecialchars($tendm) ?></td>
                                    <td style="text-align: center; font-weight: 700; color: #1e293b;"><?= $countsp ?></td>
                                    <td style="text-align: right; font-weight: 500; color: #059669;"><?= $min_formatted ?></td>
                                    <td style="text-align: right; font-weight: 700; color: #b91c1c;"><?= $max_formatted ?></td>
                                    <td style="text-align: right; font-weight: 600; color: #4b5563;"><?= $avg_formatted ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo '<tr><td colspan="6" style="text-align: center; color: #64748b; padding: 20px;">Không có dữ liệu thống kê sản phẩm.</td></tr>';
                        }
                        ?>
                        <!-- Tổng cộng -->
                        <tr style="background-color: #f8fafc; font-weight: 700; border-top: 2px solid var(--border-color);">
                            <td colspan="2" style="text-align: right; padding: 16px;">TỔNG CỘNG:</td>
                            <td style="text-align: center; padding: 16px; font-size: 1.1rem; color: var(--primary-hover);"><?= $total_sp ?> sản phẩm</td>
                            <td colspan="3" style="background-color: #f8fafc;"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Table Grid for Top Selling & Order Status -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 30px; margin-bottom: 20px;">
            <!-- Table 2: Top Selling Products -->
            <div class="admin-card" style="margin-bottom: 0;">
                <div class="card-header">
                    <h3 class="card-title" style="color: #15803d;"><i class="fa-solid fa-fire" style="color: #ea580c;"></i> TOP 5 SẢN PHẨM BÁN CHẠY NHẤT</h3>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th style="text-align: center; width: 100px;">Đã bán</th>
                                <th style="text-align: right; width: 150px;">Doanh thu mang lại</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($top_selling) && is_array($top_selling) && count($top_selling) > 0) {
                                foreach ($top_selling as $ts) {
                                    $rev_ts_formatted = number_format($ts['revenue'], 0, ',', '.') . ' ₫';
                                    ?>
                                    <tr>
                                        <td style="font-weight: 700; color: var(--dark-color); font-size: 0.9rem;"><?= htmlspecialchars($ts['product_name']) ?></td>
                                        <td style="text-align: center; font-weight: 700; color: var(--primary-color); font-size: 1.05rem;"><?= $ts['quantity_sold'] ?></td>
                                        <td style="text-align: right; font-weight: 700; color: #059669; font-size: 0.9rem;"><?= $rev_ts_formatted ?></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo '<tr><td colspan="3" style="text-align: center; color: #64748b; padding: 20px;">Chưa ghi nhận sản phẩm bán chạy (Cần đơn hàng Đã hoàn thành).</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Table 3: Order status stats -->
            <div class="admin-card" style="margin-bottom: 0;">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa-solid fa-truck-fast"></i> BẢNG THỐNG KÊ TRẠNG THÁI ĐƠN HÀNG</h3>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Trạng thái đơn hàng</th>
                                <th style="text-align: center; width: 100px;">Số lượng</th>
                                <th style="text-align: center; width: 100px;">Tỷ lệ</th>
                                <th style="text-align: right; width: 150px;">Giá trị tương ứng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $percentage_pending = $total_orders > 0 ? round(($pending_orders / $total_orders) * 100, 1) : 0;
                            $percentage_shipping = $total_orders > 0 ? round(($shipping_orders / $total_orders) * 100, 1) : 0;
                            $percentage_completed = $total_orders > 0 ? round(($completed_orders / $total_orders) * 100, 1) : 0;
                            $percentage_canceled = $total_orders > 0 ? round(($canceled_orders / $total_orders) * 100, 1) : 0;
                            ?>
                            <tr>
                                <td style="font-weight: 600; color: #d97706; font-size: 0.9rem;"><i class="fa-solid fa-hourglass-start"></i> Chờ xác nhận</td>
                                <td style="text-align: center; font-weight: 700;"><?= $pending_orders ?></td>
                                <td style="text-align: center; font-weight: 600;"><?= $percentage_pending ?>%</td>
                                <td style="text-align: right; color: #64748b; font-style: italic; font-size: 0.85rem;">Chưa ghi nhận</td>
                            </tr>
                            <tr>
                                <td style="font-weight: 600; color: #0284c7; font-size: 0.9rem;"><i class="fa-solid fa-truck-ramp-box"></i> Đang giao hàng</td>
                                <td style="text-align: center; font-weight: 700;"><?= $shipping_orders ?></td>
                                <td style="text-align: center; font-weight: 600;"><?= $percentage_shipping ?>%</td>
                                <td style="text-align: right; color: #64748b; font-style: italic; font-size: 0.85rem;">Chưa ghi nhận</td>
                            </tr>
                            <tr style="background-color: #f0fdf4;">
                                <td style="font-weight: 700; color: #16a34a; font-size: 0.9rem;"><i class="fa-solid fa-circle-check"></i> Đã hoàn thành</td>
                                <td style="text-align: center; font-weight: 700; color: #16a34a;"><?= $completed_orders ?></td>
                                <td style="text-align: center; font-weight: 700; color: #16a34a;"><?= $percentage_completed ?>%</td>
                                <td style="text-align: right; font-weight: 800; color: #16a34a; font-size: 0.9rem;"><?= $revenue_formatted ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: 600; color: #dc2626; font-size: 0.9rem;"><i class="fa-solid fa-ban"></i> Đã hủy</td>
                                <td style="text-align: center; font-weight: 700;"><?= $canceled_orders ?></td>
                                <td style="text-align: center; font-weight: 600;"><?= $percentage_canceled ?>%</td>
                                <td style="text-align: right; color: #dc2626; font-weight: 500; font-size: 0.9rem;">0 ₫</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Render dynamic charts -->
<script>
    // 1. Dữ liệu Thống kê Cơ cấu sản phẩm theo danh mục (Doughnut Chart)
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    
    const categoryLabels = [
        <?php
        foreach ($listthongke as $tk) {
            echo "'" . addslashes($tk['tendm']) . "',";
        }
        ?>
    ];
    
    const categoryData = [
        <?php
        foreach ($listthongke as $tk) {
            echo $tk['countsp'] . ",";
        }
        ?>
    ];

    new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
            labels: categoryLabels,
            datasets: [{
                data: categoryData,
                backgroundColor: [
                    '#10b981', // emerald
                    '#f59e0b', // amber
                    '#ef4444', // red
                    '#3b82f6', // blue
                    '#8b5cf6', // violet
                    '#ec4899'  // pink
                ],
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12,
                        padding: 15,
                        font: {
                            family: "'Outfit', sans-serif",
                            size: 11
                        }
                    }
                }
            }
        }
    });

    // 2. Dữ liệu Thống kê Phân khúc giá sản phẩm (Grouped Bar Chart)
    const priceCtx = document.getElementById('priceChart').getContext('2d');
    
    const minPrices = [
        <?php
        foreach ($listthongke as $tk) {
            echo $tk['minprice'] . ",";
        }
        ?>
    ];
    
    const maxPrices = [
        <?php
        foreach ($listthongke as $tk) {
            echo $tk['maxprice'] . ",";
        }
        ?>
    ];
    
    const avgPrices = [
        <?php
        foreach ($listthongke as $tk) {
            echo round($tk['avgprice']) . ",";
        }
        ?>
    ];

    new Chart(priceCtx, {
        type: 'bar',
        data: {
            labels: categoryLabels,
            datasets: [
                {
                    label: 'Giá thấp nhất',
                    data: minPrices,
                    backgroundColor: '#10b981',
                    borderRadius: 4
                },
                {
                    label: 'Giá trung bình',
                    data: avgPrices,
                    backgroundColor: '#6b7280',
                    borderRadius: 4
                },
                {
                    label: 'Giá cao nhất',
                    data: maxPrices,
                    backgroundColor: '#ef4444',
                    borderRadius: 4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        boxWidth: 12,
                        font: {
                            family: "'Outfit', sans-serif",
                            size: 11
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString('vi-VN') + ' ₫';
                        },
                        font: {
                            family: "'Outfit', sans-serif",
                            size: 10
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            family: "'Outfit', sans-serif",
                            size: 10
                        }
                    }
                }
            }
        }
    });
</script>

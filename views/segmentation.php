<?php

$this->title = 'Сегментация данных';
?>

<div class="container mt-5">
    <h1 class="text-center"><?= $this->title ?></h1>
    <p class="lead text-center">Сегментация клиентов для оптимизации маркетинговых усилий.</p>

    <!-- Сегментация по возрасту -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title">Сегментация по возрасту</h4>
        </div>
        <div class="card-body">
            <canvas id="ageSegmentationChart" class="chart-canvas"></canvas>
        </div>
    </div>

    <!-- Таблица с результатами сегментации -->
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title">Результаты сегментации</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Возрастная группа</th>
                    <th>Количество клиентов</th>
                    <th>Процент от общей базы</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>18-24</td>
                    <td>250</td>
                    <td>25%</td>
                </tr>
                <tr>
                    <td>25-34</td>
                    <td>300</td>
                    <td>30%</td>
                </tr>
                <tr>
                    <td>35-44</td>
                    <td>200</td>
                    <td>20%</td>
                </tr>
                <tr>
                    <td>45+</td>
                    <td>250</td>
                    <td>25%</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- График сегментации по доходу -->
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title">Сегментация по доходу</h4>
        </div>
        <div class="card-body">
            <canvas id="incomeSegmentationChart" class="chart-canvas"></canvas>
        </div>
    </div>
</div>

<script>

    // График сегментации по возрасту
    var ctx1 = document.getElementById('ageSegmentationChart').getContext('2d');
    var ageSegmentationChart = new Chart(ctx1, {
        type: 'pie',
        data: {
            labels: ['18-24', '25-34', '35-44', '45+'],
            datasets: [{
                data: [250, 300, 200, 250],
                backgroundColor: ['#ff6384', '#36a2eb', '#ffcd56', '#4bc0c0'],
                borderColor: ['#fff', '#fff', '#fff', '#fff'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            aspectRatio: 2, // Уменьшаем размер графика


            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function (tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw + ' клиентов';
                        }
                    }
                }
            }
        }
    });

    // График сегментации по доходу
    var ctx2 = document.getElementById('incomeSegmentationChart').getContext('2d');
    var incomeSegmentationChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['До 50k', '50k-100k', '100k-150k', '150k+'],
            datasets: [{
                label: 'Количество клиентов',
                data: [150, 250, 200, 150],
                backgroundColor: '#36a2eb',
                borderColor: '#fff',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            aspectRatio: 1.5, // Уменьшаем размер графика
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Количество клиентов'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Доходные группы'
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                },
            }
        }
    });
</script>



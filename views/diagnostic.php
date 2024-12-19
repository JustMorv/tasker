<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Анализ клиентской базы</title>
    <!-- Подключаем Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>

        body {
            overflow-x: hidden; /* Убираем горизонтальный скролл на странице */
        }

        .container {
            width: 100%;
            max-width: 1200px; /* Ограничиваем максимальную ширину контейнера */
            margin: 0 auto; /* Центрируем контейнер */
            padding: 0 15px; /* Добавляем отступы по бокам */
        }

        .chart-canvas {
            width: 100% !important; /* Графики занимают 100% ширины контейнера */
            height: auto !important; /* Высота графиков автоматически подстраивается */
            max-width: 100%; /* Ограничиваем максимальную ширину 100% */
        }

        .card {
            margin-bottom: 30px; /* Добавляем отступы между картами */
        }

    </style>
</head>
<body>
<h1 class="text-center ">Анализ клиентской базы</h1>
<div class="container ">

    <!-- График распределения клиентов по возрасту -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title">Распределение клиентов по возрасту</h4>
        </div>
        <div class="card-body">
            <canvas id="ageDistributionChart" class="chart-canvas"></canvas>
        </div>
    </div>

    <!-- Таблица статистики по клиентам -->
    <div class="card shadow-sm " >
        <div class="card-header bg-primary text-white">
            <h4 class="card-title">Статистика по клиентам</h4>
        </div>
        <div class="card-body" style="overflow: scroll">
            <table class="table table-bordered table-striped" >
                <thead>
                <tr>
                    <th>ФИО</th>
                    <th>Возраст</th>
                    <th>Доход</th>
                    <th>Частота покупок</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Иванов Иван Иванович</td>
                    <td>30</td>
                    <td>75,000</td>
                    <td>10</td>
                </tr>
                <tr>
                    <td>Петров Петр Петрович</td>
                    <td>45</td>
                    <td>100,000</td>
                    <td>7</td>
                </tr>
                <tr>
                    <td>Сидоров Сидор Сидорович</td>
                    <td>23</td>
                    <td>50,000</td>
                    <td>5</td>
                </tr>
                <tr>
                    <td>Михайлов Михаил Михайлович</td>
                    <td>35</td>
                    <td>120,000</td>
                    <td>15</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- График по доходу клиентов -->
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title">Распределение клиентов по доходу</h4>
        </div>
        <div class="card-body">
            <canvas id="incomeDistributionChart" class="chart-canvas"></canvas>
        </div>
    </div>
</div>

<script>
    // График распределения клиентов по возрасту
    var ctx1 = document.getElementById('ageDistributionChart').getContext('2d');
    var ageDistributionChart = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['18-24', '25-34', '35-44', '45+'],
            datasets: [{
                label: 'Количество клиентов',
                data: [150, 250, 300, 200],
                backgroundColor: '#36a2eb',
                borderColor: '#fff',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
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
                        text: 'Возрастные группы'
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

    // График распределения клиентов по доходу
    var ctx2 = document.getElementById('incomeDistributionChart').getContext('2d');
    var incomeDistributionChart = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: ['До 50k', '50k-100k', '100k-150k', '150k+'],
            datasets: [{
                data: [100, 200, 150, 50],
                backgroundColor: ['#ff6384', '#36a2eb', '#ffcd56', '#4bc0c0'],
                borderColor: ['#fff', '#fff', '#fff', '#fff'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw + ' клиентов';
                        }
                    }
                }
            }
        }
    });
</script>

<!-- Подключаем Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

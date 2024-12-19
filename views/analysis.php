<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Анализ клиентской базы</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style.css"> <!-- Подключаем ваш стиль -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Обнуляем отступы и паддинги */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            overflow-x: hidden; /* Убираем горизонтальный скролл на странице */
        }


        .row {
            margin-left: -15px;
            margin-right: -15px;
        }

        .col-md-6 {
            padding-left: 15px;
            padding-right: 15px;
        }

        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center mt-4">Анализ клиентской базы</h1>
    <!-- Таблица статистики по клиентам -->
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title">Статистика по ролям</h4>
        </div>
        <div class="card-body" style="overflow: scroll">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>№</th>
                    <th>Имя пользователя</th>
                    <th>Электронная почта</th>
                    <th>Роль</th>
                    <th>Дата регистрации</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Иван Иванов</td>
                    <td>ivanov@example.com</td>
                    <td>Администратор</td>
                    <td>2024-01-01</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Мария Петрова</td>
                    <td>petrova@example.com</td>
                    <td>Пользователь</td>
                    <td>2024-02-15</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Алексей Сидоров</td>
                    <td>sidorov@example.com</td>
                    <td>Учитель</td>
                    <td>2024-03-10</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Наталья Иванова</td>
                    <td>ivanova@example.com</td>
                    <td>Студент</td>
                    <td>2024-04-20</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Ряд для отображения других графиков в карточках -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title">Линейный график клиентов</h4>
                </div>
                <div class="card-body">
                    <canvas id="lineChart"></canvas> <!-- Место для линейного графика -->
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title">Распределение ролей</h4>
                </div>
                <div class="card-body">
                    <canvas id="doughnutChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Сценарии для графиков -->
<script>



    // Данные для линейного графика
    var lineChartData = {
        labels: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль'],
        datasets: [{
            label: 'Количество клиентов',
            borderColor: '#4e73df',
            data: [65, 59, 80, 81, 56, 55, 40],
            fill: false,
        }]
    };

    // Конфигурация для линейного графика
    var lineChartConfig = {
        type: 'line',
        data: lineChartData,
        aspectRatio: 5, // Уменьшаем размер графика
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            },
        }
    };

    // Данные для пончик-графика
    var doughnutChartData = {
        labels: ['Администратор', 'Пользователь', 'Учитель', 'Студент'],
        datasets: [{
            label: 'Распределение ролей',
            data: [300, 50, 100, 80],
            backgroundColor: ['#ff5733', '#33ff57', '#3357ff', '#ff33a1'],
            hoverOffset: 4
        }]
    };

    // Конфигурация для пончик-графика
    var doughnutChartConfig = {
        type: 'doughnut',
        data: doughnutChartData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            },
        }
    };

    // Отображение линейного графика
    var ctxLine = document.getElementById('lineChart').getContext('2d');
    new Chart(ctxLine, lineChartConfig);

    // Отображение пончик-графика
    var ctxDoughnut = document.getElementById('doughnutChart').getContext('2d');
    new Chart(ctxDoughnut, doughnutChartConfig);
</script>

<!-- Подключаем Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

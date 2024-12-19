<?php

class PredictiveView 
{
    /**
     * Метод для отображения страницы предсказательного анализа.
     *
     * @param array $predictions Данные предсказаний (месяцы и значения)
     */
    public function render($predictions)
    {
        ?>
        <!DOCTYPE html>
        <html lang="ru">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Предсказательный анализ</title>
            <link rel="stylesheet" href="/assets/styles.css">
            <style>
                .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
                .chart-container { width: 100%; height: 400px; }
                .table-container { margin-top: 20px; }
                table { width: 100%; border-collapse: collapse; }
                th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
                th { background-color: #f4f4f4; }
            </style>
        </head>
        <body>

        <div class="container">
            <h1>Предсказательный анализ</h1>

            <!-- График -->
            <div class="chart-container">
                <canvas id="predictionChart"></canvas>
            </div>

            <!-- Таблица с данными -->
            <div class="table-container">
                <h2>Данные предсказаний</h2>
                <table>
                    <tr>
                        <th>Месяц</th>
                        <th>Значение</th>
                    </tr>
                    <?php foreach ($predictions['months'] as $index => $month) : ?>
                        <tr>
                            <td><?= $month ?></td>
                            <td><?= $predictions['values'][$index] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>

        <script src="/assets/chart.min.js"></script>
        <script>
            var ctx = document.getElementById('predictionChart').getContext('2d');
            var predictionChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?= json_encode($predictions['months']) ?>,
                    datasets: [{
                        label: 'Предсказанные значения',
                        data: <?= json_encode($predictions['values']) ?>,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'top' }
                    }
                }
            });
        </script>

        </body>
        </html>
        <?php
    }
}

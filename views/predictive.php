<?php


$title = 'Предсказательный анализ';
?>

<div class="container mt-5">
    <h1 class="text-center"><?= $title ?></h1>
    <p class="lead text-center">Предсказания для клиентов на основе анализа данных.</p>

    <!-- Таблица с возможностями анализа -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title">Возможности анализа</h4>
        </div>
        <div class="card-body" style="overflow: scroll">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Анализ</th>
                    <th>Возможности</th>
                    <th>Статус</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Предсказание трендов</td>
                    <td>Можно ли предсказать тренды на основе текущих данных</td>
                    <td><span class="badge bg-success">Возможно</span></td>
                </tr>
                <tr>
                    <td>Предсказание покупок</td>
                    <td>Предсказание покупок на основе предыдущего поведения клиентов</td>
                    <td><span class="badge bg-warning">Частично возможно</span></td>
                </tr>
                <tr>
                    <td>Сегментация клиентов</td>
                    <td>Разделение клиентов на группы для улучшения таргетинга</td>
                    <td><span class="badge bg-success">Возможно</span></td>
                </tr>
                <tr>
                    <td>Персонализация предложений</td>
                    <td>Адаптация предложения для клиента на основе его данных</td>
                    <td><span class="badge bg-success">Возможно</span></td>
                </tr>
                <tr>
                    <td>Автоматизация рассылок</td>
                    <td>Отправка автоматических сообщений на основе анализа данных</td>
                    <td><span class="badge bg-danger">Не возможно</span></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- График предсказаний -->
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title">Предсказание трендов</h4>
        </div>
        <div class="card-body">
            <canvas id="predictionChart"></canvas>
        </div>
    </div>
</div>
<script>


    var ctx = document.getElementById('predictionChart').getContext('2d');
    var predictionChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Предсказанные значения',
                data: [10, 20, 15, 25, 30, 35, 40],
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: false,
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Месяцы'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Значения'
                    }
                }
            }
        }
    });
</script>

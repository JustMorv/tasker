<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление задачами</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">

    <h1>Управление задачами</h1>
    <?php if ($user && $user['role'] === 'admin'): ?>
        <a href="/task/create" class=" btn btn-success mb-2">Создать задачу</a><br>
    <?php endif; ?>
    <div class="card-body" style="overflow: scroll">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Заголовок</th>
                <th>Описание</th>
                <th>Дата начала</th>
                <th>Дата окончания</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($tasks)): ?>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= htmlspecialchars($task['id']) ?></td>
                        <td><?= htmlspecialchars($task['title']) ?></td>
                        <td><?= htmlspecialchars($task['description']) ?></td>
                        <td><?= htmlspecialchars($task['start_time']) ?></td>
                        <td><?= htmlspecialchars($task['end_time']) ?></td>
                        <td>
                            <a href="/task/editTask/<?= $task['id'] ?>" class="btn btn-warning btn-sm">Редактировать</a>
                            <?php if ($user && $user['role'] === 'admin'): ?>
                                <a href="/task/deleteTask/<?= $task['id'] ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Вы уверены, что хотите удалить задачу <?= htmlspecialchars($task['title']) ?>?')">
                                    Удалить
                                </a>
                            <?php endif; ?>

                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Задачи не найдены.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

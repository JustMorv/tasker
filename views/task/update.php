<?php
// views/task/update.php
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование задачи</title>
</head>
<body>
<h1>Редактирование задачи</h1>
<form action="" method="post">
    <div>
        <label for="title">Заголовок</label>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($task['title']) ?>" required>
    </div>
    <div>
        <label for="description">Описание</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($task['description']) ?></textarea>
    </div>
    <div>
        <label for="status">Статус</label>
        <select name="status" id="status">
            <option value="начало" <?= $task['status'] == 'начало' ? 'selected' : '' ?>>Начало</option>
            <option value="в процессе" <?= $task['status'] == 'в процессе' ? 'selected' : '' ?>>В процессе</option>
            <option value="окончание" <?= $task['status'] == 'окончание' ? 'selected' : '' ?>>Окончание</option>
            <option value="завершено" <?= $task['status'] == 'завершено' ? 'selected' : '' ?>>Завершено</option>
        </select>
    </div>
    <div>
        <label for="start_time">Время начала</label>
        <input type="datetime-local" id="start_time" name="start_time" value="<?= $task['start_time'] ?>">
    </div>
    <div>
        <label for="end_time">Время окончания</label>
        <input type="datetime-local" id="end_time" name="end_time" value="<?= $task['end_time'] ?>">
    </div>
    <button type="submit">Сохранить изменения</button>
</form>
</body>
</html>

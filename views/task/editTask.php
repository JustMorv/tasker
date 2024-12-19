<!-- views/editTask.php -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать задачу</title>
    <link rel="stylesheet" href="../../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1>Редактирование задачи</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($task['title']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control" id="description" name="description" required><?= htmlspecialchars($task['description']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Статус</label>
            <select class="form-select" id="status" name="status" required>
                <option value="начало" <?= $task['status'] === 'начало' ? 'selected' : '' ?>>Начало</option>
                <option value="в процессе" <?= $task['status'] === 'в процессе' ? 'selected' : '' ?>>В процессе</option>
                <option value="окончание" <?= $task['status'] === 'окончание' ? 'selected' : '' ?>>Окончание</option>
                <option value="завершено" <?= $task['status'] === 'завершено' ? 'selected' : '' ?>>Завершено</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="start_time" class="form-label">Дата начала</label>
            <input type="datetime-local" class="form-control" id="start_time" name="start_time" value="<?= $task['start_time'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="end_time" class="form-label">Дата окончания</label>
            <input type="datetime-local" class="form-control" id="end_time" name="end_time" value="<?= $task['end_time'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Обновить задачу</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

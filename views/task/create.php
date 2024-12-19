<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание задачи</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Создание задачи</h1>
    <form action="/task/create" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Заголовок</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">Дата начала</label>
            <input type="datetime-local" id="start_time" name="start_time" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">Дата окончания</label>
            <input type="datetime-local" id="end_time" name="end_time" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Статус</label>
            <select id="status" name="status" class="form-select" required>
                <option value="начало">Начало</option>
                <option value="в процессе">В процессе</option>
                <option value="окончание">Окончание</option>
                <option value="завершено">Завершено</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Создать задачу</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

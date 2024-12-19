<!-- createMailing.php -->
<div class="container mt-4">
    <h1 class="mb-4">Создать новую рассылку</h1>

    <form method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Название рассылки:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Содержимое рассылки:</label>
            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Создать рассылку</button>
    </form>
</div>

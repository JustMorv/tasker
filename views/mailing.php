<!-- mailing.php -->
<div class="container mt-4">
    <h1 class="mb-4">Рассылки</h1>

    <?php if ($_SESSION['role'] === 'admin'): ?>
        <a href="/site/createMailing" class="btn btn-success mb-3">Создать новую рассылку</a>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Название</th>
            <th scope="col">Создано</th>
            <th scope="col">Создал</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($mailings as $mailing): ?>
            <tr>
                <td><?= htmlspecialchars($mailing['title']) ?></td>
                <td><?= htmlspecialchars($mailing['created_at']) ?></td>
                <td><?= htmlspecialchars($mailing['username']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

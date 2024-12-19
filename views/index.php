
<h1>Добро пожаловать в систему JustSchool</h1>

<p>Это главная страница системы управления клиентами и учениками.</p>
<p>Пожалуйста, используйте навигацию слева для перехода по разделам.</p>

<?php if (isset($_SESSION['user_id'])): ?>
    <p>Добро пожаловать, <?= htmlspecialchars($_SESSION['username']); ?>!</p>
    <p>Ваша роль: <?= htmlspecialchars($_SESSION['role']); ?></p>
<?php else: ?>
    <p>Вы не авторизованы. Пожалуйста, <a href="/site/login">войдите</a> для доступа к системе.</p>
<?php endif; ?>
<pre>
<?=print_r($_SESSION['user_id'])?>
</pre>
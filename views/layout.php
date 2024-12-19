<?php
require_once __DIR__ . '/../models/UserModel.php';
$userModel = new UserModel();
$user = $userModel->getLoggedInUser(); // Получаем текущего авторизованного пользователя
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Информационная система</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<header class="header">
    <div class="navbar p-4">
        <a href="/site/index" class="logo">JustSchool</a>

        <div class="links">
            <?php if ($user): ?>
             <div class="d-block">
                 <span class="user-info"><?= htmlspecialchars($user['username']); ?>!</span>
                 <a href="/site/logout" class="btn-logout">Выйти</a>
             </div>
            <?php else: ?>
                <a href="/site/login">Вход</a>
                <a href="/site/register">Регистрация</a>
            <?php endif; ?>
        </div>
    </div>
</header>
<div class="container">

    <!-- Шапка сайта -->

    <button class="sidebar-toggle" style="position: sticky" onclick="toggleSidebar()"> > </button>

    <aside class="sidebar">
        <ul class="nav">
            <li><a href="/site/personalization">Персонализация</a></li>
            <li><a href="/task/index">задачи</a></li>
            <?php if ($user && $user['role'] === 'admin'): ?>
                <li><a href="/site/analysis">Анализ клиентской базы</a></li>
                <li><a href="/site/diagnostic">Диагностический анализ</a></li>
                <li><a href="/site/predictive">Предсказательный анализ</a></li>
                <li><a href="/site/segmentation">Сегментация данных</a></li>
                <li><a href="/site/mailing">Автоматизированная рассылка</a></li>
                <li><a href="/site/manageUsers">Управление пользователями</a></li>
            <?php endif; ?>
        </ul>
    </aside>


    <!-- Контент -->
    <main class="content">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Функция для переключения sidebar
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const body = document.body;

            sidebar.classList.toggle('open'); // Переключаем класс "open"

            if (sidebar.classList.contains('open')) {
                body.classList.add('no-scroll'); // Запрещаем скролл
            } else {
                body.classList.remove('no-scroll'); // Включаем скролл обратно
            }
        }

    </script>

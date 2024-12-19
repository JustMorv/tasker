<?php
// Подключение модели UserProfileModel
require_once __DIR__ . '/../models/UserProfileModel.php';


// Проверяем авторизацию пользователя
if (!isset($_SESSION['user_id'])) {
    header('Location: /login.php');
    exit;
}

$userId = $_SESSION['user_id'];
$profileModel = new UserProfileModel();

// Если форма отправлена
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $dateOfBirth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $additionalInfo = $_POST['additional_info'];

    // Собираем данные в массив
    $data = [
        'first_name' => $firstName,
        'last_name' => $lastName,
        'date_of_birth' => $dateOfBirth,
        'gender' => $gender,
        'additional_info' => $additionalInfo
    ];

    // Сохраняем данные профиля
    $profileModel->saveProfile($userId, $data);

    // Перенаправляем для предотвращения повторной отправки формы
    header('Location: /site/personalization');
    exit;
}

// Получаем данные профиля для отображения
$profile = $profileModel->getProfileByUserId($userId);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Персонализация профиля</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<div class="container">
    <h1>Персонализация профиля</h1>
    <form action="" method="post" class="profile-form">
        <div class="form-group">
            <label for="first_name">Имя:</label>
            <input type="text" id="first_name" name="first_name"
                   value="<?= htmlspecialchars($profile['first_name'] ?? '') ?>"
                   required>
        </div>

        <div class="form-group">
            <label for="last_name">Фамилия:</label>
            <input type="text" id="last_name" name="last_name"
                   value="<?= htmlspecialchars($profile['last_name'] ?? '') ?>"
                   required>
        </div>

        <div class="form-group">
            <label for="date_of_birth">Дата рождения:</label>
            <input type="date" id="date_of_birth" name="date_of_birth"
                   value="<?= htmlspecialchars($profile['date_of_birth'] ?? '') ?>"
                   required>
        </div>

        <div class="form-group">
            <label for="gender">Пол:</label>
            <select id="gender" name="gender" required>
                <option value="male" <?= isset($profile['gender']) && $profile['gender'] === 'male' ? 'selected' : '' ?>>Мужской</option>
                <option value="female" <?= isset($profile['gender']) && $profile['gender'] === 'female' ? 'selected' : '' ?>>Женский</option>
                <option value="other" <?= isset($profile['gender']) && $profile['gender'] === 'other' ? 'selected' : '' ?>>Другой</option>
            </select>
        </div>

        <div class="form-group">
            <label for="additional_info">Дополнительная информация:</label>
            <textarea id="additional_info" name="additional_info"><?= htmlspecialchars($profile['additional_info'] ?? '') ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
</div>
<style>

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    input[type="text"], input[type="date"], select, textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }

    textarea {
        height: 100px;
        resize: none;
    }

    button {
        display: block;
        width: 100%;
        padding: 10px;
        font-size: 16px;
        background-color: #3498db;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #2980b9;
    }
</style>
</body>
</html>

<?php
require_once __DIR__ . '/../components/Database.php';
require_once __DIR__ . '/../models/UserModel.php';

class SiteController
{
    private $db;
    private $userModel; // Добавляем свойство для модели

    public function __construct()
    {
        // Получаем подключение к базе данных
        $this->db = (new Database())->getConnection();
        $this->userModel = new UserModel(); // Создаем объект модели

    }

    public function index()
    {
        // Стартуем сессию

        // Проверяем, авторизован ли пользователь
        if ($this->isLoggedIn()) {
            $this->renderView('index');
        } else {
            // Если не авторизован, перенаправляем на страницу входа
            header('Location: /site/login');
            exit();
        }
    }

    public function settings()
    {
        // Стартуем сессию

        if ($this->isLoggedIn()) {
            $this->renderView('settings');
        } else {
            header('Location: /site/login');
            exit();
        }
    }

    public function login()
    {
        if ($this->isLoggedIn()  ) {
            header('Location: /site/index');
            exit();
        }


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            // Пытаемся авторизовать пользователя
            if ($this->loginUser($email, $password)) {
                // Если авторизация успешна, перенаправляем на главную
                header('Location: /site/index');
                exit();
            } else {
                // Если ошибка, выводим сообщение
                echo 'Неверный email или пароль';
            }
        }

        $this->renderView('login');
    }

    public function register()
    {
        if ($this->isLoggedIn()  ) {
            header('Location: /site/index');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = isset($_POST['username']) ? $_POST['username'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $role = 'user'; // Роль по умолчанию

            // Регистрируем пользователя
            if ($this->registerUser($username, $email, $password, $role)) {
                // Перенаправляем на страницу входа после успешной регистрации
                header('Location: /site/login');
                exit();
            } else {
                // Если ошибка, выводим сообщение
                echo 'Ошибка при регистрации пользователя';
            }
        }

        $this->renderView('register');
    }


    public function manageUsers()
    {
        // Проверка на авторизацию (можно добавить проверку роли, если нужно)
        if (!$this->isLoggedIn() || $_SESSION['role'] !== 'admin') {
            header('Location: /site/login');
            exit();
        }

        // Получаем всех пользователей из базы данных
        $users = $this->userModel->getAllUsers();

        // Передаем данные во вид

        $this->renderView('manageUsers', ['users' => $users]);
    }

    private function isLoggedIn()
    {
        // Проверяем, существует ли активная сессия пользователя
        return isset($_SESSION['user_id']);
    }

    public function analysis()
    {
        if (!$this->isLoggedIn() || $_SESSION['role'] !== 'admin') {
            header('Location: /site/login');
            exit();
        }
        $this->renderView('analysis');
    }

    public function diagnostic()
    {
        if (!$this->isLoggedIn() || $_SESSION['role'] !== 'admin') {
            header('Location: /site/login');
            exit();
        }
        $this->renderView('diagnostic');
    }

    public function predictive()
    {
        if (!$this->isLoggedIn() || $_SESSION['role'] !== 'admin') {
            header('Location: /site/login');
            exit();
        }
        $this->renderView('predictive');
    }

    public function segmentation()
    {
        if (!$this->isLoggedIn() || $_SESSION['role'] !== 'admin') {
            header('Location: /site/login');
            exit();
        }
        $this->renderView('segmentation');
    }

    public function personalization()
    {
        $this->renderView('personalization');
    }

    // Функция для отображения рассылок
    public function mailing()
    {
        if (!$this->isLoggedIn()) {
            header('Location: /site/login');
            exit();
        }

        // Получаем все рассылки из базы данных
        $mailings = $this->userModel->getAllMailings();
        $this->renderView('mailing', ['mailings' => $mailings]);
    }

    // Функция для создания новой рассылки (только для админа)
    public function createMailing()
    {
        if (!$this->isLoggedIn() || $_SESSION['role'] !== 'admin') {
            header('Location: /site/login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = isset($_POST['title']) ? $_POST['title'] : '';
            $content = isset($_POST['content']) ? $_POST['content'] : '';

            // Добавляем рассылку в базу данных
            if ($this->userModel->createMailing($title, $content)) {
                header('Location: /site/mailing');
                exit();
            } else {
                echo 'Ошибка при создании рассылки';
            }
        }

        $this->renderView('createMailing');
    }
    public function architecture()
    {
        $this->renderView('architecture');
    }


    public function logout()
    {
        // Стартуем сессию

        // Удаляем данные сессии и перенаправляем на страницу входа
        session_unset();
        session_destroy();
        header('Location: /site/login');
        exit();
    }

    private function loginUser($email, $password)
    {
        // Проверяем, существует ли пользователь с таким email
        $stmt = $this->db->prepare("SELECT id, username, password_hash, role FROM users WHERE email = ?");
        $stmt->execute(array($email)); // Для PHP 5.6 нужно использовать массив вместо []

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            // Если пароль верный, сохраняем данные пользователя в сессии
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role']; // Сохраняем роль пользователя
            return true;
        }

        return false;
    }

    public function editUser()
    {
        if (!$this->isLoggedIn() || $_SESSION['role'] !== 'admin') {
            header('Location: /site/login');
            exit();
        }

        // Разбираем URL и получаем ID пользователя
        $urlParts = explode('/', $_SERVER['REQUEST_URI']);
        $userId = isset($urlParts[3]) ? (int)$urlParts[3] : 0;

        if ($userId) {
            // Получаем пользователя по ID
            $currentUser = $this->userModel->getUserById($userId);
            if (!$currentUser) {
                echo 'Пользователь не найден';
                exit();
            }

            // Если форма отправлена, обновляем данные
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $username = isset($_POST['username']) ? $_POST['username'] : '';
                $email = isset($_POST['email']) ? $_POST['email'] : '';
                $role = isset($_POST['role']) ? $_POST['role'] : 'user';

                // Обновляем данные пользователя
                if ($this->userModel->updateUser($userId, $username, $email, $role)) {
                    header('Location: /site/manageUsers');
                    exit();
                } else {
                    echo 'Ошибка при обновлении пользователя';
                }
            }

            // Отображаем форму с данными пользователя
            $this->renderView('editUser', ['currentUser' => $currentUser]);
        } else {
            echo 'ID пользователя не указан или неверный';
        }
    }


    public function deleteUser()
    {
        if (!$this->isLoggedIn() || $_SESSION['role'] !== 'admin') {
            header('Location: /site/login');
            exit();
        }

        // Разбираем URL и получаем ID пользователя
        $urlParts = explode('/', $_SERVER['REQUEST_URI']);
        $userId = isset($urlParts[3]) ? (int)$urlParts[3] : 0; // Четвёртая часть URL после site/deleteUser/{id}

        if ($userId) {
            if ($this->userModel->deleteUser($userId)) {
                header('Location: /site/manageUsers');
                exit();
            } else {
                echo 'Ошибка при удалении пользователя';
            }
        } else {
            echo 'ID пользователя не указан или неверный';
        }
    }

    private function registerUser($username, $email, $password, $role)
    {
        // Проверяем, существует ли уже пользователь с таким email
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute(array($email)); // Используем старый синтаксис для PHP 5.6

        if ($stmt->rowCount() > 0) {
            // Если email уже занят
            return false;
        }

        // Хешируем пароль перед сохранением
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // Вставляем нового пользователя в базу данных
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password_hash, role) VALUES (?, ?, ?, ?)");
        return $stmt->execute(array($username, $email, $password_hash, $role)); // Для PHP 5.6 используем массив
    }

    private function renderView($viewName, $data = [])
    {
        extract($data); // Делаем переменные из массива $data
        require_once __DIR__ . '/../views/layout.php';
        require_once __DIR__ . '/../views/' . $viewName . '.php';
    }
}

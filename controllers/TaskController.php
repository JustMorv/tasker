<?php
require_once __DIR__ . '/../models/TaskModel.php';
require_once __DIR__ . '/../components/Database.php';
require_once __DIR__ . '/../models/UserModel.php';

class TaskController
{
    private $taskModel;

    public function __construct()
    {
        // Подключение модели для задач
        $this->taskModel = new TaskModel();
    }
    public function index()
    {
        $tasks = $this->taskModel->getAllTasks();
        $this->renderView('task/index', ['tasks' => $tasks]);
    }
    private function isLoggedIn()
    {
        // Проверяем, существует ли активная сессия пользователя
        return isset($_SESSION['user_id']);
    }

    public function create()
    {
        if (!$this->isLoggedIn() || $_SESSION['role'] !== 'admin') {
            header('Location: /site/login');
            exit();
        }

        // Если форма отправлена
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Получаем данные из формы
            $title = isset($_POST['title']) ? $_POST['title'] : '';
            $description = isset($_POST['description']) ? $_POST['description'] : '';
            $start_time = isset($_POST['start_time']) ? $_POST['start_time'] : '';
            $end_time = isset($_POST['end_time']) ? $_POST['end_time'] : '';
            $status = isset($_POST['status']) ? $_POST['status'] : '';

            // Сохраняем задачу в базу
            $this->taskModel->saveTask($title, $description, $start_time, $end_time, $status);

            // Перенаправляем после успешного добавления
            header('Location: /task/index');
            exit();
        }

        // Отображаем форму создания задачи
        $this->renderView('task/create');
    }

    // Метод для редактирования задачи
    // Метод для редактирования задачи
    public function editTask()
    {
        if (!$this->isLoggedIn() || $_SESSION['role'] !== 'admin') {
            header('Location: /site/login');
            exit();
        }

        // Разбираем URL и получаем ID задачи
        $urlParts = explode('/', $_SERVER['REQUEST_URI']);
        $taskId = isset($urlParts[3]) ? (int)$urlParts[3] : 0; // Четвёртая часть URL после task/editTask/{id}

        if (!$taskId) {
            echo 'Неверный ID задачи';
            exit();
        }

        // Получаем задачу по ID
        $task = $this->taskModel->getTaskById($taskId);
        if (!$task) {
            echo 'Задача не найдена';
            exit();
        }

        // Обработка редактирования задачи
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];

            if ($this->taskModel->updateTask($taskId, $title, $description, $status, $start_time, $end_time)) {
                header('Location: /task/index');
                exit();
            } else {
                echo 'Ошибка при обновлении задачи';
            }
        }

        // Отображаем форму редактирования
        $this->renderView('editTask', ['task' => $task]);
    }


    public function deleteTask()
    {
        if (!$this->isLoggedIn() || $_SESSION['role'] !== 'admin') {
            header('Location: /site/login');
            exit();
        }
        // Разбираем URL и получаем ID задачи
        $urlParts = explode('/', $_SERVER['REQUEST_URI']);
        $taskId = isset($urlParts[3]) ? (int)$urlParts[3] : 0; // Четвёртая часть URL после task/deleteTask/{id}

        if ($taskId) {
            if ($this->taskModel->deleteTask($taskId)) {
                header('Location: /task/index'); // Перенаправляем на страницу управления задачами
                exit();
            } else {
                echo 'Ошибка при удалении задачи';
            }
        } else {
            echo 'ID задачи не указан или неверный';

        }
    }

    // Метод для рендеринга вьюхи
    private function renderView($viewName, $data = [])
    {
        extract($data); // Преобразуем массив данных в переменные

        // Проверяем, нужно ли добавлять "task" в путь
        $viewPath = strpos($viewName, 'task/') === false ? 'task/' . $viewName : $viewName;

        require_once __DIR__ . '/../views/layout.php';
        require_once __DIR__ . '/../views/' . $viewPath . '.php';
    }
}
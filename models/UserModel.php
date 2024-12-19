<?php
require_once __DIR__ . '/../components/Database.php';

class UserModel
{
    private $db;

    public function __construct()
    {
        // Создаем экземпляр класса Database для получения подключения
        $this->db = (new Database())->getConnection();
    }

    public function register($username, $email, $password, $role)
    {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (username, email, password_hash, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$username, $email, $password_hash, $role]);
    }

    public function login($email, $password)
    {
        $sql = "SELECT id, username, password_hash, role FROM users WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);

        if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($password, $user['password_hash'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                return true;
            }
        }
        return false;
    }
    public function getUserById($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            error_log('User not found for ID: ' . $userId);
        }

        return $user;
    }
    // Метод для получения всех рассылок
    public function getAllMailings()
    {
        $stmt = $this->db->prepare("SELECT m.id, m.title, m.created_at, u.username 
                                    FROM mailing m
                                    JOIN users u ON m.created_by = u.id
                                    ORDER BY m.created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Метод для создания новой рассылки
    public function createMailing($title, $content)
    {
        $stmt = $this->db->prepare("INSERT INTO mailing (title, content, created_by) 
                                    VALUES (?, ?, ?)");
        return $stmt->execute([ $title, $content, $_SESSION['user_id'] ]);
    }
    public function updateUser($id, $username, $email, $role)
    {
        $stmt = $this->db->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?");
        return $stmt->execute([$username, $email, $role, $id]);
    }

    public function deleteUser($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getAllUsers()
    {
        $sql = "SELECT id, username, email, role FROM users";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getLoggedInUser()
    {
        // Проверяем, авторизован ли пользователь
        if (isset($_SESSION['user_id'])) {
            // Получаем информацию о текущем пользователе
            $stmt = $this->db->prepare("SELECT id, username, email, role FROM users WHERE id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return null;
    }}

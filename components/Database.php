<?php
session_start();

class Database
{
    private $host = 'localhost'; // Хост базы данных
    private $dbname = 'mrmorvwv.beget.tech'; // Имя базы данных
    private $username = 'root'; // Имя пользователя
    private $password = ''; // Пароль пользователя
    private $pdo;

    public function __construct()
    {
        try {
            // Устанавливаем соединение с базой данных с использованием PDO
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->username,
                $this->password
            );
            // Устанавливаем режим обработки ошибок
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Если подключение не удалось, выводим ошибку
            die("Ошибка подключения к базе данных: " . $e->getMessage());
        }
    }

    // Получение экземпляра PDO для использования в моделях
    public function getConnection()
    {
        return $this->pdo;
    }

    // Пример метода для выполнения SQL-запроса
    public function query($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}

<?php
require_once __DIR__ . '/../components/Database.php';
// TaskModel.php
class TaskModel
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function saveTask($title, $description, $start_time, $end_time, $status)
    {
        if (!$title || !$description || !$start_time || !$end_time || !$status) {
            return false;
        }

        $stmt = $this->db->prepare('
            INSERT INTO tasks (title, description, start_time, end_time, status) 
            VALUES (:title, :description, :start_time, :end_time, :status)
        ');

        return $stmt->execute([
            'title' => $title,
            'description' => $description,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'status' => $status,
        ]);
    }

    public function getTaskById($taskId)
    {
        $stmt = $this->db->prepare('SELECT * FROM tasks WHERE id = :taskId');
        $stmt->execute(['taskId' => $taskId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function deleteTask($taskId)
    {
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = ?");
        return $stmt->execute([$taskId]);
    }
    // Метод для обновления задачи
    public function updateTask($taskId, $title, $description, $status, $startTime, $endTime)
    {
        $stmt = $this->db->prepare("UPDATE tasks SET title = ?, description = ?, status = ?, start_time = ?, end_time = ? WHERE id = ?");
        return $stmt->execute([$title, $description, $status, $startTime, $endTime, $taskId]);
    }

    // Метод для получения задачи по ID

    public function getAllTasks()
    {
        $stmt = $this->db->query('SELECT * FROM tasks');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
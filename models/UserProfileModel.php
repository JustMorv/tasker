<?php
require_once __DIR__ . '/../components/Database.php';

class UserProfileModel
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function getProfileByUserId($userId)
    {
        $stmt = $this->db->prepare('SELECT * FROM user_profiles WHERE user_id = :user_id');
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function saveProfile($userId, $data)
    {
        // Проверяем, существует ли профиль
        $profile = $this->getProfileByUserId($userId);

        if ($profile) {
            // Обновляем существующий профиль
            $stmt = $this->db->prepare('
            UPDATE user_profiles
            SET first_name = :first_name, last_name = :last_name, date_of_birth = :date_of_birth,
                gender = :gender, additional_info = :additional_info
            WHERE user_id = :user_id
        ');
        } else {
            // Создаем новый профиль
            $stmt = $this->db->prepare('
            INSERT INTO user_profiles (user_id, first_name, last_name, date_of_birth, gender, additional_info)
            VALUES (:user_id, :first_name, :last_name, :date_of_birth, :gender, :additional_info)
        ');
        }

        $stmt->execute([
            'user_id' => $userId,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'date_of_birth' => $data['date_of_birth'],
            'gender' => $data['gender'],
            'additional_info' => $data['additional_info'],
        ]);
    }

}


<?php

class Dashboard
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get total students for logged-in user
    public function getTotalStudents($userId)
    {
        $query = "SELECT COUNT(*) AS total
                  FROM students
                  WHERE user_id = :user_id";

        $stmt = $this->conn->prepare($query);

        $stmt->execute([
            ':user_id' => $userId
        ]);

        $result = $stmt->fetch();

        return $result['total'];
    }

    // Get recently added students
    public function getRecentStudents($userId)
    {
        $query = "SELECT id, roll_number, first_name,
                         last_name, course, year
                  FROM students
                  WHERE user_id = :user_id
                  ORDER BY created_at DESC
                  LIMIT 5";

        $stmt = $this->conn->prepare($query);

        $stmt->execute([
            ':user_id' => $userId
        ]);

        return $stmt->fetchAll();
    }
}

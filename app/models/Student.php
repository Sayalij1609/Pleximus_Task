
<?php

class Student
{
    private $conn;
    private $table = "students";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Check whether the roll number already exists
    // for the currently logged-in user.
    public function rollNumberExists($rollNumber, $userId)
    {
        $query = "SELECT id FROM {$this->table}
                  WHERE roll_number = :roll_number
                  AND user_id = :user_id
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);

        $stmt->execute([
            ':roll_number' => $rollNumber,
            ':user_id' => $userId
        ]);

        return $stmt->fetch() !== false;
    }

    // Insert a new student record.
    public function create($data)
    {
        $query = "INSERT INTO {$this->table}
                  (user_id, roll_number, first_name, last_name,
                   email, phone, gender, date_of_birth,
                   course, `year`, address, created_at, updated_at)
                  VALUES
                  (:user_id, :roll_number, :first_name, :last_name,
                   :email, :phone, :gender, :date_of_birth,
                   :course, :year, :address, NOW(), NOW())";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':user_id' => $data['user_id'],
            ':roll_number' => $data['roll_number'],
            ':first_name' => $data['first_name'],
            ':last_name' => $data['last_name'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':gender' => $data['gender'],
            ':date_of_birth' => $data['date_of_birth'],
            ':course' => $data['course'],
            ':year' => $data['year'],
            ':address' => $data['address']
        ]);
    }
}

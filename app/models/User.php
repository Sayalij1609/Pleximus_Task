
<?php

class User
{
    private $conn;
    private $table = "users";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Find user using email
    public function findByEmail($email)
    {
        $query = "SELECT * FROM " . $this->table .
                 " WHERE email = :email LIMIT 1";

        $stmt = $this->conn->prepare($query);

        $stmt->execute([
            ':email' => $email
        ]);

        return $stmt->fetch();
    }

    // Register a new user
    public function create($name, $email, $hashedPassword)
    {
        $query = "INSERT INTO " . $this->table .
                 " (name, email, password)
                 VALUES (:name, :email, :password)";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $hashedPassword
        ]);
    }

    // Find user using ID
    public function findById($id)
    {
        $query = "SELECT * FROM " . $this->table .
                 " WHERE id = :id LIMIT 1";

        $stmt = $this->conn->prepare($query);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch();
    }

    // Update user password
    public function updatePassword($id, $hashedPassword)
    {
        $query = "UPDATE " . $this->table .
                 " SET password = :password
                 WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':password' => $hashedPassword,
            ':id' => $id
        ]);
    }
}

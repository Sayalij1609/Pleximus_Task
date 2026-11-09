
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
}

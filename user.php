<?php

class User {
    private $conn;
    
    // Constructor to initialize database connection
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    // Method to create a new user
    public function createUser($username, $password, $email) {
        // Validate input
        if (empty($username) || empty($password) || empty($email)) {
            return false;
        }
        
        // Sanitize input to prevent SQL injection attacks
        $username = mysqli_real_escape_string($this->conn, $username);
        $email = mysqli_real_escape_string($this->conn, $email);
        $password = mysqli_real_escape_string($this->conn, $password);
        
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert user data into database
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        $result = mysqli_query($this->conn, $query);
        
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    // Method to check if a user with the given username exists
    public function usernameExists($username) {
        // Sanitize input to prevent SQL injection attacks
        $username = mysqli_real_escape_string($this->conn, $username);
        
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($this->conn, $query);
        
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    // Method to check if a user with the given email exists
    public function emailExists($email) {
        // Sanitize input to prevent SQL injection attacks
        $email = mysqli_real_escape_string($this->conn, $email);
        
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($this->conn, $query);
        
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    // Method to verify a user's login credentials
    public function verifyLogin($username, $password) {
        // Sanitize input to prevent SQL injection attacks
        $username = mysqli_real_escape_string($this->conn, $username);
        $password = mysqli_real_escape_string($this->conn, $password);
        
        // Get the user's hashed password from the database
        $query = "SELECT password FROM users WHERE username = '$username'";
        $result = mysqli_query($this->conn, $query);
        
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row['password'];
            
            // Verify the password
            if (password_verify($password, $hashed_password)) {
                return true;
            }
        }
        
        return false;
    }
    
    // Function to get user data from the database
    public function getUserData($username)
    {
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return false;
        }
    }

    // Function to register a new user in the database
    public function registerUser($username, $password, $email)
    {
        // Sanitize user input to prevent SQL injection
        $username = mysqli_real_escape_string($this->conn, $username);
        $password = mysqli_real_escape_string($this->conn, $password);
        $email = mysqli_real_escape_string($this->conn, $email);

        // Hash password before storing in database
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into database
        $query = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $username, $password, $email);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Function to authenticate user
    public function authenticateUser($username, $password)
    {
        // Get user data from database
        $user = $this->getUserData($username);

        // Verify password hash
        if ($user && password_verify($password, $user['password'])) {
            return true;
        } else {
            return false;
        }
    }
}
<?php
require_once 'config.php';

class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        try {
            $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $this->conn->set_charset('utf8mb4');
            if ($this->conn->connect_error) {
                throw new Exception($this->conn->connect_error);
            }
        } catch (Throwable $e) {
            http_response_code(500);
            die('Database connection failed: ' . htmlspecialchars($e->getMessage()));
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }

    public function escape($str) {
        return $this->conn->real_escape_string($str);
    }

    public function insertId() {
        return $this->conn->insert_id;
    }

    public function affectedRows() {
        return $this->conn->affected_rows;
    }

    public function fetchAll($sql) {
        $result = $this->query($sql);
        $data = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function fetchOne($sql) {
        $result = $this->query($sql);
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }
}

function db() {
    return Database::getInstance()->getConnection();
}

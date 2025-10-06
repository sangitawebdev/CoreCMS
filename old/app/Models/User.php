<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        return $this->db->fetchAll("SELECT * FROM users ORDER BY id DESC");
    }

    public function getById($id) {
        return $this->db->fetch("SELECT * FROM users WHERE id=?", [$id]);
    }

    public function create($data) {
        $password = password_hash($data['password'], PASSWORD_BCRYPT);
        $stmt = $this->db->query(
            "INSERT INTO users (username,email,password,role) VALUES (?,?,?,?)",
            [$data['username'], $data['email'], $password, $data['role']]
        );
        return $stmt;
    }

    public function update($id, $data) {
        if(isset($data['password']) && $data['password']!='') {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            $stmt = $this->db->query(
                "UPDATE users SET username=?, email=?, password=?, role=? WHERE id=?",
                [$data['username'],$data['email'],$data['password'],$data['role'],$id]
            );
        } else {
            $stmt = $this->db->query(
                "UPDATE users SET username=?, email=?, role=? WHERE id=?",
                [$data['username'],$data['email'],$data['role'],$id]
            );
        }
        return $stmt;
    }

    public function delete($id) {
        return $this->db->query("DELETE FROM users WHERE id=?", [$id]);
    }
}

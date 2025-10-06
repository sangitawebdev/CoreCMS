<?php
class Post {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        return $this->db->fetchAll("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id=users.id ORDER BY posts.id DESC");
    }

    public function getById($id) {
        return $this->db->fetch("SELECT * FROM posts WHERE id=?", [$id]);
    }

    public function create($data) {
        return $this->db->query(
            "INSERT INTO posts (user_id,title,slug,content,status) VALUES (?,?,?,?,?)",
            [$data['user_id'],$data['title'],$data['slug'],$data['content'],$data['status']]
        );
    }

    public function update($id, $data) {
        return $this->db->query(
            "UPDATE posts SET title=?, slug=?, content=?, status=? WHERE id=?",
            [$data['title'],$data['slug'],$data['content'],$data['status'],$id]
        );
    }

    public function delete($id) {
        return $this->db->query("DELETE FROM posts WHERE id=?", [$id]);
    }
}

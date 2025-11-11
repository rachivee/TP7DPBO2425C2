<?php
require_once 'config/db.php';

class Venue {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // Mengambil semua venues
    public function getAllVenues() {
        $stmt = $this->db->query("SELECT * FROM venues ORDER BY name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Menambah venue baru
    public function addVenue($name, $address, $city, $capacity) {
        $query = "INSERT INTO venues (name, address, city, capacity) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        
        return $stmt->execute([$name, $address, $city, $capacity]);
    }

    // Mengambil venue berdasarkan ID
    public function getVenueById($id) {
        $query = "SELECT * FROM venues WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mengupdate data venue
    public function updateVenue($id, $name, $address, $city, $capacity) {
        $query = "UPDATE venues SET name = ?, address = ?, city = ?, capacity = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        
        return $stmt->execute([$name, $address, $city, $capacity, $id]);
    }

    // Menghapus venue
    public function deleteVenue($id) {
        $query = "DELETE FROM venues WHERE id = ?";
        $stmt = $this->db->prepare($query);
        
        return $stmt->execute([$id]);
    }
}
?>

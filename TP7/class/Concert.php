<?php
require_once 'config/db.php';

class Concert {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // Mengambil semua konser
    public function getAllConcerts() {
        $stmt = $this->db->query("SELECT concerts.*, venues.name AS venue_name FROM concerts JOIN venues ON concerts.venue_id = venues.id ORDER BY concerts.date ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mengambil satu konser berdasarkan ID
    public function getConcertById($id) {
        $stmt = $this->db->prepare("SELECT concerts.*, venues.name AS venue_name FROM concerts JOIN venues ON concerts.venue_id = venues.id WHERE concerts.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Menghapus semua orders terkait concert tertentu
    public function deleteConcertOrders($concertId) {
        $stmt = $this->db->prepare("DELETE FROM orders WHERE concert_id = ?");
        return $stmt->execute([$concertId]);
    }

    // Menghapus concert setelah orders terkait terhapus
    public function deleteConcert($concertId) {
        // Hapus orders terkait concert
        $this->deleteConcertOrders($concertId);

        // Hapus concert
        $stmt = $this->db->prepare("DELETE FROM concerts WHERE id = ?");
        return $stmt->execute([$concertId]);
    }

    // Menambahkan concert
    public function addConcert($artist, $venue_id, $date, $price, $stock) {
        $stmt = $this->db->prepare("INSERT INTO concerts (artist, venue_id, date, price, stock) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$artist, $venue_id, $date, $price, $stock]);
    }

    // Mengupdate concert
    public function updateConcert($id, $artist, $venue_id, $date, $price, $stock) {
        $stmt = $this->db->prepare("UPDATE concerts SET artist = ?, venue_id = ?, date = ?, price = ?, stock = ? WHERE id = ?");
        return $stmt->execute([$artist, $venue_id, $date, $price, $stock, $id]);
    }
}
?>

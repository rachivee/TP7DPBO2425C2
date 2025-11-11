<?php
require_once 'config/db.php';

class Order {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // Mengambil semua orders
    public function getAllOrders() {
        $stmt = $this->db->query("SELECT orders.*, concerts.artist, concerts.date, concerts.price 
                                         FROM orders
                                         JOIN concerts ON orders.concert_id = concerts.id 
                                         ORDER BY orders.order_date DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Menambahkan order (gaya seperti borrowBook)
    public function addOrder($name, $concertId, $quantity) {
        // Ambil data konser
        $concertData = $this->db->query("SELECT price, stock FROM concerts WHERE id = $concertId")->fetch();

        // Pastikan konser ada dan stok cukup
        if ($concertData && $concertData['stock'] >= $quantity) {
            $totalPrice = $concertData['price'] * $quantity;

            // Kurangi stok konser
            $newStock = $concertData['stock'] - $quantity;
            $updateStock = $this->db->prepare("UPDATE concerts SET stock = ? WHERE id = ?");
            $updateStock->execute([$newStock, $concertId]);

            // Tambahkan order
            $stmt = $this->db->prepare("INSERT INTO orders (name, concert_id, quantity, total_price, order_date) VALUES (?, ?, ?, ?, NOW())");
            return $stmt->execute([$name, $concertId, $quantity, $totalPrice]);
        }

        // Jika stok tidak cukup atau konser tidak ditemukan
        return false;
    }

    // Mengambil order berdasarkan ID
    public function getOrderById($id) {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mengupdate order
public function updateOrder($id, $name, $concertId, $quantity)
{
    // --- Ambil data order lama ---
    $stmtOld = $this->db->prepare("
        SELECT concert_id, quantity 
        FROM orders 
        WHERE id = ?
    ");
    $stmtOld->execute([$id]);
    $oldOrder = $stmtOld->fetch(PDO::FETCH_ASSOC);

    if (!$oldOrder) {
        return false; // Order tidak ditemukan
    }

    // --- Kembalikan stok dari order lama ---
    $stmtRestore = $this->db->prepare("
        UPDATE concerts 
        SET stock = stock + ? 
        WHERE id = ?
    ");
    $stmtRestore->execute([$oldOrder['quantity'], $oldOrder['concert_id']]);

    // --- Ambil data konser baru ---
    $stmtConcert = $this->db->prepare("
        SELECT price, stock 
        FROM concerts 
        WHERE id = ?
    ");
    $stmtConcert->execute([$concertId]);
    $concert = $stmtConcert->fetch(PDO::FETCH_ASSOC);

    if (!$concert || $concert['stock'] < $quantity) {
        return false; // Konser tidak ditemukan / stok tidak cukup
    }

    // --- Hitung total harga baru ---
    $totalPrice = $concert['price'] * $quantity;

    // --- Update data order ---
    $stmtUpdate = $this->db->prepare("
        UPDATE orders 
        SET name = ?, concert_id = ?, quantity = ?, total_price = ? 
        WHERE id = ?
    ");
    $result = $stmtUpdate->execute([$name, $concertId, $quantity, $totalPrice, $id]);

    // --- Kurangi stok baru jika update berhasil ---
    if ($result) {
        $stmtReduce = $this->db->prepare("
            UPDATE concerts 
            SET stock = stock - ? 
            WHERE id = ?
        ");
        $stmtReduce->execute([$quantity, $concertId]);
    }

    return $result;
}



    // Menghapus order (kembalikan stok tiket)
    public function deleteOrder($id) {
        $order = $this->db->query("SELECT concert_id, quantity FROM orders WHERE id = $id")->fetch();
        if (!$order) {
            return false;
        }
        // Kembalikan stok konser
        $this->db->prepare("UPDATE concerts SET stock = stock + ? WHERE id = ?")
                 ->execute([$order['quantity'], $order['concert_id']]);

        // Hapus order
        $stmt = $this->db->prepare("DELETE FROM orders WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>

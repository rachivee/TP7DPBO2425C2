<?php
// Menampilkan data concert yang sudah ada
if (isset($_GET['id'])) {
    $concertId = $_GET['id'];
    $concertData = $concert->getConcertById($concertId);
}
?>

<h3>Edit Concert</h3>
<form method="POST">
    <input type="hidden" name="id" value="<?= $concertData['id'] ?>">

    <label>Concert</label>
    <input type="text" name="artist" value="<?= $concertData['artist'] ?>" required>

    <label>Venue</label>
    <select name="venue_id">
        <!-- Daftar venue -->
        <?php foreach ($venue->getAllVenues() as $v): ?>
            <option value="<?= $v['id'] ?>" <?= $v['id'] == $concertData['venue_id'] ? 'selected' : '' ?>><?= $v['name'] ?></option>
        <?php endforeach; ?>
    </select>

    <label>Date</label>
    <input type="date" name="date" value="<?= $concertData['date'] ?>" required>

    <label>Price</label>
    <input type="number" name="price" step="0.01" value="<?= $concertData['price'] ?>" required>

    <label>Stock</label>
    <input type="number" name="stock" value="<?= $concertData['stock'] ?>" required>

    <button type="submit" name="edit_concert">Update Concert</button>
</form>

<div class="center-button">
    <a href="?page=concerts" class="btn-add">Back to List</a>
</div>
<br>

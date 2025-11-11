<h3>Add Order</h3>
<form method="POST">
    <label>Name</label>
    <input type="text" name="user_name" required>

    <label>Concert</label>
    <select name="concert_id" required>
        <?php foreach ($concert->getAllConcerts() as $c): ?>
            <option value="<?= $c['id'] ?>"><?= $c['artist'] ?> (<?= $c['date'] ?>)</option>
        <?php endforeach; ?>
    </select>

    <label>Quantity</label>
    <input type="number" name="qty" required>

    <button type="submit" name="add_order">Add Order</button>
</form>

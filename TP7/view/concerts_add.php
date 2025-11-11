<h3>Add Concert</h3>
<form method="POST">
    <label>Concert</label>
    <input type="text" name="artist" required>

    <label>Venue</label>
    <select name="venue_id" required>
        <?php foreach ($venue->getAllVenues() as $v): ?>
            <option value="<?= $v['id'] ?>"><?= $v['name'] ?></option>
        <?php endforeach; ?>
    </select>

    <label>Date</label>
    <input type="date" name="date" required>

    <label>Price</label>
    <input type="number" name="price" step="0.01" required>

    <label>Stock</label>
    <input type="number" name="stock" required>

    <button type="submit" name="add_concert">Add Concert</button>
</form>

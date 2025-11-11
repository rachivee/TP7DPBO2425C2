<?php
if (isset($_GET['id'])) {
    $orderId = $_GET['id'];
    $orderData = $order->getOrderById($orderId);
}
?>

<h3>Edit Order</h3>
<form method="POST">
    <input type="hidden" name="id" value="<?= $orderData['id'] ?>">

    <label>Name</label>
    <input type="text" name="name" value="<?= $orderData['name'] ?>" required>

    <label>Concert</label>
    <select name="concert_id" required>
        <?php foreach ($concert->getAllConcerts() as $c): ?>
            <option value="<?= $c['id'] ?>" <?= $c['id'] == $orderData['concert_id'] ? 'selected' : '' ?>>
                <?= $c['artist'] ?> (<?= $c['date'] ?>)
            </option>
        <?php endforeach; ?>
    </select>

    <label>Quantity</label>
    <input type="number" name="quantity" value="<?= $orderData['quantity'] ?>" required>

    <button type="submit" name="edit_order">Update Order</button>
</form>

<div class="center-button">
    <a href="?page=orders" class="btn-add">Back to List</a>
</div>

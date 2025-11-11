<h3>Order List</h3>

<table border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>Name</th>
    <th>Concert</th>
    <th>Date</th>
    <th>Qty</th>
    <th>Total Price</th>
    <th>Actions</th>
</tr>

<?php foreach ($order->getAllOrders() as $o): ?>
<tr>
    <td><?= $o['name'] ?></td>
    <td><?= $o['artist'] ?></td>
    <td><?= $o['date'] ?></td>
    <td><?= $o['quantity'] ?></td>
    <td><?= $o['total_price'] ?></td>
    <td>
        <a href="?page=orders_edit&id=<?= $o['id'] ?>" class="btn-edit">Edit</a> |
        <a href="?cancel_order=<?= $o['id'] ?>" onclick="return confirm('Cancel this order?')" class="btn-delete">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<div class="center-button">
    <a href="?page=orders_add" class="btn-add">Add New Order</a>
</div>

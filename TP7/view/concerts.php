<h3>Concert List</h3>

<table border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>Concert</th>
    <th>Venue</th>
    <th>Date</th>
    <th>Price</th>
    <th>Stock</th>
    <th>Actions</th>
</tr>

<?php foreach ($concert->getAllConcerts() as $c): ?>
<tr></tr>
    <td><?= $c['artist'] ?></td>
    <td><?= $c['venue_name'] ?></td>
    <td><?= $c['date'] ?></td>
    <td><?= $c['price'] ?></td>
    <td><?= $c['stock'] ?></td>
    <td>
        <a href="?page=concerts_edit&id=<?= $c['id'] ?>" class="btn-edit">Edit</a> |
        <a href="?page=concerts&delete_concert=<?= $c['id'] ?>" 
            onclick="return confirm('Are you sure you want to delete this concert? This will also delete associated orders!')" 
            class="btn-delete">
            Delete
        </a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<div class="center-button">
    <a href="?page=concerts_add" class="btn-add">Add New Concert</a>
</div>
<br>







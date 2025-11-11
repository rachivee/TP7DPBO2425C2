<h3>Venue List</h3>

<table border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>Name</th>
    <th>Address</th>
    <th>City</th>
    <th>Capacity</th>
    <th>Actions</th>
</tr>

<?php foreach ($venue->getAllVenues() as $v): ?>
<tr>
    <td><?= $v['name'] ?></td>
    <td><?= $v['address'] ?></td>
    <td><?= $v['city'] ?></td>
    <td><?= $v['capacity'] ?></td>
    <td>
        <a href="?page=venues_edit&id=<?= $v['id'] ?>" class="btn-edit">Edit</a> |
        <a href="?delete_venue=<?= $v['id'] ?>" onclick="return confirm('Delete this venue?')" class="btn-delete">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<div class="center-button">
    <a href="?page=venues_add" class="btn-add">Add New Venue</a>
</div>

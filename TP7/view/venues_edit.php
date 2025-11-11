<?php
if (isset($_GET['id'])) {
    $venueId = $_GET['id'];
    $venueData = $venue->getVenueById($venueId);
}
?>

<h3>Edit Venue</h3>
<form method="POST">
    <input type="hidden" name="id" value="<?= $venueData['id'] ?>">

    <label>Name</label>
    <input type="text" name="name" value="<?= $venueData['name'] ?>" required>

    <label>Address</label>
    <input type="text" name="address" value="<?= $venueData['address'] ?>" required>

    <label>City</label>
    <input type="text" name="city" value="<?= $venueData['city'] ?>" required>

    <label>Capacity</label>
    <input type="number" name="capacity" value="<?= $venueData['capacity'] ?>" required>

    <button type="submit" name="edit_venue">Update Venue</button>
</form>

<div class="center-button">
    <a href="?page=venues" class="btn-add">Back to List</a>
</div>

<?php
require_once 'class/Concert.php';
require_once 'class/Venue.php';
require_once 'class/Order.php';

$concert = new Concert();
$venue = new Venue();
$order = new Order();

if (isset($_GET['delete_concert'])) {
    $concert->deleteConcert($_GET['delete_concert']);
}

if (isset($_POST['add_concert'])) {
    $concert->addConcert($_POST['artist'], $_POST['venue_id'], $_POST['date'], $_POST['price'], $_POST['stock']);
    header("Location: index.php?page=concerts");
    exit;
}

if (isset($_POST['edit_concert'])) {
    $concert->updateConcert($_POST['id'], $_POST['artist'], $_POST['venue_id'], $_POST['date'], $_POST['price'], $_POST['stock']);
    header("Location: index.php?page=concerts");
    exit;
}

if (isset($_POST['add_venue'])) {
    $venue->addVenue($_POST['name'], $_POST['address'], $_POST['city'], $_POST['capacity']);
    header("Location: index.php?page=venues");
    exit;
}

if (isset($_POST['edit_venue'])) {
    $venue->updateVenue( $_POST['id'], $_POST['name'], $_POST['address'], $_POST['city'], $_POST['capacity']);
    header("Location: index.php?page=venues");
    exit;
}

if (isset($_GET['delete_venue'])) {
    $venue->deleteVenue($_GET['delete_venue']);
    header("Location: index.php?page=venues");
    exit;
}

if (isset($_POST['add_order'])) {
    $order->addOrder($_POST['user_name'], $_POST['concert_id'], $_POST['qty']);
    header("Location: index.php?page=orders");
    exit;
}

if (isset($_POST['edit_order'])) {
    $order->updateOrder($_POST['id'], $_POST['name'], $_POST['concert_id'], $_POST['quantity']);
    header("Location: index.php?page=orders");
    exit;
}

if (isset($_GET['cancel_order'])) {
    $order->deleteOrder($_GET['cancel_order']);
    header("Location: index.php?page=orders");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Concert Ticket System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include 'view/header.php'; ?>

    <main>
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];

            switch ($page) {
                case 'concerts':
                    include 'view/concerts.php';
                    break;
                case 'concerts_add':
                    include 'view/concerts_add.php';
                    break;
                case 'concerts_edit':
                    include 'view/concerts_edit.php';
                    break;
                case 'venues':
                    include 'view/venues.php';
                    break;
                case 'venues_add':
                    include 'view/venues_add.php';
                    break;
                case 'venues_edit':
                    include 'view/venues_edit.php';
                    break;
                case 'orders':
                    include 'view/orders.php';
                    break;
                case 'orders_add':
                    include 'view/orders_add.php';
                    break;
                case 'orders_edit':
                    include 'view/orders_edit.php';
                    break;
                default:
                    echo "<h2>Page not found.</h2>";
                    break;
            }
        }
        ?>
    </main>

    <?php include 'view/footer.php'; ?>
</body>
</html>


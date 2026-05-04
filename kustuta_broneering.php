<?php include('config.php'); ?>
<?php
    if (!isset($_SESSION['tuvastamine'])) {
        header('Location: index.php');
        exit();
    }

    if (!empty($_GET['delid'])) {
        $id = (int)$_GET['delid'];

        // Check if user is admin or owns the reservation
        $user_id = $_SESSION['user_id'];
        $role = $_SESSION['role'];

        if ($role === 'administraator') {
            $paring = "DELETE FROM reservations WHERE id=$id";
        } else {
            $paring = "DELETE FROM reservations WHERE id=$id AND user_id=$user_id";
        }

        $valjund = mysqli_query($yhendus, $paring);
        if ($valjund && mysqli_affected_rows($yhendus) > 0) {
            header("Location: my_rentals.php?msg=kustutatud");
        } else {
            header("Location: my_rentals.php?msg=error");
        }
        exit();
    }

    header("Location: my_rentals.php");
?>
<?php include('config.php'); ?>
<?php include('header.php'); ?>

<!-- sisu -->
<div class="container">

    <a href="index.php" class="btn btn-dark">Tagasi</a>

    <div class="row">
<?php
    $id = $_GET['id'];
    $paring = "SELECT * FROM cars WHERE id=".$id."";
    $valjund = mysqli_query($yhendus, $paring);
    $rida = mysqli_fetch_assoc($valjund);
     #print_r($rida);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['tuvastamine'])) {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $start = new DateTime($start_date);
        $end = new DateTime($end_date);
        $days = $start->diff($end)->days + 1;
        $total_price = $rida['price'] * $days;

        // get next id
        $id_query = "SELECT MAX(id) as max_id FROM reservations";
        $id_result = mysqli_query($yhendus, $id_query);
        $id_row = mysqli_fetch_assoc($id_result);
        $next_id = ($id_row['max_id'] ?? 0) + 1;

        $user_id = $_SESSION['user_id'];
        $insert = "INSERT INTO reservations (id, user_id, car_id, start_date, end_date, total_price, status, created_at) VALUES ($next_id, $user_id, $id, '$start_date', '$end_date', $total_price, 'broneeritud', NOW())";
        if (mysqli_query($yhendus, $insert)) {
            echo '<div class="alert alert-success">Auto edukalt renditud!</div>';
        } else {
            echo '<div class="alert alert-danger">Viga rentimisel: ' . mysqli_error($yhendus) . '</div>';
        }
    }
?>
        <div class="col">
            <h1><?php echo $rida["mark"]; ?> <?php echo $rida["model"]; ?></h1>
            <p>Mootor:  <?php echo $rida["engine"]; ?></p>
            <p>Kütus:  <?php echo $rida["fuel"]; ?></p>
            <p>Aasta:  <?= $rida["year"]; ?></p>
            <p>Staatus:  <?php echo $rida["status"]; ?></p>
            <p>Käigukast:  <?php echo $rida["transmission"]; ?></p>
            <p>Istmed:  <?php echo $rida["seats"]; ?></p>
            <p class="fs-5">Hind:  <?php echo $rida["price"]; ?> €/päev</p>
            <?php if (isset($_SESSION['tuvastamine'])): ?>
                <form method="post">
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Alguskuupäev</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">Lõppkuupäev</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Rendi auto</button>
                </form>
            <?php else: ?>
                <a href="admin/login.php" class="btn btn-dark w-100">Logi sisse rentimiseks</a>
            <?php endif; ?>
        </div>
        <div class="col">
            <img src="https://loremflickr.com/800/500/<?php echo str_replace(" ","", $rida["mark"]); ?>" class="card-img-top img-fluid" alt="<?php echo $rida["mark"]; ?>">
        </div>
    </div>
</div>
<!-- /sisu -->

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
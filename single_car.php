<?php include('config.php'); ?>
<?php include('header.php'); ?>

    <!-- /menüü -->
<!-- sisu -->
<div class="container">

    <a href="index.php" class="btn btn-dark">Tagasi</a>

    <div class="row">
<?php
    $id = $_GET['id'];
    $paring = "SELECT * FROM cars WHERE id=".$id."";
    $valjund = mysqli_query($yhendus, $paring);
    $rida = mysqli_fetch_assoc($valjund);
    // print_r($rida);
?>
        <div class="col">
            <h1><?php echo $rida["mark"]; ?> <?php echo $rida["model"]; ?></h1>
            <p>Mootor:  <?php echo $rida["engine"]; ?></p>
            <p>Kütus:  <?php echo $rida["fuel"]; ?></p>
            <p>Aasta:  <?php echo $rida["year"]; ?></p>
            <p>Istmed:  <?php echo $rida["seats"]; ?></p>
            <p>Kirjeldus:  <?php echo $rida["description"]; ?></p>
            <p>Staatus:  <?php echo $rida["status"]; ?></p>
            <p>Istekohti:  <?php echo $rida["seats"]; ?></p>
            <p class="fs-5">Hind:  <?php echo $rida["price"]; ?></p>
            <a href="#" class="btn btn-dark w-100">Rendiauto</a>
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
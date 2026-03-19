<?php include('../config.php'); ?>
<?php include('../header.php'); ?>

<!-- sisu -->
<div class="container">
    <div class="row row-cols-1 row-cols-md-4 g-4">
<!-- üks auto -->
<?php
    $paring = "SELECT * FROM cars";
    if (!empty($_GET["otsi"])) {
        $otsing = $_GET["otsi"];
        $paring .= " WHERE mark LIKE '%".$otsing."%'";
    } 
    $paring .= " LIMIT 8";
    // var_dump($_GET["otsi"]);

    $valjund = mysqli_query($yhendus, $paring); //saadan päringu andmebaasi
    
        // var_dump($rida);                            //kuvan testvastuse
?>
<h2>Adminni ala</h2>
<a href="lisa.php" class="btn btn-success">+ Lisa auto</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Mark</th>
      <th scope="col">Mudel</th>
      <th scope="col">Mootor</th>
      <th scope="col">Kütus</th>
      <th scope="col">Aasta</th>
      <th scope="col">Käigukast</th>
      <th scope="col">Istekohti</th>
      <th scope="col">Iseloomustus</th>
      <th scope="col">Staatus</th>
      <th scope="col">Hind</th>
    </tr>
  </thead>
  <tbody>
    <?php
    while($rida = mysqli_fetch_assoc($valjund)){       //sikutan vastuse alla

    ?>
    <tr>
      <th scope="row"><?php echo $rida["id"]; ?></th>
      <td><?php echo $rida["mark"]; ?></td>
      <td><?php echo $rida["model"]; ?></td>
      <td><?php echo $rida["engine"]; ?></td>
      <td><?php echo $rida["fuel"]; ?></td>
      <td><?php echo $rida["year"]; ?></td>
      <td><?php echo $rida["transmission"]; ?></td>
      <td><?php echo $rida["seats"]; ?></td>
      <td><?php echo $rida["description"]; ?></td>
      <td><?php echo $rida["status"]; ?></td>
      <td><?php echo $rida["price"]; ?></td>
      <td><a href="kustuta.php?editid=<?= $rida["id"]; ?></a>" class="btn btn-warning">Muuda</a></td>
      <td><a href="kustuta.php?delid=<?= $rida["id"]; ?></a>" class="btn btn-danger">Kustuta</a></td>
    </tr>
  
  <?php } ?>
  </tbody>
</table>
    

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
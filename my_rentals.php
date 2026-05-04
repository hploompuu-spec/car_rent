<?php include('config.php'); ?>
<?php include('header.php'); ?>

<!-- sisu -->
<div class="container">
    <h2>Minu broneeringud</h2>
    <?php
    if (!isset($_SESSION['tuvastamine'])) {
        echo '<div class="alert alert-warning">Palun logi sisse, et näha oma renditud autosid.</div>';
    } else {
        if ($_SESSION['role'] === 'administraator') {
            $pealkiri = 'Kõik rendid';
            $paring = "SELECT r.start_date, r.end_date, r.total_price, r.status, c.mark, c.model, u.email, u.first_name, u.last_name
                       FROM reservations r
                       JOIN cars c ON r.car_id = c.id
                       JOIN users u ON r.user_id = u.id
                       ORDER BY r.start_date DESC";
        } else {
            $pealkiri = 'Minu broneeringud';
            $user_id = $_SESSION['user_id'];
            $paring = "SELECT r.start_date, r.end_date, r.total_price, r.status, c.mark, c.model
                       FROM reservations r
                       JOIN cars c ON r.car_id = c.id
                       WHERE r.user_id = $user_id
                       ORDER BY r.start_date DESC";
        }

        echo '<h3>' . $pealkiri . '</h3>';
        $valjund = mysqli_query($yhendus, $paring);

        if (mysqli_num_rows($valjund) > 0) {
            echo '<table class="table">
                    <thead>
                        <tr>
                            <th>Auto</th>
                            <th>Alguskuupäev</th>
                            <th>Lõppkuupäev</th>
                            <th>Koguhind</th>
                            <th>Staatus</th>';
            if ($_SESSION['role'] === 'administraator') {
                echo '<th>Kasutaja</th>';
            }
            echo '      </tr>
                    </thead>
                    <tbody>';

            while ($rida = mysqli_fetch_assoc($valjund)) {
                echo '<tr>
                        <td>' . $rida['mark'] . ' ' . $rida['model'] . '</td>
                        <td>' . $rida['start_date'] . '</td>
                        <td>' . $rida['end_date'] . '</td>
                        <td>' . $rida['total_price'] . ' €</td>
                        <td>' . $rida['status'] . '</td>';
                if ($_SESSION['role'] === 'administraator') {
                    echo '<td>' . $rida['first_name'] . ' ' . $rida['last_name'] . ' (' . $rida['email'] . ')</td>';
                }
                echo '  </tr>';
            }

            echo '</tbody></table>';
        } else {
            echo '<div class="alert alert-info">Pole leitud ühtegi rentimist.</div>';
        }
    }
    ?>
</div>
<!-- /sisu -->

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
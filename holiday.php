<?php
session_start();


if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}


include 'header.php';

$apiUrl = "https://data.gov.sg/api/action/datastore_search?resource_id=6228c3c5-03bd-4747-bb10-85140f87168b&limit=10";

// Fetch data from API
$response = file_get_contents($apiUrl);
$data = json_decode($response, true);

// Display public holidays
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Holidays</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="bg-light p-5 text-center  " style="height: 90vh;">
   <div class="container gradient-custom">
    <h2>Public Holidays</h2>
    <table>
        <tr>
            <th>Date</th>
            <th>Holiday Name</th>
            <th>Day</th>
        </tr>
        <?php foreach ($data['result']['records'] as $holiday): ?>
        <tr>
            <td><?php echo date('Y-m-d', strtotime($holiday['date'])); ?></td>
            <td><?php echo $holiday['name']; ?></td>
            <td><?php echo date('l', strtotime($holiday['date'])); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php include 'footer.php'; ?>

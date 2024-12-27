<!DOCTYPE html>
<html>
<head>
  <title>Random Photopack JKT48 Sorting</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <h1 class="mt-5">Random Photopack JKT48 Sorting</h1>
    <p class="lead">By Nailar Raza and Friends</p>

    <h3 class="mt-4">Input Dataset JKT48 Photopack (Member Name & Availability)</h3>
    <form method="post" action="">
      <div class="mb-3">
        <textarea class="form-control" name="dataset" placeholder="Enter dataset as CSV format, contoh:
Christy,60
Freya,50
Muthe,75
Fiony,65" rows="5"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Acak Isi Produk Photopack</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $dataset = $_POST["dataset"];

      try {
        // Parse dataset 
        $data = array_map(function ($line) {
          return explode(',', trim($line));
        }, explode("\n", $dataset));

        // Generate random rows
        $randomizedRows = [];
        foreach ($data as $row) {
          $name = $row[0];
          $availability = intval($row[1]);
          for ($i = 0; $i < $availability; $i++) {
            $randomizedRows[] = $name;
          }
        }
        shuffle($randomizedRows);

        // Group results
        $groupSize = 5;
        $groupedResults = array_chunk($randomizedRows, $groupSize);

        // Display output table
        echo "<h3 class='mt-5'>Hasil:</h3>";
        echo "<table class='table table-striped'>";
        echo "<thead><tr><th>No</th><th>Names</th></tr></thead>";
        echo "<tbody>";
        foreach ($groupedResults as $i => $group) {
          $no = $i + 1;
          $names = implode(" - ", $group);
          echo "<tr><td>$no</td><td>$names</td></tr>";
        }
        echo "</tbody></table>";
      } catch (Exception $e) {
        echo "<div class='alert alert-danger' role='alert'>Error: " . $e->getMessage() . "</div>";
      }
    }
    ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
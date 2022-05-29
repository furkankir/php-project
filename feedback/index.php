<?php include 'config/database.php'; ?>

<?php
$lcSql = "SELECT * FROM php_dev.project";
$result = mysqli_query($conn, $lcSql);
$stuData = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php
$name = $score = '';
$nameErr = $scoreErr = '';

if (isset($_POST['submit'])) {
  if (empty($_POST['Name'])) {
    $nameErr = 'Name is required';
  } else {
    $name = filter_input(INPUT_POST, 'Name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  if (empty($_POST['Score'])) {
    $scoreErr = 'Score is required';
  } else {
    $score = filter_input(INPUT_POST, 'Score', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  }

  if (empty($nameErr) && empty($scoreErr)) {
    $lcSql = "INSERT INTO php_dev.project (Name,Score) VALUES ('$name','$score')";

    if (mysqli_query($conn, $lcSql)) {
      header('Location: index.php');
    } else {
      echo 'Error' . mysqli_error($conn);
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Document</title>
  <style>
    body {
      background-image: url('img/mountain.jpg');
      background-size: 100rem;
      background-repeat: no-repeat;
    }
  </style>
</head>

<body>

<!-- table da verilerin isimler ID Name Score-->


  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="mt-4 ">
    <div class="card rounded shadow p-3 w-50 mx-auto">
      <div class="mx-auto p-3 w-50   ">
        <label for="Name" class="form-label">Name</label>
        <input type="text" name="Name" class="form-control <?php echo !$nameErr ?: 'is-invalid' ?>" id="Name" placeholder="Enter the students Name">
        <div class="invalid-feedback">
          <?php echo $nameErr; ?>
        </div>
      </div>
      <div class="mx-auto p-3 w-50  ">
        <label for="Score" class="form-label">Score</label>
        <input type="text" name="Score" class="form-control <?php echo !$scoreErr ?: 'is-invalid' ?>" id="Score" placeholder="Enter the students Score">
        <div class="invalid-feedback">
          <?php echo $scoreErr; ?>
        </div>
      </div>
      <button type="submit" name="submit" class=" btn btn-primary d-grid gap-2 d-md-block position-absolute start-50 translate-middle" style="top: 18rem;">Submit</button>

    </div>
  </form>

  <div class="card rounded shadow p-3 w-50 mx-auto " style="bottom: -6rem ;">
    <?php if (empty($stuData)) : ?>
      <p class="lead mx-auto">There is no data</p>
    <?php else : ?>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Score</th>
            <th scope="col">Date</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($stuData as $item) : ?>
            <tr>
              <th scope="row"><?php echo $item['ID']; ?></th>
              <td><?php echo $item['Name']; ?></td>
              <td><?php echo $item['Score']; ?></td>
              <td><?php echo $item['Date']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>

  </div>

</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin panel</title>
  <link rel="stylesheet" href="./style/app.css">
  <script src="./scripts/app.js"></script>
</head>
<body>
  <div class="wrapper">
    <div class="header">
      <h2>Admin panel</h2>
    </div>
    <div class="main">       
      <?php
        require_once 'login.php';
        require_once 'table.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) die($conn->connect_error);
        $query = "SELECT * FROM $table WHERE uni_id=2";
        $result = $conn->query($query);
        if (!$result) die ($conn->error);
        $rows = $result->num_rows;
      ?>
      <div class="table_cell">
        Identifier:<br>
        <input id="id" type="text" name="identifier:">
      </div>
      <div class="table_cell">
        Name:<br>
        <input id="type" type="text" name="name">
      </div>
      <div class="table_cell">
        Status:<br>
        <input id="sta" type="text" name="status">
      </div>
      <div class="table_cell">
        Description:<br>
        <input id="dsc" type="text" name="description">
      </div>
      <?php
        for ($i=0; $i < $rows; ++$i) { 
          $result->data_seek($i);
          $row = $result->fetch_array(MYSQLI_ASSOC);
          echo '<div class="table_cell">'.$row['uni_id'].'</div>';
          echo '<div class="table_cell">'. $row['Name'].'</div>';
          echo ($row['Status']) ? '<div class="table_cell">Online</div>'
          : '<div class="table_cell">Off</div>';  
          echo '<div class="table_cell">'.$row['Description'].'</div>';
        }
        $result->close;
        $conn->close;
      ?>
      <p id="id_target"></p>
      <p id="type_target"></p>
      <p id="sta_target"></p>
      <p id="dsc_target"></p>
    </div>
</body>
</html>


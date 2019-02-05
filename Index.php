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
        require_once __DIR__.'/login.php';
        require_once __DIR__.'/table.php';
        require_once __DIR__.'/functions.php';

        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) die($conn->connect_error);

        $string = "SELECT * FROM $table";
        $conditions = array();

        if (isset($_POST["name"]) || isset($_POST["description"])
            || isset($_POST["status"])) {

          if (isset($_POST["name"]) && !empty($_POST["name"])) {
            $name = mysql_entities_fix_string($conn, $_POST['name']);
            $conditions[] = "(Name LIKE '%$name%')";
          }

          if (isset($_POST["description"]) && !empty($_POST["description"])) {
            $description = mysql_entities_fix_string($conn, $_POST['description']); 
            $conditions[] = "(Description LIKE '%$description%')";
          }

          if (isset($_POST["status"])) {
            $status = $_POST['status'];
            if ($_POST["status"]!='2') {
              $conditions[] = "(Status='$status')";
            }   
          }

          $mCondition = implode( ' AND ', $conditions);

          if ($mCondition) {
            $mCondition = " WHERE " .$mCondition;
          } else $mCondition = "";
          $query = "SELECT * FROM $table" .$mCondition;
          //echo $mCondition;
        }  
  
        // if (isset($_POST["name"]) && !empty($_POST["name"]))  {
        //   $name = mysql_entities_fix_string($conn, $_POST['name']);
        //   $query = "SELECT * FROM $table WHERE (Name LIKE '%$name%')";
        // } else $query = "SELECT * FROM $table";
        
        $result = $conn->query($query);

        if (!$result) die ($conn->error);

        $rows = $result->num_rows;
      ?>
      <div class="table_cell">
        Identifier:<br>
        <input id="ind" type="text" name="identifier" form="filterform">
      </div>
      <div class="table_cell">
        Name:<br>
        <input id="name" type="text" value="<?= $name ?>" name="name" form="filterform">
      </div>
      <div class="table_cell">
        Status:<br>
        <select id="sta" name="status" form="filterform">
          <option value='2' <?php if ($status == 2) echo 'selected'; ?> >All</option>
          <option value='1' <?php if ($status == 1) echo 'selected'; ?> >Online</option>
          <option value='0' <?php if ($status == 0) echo 'selected'; ?> >Off</option>
        </select>
      </div>
      <div class="table_cell">
        Description:<br>
        <input id="dsc" type="text" value="<?= $description ?>" name="description" form="filterform">
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
      <form action="index.php" method="post" class="hiddena" id="filterform">
        <!-- <input type="text" id="ind_target" name="identifier"> -->
        <!-- <input type="text" id="name_target" name="name"> -->
        <!-- <input type="text" id="sta_target" name="status"> -->
        <!-- <input type="text" id="dsc_target" name="description"> -->
      </form>
    </div>
</body>
</html>


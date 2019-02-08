<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin panel</title>
  <link rel="stylesheet" href="./style/app.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous">
  </script>
  <script 
    type="text/javascript" 
    charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js">
  </script>
  <script src="./scripts/app.js"></script>
</head>
<body>
  <div class="wrapper">
    <div class="header">
      <h2>Admin panel</h2>
    </div>
    <div class="main">
      <?php
        require_once __DIR__.'/Connection.php';
        require_once __DIR__.'/tables.php';
        require_once __DIR__.'/functions.php';

        $dbconn = pg_connect("host=$hn dbname=$db user=$un password=$pw")
        or die('CONNECTION EROR: ' . pg_last_error());
        $query = "SELECT * FROM {$tables['pt']}";
        $result = pg_query($query) or die('QUERY ERROR: ' . pg_last_error());

      ?> 
      <table id="DomainsPG" class="display" style="width:100%">
        <thead>
          <tr>
            <th>Identifier</th>
            <th>Name</th>
            <th>Status</th>
            <th>Description</th>
          </tr>
        </thead>
        <tbody>  
          <?php  
            while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            echo "<tr>\n";
            foreach ($line as $col_value) {
              if ($col_value == 't') echo "<td>Online</td>";
              else if ($col_value == 'f') echo "<td>Offline</td>";
              else echo "<td>$col_value</td>";
            }
            echo "</tr>";
            }
            error_reporting(0);
            TableInsert($dbconn, $tables['pt'], $pt_array);
          ?>
        </tbody>    
      </table>
      <?php
        pg_free_result($result);
        pg_close($dbconn);
      ?>
    </div>
</body>
</html>


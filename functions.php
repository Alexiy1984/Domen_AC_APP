<?php
  function TableInsert($dbCon, $tableName, $asArray) {
    foreach ($asArray as $row) {
      //echo "<p>Name: {$row['name']}, State: {$row['state']}, Description: {$row['description']}</p>";
      $exists = "SELECT EXISTS ( SELECT identifier FROM $tableName WHERE 
      (name = '{$row['name']}' AND description = '{$row['description']}')  )::int";
      $res = pg_query($exists) or die('QUERY ERROR: ' . pg_last_error());
      while ($exist_row = pg_fetch_row($res)) {
        //echo $row[0];
        if ($exist_row[0] == 0) {
          $insrt = pg_insert($dbCon , $tableName , $row )
          or die('<p>QUERY ERROR: ' . pg_last_error(). '</p>');
        }
      }
    }
    pg_free_result($res);
  }
?>  

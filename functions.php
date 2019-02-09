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
          or die(ShowError(pg_last_error()));
        }
      }
    }
    pg_free_result($res);
  }

  function ShowError($errorText) {
    echo '<p class=error-message> Sorry GET : ' .$errorText. '</p>';
  }

  function InsertRow($dbCon, $tableName) {
    if (isset($_POST['name']) && !empty($_POST['name']))
    foreach ($_POST as $key => $value) {
      if ($value == 'add' && $key == 'submit') {
        $row = [];
        foreach ($_POST as $key => $value) {
          if ($key != 'submit') {
            $row[str_replace('_add' ,'', $key)] = $value;
          }
        }
        $insrt = pg_insert($dbCon , $tableName, $row) or die(ShowError(pg_last_error()));;
      } else if ($value == 'edit' && $key == 'submit') {
        echo $key .$value .' pressed';
      }
    }
  }
?>  

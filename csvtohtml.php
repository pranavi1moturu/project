$a = $_REQUEST["file"];
 $row = 0;
 if (($handle = fopen($a, "r")) !== FALSE)
  {
 echo "<table border='3'>";
     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
      {
        $num = count($data);
        echo '<tr>'; 
         for ($c=0; $c < $num; $c++)
          {
            if ($row == 0) 
            {
            echo '<th>' . $data[$c] . '</th>';
            }
            else  echo '<td>' .  $data[$c] . '</td>';
         }
     echo '</tr>';
     $row++;
     }
     echo '</table>';
     fclose($handle);
     }
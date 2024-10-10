<!DOCTYPE html>
<html>
<head>
    <title>Rounded Rectangle Bullseye</title>
</head>
<body>
<pre>
<?php
$size = 7; 
if ($size % 2 == 0 || $size < 5) {
    echo "Invalid size. Please enter an odd number greater than or equal to 5.";
} else {
    $middle = ceil($size / 2); 

    
    for ($row = 1; $row <= $size; $row++) {
      
        for ($col = 1; $col <= $size; $col++) {
        
            if ($row == 1 && $col == 1) {
                echo "/";
            }
          
            elseif ($row == 1 && $col == $size) {
                echo "\\";
            }
           
            elseif ($row == $size && $col == 1) {
                echo "\\";
            }
           
            elseif ($row == $size && $col == $size) {
                echo "/";
            }
          
            elseif ($row == $middle && $col == $middle) {
                echo "+";
            }
            
            elseif ($row == $middle) {
                echo "-";
            }
           
            elseif ($col == $middle) {
                echo "|";
            }
          
            elseif ($row == 1 || $row == $size) {
                echo "-";
            }
        
            elseif ($col == 1 || $col == $size) {
                echo "|";
            }
          
            else {
                echo " ";
            }
        }
        echo "\n"; 
    }
}
?>
</pre>
</body>
</html>

<?php

//set connection
$mysql = mysqli_connect("localhost", "root", "", "temp");

// Check connection
if($mysql === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt select query execution
$select_temp24 = "SELECT * FROM temperature WHERE temperature.timestemp > DATE_SUB(CURDATE(), INTERVAL 1 DAY)";
if($result = mysqli_query($mysql, $select_temp24)){
    if(mysqli_num_rows($result) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>id</th>";
                echo "<th>temp</th>";
                echo "<th>pic name</th>";
                echo "<th>picture</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['temp'] . "</td>";
                echo "<td>" . $row['pic'] . "</td>";
                echo "<td><img src='upload/" . $row['pic']. " ' width='200' height='200'></td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $select_temp24. " . mysqli_error($mysql);
}
 
// Close connection
mysqli_close($mysql);
?>
<?php
require('../includes/dbconnect.inc.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colleges information</title>
</head>
<body>
    <form action="" method="post">
       <h2> Select Desired Country</h2>
    <h3>
    <?php
    $query="select * from countries;";
    $result=mysqli_query($conn,$query);
    $countries=array();
    while($row=mysqli_fetch_assoc($result)){
        $countries[]=$row;
            }
    foreach($countries as $country){
        echo "<input type='radio' id='country' name='country' value='" . $country['countryname'] . "'>";
        echo "<label for='" . $country['countryname'] . "'>" . $country['countryname'] . "</label>";
    }
                
    ?>
    </h3>    
  
       <h2> Select Interested Program</h2> 
    <?php
    $query="select coursename from courses group by coursename;";
    $result=mysqli_query($conn,$query);
    $courserow=array();
    while($row=mysqli_fetch_assoc($result)){
        $courserow[]=$row;
            }
// var_dump($courserow);
    foreach($courserow as $course){
        echo "<input type='checkbox' id='" . $course['coursename'] . "' name='".$course['coursename']."' value='" . $course['coursename']."'selected >" ;
        echo "<label for='" . $course['coursename'] . "'>" . $course['coursename'] . "</label>";
            }
    ?>
    <button type="submit">Search</button>
    </form>
    <table border="1px">
    <thead>
        <th>Country</th>
        <th>College Name</th>
        <th>City</th>
        <th>Course Name</th>
        <th>Level</th>
        <th>Course Duration</th>
        <th>Apply</th>
    </thead>   
    <tbody> 
<?php
// for ($i = 0; $i < count($row); $i++) {
//     echo "<tr>";
//     for ($j = 0; $j <= count($row[$i]); $j++) {
//         echo "<td>" . $row[$i][$j] . "</td>";
        
//     }
//     echo "<td><button>Apply</button></td>";
//     echo "</tr>";
// }
?>
    </tbody>

</table>
 </body>
</html>
<?php
if(isset($_POST['country'])){
    $country=$_POST['country'];
    $query="select * from colleges where country='$country';";
    $result=mysqli_query($conn,$query);
    $colleges=array();
    while($row=mysqli_fetch_assoc($result)){
        $colleges[]=$row;
    }
    foreach($colleges as $college){
        echo "<tr>";
        echo "<td>" . $college['country'] . "</td>";
        echo "<td>" . $college['collegename'] . "</td>";
        echo "<td>" . $college['city'] . "</td>";
        // // echo "<td>" . $college['coursename'] . "</td>";
        // echo "<td>" . $college['level'] . "</td>";
        // echo "<td>" . $college['duration'] . "</td>";
        echo "<td><button>Apply</button></td>";
        echo "</tr>";
    }
}
?>

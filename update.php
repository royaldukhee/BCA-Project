<?php
isset($_POST['name']) &&

isset($_POST['email']) &&

isset($_POST['gender']) &&

isset($_POST['id']);

echo($_POST['name']);
echo($_POST['email']);
echo($_POST['gender']);

$connection=mysqli_connect('localhost','root','','jhamkanath');
if($connection->connect_error){
    echo "connection error: " .$connection->connect_error;

}
else{
$query ="update users set name =?,gender=?, email=? where id =?";
$stmt =$connection->prepare($query);
$stmt->bind_param('sssi',$name,$gender,$email,$id);
$stmt->execute();
header("Location:/index.php");
}
?>
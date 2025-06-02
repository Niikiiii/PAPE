<?php 
require_once "db.php";
if (isset($_POST["id"])){
$e=$_POST["id"];
$sql="DELETE FROM equipamentos WHERE Equipamentos.idEquipamento = $e";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
    } else {
    echo "Error deleting record: " . $conn->error;
    }
    $conn->close();
    header('Location:	tables.php');

}

?>
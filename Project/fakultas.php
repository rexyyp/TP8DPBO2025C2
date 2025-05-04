<?php
include_once("views/Template.class.php");
include_once("models/DB.class.php");
include_once("controllers/Fakultas.controller.php");

$fakultas = new FakultasController;

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['add'])) {
    // Handling data add
    $data = $_POST;
    $fakultas->add($data);
} 
else if (isset($_POST['update'])) {
    // Handling data update
    $id = $_POST['id'];
    $data = $_POST;
    $fakultas->update($id, $data);
}
else if (!empty($_GET['id_hapus'])) {
    // Handling data delete
    $id = $_GET['id_hapus'];
    $fakultas->delete($id);
} 
else if (!empty($_GET['id_edit'])) {
    // Handling edit form display
    $id = $_GET['id_edit'];
    $fakultas->edit($id);
} 
else {
    // Default view
    $fakultas->index();
}
?>
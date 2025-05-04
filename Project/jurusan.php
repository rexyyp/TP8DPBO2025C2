<?php
include_once("views/Template.class.php");
include_once("models/DB.class.php");
include_once("controllers/Jurusan.controller.php");

$jurusan = new JurusanController;

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['add'])) {
    // Handling data add
    $data = $_POST;
    $jurusan->add($data);
} 
else if (isset($_POST['update'])) {
    // Handling data update
    $id = $_POST['id'];
    $data = $_POST;
    $jurusan->update($id, $data);
}
else if (!empty($_GET['id_hapus'])) {
    // Handling data delete
    $id = $_GET['id_hapus'];
    $jurusan->delete($id);
} 
else if (!empty($_GET['id_edit'])) {
    // Handling edit form display
    $id = $_GET['id_edit'];
    $jurusan->edit($id);
} 
else {
    // Default view
    $jurusan->index();
}
?>
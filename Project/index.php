<?php
include_once("views/Template.class.php");
include_once("models/DB.class.php");
include_once("controllers/Mahasiswa.controller.php");

$mahasiswa = new MahasiswaController;

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

if (isset($_POST['add'])) {
    // Handling data add
    $data = $_POST;
    $mahasiswa->add($data);
} 
else if (isset($_POST['update'])) {
    // Handling data update
    $nim = $_POST['nim'];
    $data = $_POST;
    $mahasiswa->update($nim, $data);
}
else if (!empty($_GET['id_hapus'])) {
    // Handling data delete
    $nim = $_GET['id_hapus'];
    $mahasiswa->delete($nim);
} 
else if (!empty($_GET['id_edit'])) {
    // Handling edit form display
    $nim = $_GET['id_edit'];
    $mahasiswa->edit($nim);
} 
else {
    // Default view
    $mahasiswa->index();
}
?>
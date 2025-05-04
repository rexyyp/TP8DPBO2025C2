<?php
include_once("conf.php");
include_once("models/Fakultas.class.php");
include_once("views/Fakultas.view.php");

class FakultasController
{
  // Properti controller
  private $fakultas;

  // Konstruktor controller Fakultas
  function __construct()
  {
    $this->fakultas = new Fakultas(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
  }

  // Method utama menampilkan semua data fakultas
  public function index()
  {
    // Buka koneksi ke database
    $this->fakultas->open();

    // Ambil data fakultas
    $this->fakultas->getFakultas();

    // Simpan data ke array
    $data = array();
    while ($row = $this->fakultas->getResult()) {
      array_push($data, $row);
    }

    // Tutup koneksi
    $this->fakultas->close();

    // Tampilkan ke view
    $view = new FakultasView();
    $view->render($data);
  }

  // Menampilkan form edit dengan data fakultas yang dipilih
  function edit($id)
  {
    // Buka koneksi
    $this->fakultas->open();
    
    // Ambil semua data fakultas untuk tabel
    $this->fakultas->getFakultas();
    $data = array();
    while ($row = $this->fakultas->getResult()) {
      array_push($data, $row);
    }
    
    // Ambil data fakultas yang akan diedit
    $this->fakultas->getFakultasById($id);
    $editData = $this->fakultas->getResult();
    
    // Tutup koneksi
    $this->fakultas->close();
    
    // Tampilkan ke view dengan mode edit
    $view = new FakultasView();
    $view->render($data, $editData);
  }

  // Tambah data fakultas
  function add($data)
  {
    $this->fakultas->open();
    $this->fakultas->add($data);
    $this->fakultas->close();

    header("location:fakultas.php");
  }

  // Proses update data fakultas
  function update($id, $data)
  {
    $this->fakultas->open();
    $this->fakultas->edit($id, $data);
    $this->fakultas->close();

    header("location:fakultas.php");
  }

  // Hapus data fakultas
  function delete($id)
  {
    $this->fakultas->open();
    $this->fakultas->delete($id);
    $this->fakultas->close();

    header("location:fakultas.php");
  }
}
?>
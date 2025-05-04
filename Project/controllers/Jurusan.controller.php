<?php
include_once("conf.php");
include_once("models/Jurusan.class.php");
include_once("models/Fakultas.class.php");
include_once("views/Jurusan.view.php");

class JurusanController
{
  // Properti controller
  private $jurusan;
  private $fakultas;

  // Konstruktor controller Jurusan
  function __construct()
  {
    $this->jurusan = new Jurusan(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
    $this->fakultas = new Fakultas(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
  }

  // Method utama menampilkan semua data jurusan
  public function index()
  {
    // Buka koneksi ke database
    $this->jurusan->open();

    // Ambil data jurusan
    $this->jurusan->getJurusan();

    // Simpan data ke array
    $data = array();
    while ($row = $this->jurusan->getResult()) {
      array_push($data, $row);
    }

    // Tutup koneksi
    $this->jurusan->close();

    // Ambil fakultas dari database untuk option
    $this->fakultas->open();
    $this->fakultas->getFakultas();

    $fakultasData = array();
    while ($row = $this->fakultas->getResult()) {
      array_push($fakultasData, $row);
    }

    $this->fakultas->close();

    // Tampilkan ke view
    $view = new JurusanView();
    $view->render($data, $fakultasData);
  }

  // Menampilkan form edit dengan data jurusan yang dipilih
  function edit($id)
  {
    // Buka koneksi
    $this->jurusan->open();
    
    // Ambil semua data jurusan untuk tabel
    $this->jurusan->getJurusan();
    $data = array();
    while ($row = $this->jurusan->getResult()) {
      array_push($data, $row);
    }
    
    // Ambil data jurusan yang akan diedit
    $query = "SELECT * FROM jurusan WHERE id = '$id'";
    $this->jurusan->execute($query);
    $editData = $this->jurusan->getResult();
    
    // Tutup koneksi
    $this->jurusan->close();
    
    // Ambil data fakultas untuk dropdown
    $this->fakultas->open();
    $this->fakultas->getFakultas();
    
    $fakultasData = array();
    while ($row = $this->fakultas->getResult()) {
      array_push($fakultasData, $row);
    }
    $this->fakultas->close();
    
    // Tampilkan ke view dengan mode edit
    $view = new JurusanView();
    $view->render($data, $fakultasData, $editData);
  }

  // Tambah data jurusan
  function add($data)
  {
    $this->jurusan->open();
    $this->jurusan->add($data);
    $this->jurusan->close();

    header("location:jurusan.php");
  }

  // Proses update data jurusan
  function update($id, $data)
  {
    $this->jurusan->open();
    $this->jurusan->edit($id, $data);
    $this->jurusan->close();

    header("location:jurusan.php");
  }

  // Hapus data jurusan
  function delete($id)
  {
    $this->jurusan->open();
    $this->jurusan->delete($id);
    $this->jurusan->close();

    header("location:jurusan.php");
  }
}
?>
<?php
include_once("conf.php");
include_once("models/Mahasiswa.class.php");
include_once("models/Jurusan.class.php");
include_once("views/Mahasiswa.view.php");

class MahasiswaController
{
  // Properti controller
  private $mahasiswa;
  private $jurusan;

  // Konstruktor controller Mahasiswa
  function __construct()
  {
    $this->mahasiswa = new Mahasiswa(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
    $this->jurusan = new Jurusan(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
  }

  // Method utama menampilkan semua data mahasiswa
  public function index()
  {
    // Buka koneksi ke database
    $this->mahasiswa->open();

    // Ambil data mahasiswa
    $this->mahasiswa->getMahasiswa();

    // Simpan data ke array
    $data = array();
    while ($row = $this->mahasiswa->getResult()) {
      array_push($data, $row);
    }

    // Tutup koneksi
    $this->mahasiswa->close();

    // Ambil jurusan dari database untuk option
    $this->jurusan->open();
    $this->jurusan->getJurusan();

    $jurusanData = array();
    while ($row = $this->jurusan->getResult()) {
      array_push($jurusanData, $row);
    }

    $this->jurusan->close();

    // Tampilkan ke view
    $view = new MahasiswaView();
    $view->render($data, $jurusanData);
  }

  // Menampilkan form edit dengan data mahasiswa yang dipilih
  function edit($nim)
  {
    // Buka koneksi
    $this->mahasiswa->open();
    
    // Ambil data mahasiswa
    $this->mahasiswa->getMahasiswa();
    $data = array();
    while ($row = $this->mahasiswa->getResult()) {
      array_push($data, $row);
    }
    
    // Ambil data mahasiswa yang akan diedit
    $this->mahasiswa->getMahasiswaByNIM($nim);
    $editData = $this->mahasiswa->getResult();
    
    // Tutup koneksi
    $this->mahasiswa->close();
    
    // Ambil data jurusan untuk dropdown
    $this->jurusan->open();
    $this->jurusan->getJurusan();
    
    $jurusanData = array();
    while ($row = $this->jurusan->getResult()) {
      array_push($jurusanData, $row);
    }
    $this->jurusan->close();
    
    // Tampilkan ke view dengan mode edit
    $view = new MahasiswaView();
    $view->render($data, $jurusanData, $editData);
  }

  // Proses update data mahasiswa
  function update($nim, $data)
  {
    $this->mahasiswa->open();
    $this->mahasiswa->edit($nim, $data);
    $this->mahasiswa->close();

    header("location:index.php");
  }

  // Tambah data mahasiswa
  function add($data)
  {
    $this->mahasiswa->open();
    $this->mahasiswa->add($data);
    $this->mahasiswa->close();

    header("location:index.php");
  }

  // Hapus data mahasiswa
  function delete($nim)
  {
    $this->mahasiswa->open();
    $this->mahasiswa->delete($nim);
    $this->mahasiswa->close();

    header("location:index.php");
  }
}
?>
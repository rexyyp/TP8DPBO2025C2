<?php

class Mahasiswa extends DB
{
    public function getMahasiswa()
    {
        $query = "SELECT m.nim, m.nama_mahasiswa, m.telepon, m.tanggal_masuk, j.nama_jurusan 
                 FROM mahasiswa m JOIN jurusan j ON m.id_jurusan = j.id";
        return $this->execute($query);
    }

    public function getMahasiswaByNIM($nim)
    {
        $query = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
        return $this->execute($query);
    }

    public function add($data)
    {
        $nim = $data['nim'];
        $nama = $data['nama_mahasiswa'];
        $telepon = $data['telepon'];
        $tanggal_masuk = $data['tanggal_masuk'];
        $id_jurusan = $data['id_jurusan'];

        $query = "INSERT INTO mahasiswa values ('$nim', '$nama', '$telepon', '$tanggal_masuk', '$id_jurusan')";
        return $this->execute($query);
    }

    public function edit($nim, $data)
    {
        $nama = $data['nama_mahasiswa'];
        $telepon = $data['telepon'];
        $tanggal_masuk = $data['tanggal_masuk'];
        $id_jurusan = $data['id_jurusan'];

        $query = "UPDATE mahasiswa 
                  SET nama_mahasiswa = '$nama', 
                      telepon = '$telepon', 
                      tanggal_masuk = '$tanggal_masuk', 
                      id_jurusan = '$id_jurusan' 
                  WHERE nim = '$nim'";
                  
        return $this->execute($query);
    }

    public function delete($nim)
    {
        $query = "DELETE FROM mahasiswa WHERE nim = '$nim'";
        return $this->execute($query);
    }
}
?>
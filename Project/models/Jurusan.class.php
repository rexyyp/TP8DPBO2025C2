<?php

class Jurusan extends DB
{
    // Ambil semua data jurusan
    function getJurusan()
    {
        $query = "SELECT * FROM jurusan";
        return $this->execute($query);
    }

    // Tambah jurusan baru
    function add($data)
    {
        $nama_jurusan = $data['nama_jurusan'];
        $id_fakultas = $data['id_fakultas'];

        $query = "INSERT INTO jurusan values ('', '$nama_jurusan', '$id_fakultas')";
        return $this->execute($query);
    }

    // Hapus jurusan berdasarkan ID
    function delete($id)
    {
        $query = "DELETE FROM jurusan WHERE id = '$id'";
        return $this->execute($query);
    }

    // Edit data jurusan
    function edit($id, $data)
    {
        $nama_jurusan = $data['nama_jurusan'];
        $id_fakultas = $data['id_fakultas'];
        
        $query = "UPDATE jurusan SET nama_jurusan = '$nama_jurusan', id_fakultas = '$id_fakultas' WHERE id = '$id'";
        return $this->execute($query);
    }
}
?>

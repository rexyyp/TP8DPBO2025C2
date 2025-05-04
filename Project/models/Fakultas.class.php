<?php

class Fakultas extends DB
{
    // Ambil semua data fakultas
    function getFakultas()
    {
        $query = "SELECT * FROM fakultas";
        return $this->execute($query);
    }

    // Ambil data fakultas berdasarkan ID
    function getFakultasById($id)
    {
        $query = "SELECT * FROM fakultas WHERE id = '$id'";
        return $this->execute($query);
    }

    // Tambah fakultas baru
    function add($data)
    {
        $nama_fakultas = $data['nama_fakultas'];

        $query = "INSERT INTO fakultas values ('', '$nama_fakultas')";
        return $this->execute($query);
    }

    // Hapus fakultas berdasarkan ID
    function delete($id)
    {
        $query = "DELETE FROM fakultas WHERE id = '$id'";
        return $this->execute($query);
    }

    // Edit data fakultas
    function edit($id, $data)
    {
        $nama_fakultas = $data['nama_fakultas'];
        
        $query = "UPDATE fakultas SET nama_fakultas = '$nama_fakultas' WHERE id = '$id'";
        return $this->execute($query);
    }
}
?>
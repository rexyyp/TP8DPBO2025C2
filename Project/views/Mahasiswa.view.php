<?php
class MahasiswaView
{
    public function render($data, $jurusanData, $editData = null)
    {
        $no = 1;
        $dataMahasiswa = null;

        // Tampilkan data mahasiswa
        foreach ($data as $row) {
            list($nim, $nama_mahasiswa, $telepon, $tanggal_masuk, $id_jurusan) = $row;

            $dataMahasiswa .= "<tr>
                        <td>" . $no++ . "</td>
                        <td>" . $nim . "</td>
                        <td>" . $nama_mahasiswa . "</td>
                        <td>" . $telepon . "</td>
                        <td>" . $tanggal_masuk . "</td>
                        <td>" . $id_jurusan . "</td>
                        <td>
                        <a href='index.php?id_edit=" . $nim .  "' class='btn btn-warning'>Edit</a>
                        <a href='index.php?id_hapus=" . $nim . "' class='btn btn-danger'>Hapus</a>
                        </td>
                        </tr>";
        }

        // Bangun dropdown jurusan
        $dropdownJurusan = null;
        foreach ($jurusanData as $jurusan) {
            $selected = "";
            $id = $jurusan[0]; // Assuming first column is id_jurusan
            $nama_jurusan = $jurusan['nama_jurusan'];
            
            // If in edit mode and this is the selected jurusan
            if ($editData && $id == $editData['id_jurusan']) {
                $selected = "selected";
            }

            $dropdownJurusan .= "<option value='" . $id . "' " . $selected . ">" . $nama_jurusan . "</option>";
        }

        // Set form action based on edit mode
        $formAction = "index.php";
        $submitButton = "<button type='submit' name='add' class='btn btn-success w-100'>Add</button>";
        $formTitle = "Add Mahasiswa";
        $nimField = "<input type='text' class='form-control' id='nim' name='nim' required>";
        $namaMahasiswa = "";
        $telepon = "";
        $tanggalMasuk = "";

        // If in edit mode, change form to update mode
        if ($editData) {
            $formAction = "index.php?action=update";
            $submitButton = "<button type='submit' name='update' class='btn btn-primary w-100'>Update</button>";
            $formTitle = "Edit Mahasiswa";
            $namaMahasiswa = $editData['nama_mahasiswa'];
            $telepon = $editData['telepon'];
            $tanggalMasuk = $editData['tanggal_masuk'];
            // Make NIM field readonly in edit mode and keep original value in hidden field
            $nimField = "<input type='text' class='form-control' id='nim' value='" . $editData['nim'] . "' readonly>
                        <input type='hidden' name='nim' value='" . $editData['nim'] . "'>";
        }

        // Render template and replace placeholders
        $tpl = new Template("templates/mahasiswa.html");
        $tpl->replace("JUDUL", "Mahasiswa");
        $tpl->replace("DATA_TABEL", $dataMahasiswa);
        $tpl->replace("DROPDOWN_JURUSAN", $dropdownJurusan);
        $tpl->replace("FORM_TITLE", $formTitle);
        $tpl->replace("FORM_ACTION", $formAction);
        $tpl->replace("NIM_FIELD", $nimField);
        $tpl->replace("NAMA_MAHASISWA", $namaMahasiswa);
        $tpl->replace("TELEPON", $telepon);
        $tpl->replace("TANGGAL_MASUK", $tanggalMasuk);
        $tpl->replace("SUBMIT_BUTTON", $submitButton);
        $tpl->write();
    }
}
?>
<?php
class JurusanView
{
    public function render($data, $fakultasData, $editData = null)
    {
        $no = 1;
        $dataJurusan = null;

        // Tampilkan data jurusan
        foreach ($data as $row) {
            $id = $row['id'];
            $nama_jurusan = $row['nama_jurusan'];
            $id_fakultas = $row['id_fakultas'];

            // Cari nama fakultas berdasarkan id_fakultas
            $nama_fakultas = '';
            foreach ($fakultasData as $fakultas) {
                if ($fakultas['id'] == $id_fakultas) {
                    $nama_fakultas = $fakultas['nama_fakultas'];
                    break;
                }
            }

            $dataJurusan .= "<tr>
                        <td>" . $no++ . "</td>
                        <td>" . $nama_jurusan . "</td>
                        <td>" . $nama_fakultas . "</td>
                        <td>
                        <a href='jurusan.php?id_edit=" . $id .  "' class='btn btn-warning'>Edit</a>
                        <a href='jurusan.php?id_hapus=" . $id . "' class='btn btn-danger'>Hapus</a>
                        </td>
                        </tr>";
        }

        // Bangun dropdown fakultas
        $dropdownFakultas = null;
        foreach ($fakultasData as $fakultas) {
            $selected = "";
            $id = $fakultas['id'];
            $nama_fakultas = $fakultas['nama_fakultas'];
            
            // If in edit mode and this is the selected fakultas
            if ($editData && $id == $editData['id_fakultas']) {
                $selected = "selected";
            }

            $dropdownFakultas .= "<option value='" . $id . "' " . $selected . ">" . $nama_fakultas . "</option>";
        }

        // Set form action based on edit mode
        $formAction = "jurusan.php";
        $submitButton = "<button type='submit' name='add' class='btn btn-success w-100'>Add</button>";
        $formTitle = "Add Jurusan";
        $namaJurusan = "";
        $idField = "";

        // If in edit mode, change form to update mode
        if ($editData) {
            $formAction = "jurusan.php?action=update";
            $submitButton = "<button type='submit' name='update' class='btn btn-primary w-100'>Update</button>";
            $formTitle = "Edit Jurusan";
            $namaJurusan = $editData['nama_jurusan'];
            $idField = "<input type='hidden' name='id' value='" . $editData['id'] . "'>";
        }

        // Render template and replace placeholders
        $tpl = new Template("templates/jurusan.html");
        $tpl->replace("JUDUL", "Jurusan");
        $tpl->replace("DATA_TABEL", $dataJurusan);
        $tpl->replace("DROPDOWN_FAKULTAS", $dropdownFakultas);
        $tpl->replace("FORM_TITLE", $formTitle);
        $tpl->replace("FORM_ACTION", $formAction);
        $tpl->replace("NAMA_JURUSAN", $namaJurusan);
        $tpl->replace("ID_FIELD", $idField);
        $tpl->replace("SUBMIT_BUTTON", $submitButton);
        $tpl->write();
    }
}
?>
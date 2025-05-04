<?php
class FakultasView
{
    public function render($data, $editData = null)
    {
        $no = 1;
        $dataFakultas = null;

        // Tampilkan data fakultas
        foreach ($data as $row) {
            $id = $row['id'];
            $nama_fakultas = $row['nama_fakultas'];

            $dataFakultas .= "<tr>
                        <td>" . $no++ . "</td>
                        <td>" . $nama_fakultas . "</td>
                        <td>
                        <a href='fakultas.php?id_edit=" . $id .  "' class='btn btn-warning'>Edit</a>
                        <a href='fakultas.php?id_hapus=" . $id . "' class='btn btn-danger'>Hapus</a>
                        </td>
                        </tr>";
        }

        // Set form action based on edit mode
        $formAction = "fakultas.php";
        $submitButton = "<button type='submit' name='add' class='btn btn-success'>Add</button>";
        $formTitle = "Add Fakultas";
        $namaFakultas = "";
        $idField = "";

        // If in edit mode, change form to update mode
        if ($editData) {
            $formAction = "fakultas.php?action=update";
            $submitButton = "<button type='submit' name='update' class='btn btn-primary'>Update</button>";
            $formTitle = "Edit Fakultas";
            $namaFakultas = $editData['nama_fakultas'];
            $idField = "<input type='hidden' name='id' value='" . $editData['id'] . "'>";
        }

        // Render template and replace placeholders
        $tpl = new Template("templates/fakultas.html");
        $tpl->replace("JUDUL", "Fakultas");
        $tpl->replace("DATA_TABEL", $dataFakultas);
        $tpl->replace("FORM_TITLE", $formTitle);
        $tpl->replace("FORM_ACTION", $formAction);
        $tpl->replace("NAMA_FAKULTAS", $namaFakultas);
        $tpl->replace("ID_FIELD", $idField);
        $tpl->replace("SUBMIT_BUTTON", $submitButton);
        $tpl->write();
    }
}
?>
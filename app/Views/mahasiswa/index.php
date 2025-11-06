<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
</head>
<body>

<h2>Data Mahasiswa</h2>

<form id="formTambah">
    <input type="text" name="nama" placeholder="Nama">
    <input type="text" name="nim" placeholder="NIM">
    <select name="id_jurusan">
        <option value="1">Informatika</option>
        <option value="2">Sistem Informasi</option>
        <option value="3">Teknik Komputer</option>
    </select>
    <button type="submit">Tambah</button>
</form>

<hr>

<table id="tabelMahasiswa" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Jurusan</th>
            <th>Aksi</th>
        </tr>
    </thead>
</table>

<script>
$(document).ready(function() {
    var table = $('#tabelMahasiswa').DataTable({
        ajax: '<?= base_url('mahasiswa/getData') ?>',
        columns: [
            { data: 'id_mahasiswa' },
            { data: 'nama' },
            { data: 'nim' },
            { data: 'nama_jurusan' },
            {
                data: null,
                render: function(data) {
                    return `<button onclick="hapus(${data.id_mahasiswa})">Hapus</button>`;
                }
            }
        ]
    });

    $('#formTambah').on('submit', function(e) {
        e.preventDefault();
        $.post('<?= base_url('mahasiswa/add') ?>', $(this).serialize(), function() {
            table.ajax.reload();
        });
    });
});

function hapus(id) {
    $.get('<?= base_url('mahasiswa/delete/') ?>' + id, function() {
        $('#tabelMahasiswa').DataTable().ajax.reload();
    });
}
</script>

</body>
</html>

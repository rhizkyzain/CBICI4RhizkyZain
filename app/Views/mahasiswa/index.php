<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="container py-4">

<h2 class="mb-4">Data Mahasiswa</h2>

<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalMahasiswa" id="btnTambah">
    Tambah Mahasiswa
</button>

<table id="tabelMahasiswa" class="table table-striped table-bordered">
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

<!-- Modal Tambah/Edit -->
<div class="modal fade" id="modalMahasiswa" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formMahasiswa">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitle">Tambah Mahasiswa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id_mahasiswa" id="id_mahasiswa">
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" id="nama" required>
            </div>
            <div class="mb-3">
                <label>NIM</label>
                <input type="text" class="form-control" name="nim" id="nim" required>
            </div>
            <div class="mb-3">
                <label>Jurusan</label>
                <select class="form-select" name="id_jurusan" id="id_jurusan" required>
                    <option value="">-- Pilih Jurusan --</option>
                    <option value="1">Informatika</option>
                    <option value="2">Sistem Informasi</option>
                    <option value="3">Teknik Komputer</option>
                </select>
            </div>
            <div id="errorMessage" class="text-danger"></div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    var table = $('#tabelMahasiswa').DataTable({
        ajax: '<?= base_url("mahasiswa/getData") ?>',
        columns: [
            { data: 'id_mahasiswa' },
            { data: 'nama' },
            { data: 'nim' },
            { data: 'nama_jurusan' },
            {
                data: null,
                render: function(data) {
                    return `
                        <button class="btn btn-warning btn-sm me-1" onclick="editData(${data.id_mahasiswa})">Edit</button>
                        <button class="btn btn-danger btn-sm" onclick="hapus(${data.id_mahasiswa})">Hapus</button>
                    `;
                }
            }
        ],
        responsive: true
    });

    // Reset modal saat klik tombol tambah
    $('#btnTambah').on('click', function() {
        $('#modalTitle').text('Tambah Mahasiswa');
        $('#formMahasiswa')[0].reset();
        $('#id_mahasiswa').val('');
        $('#errorMessage').text('');
    });

    // Submit tambah/edit
    $('#formMahasiswa').on('submit', function(e) {
        e.preventDefault();
        $('#errorMessage').text('');
        $.post('<?= base_url("mahasiswa/save") ?>', $(this).serialize(), function(res) {
            if(res.status === 'error') {
                $('#errorMessage').text(res.message);
            } else {
                table.ajax.reload();
                var modalEl = document.getElementById('modalMahasiswa');
                var modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();
                $('#formMahasiswa')[0].reset();
            }
        }, 'json');
    });
});

function hapus(id) {
    if(confirm('Apakah yakin ingin menghapus data ini?')) {
        $.get('<?= base_url("mahasiswa/delete/") ?>' + id, function() {
            $('#tabelMahasiswa').DataTable().ajax.reload();
        });
    }
}

function editData(id) {
    $.get('<?= base_url("mahasiswa/get/") ?>' + id, function(res) {
        $('#modalTitle').text('Edit Mahasiswa');
        $('#id_mahasiswa').val(res.id_mahasiswa);
        $('#nama').val(res.nama);
        $('#nim').val(res.nim);
        $('#id_jurusan').val(res.id_jurusan);
        var modalEl = document.getElementById('modalMahasiswa');
        var modal = new bootstrap.Modal(modalEl);
        modal.show();
    }, 'json');
}
</script>

</body>
</html>

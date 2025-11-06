<?php

namespace App\Models;
use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'Mahasiswa';
    protected $primaryKey = 'id_mahasiswa';
    protected $allowedFields = ['nama', 'nim', 'id_jurusan'];

    // JOIN example
    public function getMahasiswaWithJurusan()
    {
        return $this->select('Mahasiswa.*, Jurusan.nama_jurusan')
                    ->join('Jurusan', 'Jurusan.id_jurusan = Mahasiswa.id_jurusan')
                    ->findAll();
    }
}

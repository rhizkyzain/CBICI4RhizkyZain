<?php

namespace App\Models;
use CodeIgniter\Model;

class JurusanModel extends Model
{
    protected $table = 'Jurusan';
    protected $primaryKey = 'id_jurusan';
    protected $allowedFields = ['nama_jurusan'];
}

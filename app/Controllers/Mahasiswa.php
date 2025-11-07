<?php

namespace App\Controllers;
use App\Models\MahasiswaModel;
use App\Models\JurusanModel;

class Mahasiswa extends BaseController
{
    protected $mahasiswaModel;
    protected $jurusanModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
        $this->jurusanModel = new JurusanModel();
    }

    public function index()
    {
        return view('mahasiswa/index');
    }

    public function getData()
    {
        $data = $this->mahasiswaModel->getMahasiswaWithJurusan();
        return $this->response->setJSON(['data' => $data]);
    }

    public function add()
    {
        $this->mahasiswaModel->save([
            'nama' => $this->request->getPost('nama'),
            'nim' => $this->request->getPost('nim'),
            'id_jurusan' => $this->request->getPost('id_jurusan')
        ]);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function delete($id)
    {
        $this->mahasiswaModel->delete($id);
        return $this->response->setJSON(['status' => 'deleted']);
    }
    public function save()
{
    $id = $this->request->getPost('id_mahasiswa');
    $nama = $this->request->getPost('nama');
    $nim = $this->request->getPost('nim');
    $id_jurusan = $this->request->getPost('id_jurusan');

    $existing = $this->mahasiswaModel
                     ->where('nim', $nim)
                     ->orWhere('nama', $nama);

    if($id) {
        $existing->where('id_mahasiswa !=', $id);
    }

    $existing = $existing->first();

    if($existing) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'NIM atau Nama sudah ada.'
        ]);
    }

    $this->mahasiswaModel->save([
        'id_mahasiswa' => $id,
        'nama' => $nama,
        'nim' => $nim,
        'id_jurusan' => $id_jurusan
    ]);

    return $this->response->setJSON(['status' => 'success']);
}

public function get($id)
{
    $data = $this->mahasiswaModel->find($id);
    return $this->response->setJSON($data);
}


}

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
}

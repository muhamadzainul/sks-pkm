<?php

namespace App\Controllers\Admin;

use App\Models\Model_kapus;
use App\Controllers\BaseController;

class Kapus extends BaseController
{
    protected $db;
    protected $kapusBuilder;
    protected $kapusModel;
    public function __construct()
    {
        $this->kapusModel   = new Model_kapus();
        $this->db           = \Config\Database::connect();
        $this->kapusBuilder = $this->db->table('kapus');
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
        // $data_kapus = $this->kapusModel->findAll();

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $kapus = $this->kapusModel->search($keyword);
        } else {
            $kapus = $this->kapusModel;
        }

        $data = [
      // 'data_kapus' => $data_kapus
        'title'       => 'Data Kapus',
        'data_kapus'  => $kapus->paginate(4),
        'pager'       => $this->kapusModel->pager,
        'currentPage' => $currentPage
     ];
        return view('/administrator/data_kapus', $data);
    }

    public function simpan()
    {

      // // Form Validasi
        //   if (!$this->validate([
        //     'nip_kapus' => [
        //       'rules' => 'required|is_unique[kapus.nip_kapus]',
        //       'errors' => [
        //         'required' => 'NIK kapus harus di isi',
        //         'is_unique' => 'NIK kapus sudah terdaftar'
        //       ]
        //     ]
        //   ])) {
        //       // $valid = \Config\Services::validation();
        //       // return redirect()->to('/data_kapus/tambah_data_kapus')->withInput()->with('Validation', $valid);
        //       return redirect()->to('/admin/data_kapus/tambah_data_kapus')->withInput();
        //   }



        $slug = url_title($this->request->getVar('nip_kapus').'-'.$this->request->getVar('nama_kapus'), '-', true);

        $this->kapusBuilder->select('id_kapus, nama_kapus, nip_kapus, active');
        $this->kapusBuilder->where('nip_kapus', $this->request->getVar('nip_kapus'));
        $query = $this->kapusBuilder->get();
        $nip_kp = $query->getResultArray();
        if ($nip_kp[0] == 0) {
            // dd('yes');
            $data=[
            'nama_kapus'  => $this->request->getVar('nama_kapus'),
            'slug'        => $slug,
            'nip_kapus'   => $this->request->getVar('nip_kapus'),
            'active'  => 1
            ];
            // $this->kapusModel->insert([
            //   'nama_kapus' => $this->request->getVar('nama_kapus'),
            //   'slug' => $slug,
            //   'nip_kapus' => $nip_kapus,
            //   'active' => 1
            // ]);
            $this->kapusBuilder->insert($data);
        } else {
            // dd('no');
            $nip_kapus = $nip_kp[0]['nip_kapus'];
            $active = $nip_kp[0]['active'];

            if ($nip_kapus == $this->request->getVar('nip_kapus')) {
                // dd('yes');
                if ($active == 0) {
                    // dd('yes');
                    $nama_kapus = $nip_kp[0]['nama_kapus'];

                    if ($nama_kapus == $this->request->getVar('nama_kapus')) {
                        // dd('yes');
                        $id = $nip_kp['0']['id_kapus'];

                        $data = [
                            'active' => 1
                          ];
                        $this->kapusBuilder->where('id_kapus', $id);
                        $this->kapusBuilder->update($data);
                    } else {
                        // dd('no');
                        $id = $nip_kp['0']['id_kapus'];

                        $data = [
                            'nama_kapus' => $this->request->getVar('nama_kapus'),
                            'active' => 1
                        ];
                        $this->kapusBuilder->where('id_kapus', $id);
                        $this->kapusBuilder->update($data);
                    }
                } else {
                    // dd('no');
                    $data=[
                      'nama_kapus' => $this->request->getVar('nama_kapus'),
                      'slug' => $slug,
                      'nip_kapus' => $nip_kapus,
                      'active'  => 1
                        ];
                    // $this->kapusModel->insert([
                    //   'nama_kapus' => $this->request->getVar('nama_kapus'),
                    //   'slug' => $slug,
                    //   'nip_kapus' => $nip_kapus,
                    //   'active' => 1
                    // ]);
                    $this->kapusBuilder->replace($data);
                }
            } else {
                // dd('no');
                if ($active == 1) {
                    // dd('yes');
                    $data = [
                        'active' => 0
                      ];
                    $this->kapusBuilder->where('id_kapus', $id);
                    $this->kapusBuilder->update($data);
                }
                $data=[
                'nama_kapus'  => $this->request->getVar('nama_kapus'),
                'slug'        => $slug,
                'nip_kapus'   => $this->request->getVar('nip_kapus'),
                'active'  => 1
                ];
                // $this->kapusModel->insert([
                //   'nama_kapus' => $this->request->getVar('nama_kapus'),
                //   'slug' => $slug,
                //   'nip_kapus' => $nip_kapus,
                //   'active' => 1
                // ]);
                $this->kapusBuilder->insert($data);
            }
            // code...
        }



        session()->setFLashdata('pesan', 'Tambahkan');

        return redirect()->to('/admin/kapus');
    }


    public function hapus_data($slug)
    {
        // cari nama gambar berdasarkan id
        // $kapus_data = $this->kapusModel->find($id);
        $this->kapusBuilder->select('id_kapus, active');
        $this->kapusBuilder->where('slug', $slug);
        $query = $this->kapusBuilder->get();

        // dd($query);
        $id_kapus = $query->getResultArray();
        $id = $id_kapus['0']['id_kapus'];

        $data = [
          'active' => 0
        ];
        $this->kapusBuilder->where('id_kapus', $id);
        $this->kapusBuilder->update($data);
        $queryUpdate = $this->kapusBuilder->get();

        // dd($queryUpdate);

        // dd($id_kapus['0']['id_kapus']);
        // $this->kapusModel->delete($id_kapus['0']['id_kapus']);

        session()->setFLashdata('pesan', 'Hapus');
        return redirect()->to('/admin/kapus');
    }
}

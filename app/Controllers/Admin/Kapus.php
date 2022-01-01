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

        // $hasil = gmp_mod(gmp_pow(4851, 283), 50657);
        // helper(['rsa']);
        // dd(coba_hel());

        $data = [
            // 'data_kapus' => $data_kapus
            'title'       => 'Data Kapus',
            'data_kapus'  => $kapus->paginate(10),
            // 'data_kapus'  => $kapus,
            'pager'       => $this->kapusModel->pager,
            'currentPage' => $currentPage
        ];
        return view('/administrator/data_kapus', $data);
    }

    public function simpan($id = null)
    {




        $slug = url_title($this->request->getVar('nip_kapus') . '-' . $this->request->getVar('nama_kapus'), '-', true);

        $this->kapusBuilder->select('id_kapus, nama_kapus, nip_kapus, active, publik_key, private_key, hash_publik_key, hash_private_key, tanggal_dibuat, tanggal_diubah');
        $this->kapusBuilder->where('nip_kapus', $this->request->getVar('nip_kapus'));
        $query = $this->kapusBuilder->get();
        $nip_kp = $query->getResultArray();
        // dd($nip_kp);

        // dd($nip_kp);

        if ($id == null) {
            // dd('yes');
            // Form Validasi
            if (!$this->validate([
                'nip_kapus' => [
                    'rules' => 'required|is_unique[kapus.nip_kapus]',
                    'errors' => [
                        'required' => 'NIK kapus harus di isi',
                        'is_unique' => 'NIK kapus sudah terdaftar'
                    ]
                ]
            ])) {
                // $valid = \Config\Services::validation();
                // return redirect()->to('/data_kapus')->withInput()->with('Validation', $valid);
                session()->setFLashdata('pesan_error', ' Nip Petugas tidak boleh sama');

                return redirect()->to('/admin/kapus');
            }

            $gen_key = get_key();


            $data = [
                'nama_kapus'         => $this->request->getVar('nama_kapus'),
                'slug'               => $slug,
                'nip_kapus'          => $this->request->getVar('nip_kapus'),
                'publik_key'         => $gen_key[0],
                'private_key'        => $gen_key[1],
                'hash_publik_key'    => md5($gen_key[0]),
                'hash_private_key'   => md5($gen_key[1]),
                'tanggal_dibuat'     => date("Y-m-d", time()),
                'tanggal_diubah'     => date("Y-m-d", time()),
                'active'             => 1
            ];
            // $this->kapusModel->insert([
            //   'nama_kapus' => $this->request->getVar('nama_kapus'),
            //   'slug' => $slug,
            //   'nip_kapus' => $nip_kapus,
            //   'active' => 1
            // ]);
            $this->kapusBuilder->insert($data);
            session()->setFLashdata('pesan', ' Tambahkan');
        } else {
            // dd('no');
            $nip_kapus          = $nip_kp[0]['nip_kapus'];
            $active             = $nip_kp[0]['active'];
            $id                 = $nip_kp[0]['id_kapus'];
            $nama_kapus         = $nip_kp[0]['nama_kapus'];
            $publik_key         = $nip_kp[0]['publik_key'];
            $private_key        = $nip_kp[0]['private_key'];
            $hash_publik_key    = $nip_kp[0]['hash_publik_key'];
            $hash_private_key   = $nip_kp[0]['hash_private_key'];
            $tanggal_dibuat     = $nip_kp[0]['tanggal_dibuat'];

            if ($nip_kapus == $this->request->getVar('nip_kapus')) {
                // dd('yes');
                if ($active == 0) {
                    // dd('yes');

                    if ($nama_kapus == $this->request->getVar('nama_kapus')) {
                        // dd('yes');

                        $data = [
                            'active' => 1
                        ];
                        $this->kapusBuilder->where('id_kapus', $id);
                        $this->kapusBuilder->update($data);
                    } else {
                        // dd('no');

                        $data = [
                            'nama_kapus'        => $this->request->getVar('nama_kapus'),
                            'tanggal_diubah'    => date("Y-m-d", time()),
                            'active'            => 1
                        ];
                        $this->kapusBuilder->where('id_kapus', $id);
                        $this->kapusBuilder->update($data);
                        session()->setFLashdata('pesan', ' Edit');
                    }
                } else {
                    // dd('no');
                    $data = [
                        'nama_kapus'        => $this->request->getVar('nama_kapus'),
                        // 'slug'              => $slug,
                        // 'nip_kapus'         => $nip_kapus,
                        // 'publik_key'        => $publik_key,
                        // 'private_key'       => $private_key,
                        // 'hash_publik_key'   => $hash_publik_key,
                        // 'hash_private_key'  => $hash_private_key,
                        // 'tanggal_dibuat'    => $tanggal_dibuat,
                        'tanggal_diubah'    => date("Y-m-d", time()),
                        'active'            => 1
                    ];
                    // $this->kapusModel->insert([
                    //   'nama_kapus' => $this->request->getVar('nama_kapus'),
                    //   'slug' => $slug,
                    //   'nip_kapus' => $nip_kapus,
                    //   'active' => 1
                    // ]);
                    $this->kapusBuilder->update($data);
                    session()->setFLashdata('pesan', ' Edit');
                }
            } else {
                // dd('no');
                if ($active == 1) {
                    // dd('yes');
                    $data = [
                        'tanggal_diubah'    => date("Y-m-d", time()),
                        'active'            => 0
                    ];
                    $this->kapusBuilder->where('id_kapus', $id);
                    $this->kapusBuilder->update($data);
                    session()->setFLashdata('pesan', ' Edit');
                }
                $data = [
                    'nama_kapus'        => $this->request->getVar('nama_kapus'),
                    // 'slug'              => $slug,
                    // 'nip_kapus'         => $this->request->getVar('nip_kapus'),
                    // 'publik_key'        => $publik_key,
                    // 'private_key'       => $private_key,
                    // 'hash_publik_key'   => $hash_publik_key,
                    // 'hash_private_key'  => $hash_private_key,
                    // 'tanggal_dibuat'    => $tanggal_dibuat,
                    'tanggal_diubah'    => date("Y-m-d", time()),
                    'active'            => 1
                ];
                // $this->kapusModel->insert([
                //   'nama_kapus' => $this->request->getVar('nama_kapus'),
                //   'slug' => $slug,
                //   'nip_kapus' => $nip_kapus,
                //   'active' => 1
                // ]);
                $this->kapusBuilder->update($data);
                session()->setFLashdata('pesan', ' Edit');
            }
            // code...
        }



        // session()->setFLashdata('pesan', 'Tambahkan');

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

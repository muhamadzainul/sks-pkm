<?php

namespace App\Controllers\Admin;

use App\Models\Model_pasien;
use App\Models\Model_surat;
use App\Controllers\BaseController;

class Administrator extends BaseController
{
    protected $pasienModel;
    protected $suratModel;
    public function __construct()
    {
        $this->pasienModel = new Model_pasien();
        $this->suratModel = new Model_surat();
    }

    public function index()
    {
        $data = [
        'data_pasien' => $this->pasienModel->paginate(10),
        'pager' => $this->pasienModel->pager,
        'data_surat' => $this->suratModel->paginate(10),
        'pager' => $this->suratModel->pager
      ];
        return view('/administrator/index', $data);
    }
}

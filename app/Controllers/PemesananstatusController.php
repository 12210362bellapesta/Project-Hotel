<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\PemesananstatusModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class PemesananstatusController extends BaseController
{
    public function index()
    {
        return view('backend/Pemesananstatus/table');
    }

    public function all(){
        $psm = new PemesananstatusModel();
        $psm->select('id, status, urutan, aktif');

        return (new Datatable( $psm))
                ->setFieldFilter(['status', 'urutan', 'aktif'])
                ->draw();
    }

    public function show($id){
        $r = (new PemesananstatusModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }

    public function store(){
        $psm     = new PemesananstatusModel();
        $sandi  = $this->request->getVar('sandi');

        $id = $psm->insert([
            'status'      => $this->request->getVar('status'),
            'urutan'    => $this->request->getVar('urutan'),
            'aktif'      => $this->request->getVar('aktif'),
        ]); 
        
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode( intval($id) > 0 ? 200 : 406);
    }
    
    public function update(){
        $psm     = new PemesananstatusModel();
        $id     = (int)$this->request->getVar('id');
        
        if( $psm->find($id) == null )
        throw PageNotFoundException::forPageNotFound();
        
        $hasil     = $psm->update($id, [
            'status'      => $this->request->getVar('status'),
            'urutan'    => $this->request->getVar('urutan'),
            'aktif'      => $this->request->getVar('aktif'),
        ]);
        return $this->response->setJSON(['result' => $hasil]);
    }

    public function delete(){
        $psm     = new PemesananstatusModel();
        $id     = $this->request->getVar('id');
        $hasil  = $psm->delete($id);
        return $this->response->setJSON(['result' => $hasil ]);
    }
}




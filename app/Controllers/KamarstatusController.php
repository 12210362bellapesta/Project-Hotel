<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\KamarstatusModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class KamarstatusController extends BaseController
{
    public function index()
    {
        return view('backend/Kamarstatus/table');
    }

    public function all(){
        $ksm = new KamarstatusModel();
        $ksm->select('id, status, keterangan, urutan');

        return (new Datatable( $ksm))
                ->setFieldFilter(['status', 'keterangan', 'urutan'])
                ->draw();
    }

    public function show($id){
        $r = (new KamarstatusModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }

    public function store(){
        $ksm     = new KamarstatusModel();
        $sandi  = $this->request->getVar('sandi');

        $id = $ksm->insert([
            'status'      => $this->request->getVar('status'),
            'keterangan'      => $this->request->getVar('keterangan'),
            'urutan'    => $this->request->getVar('urutan'),
        ]); 
        
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode( intval($id) > 0 ? 200 : 406);
    }
    
    public function update(){
        $ksm     = new KamarstatusModel();
        $id     = (int)$this->request->getVar('id');
        
        if( $ksm->find($id) == null )
        throw PageNotFoundException::forPageNotFound();
        
        $hasil     = $ksm->update($id, [
            'status'      => $this->request->getVar('status'),
            'keterangan'      => $this->request->getVar('keterangan'),
            'urutan'    => $this->request->getVar('urutan'),
        ]);
        return $this->response->setJSON(['result' => $hasil]);
    }

    public function delete(){
        $ksm     = new KamarstatusModel();
        $id     = $this->request->getVar('id');
        $hasil  = $ksm->delete($id);
        return $this->response->setJSON(['result' => $hasil ]);
    }
}



<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\TipetarifModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class TipetarifController extends BaseController
{
    public function index()
    {
        return view('backend/Tipetarif/table');
    }

    public function all(){
        $ttm = new TipetarifModel();
        $ttm->select('id, tipe, keterangan, urutan, aktif');

        return (new Datatable( $ttm))
                ->setFieldFilter(['tipe', 'keterangan', 'urutan', 'aktif'])
                ->draw();
    }

    public function show($id){
        $r = (new TipetarifModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }

    public function store(){
        $ttm     = new TipetarifModel();
        $sandi  = $this->request->getVar('sandi');

        $id = $ttm->insert([
            'tipe'      => $this->request->getVar('tipe'),
            'keterangan'      => $this->request->getVar('keterangan'),
            'urutan'    => $this->request->getVar('urutan'),
            'aktif'      => $this->request->getVar('aktif'),
        ]); 
        
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode( intval($id) > 0 ? 200 : 406);
    }
    
    public function update(){
        $ttm     = new TipetarifModel();
        $id     = (int)$this->request->getVar('id');
        
        if( $ttm->find($id) == null )
        throw PageNotFoundException::forPageNotFound();
        
        $hasil     = $ttm->update($id, [
            'tipe'      => $this->request->getVar('tipe'),
            'keterangan'      => $this->request->getVar('keterangan'),
            'urutan'    => $this->request->getVar('urutan'),
            'aktif'      => $this->request->getVar('aktif'),
        ]);
        return $this->response->setJSON(['result' => $hasil]);
    }

    public function delete(){
        $ttm     = new TipetarifModel();
        $id     = $this->request->getVar('id');
        $hasil  = $ttm->delete($id);
        return $this->response->setJSON(['result' => $hasil ]);
    }
}



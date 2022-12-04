<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\MetodebayarModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class MetodebayarController extends BaseController
{
    public function index()
    {
        return view('backend/Metodebayar/table');
    }

    public function all(){
        $mbm = new MetodebayarModel();
        $mbm->select('id, metode, aktif');

        return (new Datatable( $mbm))
                ->setFieldFilter(['metode', 'aktif'])
                ->draw();
    }

    public function show($id){
        $r = (new MetodebayarModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }

    public function store(){
        $mbm     = new MetodebayarModel();
        $sandi  = $this->request->getVar('sandi');

        $id = $mbm->insert([
            'metode'      => $this->request->getVar('metode'),
            'aktif'      => $this->request->getVar('aktif'),
        ]);
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode( intval($id) > 0 ? 200 : 406);
    }
    
    public function update(){
        $mbm     = new MetodebayarModel();
        $id     = (int)$this->request->getVar('id');
        
        if( $mbm->find($id) == null )
        throw PageNotFoundException::forPageNotFound();
        
        $hasil     = $mbm->update($id, [
            'metode'      => $this->request->getVar('metode'),
            'aktif'      => $this->request->getVar('aktif'),
        ]);
        return $this->response->setJSON(['result' => $hasil]);
    }

    public function delete(){
        $mbm     = new MetodebayarModel();
        $id     = $this->request->getVar('id');
        $hasil  = $mbm->delete($id);
        return $this->response->setJSON(['result' => $hasil ]);
    }
    
}

<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\NegaraModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class NegaraController extends BaseController
{
    public function index()
    {
        return view('backend/Negara/table');
    }

    public function all(){
        $nm = new NegaraModel();
        $nm->select('id, negara');

        return (new Datatable( $nm))
                ->setFieldFilter(['negara'])
                ->draw();
    }

    public function show($id){
        $r = (new NegaraModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }

    public function store(){
        $nm     = new NegaraModel();
        $sandi  = $this->request->getVar('sandi');

        $id = $nm->insert([
            'negara'      => $this->request->getVar('negara'),
        ]);
        return $this->response->setJSON(['id' => $id])
                    ->setStatusCode( intval($id) > 0 ? 200 : 406);
    }

    public function update(){
        $nm     = new NegaraModel();
        $id     = (int)$this->request->getVar('id');

        if( $nm->find($id) == null )
            throw PageNotFoundException::forPageNotFound();
        
        $hasil     = $nm->update($id, [
            'negara'      => $this->request->getVar('negara'),
        ]);
        return $this->response->setJSON(['result' => $hasil]);
    }

    public function delete(){
        $nm     = new NegaraModel();
        $id     = $this->request->getVar('id');
        $hasil  = $nm->delete($id);
        return $this->response->setJSON(['result' => $hasil ]);
    }
    
}


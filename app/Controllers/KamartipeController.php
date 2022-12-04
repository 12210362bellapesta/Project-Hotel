<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Database\Migrations\Kamartipe;
use App\Models\KamartipeModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class KamartipeController extends BaseController
{
    public function index()
    {
        return view('backend/Kamartipe/table');
    }

    public function all(){
        $km = new KamartipeModel();
        $km->select('id, tipe, keterangan, urutan, aktif');

        return (new Datatable( $km))
                ->setFieldFilter(['tipe', 'keterangan', 'urutan', 'aktif'])
                ->draw();
    }

    public function show($id){
        $r = (new KamartipeModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }

    public function store(){
        $km     = new KamartipeModel();
        $sandi  = $this->request->getVar('sandi');

        $id = $km->insert([
            'tipe'      => $this->request->getVar('tipe'),
            'keterangan'      => $this->request->getVar('keterangan'),
            'urutan'    => $this->request->getVar('urutan'),
            'aktif'      => $this->request->getVar('aktif'),
        ]);

        if($id > 0){
            $this->simpanFile($id);
        }
        
        return $this->response->setJSON(['id' => $id])
        ->setStatusCode( intval($id) > 0 ? 200 : 406);
    }
    
    public function update(){
        $km     = new KamartipeModel();
        $id     = (int)$this->request->getVar('id');
        
        if( $km->find($id) == null )
        throw PageNotFoundException::forPageNotFound();
        
        $hasil     = $km->update($id, [
            'tipe'      => $this->request->getVar('tipe'),
            'keterangan'      => $this->request->getVar('keterangan'),
            'urutan'    => $this->request->getVar('urutan'),
            'aktif'      => $this->request->getVar('aktif'),
        ]);

        if($hasil == true){
            $this->simpanFile($id);
        }
        
        return $this->response->setJSON(['result' => $hasil]);
    }

    public function delete(){
        $km     = new KamartipeModel();
        $id     = $this->request->getVar('id');
        $hasil  = $km->delete($id);
        return $this->response->setJSON(['result' => $hasil ]);
    }

    private function simpanFile($id){
        $file = $this->request->getFile('berkas');

        if( $file->hasMoved() == false ){
            $direktori = WRITEPATH . 'uploads/kamartipe';
            if(file_exists($direktori) == false){
                @mkdir($direktori);
            }

            $file->store('kamartipe', $id . '.jpg');
        }


    }

    public function berkas($id){
        $am = new KamartipeModel();
        $dt = $am->find($id);
        if($dt == null)throw PageNotFoundException::forPageNotFound();

        $path = WRITEPATH . 'uploads/kamartipe/' . $id . '.jpg';
        if(file_exists($path) == false){
            throw PageNotFoundException::forPageNotFound();
        }

        echo file_get_contents($path);
        return $this->response->setHeader('Content-type', 'image/jpeg')
                    ->sendBody();
    }
}


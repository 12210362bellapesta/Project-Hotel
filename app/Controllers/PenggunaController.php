<?php

namespace App\Controllers;

use Agoenxz21\Datatables\Datatable;
use App\Controllers\BaseController;
use App\Models\PenggunaModel;
use CodeIgniter\Email\Email;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\Email as ConfigEmail;

class PenggunaController extends BaseController
{
    public function login()
    {
        $email      = $this->request->getPost('email');
        $password   = $this->request->getPost('sandi');

        $pengguna   = (new PenggunaModel())->where('email', $email)->first();

        if($pengguna == null){
            return $this->response->setJSON(['message'=>'Email tidak terdaftar'])
                        ->setStatusCode(404);
        }

        $cekPassword = password_verify($password, $pengguna['sandi']);
        if($cekPassword == false){
            return $this->response->setJSON(['message'=>'Email dan Sandi tidak cocok'])
                        ->setStatusCode(403);
        }

        $this->session->set('pengguna', $pengguna);
        return $this->response->setJSON(['message'=>"Selamat datang {$pengguna['nama_depan']}"])
                        ->setStatusCode(200);
    }

    public function viewLogin(){
        return view('login');
    }

    public function lupaPassword(){
        $_email = $this->request->getPost('email');

        $pengguna = (new PenggunaModel())->where('email', $_email)->first();

        if($pengguna == null){
            return $this->response->setJSON(['message'=>'Email tidak terdaftar'])
                        ->setStatusCode(404);
        }

        $sandibaru = substr( md5( date('Y-m-dH:i:s')),5,5);
        $pengguna ['sandi'] = password_hash($sandibaru, PASSWORD_BCRYPT);
        $r = (new PenggunaModel())->update($pengguna['id'], $pengguna);

        if($r == false){
            return $this->response->setJSON(['message'=>'Gagal merubah sandi'])
                        ->setStatusCode(502);
        }

        $email = new Email(new ConfigEmail());
        $email->setFrom('bellapesta186@gmail.com', 'Sistem Perhotelan');
        $email->setTo($pengguna['email']);
        $email->setSubject('Reset sandi pengguna');
        $email->setMessage("Hallo {$pengguna['nama']} telah meminta reset baru. Reset baru kamu adalah <b>$sandibaru</b>");
        $r = $email->send();

        if($r == true){
            return $this->response->setJSON(['message' => "Sandi baru sudah dikirim ke alamat email $_email"])
                        ->setStatusCode(200);
        }

        else{
            return $this->response->setJSON(['message'=>"Maaf ada kesalahan pengiriman email ke $_email"])
                        ->setStatusCode(500);
        }
    }

    public function viewLupaPassword(){
        return view('lupa_password');
    }

    public function logout(){
        $this->session->destroy();
        return redirect()->to('login');
    }

    public function index(){
        return view('backend/Pengguna/table');
    }

    public function all(){
        $pm = new PenggunaModel();
        $pm->select('id, nama_depan, nama_belakang, gender, email, alamat, kota, tgl_lhr, notelp, nohp, level');

        return (new Datatable( $pm))
                ->setFieldFilter(['nama_depan', 'nama_belakang', 'email', 'gender', 'alamat', 'kota', 'tgl_lhr', 'notelp', 'nohp', 'level'])
                ->draw();
    }

    public function show($id){
        $r = (new PenggunaModel())->where('id', $id)->first();
        if($r == null)throw PageNotFoundException::forPageNotFound();

        return $this->response->setJSON($r);
    }

    public function store(){
        $pm     = new PenggunaModel();
        $sandi  = $this->request->getVar('sandi');

        $id = $pm->insert([
            'nama_depan'      => $this->request->getVar('nama_depan'),
            'nama_belakang'      => $this->request->getVar('nama_belakang'),
            'gender'    => $this->request->getVar('gender'),
            'email'      => $this->request->getVar('email'),
            'alamat'      => $this->request->getVar('alamat'),
            'kota'      => $this->request->getVar('kota'),
            'tgl_lhr'      => $this->request->getVar('tgl_lhr'),
            'notelp'      => $this->request->getVar('notelp'),
            'nohp'      => $this->request->getVar('nohp'),
            'level'      => $this->request->getVar('level'),
            'sandi'      => password_hash($sandi, PASSWORD_BCRYPT),
        ]);

        if($id > 0){
            $this->simpanFile($id);
        }

        return $this->response->setJSON(['id' => $id])
        ->setStatusCode( intval($id) > 0 ? 200 : 406);
    }
    
    public function update(){
        $pm     = new PenggunaModel();
        $id     = (int)$this->request->getVar('id');
        
        if( $pm->find($id) == null )
        throw PageNotFoundException::forPageNotFound();
        
        $hasil     = $pm->update($id, [
            'nama_depan'      => $this->request->getVar('nama_depan'),
            'nama_belakang'      => $this->request->getVar('nama_belakang'),
            'gender'    => $this->request->getVar('gender'),
            'email'      => $this->request->getVar('email'),
            'alamat'      => $this->request->getVar('alamat'),
            'kota'      => $this->request->getVar('kota'),
            'tgl_lhr'      => $this->request->getVar('tgl_lhr'),
            'notelp'      => $this->request->getVar('notelp'),
            'nohp'      => $this->request->getVar('nohp'),
            'level'      => $this->request->getVar('level'),
            
        ]);
        if($hasil == true){
            $this->simpanFile($id);
        }
        
        return $this->response->setJSON(['result' => $hasil]);
    }

    public function delete(){
        $pm     = new PenggunaModel();
        $id     = $this->request->getVar('id');
        $hasil  = $pm->delete($id);
        return $this->response->setJSON(['result' => $hasil ]);
    }

    private function simpanFile($id){
        $file = $this->request->getFile('berkas');

        if( $file->hasMoved() == false ){
            $direktori = WRITEPATH . 'uploads/pengguna';
            if(file_exists($direktori) == false){
                @mkdir($direktori);
            }

            $file->store('pengguna', $id . '.jpg');
        }


    }

    public function berkas($id){
        $pm = new PenggunaModel();
        $dt = $pm->find($id);
        if($dt == null)throw PageNotFoundException::forPageNotFound();

        $path = WRITEPATH . 'uploads/pengguna/' . $id . '.jpg';
        if(file_exists($path) == false){
            throw PageNotFoundException::forPageNotFound();
        }

        echo file_get_contents($path);
        return $this->response->setHeader('Content-type', 'image/jpeg')
                    ->sendBody();
    }
}

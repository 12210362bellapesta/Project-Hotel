<?php 

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

class PemesananTest extends CIUnitTestCase{
    
    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'pemesanan', [
            'tgl_mulai' => 'Testing',
            'tgl_selesai' => '12-03-2022'
            ])->getJSON();
            $js = json_decode($json, true);
            
            $this->assertTrue($js['id'] > 0);
            
            $this->call('get', "pemesanan/".$js['id'])
            ->assertStatus(200);
            
            $this->call('patch', 'pemesanan', [
            'tgl_mulai' => 'Testing',
            'tgl_selesai' => '12-03-2022',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'pemesanan', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'pemesanan/all')
                ->assertStatus(200);
    }

}
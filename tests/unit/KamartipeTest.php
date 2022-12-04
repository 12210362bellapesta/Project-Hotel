<?php 

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

class KamartipeTest extends CIUnitTestCase{
    
    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'kamartipe', [
            'tipe' => 'Deluxe',
            'keterangan' => 'Ada',
            'urutan' => '1',
            'aktif' => 'Y',
            'gambar' => ''
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "kamartipe/".$js['id'])
                ->assertStatus(200);

        $this->call('patch', 'kamartipe', [
            'tipe' => 'Testing kamartipe update',
            'keterangan' => 'Ada',
            'urutan' => '1',
            'aktif' => 'Y',
            'gambar' => '',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'kamartipe', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'kamartipe/all')
                ->assertStatus(200);
    }

}
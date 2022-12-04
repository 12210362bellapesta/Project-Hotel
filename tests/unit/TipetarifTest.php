<?php 

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

class TipetarifTest extends CIUnitTestCase{
    
    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'tipetarif', [
            'tipe' => 'Deluxe',
            'keterangan' => 'Ada',
            'urutan' => '2',
            'aktif' => 'Y'
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "tipetarif/".$js['id'])
                ->assertStatus(200);

        $this->call('patch', 'tipetarif', [
            'tipe' => 'Testing kamartipe update',
            'keterangan' => 'Ada',
            'urutan' => '2',
            'aktif' => 'Y',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'tipetarif', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'tipetarif/all')
                ->assertStatus(200);
    }

}
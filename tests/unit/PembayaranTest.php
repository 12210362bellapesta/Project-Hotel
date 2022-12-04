<?php 

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

class PembayaranTest extends CIUnitTestCase{
    
    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'pembayaran', [
            'tgl' => 'Testing',
            'tagihan' => '4000',
            'dibayar' => '3000'
            ])->getJSON();
            $js = json_decode($json, true);
            
            $this->assertTrue($js['id'] > 0);
            
            $this->call('get', "pembayaran/".$js['id'])
            ->assertStatus(200);
            
            $this->call('patch', 'pembayaran', [
            'tgl' => 'Testing',
            'tagihan' => '4000',
            'dibayar' => '3000',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'pembayaran', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'pembayaran/all')
                ->assertStatus(200);
    }

}
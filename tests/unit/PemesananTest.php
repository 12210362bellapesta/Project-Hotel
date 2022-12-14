<?php 

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

class PemesananTest extends CIUnitTestCase{
    
    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'pemesanan', [
            'tgl_mulai' => '20-09-2022',
            'tgl_selesai' => '23-08-2022'
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "pemesanan/".$js['id'])
                ->assertStatus(200);

        $this->call('patch', 'pemesanan', [
            'tgl_mulai' => '20-09-2022',
            'tgl_selesai' => '23-08-2022',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'pemesanan', [
            'id' => $js['id']
        ])->assertStatus(200);
    }
}
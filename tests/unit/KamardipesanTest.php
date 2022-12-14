<?php 

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

class KamardipesanTest extends CIUnitTestCase{
    
    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'kamardipesan', [
            'kamar_id' => '1',
            'tarif' => 'Testing',
            ])->getJSON();
            $js = json_decode($json, true);
            
            $this->assertTrue($js['id'] > 0);
            
            $this->call('get', "kamardipesan/".$js['id'])
            ->assertStatus(200);
            
            $this->call('patch', 'kamardipesan', [
            'kamar_id' => '1',
            'tarif' => 'Testing',
            'id' => $js['id']
            ])->assertStatus(200);
            
            $this->call('delete', 'kamardipesan', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

   

}
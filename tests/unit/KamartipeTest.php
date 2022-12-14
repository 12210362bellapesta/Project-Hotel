<?php 

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

class KamartipeTest extends CIUnitTestCase{
    
    use FeatureTestTrait;

    public function testRead(){
        $this->call('get', 'kamartipe/all')
                ->assertStatus(200);
    }

}
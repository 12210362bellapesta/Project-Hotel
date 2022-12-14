<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class PenggunaTest extends CIUnitTestCase{

    use FeatureTestTrait;

    public function testLogin(){
        $this->call('post', 'login', [
            'email' => 'bellapeta136@gmail.com',
            'sandi' => '123456'
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'pengguna/all')
                ->assertStatus(302);
    }

    public function testLogout(){
        $this->call('delete', 'login')
                ->assertStatus(302);
    }
}
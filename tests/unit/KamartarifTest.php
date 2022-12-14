<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class KamartarifTest extends CIUnitTestCase{
    use FeatureTestTrait;

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'kamartarif', [
            'kamartipe_id' => '1',
            'tipetarif_id' => '1',
            'tarif' => 'Testing',
            'tgl_mulai' => '12-09-2022',
            'tgl_selesai' => '12-10-2022'
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "kamartarif/".$js['id'])
                ->assertStatus(200);

        $this->call('patch', 'kamartarif', [
            'kamartipe_id' => '1',
            'tipetarif_id' => '1',
            'tarif' => 'Testing',
            'tgl_mulai' => '12-09-2022',
            'tgl_selesai' => '12-10-2022',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'kamartarif', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

}
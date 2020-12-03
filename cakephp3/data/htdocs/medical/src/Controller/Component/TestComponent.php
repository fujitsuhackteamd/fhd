<?php
namespace App\Controller\Component;

use App\Controller\AppController;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Test component
 */
class TestComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
     // protected $_defaultConfig = [];
    public function test(){

        //python用読みこみ
        //exec();

        // 読み込み用にtest.csvを開きます。
        $f = fopen(WWW_ROOT."/data/nd_hospitaldata.csv", "r");
        // test.csvの行を1行ずつ読み込みます。
        while($line = fgetcsv($f)){
         // 読み込んだ結果を表示します。
            $data[] = $line;
        }
        // test.csvを閉じます。
        fclose($f);
        return $data;
    }
}

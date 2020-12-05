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
    public function python(){

        $choice_expert = $_GET["choice_expert"];
        $online_or_visit = $_GET["online_or_visit"];
        $address_x = $_GET["address_x"];
        $address_y = $_GET["address_y"];

        // if(empty($address_x)){
        //     $address_x = 
        // }
        // if(empty($address_y)){
        //     $address_x = 
        // }

        //病院データはき出します。

        //python用読みこみ
        //$way = WWW_ROOT."data/extract_hospital/";
        $command = "python conduct.py address_x ".$address_x." address_y ".$address_y." choice_expert ".$choice_expert." online_or_visit ".$online_or_visit." choice_priority 距離";
        var_dump($command);
        exec($command,$output);

        // 読み込み用にtest.csvを開きます。
        $f = fopen(APP."Controller/Component/extractdata/nd_hospitaldata.csv", "r");
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

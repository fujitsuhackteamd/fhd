<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DoctorsFixture
 */
class DoctorsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_unicode_ci', 'comment' => '医者の名前', 'precision' => null, 'fixed' => null],
        'hospital_name' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_unicode_ci', 'comment' => '病院の名前', 'precision' => null, 'fixed' => null],
        'address_x' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'x座標', 'precision' => null, 'autoIncrement' => null],
        'address_y' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'y座標', 'precision' => null, 'autoIncrement' => null],
        'expart' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_unicode_ci', 'comment' => '専門科', 'precision' => null, 'fixed' => null],
        'congestion' => ['type' => 'integer', 'length' => 2, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '混雑状況', 'precision' => null, 'autoIncrement' => null],
        'possible' => ['type' => 'integer', 'length' => 2, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => 'オンライン対応可能かどうか', 'precision' => null, 'autoIncrement' => null],
        'url' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_unicode_ci', 'comment' => 'zoomのURL', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '生成時間', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '最終編集時間', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_unicode_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'hospital_name' => 'Lorem ipsum dolor sit amet',
                'address_x' => 1,
                'address_y' => 1,
                'expart' => 'Lorem ipsum dolor sit amet',
                'congestion' => 1,
                'possible' => 1,
                'url' => 'Lorem ipsum dolor sit amet',
                'created' => '2020-12-01 10:52:19',
                'modified' => '2020-12-01 10:52:19',
            ],
        ];
        parent::init();
    }
}

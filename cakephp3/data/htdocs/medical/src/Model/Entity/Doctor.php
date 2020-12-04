<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Doctor Entity
 *
 * @property int $id
 * @property string $name
 * @property string $hospital_name
 * @property int $address_x
 * @property int $address_y
 * @property string $expart
 * @property int $congestion
 * @property int $possible
 * @property string $url
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Result[] $results
 * @property \App\Model\Entity\User[] $users
 */
class Doctor extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'hospital_name' => true,
        'expart' => true,
        'postal' => true,
        'street_address' => true,
        'phone_number' => true,
        'address_x' => true,
        'address_y' => true,
        'congestion' => true,
        'possible' => true,
        'url' => true,
        'created' => true,
        'modified' => true,
        'results' => true,
        'users' => true,
    ];
}

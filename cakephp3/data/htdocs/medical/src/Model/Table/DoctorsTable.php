<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Doctors Model
 *
 * @property \App\Model\Table\ResultsTable&\Cake\ORM\Association\HasMany $Results
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\Doctor get($primaryKey, $options = [])
 * @method \App\Model\Entity\Doctor newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Doctor[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Doctor|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Doctor saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Doctor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Doctor[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Doctor findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DoctorsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('doctors');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Results', [
            'foreignKey' => 'doctor_id',
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'doctor_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('hospital_name')
            ->maxLength('hospital_name', 255)
            ->requirePresence('hospital_name', 'create')
            ->notEmptyString('hospital_name');

        $validator
            ->integer('address_x')
            ->requirePresence('address_x', 'create')
            ->notEmptyString('address_x');

        $validator
            ->integer('address_y')
            ->requirePresence('address_y', 'create')
            ->notEmptyString('address_y');

        $validator
            ->scalar('expart')
            ->maxLength('expart', 255)
            ->requirePresence('expart', 'create')
            ->notEmptyString('expart');

        $validator
            ->integer('congestion')
            ->notEmptyString('congestion');

        $validator
            ->integer('possible')
            ->notEmptyString('possible');

        $validator
            ->scalar('url')
            ->maxLength('url', 255)
            ->requirePresence('url', 'create')
            ->notEmptyString('url');

        return $validator;
    }
}

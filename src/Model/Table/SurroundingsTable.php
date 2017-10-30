<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Surroundings Model
 *
 * @method \App\Model\Entity\Surrounding get($primaryKey, $options = [])
 * @method \App\Model\Entity\Surrounding newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Surrounding[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Surrounding|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Surrounding patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Surrounding[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Surrounding findOrCreate($search, callable $callback = null, $options = [])
 */
class SurroundingsTable extends Table
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

        $this->setTable('surroundings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    public function getAllSurroundings()
    {
        $surroundings = $this->find('all');
        return ($surroundings);
    }

    public function addNewSurrounding($type, $x, $y)
    {
        $s = $this->newEntity();
        $s->type = $type;
        $s->coordinate_x = $x;
        $s->coordinate_y = $y;
        $this->save($s);
    }

    public function deleteAllSurroundings()
    {
        $this->deleteAll(['1 = 1']);
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
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('type')
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->integer('coordinate_x')
            ->requirePresence('coordinate_x', 'create')
            ->notEmpty('coordinate_x');

        $validator
            ->integer('coordinate_y')
            ->requirePresence('coordinate_y', 'create')
            ->notEmpty('coordinate_y');

        return $validator;
    }
}

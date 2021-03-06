<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\I18n\Time;
use Cake\Validation\Validator;

/**
 * Messages Model
 *
 * @property \App\Model\Table\FightersTable|\Cake\ORM\Association\BelongsTo $Fighters
 *
 * @method \App\Model\Entity\Message get($primaryKey, $options = [])
 * @method \App\Model\Entity\Message newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Message[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Message|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Message patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Message[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Message findOrCreate($search, callable $callback = null, $options = [])
 */
class MessagesTable extends Table
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

        $this->setTable('messages');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->belongsTo('Fighters', [
            'foreignKey' => 'fighter_id',
            'joinType' => 'INNER'
        ]);
    }

    public function getMessagesByFighter($fighterId)
    {
        $messages=$this->find('all', ['order' => ['date' => 'DESC']])->where(['fighter_id' => $fighterId])->orWhere(['fighter_id_from' => $fighterId]);
        return $messages;
    }


/*    public function getChatByFighters($actualFighterId, $fighterId)
    {
        $chat = $this->find('all')->where(['fighter_id_from' =>$actualFighterId, 'fighter_id' =>$fighterId])
                ->orwhere(['fighter_id_from' => $fighterId, 'fighter_id'=>$actualFighterId ]);
        $chat = $this->find('all',array('conditions'=>array(
            'OR' =>array(
                'AND' =>array('fighter_id_from' =>$actualFighterId,'fighter_id' =>$fighterId),
                'AND' =>array('fighter_id_from' => $fighterId, 'fighter_id'=>$actualFighterId )
            ) )) );
        return($chat);
    }*/

    public function addNewMessage($data, $fighterId)
    {
        $m = $this->newEntity();
        $m->title = $data['title'];
        $m->date = Time::now();
        $m->message = $data['message'];
        $m->fighter_id_from = $fighterId;
        $m->fighter_id = $data['to'];
        $this->save($m);
    }
    public function addNewChatMessage($data, $fighterIdFrom, $fighterIdTo)
    {
        $m = $this->newEntity();
        $m->title = $data['title'];
        $m->date = Time::now();
        $m->message = $data['message'];
        $m->fighter_id_from = $fighterIdFrom;
        $m->fighter_id = $fighterIdTo;
        $this->save($m);
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
            ->dateTime('date')
            ->requirePresence('date', 'create')
            ->notEmpty('date');

        $validator
            ->scalar('title')
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->scalar('message')
            ->requirePresence('message', 'create')
            ->notEmpty('message');

        $validator
            ->integer('fighter_id_from')
            ->requirePresence('fighter_id_from', 'create')
            ->notEmpty('fighter_id_from');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['fighter_id'], 'Fighters'));

        return $rules;
    }
}

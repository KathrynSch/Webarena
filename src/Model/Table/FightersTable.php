<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Fighters Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $Players
 * @property |\Cake\ORM\Association\BelongsTo $Guilds
 * @property |\Cake\ORM\Association\HasMany $Messages
 * @property |\Cake\ORM\Association\HasMany $Tools
 *
 * @method \App\Model\Entity\Fighter get($primaryKey, $options = [])
 * @method \App\Model\Entity\Fighter newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Fighter[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Fighter|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fighter patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Fighter[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Fighter findOrCreate($search, callable $callback = null, $options = [])
 */
class FightersTable extends Table
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

        $this->setTable('fighters');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Players', [
            'foreignKey' => 'player_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Guilds', [
            'foreignKey' => 'guild_id'
        ]);
        $this->hasMany('Messages', [
            'foreignKey' => 'fighter_id'
        ]);
        $this->hasMany('Tools', [
            'foreignKey' => 'fighter_id'
        ]);
    }


    ///GETTERS
    public function getFighterByPlayerId($playerId)
    {
        $fighter=$this->find('all')->where(['player_id' => $playerId])->first();
        return($fighter);
    }

    public function getFighterById($fighterId)
    {
        $f = $this->get($fighterId);
        return($f);
    }

    public function getAllFighters(){
        $tabFighters=$this->find('all');
        return($tabFighters->toArray());
    }
    public function getFightersLeveled(){
        $tabFighters=$this->find('all', ['order' => 'level'])->where(['current_health !='=> 0]);
        return($tabFighters->toArray());
    }

    public function getAllAliveFighters(){
        $tabFighters=$this->find('all')->where(['current_health !='=> 0]);
        return($tabFighters->toArray());
    }

     public function getFighterHealth($fighterId){
        $f = $this->get($fighterId);
        return($f->current_health);
    }

    public function getFightersNames(){
        $f= $this->find('list', ['fields' =>['id','name'] ]);
        return($f->toArray());
    }

    ///SETTERS
    public function setFighterXp($fighterId, $fighterXp)
    {
         $f=$this->get($fighterId);
         $f->xp = $fighterXp;
         $this->save($f);
    }

    public function setFighterHealth($fighterId, $fighterCurrentHealth)
    {
        $f=$this->get($fighterId);
        $f->current_health=$fighterCurrentHealth;
        $this->save($f);
    }

     public function setPosition($fighterId, $newPosX, $newPosY)
    {
        $f = $this->get($fighterId);
        $f->coordinate_x = $newPosX;
        $f->coordinate_y = $newPosY;
        $this->save($f);
    }
    public function setFighterGuild($guildId, $fighterId)
    {
        $f = $this->get($fighterId);
        $f->guild_id = $guildId;
        $this->save($f);
    }
    
    public function setFighterName($fighterId,$name){
        $f = $this->get($fighterId);
        $f->name = $name;
        $this->save($f);
    }
    
    public function setFighterMaximumHealth($fighterId, $fighterMaximumHealth)
    {
        $f=$this->get($fighterId);
        $f->skill_health=$fighterMaximumHealth;
        $this->save($f);
    }
    
    
    public function setFighterForce($fighterId, $fighterForce)
    {
        $f=$this->get($fighterId);
        $f->skill_strength=$fighterForce;
        $this->save($f);
    }
    
    public function setFighterSight($fighterId, $fighterSight)
    {
        $f=$this->get($fighterId);
        $f->skill_sight=$fighterSight;
        $this->save($f);
    }
    
    public function setFighterLevel($fighterId, $fighterLevel)
    {
         $f=$this->get($fighterId);
         $f->level = $fighterLevel;
         $this->save($f);
    }
    
    
    public function addNewFighter($data,$playerId){
        
            if(!empty($data)){
            //if(count($data)>$this->max_files){
                //throw new InternalErrorException("Error Processing Request. Max number files accepted is {$this->max_files}",1);
            //}
                  $tabfighters=$this->getAllFighters();
                  //$filedb=TableRegistry::get('Fighters');
                  $entity=$this->newEntity();
                  $x= rand(0,14);
                  $y= rand(0, 9);
                  $occupy=false;
                  foreach ($tabfighters as $fighter){
                   
                    if ($fighter['coordinate_x']==$x && $fighter['coordinate_y']==$y){
                    
                   $occupy=true;   
                }
               }
               
               while ($occupy){
                   $occupy=false;
                  $x= rand(0,14);
                  $y= rand(0, 9);
                  
                  foreach ($tabfighters as $fighter){
                   
                   if ($fighter['coordinate_x']==$x && $fighter['coordinate_y']==$y){
                    
                     $occupy=true;   
                   }
                }
               } 
               
               
               $entity->coordinate_x=$x;
               $entity->coordinate_y=$y;
               $entity->level=1;
               $entity->xp=0;
               $entity->player_id=$playerId;
               $entity->skill_sight=2;
               $entity->skill_strength=1;
               $entity->skill_health=5;
               $entity->current_health=5;
               $entity->name=$data['name'];
               $this->save($entity);

                      
                          
                   //$newName=$filename.'.'.$avatarExtension;           
    }}

    // ELSE
    public function deleteFighter($fighterId){
        $f = $this->get($fighterId);
        $this->delete($f);
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
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->integer('coordinate_x')
            ->requirePresence('coordinate_x', 'create')
            ->notEmpty('coordinate_x');

        $validator
            ->integer('coordinate_y')
            ->requirePresence('coordinate_y', 'create')
            ->notEmpty('coordinate_y');

        $validator
            ->integer('level')
            ->requirePresence('level', 'create')
            ->notEmpty('level');

        $validator
            ->integer('xp')
            ->requirePresence('xp', 'create')
            ->notEmpty('xp');

        $validator
            ->integer('skill_sight')
            ->requirePresence('skill_sight', 'create')
            ->notEmpty('skill_sight');

        $validator
            ->integer('skill_strength')
            ->requirePresence('skill_strength', 'create')
            ->notEmpty('skill_strength');

        $validator
            ->integer('skill_health')
            ->requirePresence('skill_health', 'create')
            ->notEmpty('skill_health');

        $validator
            ->integer('current_health')
            ->requirePresence('current_health', 'create')
            ->notEmpty('current_health');

        $validator
            ->dateTime('next_action_time')
            ->allowEmpty('next_action_time');

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
        $rules->add($rules->existsIn(['player_id'], 'Players'));
        $rules->add($rules->existsIn(['guild_id'], 'Guilds'));

        return $rules;
    }
}

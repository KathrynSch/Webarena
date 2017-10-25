<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Message Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $date
 * @property string $title
 * @property string $message
 * @property int $fighter_id_from
 * @property int $fighter_id
 *
 * @property \App\Model\Entity\Fighter $fighter
 */
class Message extends Entity
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
        'date' => true,
        'title' => true,
        'message' => true,
        'fighter_id_from' => true,
        'fighter_id' => true,
        'fighter' => true
    ];
}

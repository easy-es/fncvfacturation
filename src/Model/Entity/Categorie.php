<?php
// src/Model/Entity/Categorie.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Categorie extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
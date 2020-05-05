<?php
// src/Model/Table/FacturesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class FacturesTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
        $this->belongsTo('Categories', [
            'className' => 'Categories',
            'foreignKey' => 'categorie_id'
         ]);
    }
}
?>
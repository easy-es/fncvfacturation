<?php
// src/Model/Table/CategoriesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class CategoriesTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setDisplayField('libelle');
        $this->addBehavior('Timestamp');
    }
}
?>
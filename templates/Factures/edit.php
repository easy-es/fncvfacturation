<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Facture $facture
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $facture->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $facture->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Factures'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="factures form content">
            <?= $this->Form->create($facture) ?>
            <fieldset>
                <legend><?= __('Edit Facture') ?></legend>
                <?php
                    echo $this->Form->control('numero_facture');
                    echo $this->Form->control('categorie_id', ['options' => $categories]);
                    echo $this->Form->control('montant_ttc');
                    echo $this->Form->control('adressea');
                    echo $this->Form->control('objet');
                    echo $this->Form->control('date_facture', ['empty' => true]);
                    echo $this->Form->control('relance');
                    echo $this->Form->control('reste');
                    echo $this->Form->control('montant_ttc_relance');
                    echo $this->Form->control('date_relance', ['empty' => true]);
                    echo $this->Form->control('mode_paiement');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

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
            <?= $this->Html->link(__('Edit Facture'), ['action' => 'edit', $facture->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Facture'), ['action' => 'delete', $facture->id], ['confirm' => __('Are you sure you want to delete # {0}?', $facture->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Factures'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Facture'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="factures view content">
            <h3><?= h($facture->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Category') ?></th>
                    <td><?= $facture->has('category') ? $this->Html->link($facture->category->libelle, ['controller' => 'Categories', 'action' => 'view', $facture->category->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Adressea') ?></th>
                    <td><?= h($facture->adressea) ?></td>
                </tr>
                <tr>
                    <th><?= __('Objet') ?></th>
                    <td><?= h($facture->objet) ?></td>
                </tr>
                <tr>
                    <th><?= __('Mode Paiement') ?></th>
                    <td><?= h($facture->mode_paiement) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($facture->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Numero Facture') ?></th>
                    <td><?= $this->Number->format($facture->numero_facture) ?></td>
                </tr>
                <tr>
                    <th><?= __('Montant Ttc') ?></th>
                    <td><?= $this->Number->format($facture->montant_ttc) ?></td>
                </tr>
                <tr>
                    <th><?= __('Reste') ?></th>
                    <td><?= $this->Number->format($facture->reste) ?></td>
                </tr>
                <tr>
                    <th><?= __('Montant Ttc Relance') ?></th>
                    <td><?= $this->Number->format($facture->montant_ttc_encaissement) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Facture') ?></th>
                    <td><?= h($facture->date_facture) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date encaissement') ?></th>
                    <td><?= h($facture->date_encaissement) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($facture->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($facture->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Relance') ?></th>
                    <td><?= $facture->relance ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

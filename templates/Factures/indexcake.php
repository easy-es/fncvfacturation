<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Facture[]|\Cake\Collection\CollectionInterface $factures
 */
?>
<div class="factures index content">
    <?= $this->Html->link(__('New Facture'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Factures') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('numero_facture') ?></th>
                    <th><?= $this->Paginator->sort('categorie_id') ?></th>
                    <th><?= $this->Paginator->sort('montant_ttc') ?></th>
                    <th><?= $this->Paginator->sort('adressea') ?></th>
                    <th><?= $this->Paginator->sort('objet') ?></th>
                    <th><?= $this->Paginator->sort('date_facture') ?></th>
                    <th><?= $this->Paginator->sort('relance') ?></th>
                    <th><?= $this->Paginator->sort('reste') ?></th>
                    <th><?= $this->Paginator->sort('montant_ttc_encaissement') ?></th>
                    <th><?= $this->Paginator->sort('date_encaissement') ?></th>
                    <th><?= $this->Paginator->sort('mode_paiement') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($factures as $facture): ?>
                <tr>
                    <td><?= $this->Number->format($facture->id) ?></td>
                    <td><?= $this->Number->format($facture->numero_facture) ?></td>
                    <td><?= $facture->has('category') ? $this->Html->link($facture->category->libelle, ['controller' => 'Categories', 'action' => 'view', $facture->category->id]) : '' ?></td>
                    <td><?= $this->Number->format($facture->montant_ttc) ?></td>
                    <td><?= h($facture->adressea) ?></td>
                    <td><?= h($facture->objet) ?></td>
                    <td><?= h($facture->date_facture) ?></td>
                    <td><?= h($facture->relance) ?></td>
                    <td><?= $this->Number->format($facture->reste) ?></td>
                    <td><?= $this->Number->format($facture->montant_ttc_relance) ?></td>
                    <td><?= h($facture->date_relance) ?></td>
                    <td><?= h($facture->mode_paiement) ?></td>
                    <td><?= h($facture->created) ?></td>
                    <td><?= h($facture->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $facture->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $facture->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $facture->id], ['confirm' => __('Are you sure you want to delete # {0}?', $facture->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>

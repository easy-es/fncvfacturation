<?= $this->element('Factures\menu') ?>
<div>
<?=  $nombre. ' lignes enregistrées.' ?> <br />
<?=  $update. ' lignes mise à jour' ?>
</div>
<div class="table">
    <table>
        <caption> Factures créées </caption> 
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('numero_facture') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($factures as $facture): ?>
            <tr>
                <td><?= $this->Number->format($facture->id) ?></td>
                <td><?= $facture->numero_facture ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class=" table">
    <table>
        <caption>Factures Mise à jour </caption>
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('numero_facture') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($entitiesUpdate as $facture): ?>
            <tr>
                <td><?= $this->Number->format($facture->id) ?></td>
                <td><?= $facture->numero_facture ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
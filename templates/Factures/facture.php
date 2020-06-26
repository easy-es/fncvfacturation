<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Facture $facture
 */
 $url =  $this->Url->build([
    "controller" => "Factures",
    "action" => "factureExist",
    "numero" => $facture->numero_facture
]);
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Factures'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="col">
        <div class="factures form content">
            <?= $this->Form->create($facture,[
                'inputDefaults' => [
                    'label' => false,
                    'div' => false
                ]
            ]) ?>
            <fieldset>
                <legend><?= __('Nouvelle facture') ?></legend>
                <?php
                    echo $this->Form->control('numero_facture',[ 'type' => 'number','required' => true,'id' => 'numero_facture','class' =>'form-control']);
                    echo $this->Form->control('categorie_id', [
                        'options' => $categories,
                        'class' => 'form-control'
                    ]);
                    echo $this->Form->control('montant_ttc',['label' => __('Montant TTC'),'class' => 'form-control']);
                    echo $this->Form->control('adressea',['label' => __('Adressé à'),'class' => 'form-control']);
                    echo $this->Form->control('objet',['label' => __('Objet'),'class' => 'form-control']);
                    echo $this->Form->control('date_facture', ['empty' => true]);
                    echo $this->Form->control('relance',['class' => 'form-control']);
                    echo $this->Form->control('reste',['class' => 'form-control']);
                    echo $this->Form->control('montant_ttc_encaissement',[]);
                    echo $this->Form->control('date_encaissement', ['empty' => true]);
                    echo $this->Form->control('mode_paiement');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<script>
    
$('#numero_facture').focusout(function(){
    $.ajax({
        type: "GET",
        url: '<?= $url ?>/'+ $('#numero_facture').val(),
        success: function(data) {
            if( data.retour) {
                alert('le numéro de facture existe déja');
            }
        },
        dataType:'json'
    });
});
</script>

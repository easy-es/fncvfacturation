<?php
    echo $this->Form->create();
    ?> 
    <div class="form-group">
    <?=  $this->Form->control('categorie_id', [
            'options' => $categories,
            'class' => 'form-control',
            'empty' => true
        ]);
    ?>
    </div>
    <div class="form-group">
        <?=  $this->Form->button(__('Filtrer'),['class' => 'btn btn-dark', 'id' => 'filter']); ?>   
    </div>
    <?= $this->Form->end() ?>
<script>
    $('categorie-id').change(function(){
        
    });
    $('#filter').click(function(e){
        e.preventDefault();
        var table =  $('#table').dataTable( {
            retrieve: true,
            "ajax": {
                "data": {
                    "categorie":$('#categorie-id').val()
                }
            }
        });
        $('#table').DataTable().ajax.reload();
    });
</script>
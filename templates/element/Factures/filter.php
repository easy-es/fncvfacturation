<?php
    echo $this->Form->create();
    echo $this->Form->control('categorie_id', [
            'options' => $categories,
            'class' => 'form-control'
        ]);
    echo $this->Form->end()
?>
<script>
    $('categorie-id').change(function(){
        
    })
</script>
<?php
if(isset($category)) {
    echo $this->Form->create($category, [
        'url' => ['action' => 'import'],
        'type' => 'file',
        'required' => true]);
    echo $this->Form->file('file');
    echo $this->Form->button(__('Submit'));
    echo $this->Form->end(); 
    ?>
    <div class="alert alert-info mt-2" role="alert">
        L'import n'enregistre que les nouvelles catégories qui ne sont pas présentent dans la base de données.
    </div> 
<?php
}
if(isset($nombre))
    echo $nombre. ' lignes enregistrées' ?>
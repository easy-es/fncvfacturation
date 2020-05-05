<?php
if(isset($category)) {
    echo $this->Form->create($category, [
        'url' => ['action' => 'import'],
        'type' => 'file',
        'required' => true]);
    echo $this->Form->file('file');
    echo $this->Form->button(__('Submit'));
    echo $this->Form->end(); 
}
if(isset($nombre))
    echo $nombre. ' lignes enregistrées' ?>
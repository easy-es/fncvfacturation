<?php
    echo $this->Form->create($facture, [
        'url' => ['action' => 'import'],
        'type' => 'file',
        'required' => true]);
    echo $this->Form->file('file');
    echo $this->Form->button(__('Submit'));
    echo $this->Form->end(); ?>

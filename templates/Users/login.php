<!-- templates/Users/login.php -->

<div class="users form col-3">
<?= $this->Flash->render() ?>
<?= $this->Form->create() ?>
    <fieldset>
        <div class="form-group">
            <?= $this->Form->control('username',['class' => 'form-control']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('password',['class' => 'form-control']) ?>
        </div>        
    </fieldset>
<?= $this->Form->button(__('Se connecter'),['class' => 'btn btn-dark']); ?>
<?= $this->Form->end() ?>
</div>
<div class="users form">
<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your username and password') ?></legend>
        <?= $this->Form->control('username') ?>
        <?= $this->Form->control('password') ?>
    </fieldset>
<?= $this->Form->button(__('Login')); ?>

<?= $this->Html->link(__("新規作成"),"/users/add") ?>
<!-- <a href="add">新規作成</a> -->

<?= $this->Form->end() ?>
</div>
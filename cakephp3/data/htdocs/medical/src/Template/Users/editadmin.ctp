<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('MENU') ?></li>
        <li><?= $this->Html->link(__('オンライン診断'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('マイページ'), ['action' => 'view',$user->id]) ?></li>
        <li><?= $this->Html->link(__('ログアウト'), ['controller' => 'Users', 'action' => 'logout']) ?></li>

        <?php if($user->sex == 2): ?>
            <li class="heading"><?= __('MASTER') ?></li>
            <li><?= $this->Html->link(__('登録者一覧'), ['action' => 'indexadmin']) ?> </li>
            <li><?= $this->Html->link(__('登録者追加'), ['action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('医者一覧'), ['controller' => 'Doctors', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('医者追加'), ['controller' => 'Doctors', 'action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('患者一覧'), ['controller' => 'Patients', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('患者追加'), ['controller' => 'Patients', 'action' => 'add']) ?></li>
        <?php endif; ?>

    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('name');
            echo $this->Form->control('password');
            echo $this->Form->control('age');
            echo $this->Form->control('sex');
            echo $this->Form->control('doctor_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

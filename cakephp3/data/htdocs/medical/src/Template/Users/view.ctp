<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
// echo "<pre>";
// print_r($user->patients);
// echo "</pre>";
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('MENU') ?></li>
        <!-- <li><? //echo $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li> -->
        <li><?= $this->Html->link(__('オンライン診断'), ['controller' => 'Users','action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('登録情報編集'), ['controller' => 'Users','action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Html->link(__('ログアウト'), ['controller' => 'Users', 'action' => 'logout']) ?></li>

        <?php if($sex == 2): ?>
            <li class="heading"><?= __('MASTER') ?></li>
            <li><?= $this->Html->link(__('登録者一覧'), ['controller' => 'Users','action' => 'indexadmin']) ?> </li>
            <li><?= $this->Html->link(__('登録者追加'), ['controller' => 'Users','action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('医者一覧'), ['controller' => 'Doctors', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('医者追加'), ['controller' => 'Doctors', 'action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('患者一覧'), ['controller' => 'Patients', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('患者追加'), ['controller' => 'Patients', 'action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('診察データ一覧'), ['controller' => 'Results', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('診察データ追加'), ['controller' => 'Results', 'action' => 'add']) ?></li>
        <?php endif; ?>

    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->name) ?></h3>
    <?php if($user->doctor_id != "" ):?>
        <h4><?= __('Doctor専用ページ') ?></h4>
        <?= $this->Html->link(__('Doctor専用ページ'), ['controller' => 'Doctors', 'action' => 'view',$user->doctor_id]) ?>
    <?php endif; ?>
    <h4><?= __('登録個人情報') ?></h4>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('年齢') ?></th>
            <td><?= $this->Number->format($user->age) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('性別') ?></th>
            <?php if($user->sex == 0): ?>
                <td>男性</td>
            <?php elseif($user->sex == 1) : ?>
                <td>女性</td>
            <?php elseif($user->sex == 2) : ?>
                <td>管理者権限</td>
            <?php endif; ?>
        </tr>
    </table>
    <h4><?= __('受診情報') ?></h4>
    <div class="related">
        <?php if (!empty($user->patients)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('受診科') ?></th>
                <th scope="col"><?= __('受診形態') ?></th>
                <th scope="col"><?= __('受診日') ?></th>
            </tr>
            <?php foreach ($user->patients as $patients): ?>
            <tr>
                <td><?= h($patients->department) ?></td>
                <?php if($patients->desired == 0): ?>
                    <td><?= h("対面") ?></td>
                <?php elseif($patients->desired == 1): ?>
                    <td><?= h("オンライン") ?></td>
                <?php endif;?>
                <td><?= h($patients->created) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

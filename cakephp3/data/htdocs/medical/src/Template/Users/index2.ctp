
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
    <li class="heading"><?= __('MENU') ?></li>
        <!-- <li><? //echo $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li> -->
        <li><?= $this->Html->link(__('問診表'), ['controller' => 'Users','action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('マイページ'), ['controller' => 'Users','action' => 'view', $user]) ?> </li>
        <li><?= $this->Html->link(__('登録情報編集'), ['controller' => 'Users','action' => 'edit', $user]) ?> </li>
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
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('問診表') ?></h3>
    <?//= $this->Html->link(__('来院予約'), ['controller' => 'Users', 'action' => 'logout']) ?>
    <p>病院データ同期</p>
    <?php
    $count = count($data) - 1;
    echo "結果:".$count."個発見されました。";
    ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= "先生名"; ?></th>
                <th scope="col"><?= "病院名"; ?></th>
                <th scope="col"><?= $data[0][3]; ?></th>
                <th scope="col"><?= $data[0][4]; ?></th>
                <th scope="col"><?= $data[0][5]; ?></th>
                <th scope="col"><?= $data[0][6]; ?></th>
                <th scope="col"><?= $data[0][7]; ?></th>
                <th scope="col"><?= $data[0][8]; ?></th>
            </tr>
        </thead>
        <tbody>
            <?php for($i=1;$i<=$count;$i++): ?>
            <tr>
                <td><?= $data[$i][1]; ?></td>
                <td><?= $data[$i][2]; ?></td>
                <td><?= $data[$i][3]; ?></td>
                <td><?= $data[$i][4]; ?></td>
                <td><?= $data[$i][5]; ?></td>
                <td><?= $data[$i][6]; ?></td>
                <td><?= $data[$i][7]; ?></td>
                <td><?= $data[$i][8]; ?></td>
            </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</div>

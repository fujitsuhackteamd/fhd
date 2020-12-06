<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Doctor $doctor
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
    <li class="heading"><?= __('MENU') ?></li>
        <!-- <li><? //echo $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li> -->
        <li><?= $this->Html->link(__('問診表'), ['controller' => 'Users','action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('マイページ'), ['controller' => 'Users','action' => 'view', $doctor['users'][0]['id']]) ?> </li>
        <li><?= $this->Html->link(__('医者登録情報編集'), ['controller' => 'Doctors', 'action' => 'edit',$doctor->id]) ?></li>
        <li><?= $this->Html->link(__('登録情報編集'), ['controller' => 'Users','action' => 'edit', $doctor['users'][0]['id']]) ?> </li>
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
<div class="doctors view large-9 medium-8 columns content">
    <h3><?= h($doctor->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('医師登録名') ?></th>
            <td><?= h($doctor->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('病院名') ?></th>
            <td><?= h($doctor->hospital_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('専門科') ?></th>
            <td><?= h($doctor->expart) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('郵便番号') ?></th>
            <td><?= h($doctor->postal) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('住所') ?></th>
            <td><?= h($doctor->street_address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('電話番号') ?></th>
            <td><?= h($doctor->phone_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Url') ?></th>
            <td><?= h($doctor->url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('混雑度（0が空き.1が混雑）') ?></th>
            <td><?= $this->Number->format($doctor->congestion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('オンライン対応可能かどうか') ?></th>
            <?php if($doctor->possible == 0): ?>
                <td>可能</td>
            <?php elseif($doctor->possible == 1): ?>
                <td>不可能</td>
            <?php endif; ?>
        </tr>
    </table>
    <!-- <div class="related">
        <h4><?= __('個人登録情報') ?></h4>
        <?php if (!empty($doctor->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Username') ?></th>
                <th scope="col"><?= __('名前') ?></th>
                <th scope="col"><?= __('年齢') ?></th>
                <th scope="col"><?= __('性別') ?></th>
            </tr>
            <?php foreach ($doctor->users as $users): ?>
            <tr>
                <td><?= h($users->username) ?></td>
                <td><?= h($users->name) ?></td>
                <td><?= h($users->age) ?></td>
                <?php if($users->sex == 0): ?>
                    <td>男性</td>
                <?php elseif($users->sex == 1) : ?>
                    <td>女性</td>
                <?php elseif($users->sex == 2) : ?>
                    <td>管理者権限</td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div> -->
    <div class="related">
        <h4><?= __('過去の診察結果') ?></h4>
        <?php if (!empty($doctor->results)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('患者名') ?></th>
                <th scope="col"><?= __('現状') ?></th>
                <th scope="col"><?= __('診断結果') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($doctor->results as $results): ?>
            <tr>
                <td><?= h($results->patient_id) ?></td>
                <td><?= h($results->patient_text) ?></td>
                <td><?= h($results->doctor_text) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Results', 'action' => 'view', $results->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Results', 'action' => 'edit', $results->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Results', 'action' => 'delete', $results->id], ['confirm' => __('Are you sure you want to delete # {0}?', $results->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

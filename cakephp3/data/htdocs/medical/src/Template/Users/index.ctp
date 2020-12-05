<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<?= $this->Html->script("script"); ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
    <li class="heading"><?= __('MENU') ?></li>
        <!-- <li><? //echo $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li> -->
        <li><?= $this->Html->link(__('オンライン診断'), ['controller' => 'Users','action' => 'index']) ?> </li>
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
    <h3><?= __('オンライン診断') ?></h3>
    <section id="sec3">
        <div class="height100">
            <div class="login_form mx-auto">
                <form class="needs-validation" action="./users/index2" method="GET">
                    <div class="row">
                        <div class="col-md-7 mb-3">
                            <label for="country">受診科</label>
                            <select class="custom-select d-block w-100" id="country" name="choice_expert" required>
                                <option value="">選択してください</option>
                                <option>内科</option>
                                <option>外科</option>
                                <option>眼科</option>
                                <option>耳鼻科</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-block my-3">
                        <label for="address">受診形態</label>
                        <div class="row ml-2">
                            <div class="custom-control custom-radio mr-3">
                                <input id="visit" name="online_or_visit" type="radio" value="来院" class="custom-control-input"  required>
                                <label class="custom-control-label" for="visit">来院</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="online" name="online_or_visit" type="radio" value="オンライン" class="custom-control-input" required>
                                <label class="custom-control-label" for="online">オンライン</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <input type="hidden" name="address_x" id="address_x" >
                        <input type="hidden" name="address_y" id="address_y" >
                    </div>
                    <button class="btn btn_clr btn-lg btn-block text-white" style="text-align:right;" type="submit">病院を探す</button>
                </form>
            </div>
        </div>
    </section>
</div>



<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'User Management';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container mt-3">
    <h5 class="mb-3"><?= $this->title ?></h5>
    <div class="d-flex align-items-center gap-1 flex-wrap mb-3">
        <?= Html::a('+ Create User', ['auth/signup'], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a('Roles & Permissions', ['/rbac/auth-item'], ['class' => 'btn btn-secondary btn-sm']) ?>
        <?= Html::a('Rules', ['/rbac/auth-rule'], ['class' => 'btn btn-secondary btn-sm']) ?>

        <!-- Fix for dropdown alignment -->
        <div class="btn-group">
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Location
            </button>
            <ul class="dropdown-menu">
                <li><?= Html::a('Regions', ['regions/index'], ['class' => 'dropdown-item']) ?></li>
                <li><?= Html::a('Provinces', ['provinces/index'], ['class' => 'dropdown-item']) ?></li>
                <li><?= Html::a('Cities', ['cities/index'], ['class' => 'dropdown-item']) ?></li>
                <li><?= Html::a('Barangays', ['barangays/index'], ['class' => 'dropdown-item']) ?></li>
            </ul>
        </div>
    </div>

    <div class="card shadow-lg" style="border-top: 7px solid #747474;">
        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'tableOptions' => ['class' => 'table table-sm table-bordered table-hover'],
                'columns' => [
                    'username',
                    'email',
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model->statusLabel;
                        }
                    ],
                    [
                        'attribute' => 'granted_access',
                        'label' => 'Granted Access?',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model->role
                                ? Html::a('Yes', ['/rbac/auth-assignment/grant-access', "user_id" => $model->id], ['class' => 'btn btn-primary btn-sm']) . 
                                  Html::a('Revoke', ['/rbac/auth-assignment/revoke-access', "user_id" => $model->id], [
                                    'class' => 'btn btn-warning btn-sm ms-1',
                                    'data-confirm' => 'Are you sure you want to revoke this user’s access?',
                                    'data-method' => 'post'
                                  ])
                                : Html::a('No', ['/rbac/auth-assignment/grant-access', "user_id" => $model->id], ['class' => 'btn btn-secondary btn-sm']);
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{actions}',
                        'buttons' => [
                            'actions' => function ($url, $model) {
                                $blockLabel = $model->status == 10 ? 'Block' : 'Unblock';
                                // $blockClass = $model->status == 10 ? 'text-warning' : 'text-success';
                                // $blockIcon = $model->status == 10 ? 'fa-ban' : 'fa-check';
                                $blockUrl =  $model->status == 10 ? ['block', 'id' => $model->id] : ['unblock', 'id' => $model->id];
                    
                                return '<div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>' . Html::a('Change Password', ['auth/change-password', "id" => $model->id], ['class' => 'dropdown-item']) . '</li>
                                                <li>' . Html::a('Delete', ['delete', "id" => $model->id], [
                                                    'class' => 'dropdown-item',
                                                    'data-confirm' => 'Are you sure you want to delete this user?',
                                                    'data-method' => 'post',
                                                ]) . '</li>
                                                <li>' . Html::a("$blockLabel", $blockUrl, [
                                                    'class' => "dropdown-item",
                                                    'data-confirm' => "Are you sure you want to $blockLabel this user?",
                                                    'data-method' => 'post',
                                                ]) . '</li>
                                            </ul>
                                        </div>';
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>

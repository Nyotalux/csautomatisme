<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Utilisateurs';
?>

<div class="user-index">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0"><?= Html::encode($this->title) ?></h4>
        </div>
        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $users]),
                'columns' => [
                    'id',
                    'username',
                    'first_name',
                    'last_name',
                    'email',
                    [
                        'attribute' => 'role_id',
                        'value' => function($model) {
                            return $model->role ? $model->role->name : '-';
                        }
                    ],
                    [
                        'attribute' => 'service_id',
                        'value' => function($model) {
                            return $model->service ? $model->service->name : '-';
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete}',
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>
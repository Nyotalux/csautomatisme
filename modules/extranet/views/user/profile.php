<?php
use yii\helpers\Html;

$this->title = 'Mon Profil';
?>

<div class="user-profile">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="bg-primary rounded-circle d-inline-flex p-3">
                            <i class="fas fa-user fa-3x text-white"></i>
                        </div>
                    </div>
                    <h4><?= Html::encode($user->getFullName()) ?></h4>
                    <p class="text-muted">@<?= Html::encode($user->username) ?></p>
                    <hr>
                    <p><strong>Rôle :</strong> <?= $user->role ? $user->role->name : '-' ?></p>
                    <p><strong>Service :</strong> <?= $user->service ? $user->service->name : '-' ?></p>
                    <p><strong>Secteur :</strong> <?= $user->sector ? $user->sector->name : '-' ?></p>
                    <p><strong>Région :</strong> <?= $user->region ? $user->region->name : '-' ?></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Informations personnelles</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Email</th>
                            <td><?= Html::encode($user->email ?: 'Non renseigné') ?></td>
                        </tr>
                        <tr>
                            <th>Téléphone</th>
                            <td><?= Html::encode($user->phone ?: 'Non renseigné') ?></td>
                        </tr>
                        <tr>
                            <th>Membre depuis</th>
                            <td><?= Yii::$app->formatter->asDate($user->created_at) ?></td>
                        </tr>
                        <tr>
                            <th>Dernière connexion</th>
                            <td><?= $user->last_login ? Yii::$app->formatter->asRelativeTime($user->last_login) : 'Jamais' ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
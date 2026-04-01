<?php
use yii\helpers\Html;
?>

<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card dashboard-card shadow-sm">
            <div class="card-body text-center">
                <div class="mb-3">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block">
                        <i class="fas fa-user-circle fa-3x text-primary"></i>
                    </div>
                </div>
                <h5><?= Html::encode($stats['full_name']) ?></h5>
                <p class="text-muted"><?= Html::encode($stats['username']) ?></p>
                <hr>
                <div class="text-start">
                    <p><strong>Rôle :</strong> <?= Html::encode($stats['role']) ?></p>
                    <p><strong>Service :</strong> <?= Html::encode($stats['service']) ?></p>
                    <p><strong>Secteur :</strong> <?= Html::encode($stats['sector']) ?></p>
                    <p><strong>Région :</strong> <?= Html::encode($stats['region']) ?></p>
                    <p><strong>Membre depuis :</strong> <?= Yii::$app->formatter->asDate($stats['joined_date']) ?></p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8 mb-3">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Mon activité</h5>
            </div>
            <div class="card-body">
                <?php if (empty($stats['my_activities'])): ?>
                    <p class="text-muted text-center">Aucune activité récente.</p>
                <?php else: ?>
                    <div class="activity-timeline">
                        <?php foreach ($stats['my_activities'] as $activity): ?>
                        <div class="activity-item">
                            <div class="activity-icon bg-<?= $activity['color'] ?> bg-opacity-10">
                                <i class="<?= $activity['icon'] ?> text-<?= $activity['color'] ?>"></i>
                            </div>
                            <div class="ms-3">
                                <strong><?= $activity['description'] ?></strong><br>
                                <small class="text-muted">
                                    <i class="far fa-clock"></i> <?= Yii::$app->formatter->asRelativeTime($activity['time']) ?>
                                </small>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
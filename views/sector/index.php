<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Secteurs d\'Intervention';
?>

<div class="sector-index">
    <div class="container py-5">
        <div class="row">
            <div class="col-12 text-center mb-5" data-aos="fade-down">
                <h1 class="display-4"><?= Html::encode($this->title) ?></h1>
                <p class="lead text-muted">Découvrez tous les domaines dans lesquels nous intervenons</p>
            </div>
        </div>
        
        <div class="row">
            <?php if (empty($sectors)): ?>
                <div class="col-12 text-center">
                    <p class="text-muted">Aucun secteur disponible pour le moment.</p>
                </div>
            <?php else: ?>
                <?php foreach ($sectors as $sector): ?>
                <div class="col-md-4 col-lg-3 mb-4" data-aos="zoom-in" data-aos-delay="<?= $sector->sort_order * 100 ?>">
                    <div class="card h-100 shadow-sm border-0 text-center hover-float">
                        <div class="card-body">
                            <?php if ($sector->icon): ?>
                                <i class="<?= Html::encode($sector->icon) ?> fa-3x mb-3" style="color: #667eea;"></i>
                            <?php else: ?>
                                <i class="fas fa-building fa-3x mb-3 text-muted"></i>
                            <?php endif; ?>
                            <h5 class="card-title"><?= Html::encode($sector->name) ?></h5>
                            <p class="card-text text-muted"><?= Html::encode($sector->description) ?></p>
                            <?= Html::a('En savoir plus', ['view', 'slug' => $sector->slug], ['class' => 'btn btn-outline-primary btn-sm mt-2']) ?>
                        </div>
                        <?php if ($sector->service): ?>
                        <div class="card-footer bg-transparent border-0 text-muted small">
                            <i class="fas fa-tag"></i> <?= Html::encode($sector->service->name) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
$this->registerCss("
    .sector-index .card {
        transition: transform 0.3s ease;
    }
    .sector-index .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
");
?>
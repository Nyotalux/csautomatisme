<?php
Yii::$app->seo->setMetaTags(
    $service->name,
    $service->description,
    $service->meta_keywords ?: '',
    null,
    $service->image_main ? '/uploads/' . $service->image_main : null
);
?>
<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $service->name;
?>

<div class="service-view">
    <div class="container py-5">
        <!-- En-tête du service -->
        <div class="row mb-5" data-aos="fade-down">
            <div class="col-12 text-center">
                <?php if ($service->icon): ?>
                    <i class="<?= Html::encode($service->icon) ?> fa-3x mb-3" style="color: #667eea;"></i>
                <?php endif; ?>
                <h1 class="display-4"><?= Html::encode($service->name) ?></h1>
                <p class="lead text-muted"><?= Html::encode($service->description) ?></p>
            </div>
        </div>
        
        <!-- Contenu principal -->
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto" data-aos="fade-up">
                <?php if ($service->image_main): ?>
                    <?= Html::img('@web/uploads/' . $service->image_main, [
                        'class' => 'img-fluid rounded shadow mb-4', 
                        'alt' => $service->name
                    ]) ?>
                <?php endif; ?>
                <div class="content">
                    <?= $service->content ?>
                </div>
            </div>
        </div>
        
        <!-- Secteurs d'intervention liés -->
        <?php if ($service->sectors): ?>
        <div class="row mt-5">
            <div class="col-12 text-center mb-4">
                <h2>Secteurs d'intervention</h2>
                <p class="text-muted">Domaines où nous intervenons</p>
            </div>
            <?php foreach ($service->sectors as $sector): ?>
            <div class="col-md-4 mb-4" data-aos="flip-left" data-aos-delay="<?= $sector->sort_order * 100 ?>">
                <div class="card h-100 shadow-sm text-center">
                    <div class="card-body">
                        <?php if ($sector->icon): ?>
                            <i class="<?= Html::encode($sector->icon) ?> fa-2x mb-3" style="color: #764ba2;"></i>
                        <?php endif; ?>
                        <h5 class="card-title"><?= Html::encode($sector->name) ?></h5>
                        <p class="card-text"><?= Html::encode($sector->description) ?></p>
                        <?= Html::a('Détails', ['sector/view', 'slug' => $sector->slug], ['class' => 'btn btn-outline-secondary btn-sm']) ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        
        <!-- Galerie d'images -->
        <?php if ($service->gallery): ?>
        <div class="row mt-5">
            <div class="col-12 text-center mb-4">
                <h2>Galerie</h2>
                <p class="text-muted">Quelques réalisations</p>
            </div>
            <?php foreach ($service->gallery as $image): ?>
            <div class="col-md-3 mb-4" data-aos="zoom-in">
                <?= Html::img('@web/uploads/' . $image->image, [
                    'class' => 'img-fluid rounded shadow', 
                    'alt' => $image->caption,
                    'style' => 'height: 200px; width: 100%; object-fit: cover;'
                ]) ?>
                <?php if ($image->caption): ?>
                    <p class="text-center small mt-2"><?= Html::encode($image->caption) ?></p>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>
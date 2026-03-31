<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $sector->name;
?>

<div class="sector-view">
    <div class="container py-5">
        <!-- En-tête du secteur -->
        <div class="row mb-5" data-aos="fade-down">
            <div class="col-12 text-center">
                <?php if ($sector->icon): ?>
                    <i class="<?= Html::encode($sector->icon) ?> fa-3x mb-3" style="color: #667eea;"></i>
                <?php endif; ?>
                <h1 class="display-4"><?= Html::encode($sector->name) ?></h1>
                <p class="lead text-muted"><?= Html::encode($sector->description) ?></p>
                <?php if ($sector->service): ?>
                <p class="text-muted">
                    <i class="fas fa-folder"></i> Service : 
                    <?= Html::a($sector->service->name, ['service/view', 'slug' => $sector->service->slug], ['class' => 'text-decoration-none']) ?>
                </p>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Contenu principal -->
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto" data-aos="fade-up">
                <?php if ($sector->image): ?>
                    <?= Html::img('@web/uploads/' . $sector->image, [
                        'class' => 'img-fluid rounded shadow mb-4', 
                        'alt' => $sector->name
                    ]) ?>
                <?php endif; ?>
                <div class="content">
                    <p>Nous intervenons dans le secteur <strong><?= Html::encode($sector->name) ?></strong> avec une expertise reconnue et des solutions adaptées à vos besoins spécifiques.</p>
                    <p>Notre équipe d'experts vous accompagne dans la mise en place de solutions d'automatisme, de domotique et d'électricité adaptées à votre secteur d'activité.</p>
                    
                    <h3 class="mt-4">Nos réalisations</h3>
                    <p>Découvrez quelques-unes de nos réalisations dans le secteur <?= Html::encode($sector->name) ?> :</p>
                    
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Installation de systèmes automatisés</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Mise en place de solutions domotiques sur mesure</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Rénovation et mise aux normes électriques</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Maintenance préventive et corrective</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Galerie d'images -->
        <?php if ($sector->gallery): ?>
        <div class="row mt-5">
            <div class="col-12 text-center mb-4">
                <h2>Réalisations dans ce secteur</h2>
                <p class="text-muted">Quelques projets réalisés</p>
            </div>
            <?php foreach ($sector->gallery as $image): ?>
            <div class="col-md-3 mb-4" data-aos="zoom-in">
                <div class="gallery-item">
                    <?= Html::img('@web/uploads/' . $image->image, [
                        'class' => 'img-fluid rounded shadow', 
                        'alt' => $image->caption,
                        'style' => 'height: 200px; width: 100%; object-fit: cover; cursor: pointer;'
                    ]) ?>
                    <?php if ($image->caption): ?>
                        <p class="text-center small mt-2"><?= Html::encode($image->caption) ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        
        <!-- Bouton retour -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <?= Html::a('<i class="fas fa-arrow-left"></i> Retour aux secteurs', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerCss("
    .sector-view .content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555;
    }
    .sector-view .content h3 {
        color: #667eea;
        margin-top: 2rem;
    }
    .gallery-item {
        cursor: pointer;
        transition: transform 0.3s ease;
    }
    .gallery-item:hover {
        transform: scale(1.05);
    }
");
?>
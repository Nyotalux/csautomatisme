<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Nos Services';
?>

<div class="service-index">
    <div class="container py-5">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h1 class="display-4 animate__animated animate__fadeInDown">Nos Services</h1>
                <p class="lead text-muted animate__animated animate__fadeInUp">Des solutions sur mesure pour vos besoins</p>
            </div>
        </div>
        
        <div class="row">
            <?php foreach ($services as $service): ?>
            <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="<?= $service->sort_order * 100 ?>">
                <div class="card h-100 shadow-lg border-0">
                    <?php if ($service->image_main): ?>
                        <?= Html::img('@web/uploads/' . $service->image_main, [
                            'class' => 'card-img-top', 
                            'alt' => $service->name, 
                            'style' => 'height: 250px; object-fit: cover;'
                        ]) ?>
                    <?php else: ?>
                        <div class="card-img-top bg-light text-center py-5">
                            <i class="fas fa-cog fa-4x text-muted"></i>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <?php if ($service->icon): ?>
                            <i class="<?= Html::encode($service->icon) ?> fa-2x mb-3" style="color: #667eea;"></i>
                        <?php endif; ?>
                        <h3 class="card-title h4"><?= Html::encode($service->name) ?></h3>
                        <p class="card-text"><?= Html::encode($service->description) ?></p>
                        <?= Html::a('En savoir plus', ['view', 'slug' => $service->slug], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php
Yii::$app->seo->setMetaTags(
    'Accueil',
    'CS Automatisme - Expert en automatisme, domotique et électricité industrielle depuis 20 ans.',
    'automatisme, domotique, électricité, robotique, industrie, cs automatisme'
);
?>
<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'CS Automatisme';
?>

<div class="site-index">
    <!-- Hero Section avec animation -->
    <div class="hero-section text-center py-5 mb-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
        <div class="container">
            <h1 class="display-4 animate__animated animate__fadeInDown">CS Automatisme</h1>
            <p class="lead animate__animated animate__fadeInUp">Solutions d'automatisme et de domotique pour votre entreprise</p>
            <?= Html::a('Découvrir nos services', ['service/index'], ['class' => 'btn btn-light btn-lg mt-3 animate__animated animate__fadeInUp']) ?>
        </div>
    </div>
    
    <div class="container">
        <!-- Services en vedette -->
        <div class="row mb-5">
            <div class="col-12 text-center mb-4">
                <h2>Nos Services</h2>
                <p class="text-muted">Découvrez notre expertise en automatisme</p>
            </div>
            
            <?php
            $services = \app\models\Service::find()->orderBy(['sort_order' => SORT_ASC])->limit(3)->all();
            foreach ($services as $service):
            ?>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="<?= $service->sort_order * 100 ?>">
                <div class="card h-100 shadow-sm">
                    <?php if ($service->image_main): ?>
                        <?= Html::img('@web/uploads/' . $service->image_main, ['class' => 'card-img-top', 'alt' => $service->name, 'style' => 'height: 200px; object-fit: cover;']) ?>
                    <?php endif; ?>
                    <div class="card-body text-center">
                        <?php if ($service->icon): ?>
                            <i class="<?= Html::encode($service->icon) ?> fa-3x mb-3" style="color: #667eea;"></i>
                        <?php endif; ?>
                        <h5 class="card-title"><?= Html::encode($service->name) ?></h5>
                        <p class="card-text"><?= Html::encode($service->description) ?></p>
                        <?= Html::a('En savoir plus', ['service/view', 'slug' => $service->slug], ['class' => 'btn btn-outline-primary']) ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Secteurs d'intervention -->
        <div class="row mb-5">
            <div class="col-12 text-center mb-4">
                <h2>Secteurs d'Intervention</h2>
                <p class="text-muted">Nous intervenons dans de nombreux domaines</p>
            </div>
            
            <?php
            $sectors = \app\models\Sector::find()->orderBy(['sort_order' => SORT_ASC])->limit(4)->all();
            foreach ($sectors as $sector):
            ?>
            <div class="col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="<?= $sector->sort_order * 100 ?>">
                <div class="card h-100 shadow-sm text-center">
                    <div class="card-body">
                        <?php if ($sector->icon): ?>
                            <i class="<?= Html::encode($sector->icon) ?> fa-2x mb-3" style="color: #764ba2;"></i>
                        <?php endif; ?>
                        <h5 class="card-title"><?= Html::encode($sector->name) ?></h5>
                        <p class="card-text small"><?= Html::encode($sector->description) ?></p>
                        <?= Html::a('Voir', ['sector/view', 'slug' => $sector->slug], ['class' => 'btn btn-sm btn-secondary']) ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php
// Ajouter les styles CSS personnalisés
$this->registerCss("
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 80px 0;
    }
    .card {
        transition: transform 0.3s ease-in-out;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
");
?>
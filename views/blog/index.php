<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Blog - Actualités';
?>

<div class="blog-index">
    <div class="container py-5">
        <div class="row">
            <div class="col-12 text-center mb-5" data-aos="fade-down">
                <h1 class="display-4">Actualités</h1>
                <p class="lead text-muted">Découvrez nos derniers articles et actualités</p>
            </div>
        </div>
        
        <div class="row">
            <?php if (empty($posts)): ?>
                <div class="col-12 text-center">
                    <p class="text-muted">Aucun article pour le moment.</p>
                </div>
            <?php else: ?>
                <?php foreach ($posts as $post): ?>
                <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up">
                    <div class="card h-100 shadow-lg border-0 hover-float">
                        <?php if ($post->image): ?>
                            <?= Html::img('@web/uploads/' . $post->image, [
                                'class' => 'card-img-top', 
                                'alt' => $post->title,
                                'style' => 'height: 200px; object-fit: cover;'
                            ]) ?>
                        <?php else: ?>
                            <div class="card-img-top bg-gradient-primary text-center py-5">
                                <i class="fas fa-newspaper fa-4x text-white"></i>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <div class="text-muted small mb-2">
                                <i class="far fa-calendar-alt"></i> <?= Yii::$app->formatter->asDate($post->created_at) ?>
                                <span class="ms-2"><i class="far fa-eye"></i> <?= $post->views ?> vues</span>
                            </div>
                            <h3 class="card-title h4"><?= Html::encode($post->title) ?></h3>
                            <p class="card-text"><?= Html::encode($post->excerpt) ?></p>
                            <?= Html::a('Lire la suite <i class="fas fa-arrow-right"></i>', ['view', 'slug' => $post->slug], ['class' => 'btn btn-link text-decoration-none']) ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
$this->registerCss("
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .hover-float {
        transition: transform 0.3s ease;
    }
    .hover-float:hover {
        transform: translateY(-10px);
    }
");
?>
<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $post->title;
?>

<div class="blog-view">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- En-tête de l'article -->
                <div class="text-center mb-5" data-aos="fade-down">
                    <div class="text-muted mb-3">
                        <i class="far fa-calendar-alt"></i> <?= Yii::$app->formatter->asDate($post->created_at) ?>
                        <span class="mx-2">|</span>
                        <i class="far fa-eye"></i> <?= $post->views ?> vues
                    </div>
                    <h1 class="display-4"><?= Html::encode($post->title) ?></h1>
                </div>
                
                <!-- Image principale -->
                <?php if ($post->image): ?>
                <div class="mb-5" data-aos="zoom-in">
                    <?= Html::img('@web/uploads/' . $post->image, [
                        'class' => 'img-fluid rounded shadow',
                        'alt' => $post->title
                    ]) ?>
                </div>
                <?php endif; ?>
                
                <!-- Contenu -->
                <div class="content" data-aos="fade-up">
                    <?= $post->content ?>
                </div>
                
                <!-- Boutons de partage -->
                <div class="share-buttons mt-5 pt-4 border-top" data-aos="fade-up">
                    <h5>Partager cet article :</h5>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(Yii::$app->request->absoluteUrl) ?>" 
                       target="_blank" class="btn btn-outline-primary btn-sm me-2">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url=<?= urlencode(Yii::$app->request->absoluteUrl) ?>&text=<?= urlencode($post->title) ?>" 
                       target="_blank" class="btn btn-outline-primary btn-sm me-2">
                        <i class="fab fa-twitter"></i> Twitter
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= urlencode(Yii::$app->request->absoluteUrl) ?>&title=<?= urlencode($post->title) ?>" 
                       target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fab fa-linkedin-in"></i> LinkedIn
                    </a>
                </div>
                
                <!-- Bouton retour -->
                <div class="text-center mt-5">
                    <?= Html::a('<i class="fas fa-arrow-left"></i> Retour au blog', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerCss("
    .blog-view .content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #444;
    }
    .blog-view .content h2 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: #667eea;
    }
    .blog-view .content img {
        max-width: 100%;
        height: auto;
        margin: 1.5rem 0;
        border-radius: 8px;
    }
    .share-buttons a {
        transition: transform 0.3s ease;
    }
    .share-buttons a:hover {
        transform: translateY(-2px);
    }
");
?>
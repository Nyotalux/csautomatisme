<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-contact">
    <div class="container py-5">
        <div class="row">
            <div class="col-12 text-center mb-5" data-aos="fade-down">
                <h1 class="display-4"><?= Html::encode($this->title) ?></h1>
                <p class="lead text-muted">N'hésitez pas à nous contacter pour toute question ou devis</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6 mb-4" data-aos="fade-right">
                <div class="card shadow-lg border-0 h-100">
                    <div class="card-body p-5">
                        <h3 class="mb-4">Nos coordonnées</h3>
                        
                        <div class="mb-4">
                            <i class="fas fa-map-marker-alt fa-2x text-primary mb-3"></i>
                            <h5>Adresse</h5>
                            <p class="text-muted">123 Avenue des Automatismes<br>75000 Paris, France</p>
                        </div>
                        
                        <div class="mb-4">
                            <i class="fas fa-phone fa-2x text-primary mb-3"></i>
                            <h5>Téléphone</h5>
                            <p class="text-muted">+33 1 23 45 67 89</p>
                        </div>
                        
                        <div class="mb-4">
                            <i class="fas fa-envelope fa-2x text-primary mb-3"></i>
                            <h5>Email</h5>
                            <p class="text-muted">contact@csautomatisme.com</p>
                        </div>
                        
                        <div class="mb-4">
                            <i class="fas fa-clock fa-2x text-primary mb-3"></i>
                            <h5>Horaires</h5>
                            <p class="text-muted">Lundi - Vendredi: 9h00 - 18h00<br>Samedi - Dimanche: Fermé</p>
                        </div>
                        
                        <div class="mt-4">
                            <h5>Suivez-nous</h5>
                            <a href="#" class="btn btn-outline-primary btn-sm me-2"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="btn btn-outline-primary btn-sm me-2"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="btn btn-outline-primary btn-sm me-2"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="btn btn-outline-primary btn-sm"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 mb-4" data-aos="fade-left">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <h3 class="mb-4">Envoyez-nous un message</h3>
                        
                        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                            
                            <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'placeholder' => 'Votre nom']) ?>
                            
                            <?= $form->field($model, 'email')->input('email', ['placeholder' => 'votre@email.com']) ?>
                            
                            <?= $form->field($model, 'subject')->textInput(['placeholder' => 'Sujet de votre message']) ?>
                            
                            <?= $form->field($model, 'body')->textarea(['rows' => 6, 'placeholder' => 'Votre message...']) ?>
                            
                            <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                            ]) ?>
                            
                            <div class="form-group">
                                <?= Html::submitButton('Envoyer', ['class' => 'btn btn-primary btn-lg', 'name' => 'contact-button']) ?>
                            </div>
                            
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Carte Google Maps -->
        <div class="row mt-5" data-aos="zoom-in">
            <div class="col-12">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-0">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.991440608414!2d2.292292615509614!3d48.85837007928754!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e2964e34e2d%3A0x8ddca9ee380ef7e0!2sTour%20Eiffel!5e0!3m2!1sfr!2sfr!4v1645000000000!5m2!1sfr!2sfr" 
                            width="100%" 
                            height="400" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerCss("
    .site-contact .card {
        transition: transform 0.3s ease;
    }
    .site-contact .card:hover {
        transform: translateY(-5px);
    }
");
?>
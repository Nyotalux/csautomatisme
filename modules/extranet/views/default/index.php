<?php
$this->title = 'Extranet - Administration';
?>
<div class="extranet-default-index">
    <h1>Bienvenue dans l'extranet</h1>
    <p>Gérez vos départements, services et secteurs d'intervention.</p>
    
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Départements</h5>
                    <p class="card-text">Gérer les départements</p>
                    <a href="<?= \yii\helpers\Url::to(['/extranet/department']) ?>" class="btn btn-primary">Accéder</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Services</h5>
                    <p class="card-text">Gérer les services</p>
                    <a href="<?= \yii\helpers\Url::to(['/extranet/service']) ?>" class="btn btn-primary">Accéder</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Secteurs</h5>
                    <p class="card-text">Gérer les secteurs d'intervention</p>
                    <a href="<?= \yii\helpers\Url::to(['/extranet/sector']) ?>" class="btn btn-primary">Accéder</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Galerie</h5>
                    <p class="card-text">Gérer les images</p>
                    <a href="<?= \yii\helpers\Url::to(['/extranet/gallery']) ?>" class="btn btn-primary">Accéder</a>
                </div>
            </div>
        </div>
    </div>
</div>
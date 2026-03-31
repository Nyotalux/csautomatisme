<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\Department;
use app\models\Service;
use app\models\Sector;

class DataSeederController extends Controller
{
    public function actionIndex()
    {
        echo "Début du remplissage des données...\n";
        
        // Créer les départements
        $departments = [
            ['name' => 'Automatisme Industriel'],
            ['name' => 'Domotique'],
            ['name' => 'Électricité'],
            ['name' => 'Informatique Industrielle'],
        ];
        
        foreach ($departments as $dept) {
            $department = new Department();
            $department->name = $dept['name'];
            $department->created_at = date('Y-m-d H:i:s');
            $department->updated_at = date('Y-m-d H:i:s');
            $department->save();
            echo "Département créé: {$dept['name']}\n";
        }
        
        // Créer les services
        $services = [
            [
                'department_id' => 1,
                'name' => 'Automatisation des lignes de production',
                'slug' => 'automatisation-lignes-production',
                'description' => 'Optimisation et automatisation de vos lignes de production',
                'content' => '<p>Nous concevons et réalisons des systèmes d\'automatisation sur mesure pour vos lignes de production. Notre expertise couvre :</p>
                <ul>
                    <li>Étude et conception de solutions automatisées</li>
                    <li>Programmation d\'automates (Siemens, Schneider, Allen Bradley)</li>
                    <li>Supervision et interfaces homme-machine</li>
                    <li>Mise en service et formation</li>
                </ul>',
                'icon' => 'fas fa-industry',
                'animation' => 'fadeInUp',
                'sort_order' => 1,
            ],
            [
                'department_id' => 1,
                'name' => 'Robotique industrielle',
                'slug' => 'robotique-industrielle',
                'description' => 'Intégration de robots pour vos processus industriels',
                'content' => '<p>Spécialistes en robotique industrielle, nous vous accompagnons dans l\'intégration de solutions robotisées :</p>
                <ul>
                    <li>Choix et intégration de robots</li>
                    <li>Programmation et simulation</li>
                    <li>Sécurité des zones robotisées</li>
                    <li>Maintenance et support</li>
                </ul>',
                'icon' => 'fas fa-robot',
                'animation' => 'fadeInUp',
                'sort_order' => 2,
            ],
            [
                'department_id' => 2,
                'name' => 'Domotique résidentielle',
                'slug' => 'domotique-residentielle',
                'description' => 'Maisons connectées et intelligentes',
                'content' => '<p>Transformez votre maison en habitat intelligent :</p>
                <ul>
                    <li>Gestion centralisée de l\'éclairage et des volets</li>
                    <li>Contrôle du chauffage et de la climatisation</li>
                    <li>Sécurité et vidéosurveillance</li>
                    <li>Contrôle vocal et à distance</li>
                </ul>',
                'icon' => 'fas fa-home',
                'animation' => 'fadeInUp',
                'sort_order' => 3,
            ],
            [
                'department_id' => 3,
                'name' => 'Installations électriques',
                'slug' => 'installations-electriques',
                'description' => 'Conception et réalisation d\'installations électriques',
                'content' => '<p>Experts en électricité industrielle et tertiaire :</p>
                <ul>
                    <li>Étude et dimensionnement</li>
                    <li>Installation de tableaux électriques</li>
                    <li>Mise aux normes et conformité</li>
                    <li>Maintenance préventive et curative</li>
                </ul>',
                'icon' => 'fas fa-bolt',
                'animation' => 'fadeInUp',
                'sort_order' => 4,
            ],
        ];
        
        foreach ($services as $svc) {
            $service = new Service();
            $service->attributes = $svc;
            $service->created_at = date('Y-m-d H:i:s');
            $service->updated_at = date('Y-m-d H:i:s');
            $service->save();
            echo "Service créé: {$svc['name']}\n";
        }
        
        // Créer les secteurs
        $sectors = [
            [
                'service_id' => 1,
                'name' => 'Automobile',
                'slug' => 'automobile',
                'description' => 'Automatisation des chaînes de montage automobile',
                'icon' => 'fas fa-car',
                'sort_order' => 1,
            ],
            [
                'service_id' => 1,
                'name' => 'Agroalimentaire',
                'slug' => 'agroalimentaire',
                'description' => 'Solutions pour l\'industrie agroalimentaire',
                'icon' => 'fas fa-apple-alt',
                'sort_order' => 2,
            ],
            [
                'service_id' => 2,
                'name' => 'Industrie pharmaceutique',
                'slug' => 'pharmaceutique',
                'description' => 'Automatisation des process pharmaceutiques',
                'icon' => 'fas fa-capsules',
                'sort_order' => 3,
            ],
            [
                'service_id' => 3,
                'name' => 'Résidentiel',
                'slug' => 'residentiel',
                'description' => 'Maisons et appartements connectés',
                'icon' => 'fas fa-building',
                'sort_order' => 4,
            ],
            [
                'service_id' => 4,
                'name' => 'Tertiaire',
                'slug' => 'tertiaire',
                'description' => 'Bureaux et commerces',
                'icon' => 'fas fa-briefcase',
                'sort_order' => 5,
            ],
        ];
        
        foreach ($sectors as $sec) {
            $sector = new Sector();
            $sector->attributes = $sec;
            $sector->created_at = date('Y-m-d H:i:s');
            $sector->updated_at = date('Y-m-d H:i:s');
            $sector->save();
            echo "Secteur créé: {$sec['name']}\n";
        }
        
        echo "Remplissage terminé avec succès!\n";
    }
}
<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\User;
use app\models\Role;
use app\models\Region;
use app\models\Service;
use app\models\Sector;
use app\models\Department;
use app\models\Post;
use app\models\Testimonial;

class DataSeederController extends Controller
{
    public function actionIndex()
    {
        echo "=== Début du remplissage des données ===\n\n";
        
        $this->createRegions();
        $this->createRoles();
        $this->createDepartments();
        $this->createServices();
        $this->createSectors();
        $this->createUsers();
        $this->createPosts();
        $this->createTestimonials();
        
        echo "\n=== Remplissage terminé avec succès ! ===\n";
    }
    
    private function createRegions()
    {
        echo "Création des régions...\n";
        
        $regions = [
            ['name' => 'Île-de-France', 'code' => 'IDF', 'description' => 'Région parisienne'],
            ['name' => 'Auvergne-Rhône-Alpes', 'code' => 'ARA', 'description' => 'Région lyonnaise et alpine'],
            ['name' => 'Nouvelle-Aquitaine', 'code' => 'NAQ', 'description' => 'Sud-Ouest de la France'],
            ['name' => 'Occitanie', 'code' => 'OCC', 'description' => 'Sud de la France'],
            ['name' => 'Grand Est', 'code' => 'GES', 'description' => 'Est de la France'],
            ['name' => 'Hauts-de-France', 'code' => 'HDF', 'description' => 'Nord de la France'],
            ['name' => 'Normandie', 'code' => 'NOR', 'description' => 'Normandie'],
            ['name' => 'Bretagne', 'code' => 'BRE', 'description' => 'Bretagne'],
            ['name' => 'Pays de la Loire', 'code' => 'PDL', 'description' => 'Pays de la Loire'],
            ['name' => 'Centre-Val de Loire', 'code' => 'CVL', 'description' => 'Centre'],
            ['name' => 'Bourgogne-Franche-Comté', 'code' => 'BFC', 'description' => 'Bourgogne'],
            ['name' => 'Provence-Alpes-Côte d\'Azur', 'code' => 'PAC', 'description' => 'Sud-Est'],
            ['name' => 'Corse', 'code' => 'COR', 'description' => 'Île de Beauté'],
        ];
        
        foreach ($regions as $region) {
            $model = new Region();
            $model->name = $region['name'];
            $model->code = $region['code'];
            $model->description = $region['description'];
            $model->status = 1;
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save();
        }
        
        echo "  - " . count($regions) . " régions créées\n";
    }
    
    private function createRoles()
    {
        echo "Création des rôles...\n";
        
        $roles = [
            [
                'name' => 'Administrateur',
                'slug' => 'admin',
                'description' => 'Accès complet à toutes les fonctionnalités',
                'permissions' => json_encode([
                    'manage_users' => true,
                    'manage_services' => true,
                    'manage_sectors' => true,
                    'manage_regions' => true,
                    'manage_posts' => true,
                    'manage_testimonials' => true,
                    'view_all' => true,
                    'edit_all' => true,
                    'delete_all' => true,
                ]),
            ],
            [
                'name' => 'Responsable Service',
                'slug' => 'service_manager',
                'description' => 'Gestion de son service uniquement',
                'permissions' => json_encode([
                    'manage_users' => false,
                    'manage_services' => true,
                    'manage_sectors' => true,
                    'manage_regions' => false,
                    'manage_posts' => true,
                    'manage_testimonials' => true,
                    'view_all' => false,
                    'edit_all' => false,
                    'delete_all' => false,
                ]),
            ],
            [
                'name' => 'Technicien',
                'slug' => 'technician',
                'description' => 'Consultation et modification limitée',
                'permissions' => json_encode([
                    'manage_users' => false,
                    'manage_services' => false,
                    'manage_sectors' => false,
                    'manage_regions' => false,
                    'manage_posts' => false,
                    'manage_testimonials' => false,
                    'view_all' => false,
                    'edit_all' => false,
                    'delete_all' => false,
                ]),
            ],
            [
                'name' => 'Commercial',
                'slug' => 'commercial',
                'description' => 'Accès aux données clients et devis',
                'permissions' => json_encode([
                    'manage_users' => false,
                    'manage_services' => false,
                    'manage_sectors' => false,
                    'manage_regions' => false,
                    'manage_posts' => false,
                    'manage_testimonials' => false,
                    'view_all' => false,
                    'edit_all' => false,
                    'delete_all' => false,
                ]),
            ],
        ];
        
        foreach ($roles as $role) {
            $model = new Role();
            $model->name = $role['name'];
            $model->slug = $role['slug'];
            $model->description = $role['description'];
            $model->permissions = $role['permissions'];
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save();
        }
        
        echo "  - " . count($roles) . " rôles créés\n";
    }
    
    private function createDepartments()
    {
        echo "Création des départements...\n";
        
        $departments = [
            ['name' => 'Automatisme Industriel'],
            ['name' => 'Domotique'],
            ['name' => 'Électricité'],
            ['name' => 'Informatique Industrielle'],
            ['name' => 'Robotique'],
            ['name' => 'Maintenance'],
        ];
        
        foreach ($departments as $dept) {
            $model = new Department();
            $model->name = $dept['name'];
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save();
        }
        
        echo "  - " . count($departments) . " départements créés\n";
    }
    
    private function createServices()
    {
        echo "Création des services...\n";
        
        $services = [
            [
                'department_id' => 1,
                'name' => 'Automatisation des lignes de production',
                'slug' => 'automatisation-lignes-production',
                'description' => 'Optimisation et automatisation de vos lignes de production',
                'content' => '<p>Nous concevons et réalisons des systèmes d\'automatisation sur mesure pour vos lignes de production.</p>',
                'icon' => 'fas fa-industry',
                'sort_order' => 1,
            ],
            [
                'department_id' => 1,
                'name' => 'Robotique industrielle',
                'slug' => 'robotique-industrielle',
                'description' => 'Intégration de robots pour vos processus industriels',
                'content' => '<p>Spécialistes en robotique industrielle, nous vous accompagnons dans l\'intégration de solutions robotisées.</p>',
                'icon' => 'fas fa-robot',
                'sort_order' => 2,
            ],
            [
                'department_id' => 2,
                'name' => 'Domotique résidentielle',
                'slug' => 'domotique-residentielle',
                'description' => 'Maisons connectées et intelligentes',
                'content' => '<p>Transformez votre maison en habitat intelligent.</p>',
                'icon' => 'fas fa-home',
                'sort_order' => 3,
            ],
            [
                'department_id' => 3,
                'name' => 'Installations électriques',
                'slug' => 'installations-electriques',
                'description' => 'Conception et réalisation d\'installations électriques',
                'content' => '<p>Experts en électricité industrielle et tertiaire.</p>',
                'icon' => 'fas fa-bolt',
                'sort_order' => 4,
            ],
            [
                'department_id' => 4,
                'name' => 'Supervision industrielle',
                'slug' => 'supervision-industrielle',
                'description' => 'Solutions de supervision et contrôle',
                'content' => '<p>Solutions de supervision pour optimiser votre production.</p>',
                'icon' => 'fas fa-desktop',
                'sort_order' => 5,
            ],
        ];
        
        foreach ($services as $svc) {
            $model = new Service();
            $model->attributes = $svc;
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save();
        }
        
        echo "  - " . count($services) . " services créés\n";
    }
    
    private function createSectors()
    {
        echo "Création des secteurs...\n";
        
        $sectors = [
            ['service_id' => 1, 'name' => 'Automobile', 'slug' => 'automobile', 'description' => 'Automatisation des chaînes de montage automobile', 'icon' => 'fas fa-car', 'sort_order' => 1],
            ['service_id' => 1, 'name' => 'Agroalimentaire', 'slug' => 'agroalimentaire', 'description' => 'Solutions pour l\'industrie agroalimentaire', 'icon' => 'fas fa-apple-alt', 'sort_order' => 2],
            ['service_id' => 2, 'name' => 'Pharmaceutique', 'slug' => 'pharmaceutique', 'description' => 'Automatisation des process pharmaceutiques', 'icon' => 'fas fa-capsules', 'sort_order' => 3],
            ['service_id' => 3, 'name' => 'Résidentiel', 'slug' => 'residentiel', 'description' => 'Maisons et appartements connectés', 'icon' => 'fas fa-building', 'sort_order' => 4],
            ['service_id' => 4, 'name' => 'Tertiaire', 'slug' => 'tertiaire', 'description' => 'Bureaux et commerces', 'icon' => 'fas fa-briefcase', 'sort_order' => 5],
            ['service_id' => 5, 'name' => 'Industrie lourde', 'slug' => 'industrie-lourde', 'description' => 'Supervision des grands sites industriels', 'icon' => 'fas fa-factory', 'sort_order' => 6],
        ];
        
        foreach ($sectors as $sec) {
            $model = new Sector();
            $model->attributes = $sec;
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save();
        }
        
        echo "  - " . count($sectors) . " secteurs créés\n";
    }
    
    private function createUsers()
    {
        echo "Création des utilisateurs...\n";
        
        $users = [
            // Admin
            [
                'username' => 'admin',
                'password' => 'admin123',
                'first_name' => 'Jean',
                'last_name' => 'Admin',
                'email' => 'admin@csautomatisme.com',
                'role_id' => 1, // admin
                'service_id' => null,
                'sector_id' => null,
                'region_id' => null,
                'status' => 10,
            ],
            // Responsable Automatisme - IDF
            [
                'username' => 'paul.durand',
                'password' => 'password',
                'first_name' => 'Paul',
                'last_name' => 'Durand',
                'email' => 'paul.durand@csautomatisme.com',
                'role_id' => 2, // service_manager
                'service_id' => 1, // Automatisation
                'sector_id' => 1, // Automobile
                'region_id' => 1, // IDF
                'status' => 10,
            ],
            // Responsable Domotique - ARA
            [
                'username' => 'marie.martin',
                'password' => 'password',
                'first_name' => 'Marie',
                'last_name' => 'Martin',
                'email' => 'marie.martin@csautomatisme.com',
                'role_id' => 2,
                'service_id' => 3, // Domotique
                'sector_id' => 4, // Résidentiel
                'region_id' => 2, // ARA
                'status' => 10,
            ],
            // Technicien Électricité - NAQ
            [
                'username' => 'thomas.bernard',
                'password' => 'password',
                'first_name' => 'Thomas',
                'last_name' => 'Bernard',
                'email' => 'thomas.bernard@csautomatisme.com',
                'role_id' => 3, // technician
                'service_id' => 4, // Installations électriques
                'sector_id' => 5, // Tertiaire
                'region_id' => 3, // NAQ
                'status' => 10,
            ],
            // Commercial - OCC
            [
                'username' => 'sophie.petit',
                'password' => 'password',
                'first_name' => 'Sophie',
                'last_name' => 'Petit',
                'email' => 'sophie.petit@csautomatisme.com',
                'role_id' => 4, // commercial
                'service_id' => 2, // Robotique
                'sector_id' => 3, // Pharmaceutique
                'region_id' => 4, // OCC
                'status' => 10,
            ],
            // Responsable Robotique - HDF
            [
                'username' => 'lucas.robert',
                'password' => 'password',
                'first_name' => 'Lucas',
                'last_name' => 'Robert',
                'email' => 'lucas.robert@csautomatisme.com',
                'role_id' => 2,
                'service_id' => 2, // Robotique
                'sector_id' => 3, // Pharmaceutique
                'region_id' => 6, // HDF
                'status' => 10,
            ],
            // Technicien Domotique - BRE
            [
                'username' => 'emma.dubois',
                'password' => 'password',
                'first_name' => 'Emma',
                'last_name' => 'Dubois',
                'email' => 'emma.dubois@csautomatisme.com',
                'role_id' => 3,
                'service_id' => 3, // Domotique
                'sector_id' => 4, // Résidentiel
                'region_id' => 8, // Bretagne
                'status' => 10,
            ],
        ];
        
        foreach ($users as $userData) {
            $user = new User();
            $user->username = $userData['username'];
            $user->setPassword($userData['password']);
            $user->authKey = Yii::$app->security->generateRandomString();
            $user->accessToken = Yii::$app->security->generateRandomString();
            $user->first_name = $userData['first_name'];
            $user->last_name = $userData['last_name'];
            $user->service_id = $userData['service_id'];
            $user->sector_id = $userData['sector_id'];
            $user->region_id = $userData['region_id'];
            $user->role_id = $userData['role_id'];
            $user->status = $userData['status'];
            $user->created_at = date('Y-m-d H:i:s');
            $user->updated_at = date('Y-m-d H:i:s');
            $user->save();
        }
        
        echo "  - " . count($users) . " utilisateurs créés\n";
    }
    
    private function createPosts()
    {
        echo "Création des articles de blog...\n";
        
        $posts = [
            [
                'title' => 'Les tendances de l\'automatisme en 2024',
                'slug' => 'tendances-automatisme-2024',
                'excerpt' => 'Découvrez les innovations qui façonnent l\'avenir de l\'automatisme industriel',
                'content' => '<p>L\'année 2024 marque un tournant dans le monde de l\'automatisme avec l\'émergence de nouvelles technologies.</p><h2>Les 5 tendances majeures</h2><ul><li>Intelligence Artificielle embarquée</li><li>Jumeaux numériques</li><li>Cybersécurité industrielle</li><li>5G industrielle</li><li>Éco-conception</li></ul>',
                'status' => 1,
            ],
            [
                'title' => 'Comment optimiser votre consommation énergétique',
                'slug' => 'optimiser-consommation-energetique',
                'excerpt' => 'Solutions pratiques pour réduire vos factures d\'électricité',
                'content' => '<p>La maîtrise de la consommation énergétique est devenue un enjeu majeur pour les entreprises.</p><h2>1. Audit énergétique</h2><h2>2. Automatisation intelligente</h2><h2>3. Gestion de l\'éclairage</h2><h2>4. Supervision centralisée</h2>',
                'status' => 1,
            ],
            [
                'title' => 'La domotique : vers une maison intelligente',
                'slug' => 'domotique-maison-intelligente',
                'excerpt' => 'Comment la technologie transforme nos habitats',
                'content' => '<p>La domotique révolutionne notre façon de vivre.</p><h2>Confort et bien-être</h2><h2>Sécurité renforcée</h2><h2>Économies d\'énergie</h2><h2>Accessibilité</h2>',
                'status' => 1,
            ],
        ];
        
        foreach ($posts as $postData) {
            $post = new Post();
            $post->title = $postData['title'];
            $post->slug = $postData['slug'];
            $post->excerpt = $postData['excerpt'];
            $post->content = $postData['content'];
            $post->status = $postData['status'];
            $post->views = 0;
            $post->created_at = date('Y-m-d H:i:s');
            $post->updated_at = date('Y-m-d H:i:s');
            $post->save();
        }
        
        echo "  - " . count($posts) . " articles créés\n";
    }
    
    private function createTestimonials()
    {
        echo "Création des témoignages...\n";
        
        $testimonials = [
            ['client_name' => 'Jean Dupont', 'client_company' => 'Industrie Moderne', 'content' => 'Excellent travail ! L\'équipe a su répondre à tous nos besoins.', 'rating' => 5],
            ['client_name' => 'Marie Martin', 'client_company' => 'Tech Solutions', 'content' => 'Professionnalisme et réactivité. Je recommande vivement.', 'rating' => 5],
            ['client_name' => 'Pierre Durand', 'client_company' => 'Bâtiment Plus', 'content' => 'Service après-vente impeccable. Toujours disponibles.', 'rating' => 4],
            ['client_name' => 'Sophie Bernard', 'client_company' => 'Agro France', 'content' => 'Une équipe compétente qui maîtrise parfaitement son sujet.', 'rating' => 5],
        ];
        
        foreach ($testimonials as $testimonialData) {
            $testimonial = new Testimonial();
            $testimonial->client_name = $testimonialData['client_name'];
            $testimonial->client_company = $testimonialData['client_company'];
            $testimonial->content = $testimonialData['content'];
            $testimonial->rating = $testimonialData['rating'];
            $testimonial->status = 1;
            $testimonial->sort_order = 1;
            $testimonial->created_at = date('Y-m-d H:i:s');
            $testimonial->updated_at = date('Y-m-d H:i:s');
            $testimonial->save();
        }
        
        echo "  - " . count($testimonials) . " témoignages créés\n";
    }
}
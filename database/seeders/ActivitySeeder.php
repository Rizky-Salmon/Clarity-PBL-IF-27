<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Activity::insert([
            ['activity_name' => 'Représentation institutionelle'],
            ['activity_name' => 'Accompagnement renforcé EUNICE'],
            ['activity_name' => 'Collecte des indicateurs'],
            ['activity_name' => 'Contrôle financier de projet'],
            ['activity_name' => 'Gestion réunion "Statut Projet"'],
            ['activity_name' => 'Représentation UPHF Board of Director EUNICE'],
            ['activity_name' => 'Conseil au pilotage des Projets Erasmus+ de l’UPHF'],
            ['activity_name' => 'Suivi du respect de la Charte Erasmus+'],
            ['activity_name' => 'Etablissement et suivi des budgets'],
            ['activity_name' => 'Etablissement des rapports, bilans et statistiques'],
            ['activity_name' => 'Encadrement d\'agents'],
            ['activity_name' => 'Amélioration permanente du branding RI de l’UPHF'],
            ['activity_name' => 'Liaison entre la Cellule mobilité et la Cellule Projets et Partenariats'],
            ['activity_name' => 'Réponses aux sollicitations des partenaires et acteurs internes sur les accords'],
            ['activity_name' => 'Gestion personnel, chronotime'],
            ['activity_name' => 'Prospection des universités dans les pays anglophones BRIDGE'],
            ['activity_name' => 'Participation à la coordination et à l\'organisation de l\'accueil des délégations étrangères à l\'université en lien avec la présidence'],
            ['activity_name' => 'Contribution aux partages de connaissances intra-service et intra-universitaire'],
            ['activity_name' => 'Accompagnement des enseignants et particulièrement les chargés de mission par zone géographique dans le développement et le suivi de leurs activités internationales'],
            ['activity_name' => 'Evaluation des partenariats en cours (fiches de synthèse, tableaux de bord, statistiques) et proposer des pistes d’amélioration'],
            ['activity_name' => 'Veille stratégique sur les opportunités de financement et sur les appels à projets en fonction de besoins identifiés (exemples non limitants ; Erasmus+, ADESFA, AUF, Ambassades, etc.)'],
            ['activity_name' => 'Identification des réseaux d’informations et partager les informations sur ces opportunités'],
            ['activity_name' => 'Relecture et traduction de documents en anglais et en français'],
            ['activity_name' => 'Coordination d\'un volet de projet : IUMEME'],
            ['activity_name' => 'Accompagnement du PRI à organiser et stabiliser la gestion de projet'],
            ['activity_name' => 'Accompagnement des Chargé de mission pour la coordination et le développement de leur perimètre'],
            ['activity_name' => 'Veille et participation aux montages et dépôts de projets Erasmus+'],
            ['activity_name' => 'Contribution au dévelopement d\'outils de communication en faveur de ces publics et de la promotion du label EURAXESS'],
            ['activity_name' => 'Elaboration et mise en œuvre la politique de coopération internationale de l\'établissement'],
            ['activity_name' => 'Conseil à l\'équipe de direction dans le domaine de la coopération internationale en relation avec la politique scientifique de l\'établissement, synthétiser et préparer des éléments d\'aide à la décision'],
            ['activity_name' => 'Représentation de l\'établissement et animer les relations avec les partenaires, constituer des réseaux professionnels, impulser et coordonner des manifestations internationales'],
            ['activity_name' => 'Promotion des activités scientifiques et/ou pédagogiques de l\'établissement sur le plan international, rechercher et fédérer des partenaires potentiels'],
            ['activity_name' => 'Pilotage des programmes de coopération internationale'],
            ['activity_name' => 'Négociation des conventions correspondantes aux programmes de coopération internationale et en assurer le suivi'],
            ['activity_name' => 'Promotion et organisation de la veille sur les dispositifs européens et/ou internationaux existants dans le domaine de la recherche et/ou de la formation'],
            ['activity_name' => 'Promotion et organisation de la diffusion de l\'information sur la coopération internationale'],
            ['activity_name' => 'Organisation et réflexion prospective sur le développement de l’offre de formations proposée en co-diplomation et sur l’internationalisation des formations et proposer les actions à mener'],
            ['activity_name' => 'Planification, organisation et le contrôle des activités du service, ainsi que l\'encadrement des personnels'],
            ['activity_name' => 'Mise en place d\'une méthodologie de gestion de projet cohérente à l’UPHF'],
            ['activity_name' => 'Participation au bon accueil des délégations étrangères'],
            ['activity_name' => 'Animation équipe projet local'],
            ['activity_name' => 'Lien avec coordinateur du projet'],
            ['activity_name' => 'Rédaction et mise à jour Procédure DAF/AC'],
            ['activity_name' => 'Représentation UPHF Project Management Team meeting'],
            ['activity_name' => 'Représentation UPHF Student Board EUNICE'],
            ['activity_name' => 'Participations aux activités AISBL'],
            ['activity_name' => 'Mise à jour/netttoyage/archive Arborescence serveur'],
            ['activity_name' => 'Définition de la stratégie pour la participation aux actions de mobilité Erasmus+ et autres'],
        ]);

    }
}

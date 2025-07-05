<?php
namespace App\Services;

use App\Repositories\VenteRepository;
use App\Repositories\ArticleVenteRepository; 
use App\Models\Vente;
use App\Models\ArticleVente; 
use App\Services\ClientService; 
use App\Services\UtilisateurService; 

class VenteService {
    private $venteRepository;
    private $articleVenteRepository;
    private $clientService;
    private $utilisateurService;

    public function __construct() {
        $this->venteRepository = new VenteRepository();
        $this->articleVenteRepository = new ArticleVenteRepository();
        $this->clientService = new ClientService();
        $this->utilisateurService = new UtilisateurService();
    }

    public function getAllVentes(): array {
        $ventesData = $this->venteRepository->findAll();
        $ventes = [];
        foreach ($ventesData as $data) {
            $ventes[] = (new Vente())->fromArray($data);
        }
        return $ventes;
    }

    public function getVenteById(int $id): ?Vente {
        $venteData = $this->venteRepository->findById($id);
        if ($venteData) {
            return (new Vente())->fromArray($venteData);
        }
        return null;
    }


    public function createVente(array $data): ?Vente {
        // Validation basique
        if (empty($data['client_id']) || empty($data['articles'])) {
            return null; 
        }

        $totalVente = 0;
        $detailsProduitsVendus = [];

        foreach ($data['articles'] as $item) {
            $article = $this->articleVenteRepository->findById($item['article_vente_id']);
            if (!$article) {
                return null;
            }

            if ($article['quantite_stock'] < $item['quantite_vendue']) {
                return null;
            }

            $prixUnitaire = $article['prix_vente']; 
            $totalVente += $prixUnitaire * $item['quantite_vendue'];

            $detailsProduitsVendus[] = [
                'article_vente_id' => $item['article_vente_id'],
                'nom_produit' => $article['nom_produit'], 
                'quantite_vendue' => $item['quantite_vendue'],
                'prix_unitaire_vente' => $prixUnitaire
            ];
        }

        $venteData = [
            'client_id' => $data['client_id'],
            'total_vente' => $totalVente,
            'utilisateur_id' => $_SESSION['user_id'] ?? null, 
            'statut_paiement' => $data['statut_paiement'] ?? 'en_attente',
            'mode_paiement' => $data['mode_paiement'] ?? null,
            'details_produits_vendus' => json_encode($detailsProduitsVendus) 
        ];

        $venteId = $this->venteRepository->create($venteData);

        if ($venteId) {
            foreach ($data['articles'] as $item) {
                $article = $this->articleVenteRepository->findById($item['article_vente_id']);
                $nouvelleQuantiteStock = ($article['quantite_stock'] ?? 0) - (int)$item['quantite_vendue'];
                $this->articleVenteRepository->update($item['article_vente_id'], ['quantite_stock' => $nouvelleQuantiteStock]);
            }
            return $this->getVenteById($venteId);
        }
        return null;
    }

    public function updateVente(int $id, array $data): bool {
        $existingVente = $this->venteRepository->findById($id);
        if (!$existingVente) {
            return false;
        }

        $updateData = [];
        if (isset($data['client_id'])) $updateData['client_id'] = $data['client_id'];
        if (isset($data['statut_paiement'])) $updateData['statut_paiement'] = $data['statut_paiement'];
        if (isset($data['mode_paiement'])) $updateData['mode_paiement'] = $data['mode_paiement'];

        return $this->venteRepository->update($id, $updateData);
    }

    public function deleteVente(int $id): bool {
        return $this->venteRepository->delete($id);
    }

    public function getClientsForForm(): array {
        return $this->clientService->getAllClients();
    }

    public function getArticlesVenteForForm(): array {
        $articlesData = $this->articleVenteRepository->findAll();
        $articles = [];
        foreach ($articlesData as $data) {
            $articles[] = (new ArticleVente())->fromArray($data);
        }
        return $articles;
    }

    public function getVentesWithRelatedNames(): array {
        $ventes = $this->getAllVentes();
        $clients = $this->clientService->getAllClients();
        $utilisateurs = $this->utilisateurService->getAllUtilisateurs();

        $clientMap = [];
        foreach ($clients as $client) {
            $clientMap[$client->getClientId()] = $client->getNom();
        }

        $utilisateurMap = [];
        foreach ($utilisateurs as $utilisateur) {
            $utilisateurMap[$utilisateur->getUtilisateurId()] = $utilisateur->getNomComplet(); 
        }

        foreach ($ventes as $vente) {
            $vente->client_nom = $clientMap[$vente->getClientId()] ?? 'Client Inconnu';
            $vente->utilisateur_nom = $utilisateurMap[$vente->getUtilisateurId()] ?? 'Vendeur Inconnu';
        }
        return $ventes;
    }

    public function getTotalSalesAmount(): float {
        $ventesData = $this->venteRepository->findAll();
        $total = 0;
        foreach ($ventesData as $data) {
            $total += (float)($data['total_vente'] ?? 0);
        }
        return $total;
    }

    public function getLatestSales(int $limit = 5): array {
        $ventes = $this->getVentesWithRelatedNames(); 
        
        usort($ventes, function($a, $b) {
            return strtotime($b->getDateVente()) - strtotime($a->getDateVente());
        });

        return array_slice($ventes, 0, $limit);
    }
}
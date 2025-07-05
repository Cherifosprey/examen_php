<?php
namespace App\Models;

class Production {
    private $production_id;
    private $article_vente_id;
    private $quantite_produite;
    private $date_production;
    private $utilisateur_id;
    private $statut;

    public function getProductionId(): ?int { return $this->production_id; }
    public function getArticleVenteId(): ?int { return $this->article_vente_id; }
    public function getQuantiteProduite(): ?int { return $this->quantite_produite; }
    public function getDateProduction(): ?string { return $this->date_production; }
    public function getUtilisateurId(): ?int { return $this->utilisateur_id; }
    public function getStatut(): ?string { return $this->statut; }

    public function setProductionId(?int $production_id): self { $this->production_id = $production_id; return $this; }
    public function setArticleVenteId(?int $article_vente_id): self { $this->article_vente_id = $article_vente_id; return $this; }
    public function setQuantiteProduite(?int $quantite_produite): self { $this->quantite_produite = $quantite_produite; return $this; }
    public function setDateProduction(?string $date_production): self { $this->date_production = $date_production; return $this; }
    public function setUtilisateurId(?int $utilisateur_id): self { $this->utilisateur_id = $utilisateur_id; return $this; }
    public function setStatut(?string $statut): self { $this->statut = $statut; return $this; }

    public function fromArray(array $data): self {
        $this->setProductionId($data['production_id'] ?? null);
        $this->setArticleVenteId($data['article_vente_id'] ?? null);
        $this->setQuantiteProduite($data['quantite_produite'] ?? null);
        $this->setDateProduction($data['date_production'] ?? null);
        $this->setUtilisateurId($data['utilisateur_id'] ?? null);
        $this->setStatut($data['statut'] ?? null);
        return $this;
    }

    public function toArray(): array {
        return [
            'production_id' => $this->production_id,
            'article_vente_id' => $this->article_vente_id,
            'quantite_produite' => $this->quantite_produite,
            'date_production' => $this->date_production,
            'utilisateur_id' => $this->utilisateur_id,
            'statut' => $this->statut,
        ];
    }
}
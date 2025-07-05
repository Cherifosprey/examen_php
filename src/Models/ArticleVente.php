<?php
namespace App\Models;

class ArticleVente {
    private $article_vente_id;
    private $nom_produit;
    private $description;
    private $prix_vente;
    private $categorie_id;
    private $quantite_stock;
    private $date_creation;
    private $statut;

    public function __construct(
        $article_vente_id = null, $nom_produit = null, $description = null, $prix_vente = null, $categorie_id = null,
        $quantite_stock = null, $date_creation = null, $statut = 'actif'
    ) {
        $this->article_vente_id = $article_vente_id;
        $this->nom_produit = $nom_produit;
        $this->description = $description;
        $this->prix_vente = $prix_vente;
        $this->categorie_id = $categorie_id;
        $this->quantite_stock = $quantite_stock;
        $this->date_creation = $date_creation;
        $this->statut = $statut;
    }

    public function getArticleVenteId(): ?int { return $this->article_vente_id; }
    public function getNomProduit(): ?string { return $this->nom_produit; }
    public function getDescription(): ?string { return $this->description; }
    public function getPrixVente(): ?float { return $this->prix_vente; }
    public function getCategorieId(): ?int { return $this->categorie_id; }
    public function getQuantiteStock(): ?int { return $this->quantite_stock; }
    public function getDateCreation(): ?string { return $this->date_creation; }
    public function getStatut(): ?string { return $this->statut; }

    public function setArticleVenteId(?int $article_vente_id): self { $this->article_vente_id = $article_vente_id; return $this; }
    public function setNomProduit(?string $nom_produit): self { $this->nom_produit = $nom_produit; return $this; }
    public function setDescription(?string $description): self { $this->description = $description; return $this; }
    public function setPrixVente(?float $prix_vente): self { $this->prix_vente = $prix_vente; return $this; }
    public function setCategorieId(?int $categorie_id): self { $this->categorie_id = $categorie_id; return $this; }
    public function setQuantiteStock(?int $quantite_stock): self { $this->quantite_stock = $quantite_stock; return $this; }
    public function setDateCreation(?string $date_creation): self { $this->date_creation = $date_creation; return $this; }
    public function setStatut(?string $statut): self { $this->statut = $statut; return $this; }

    public function fromArray(array $data): self {
        return new self(
            $data['article_vente_id'] ?? null,
            $data['nom_produit'] ?? null,
            $data['description'] ?? null,
            $data['prix_vente'] ?? null,
            $data['categorie_id'] ?? null,
            $data['quantite_stock'] ?? null,
            $data['date_creation'] ?? date('Y-m-d H:i:s'),
            $data['statut'] ?? 'actif'   
        );
    }


    public function toArray(): array {
        return [
            'article_vente_id' => $this->article_vente_id,
            'nom_produit' => $this->nom_produit,
            'description' => $this->description,
            'prix_vente' => $this->prix_vente,
            'categorie_id' => $this->categorie_id,
            'quantite_stock' => $this->quantite_stock,
            'date_creation' => $this->date_creation,
            'statut' => $this->statut,
        ];
    }
}
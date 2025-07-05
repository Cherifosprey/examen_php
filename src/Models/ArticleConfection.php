<?php
namespace App\Models;

class ArticleConfection {
    private $article_confection_id;
    private $nom_article;
    private $description;
    private $prix_unitaire_achat;
    private $unite_mesure;
    private $quantite_stock;
    private $fournisseur_id;
    private $categorie_id;
    private $date_creation;
    private $statut;

    public function getArticleConfectionId(): ?int { return $this->article_confection_id; }
    public function getNomArticle(): ?string { return $this->nom_article; }
    public function getDescription(): ?string { return $this->description; }
    public function getPrixUnitaireAchat(): ?float { return $this->prix_unitaire_achat; }
    public function getUniteMesure(): ?string { return $this->unite_mesure; }
    public function getQuantiteStock(): ?int { return $this->quantite_stock; }
    public function getFournisseurId(): ?int { return $this->fournisseur_id; }
    public function getCategorieId(): ?int { return $this->categorie_id; }
    public function getDateCreation(): ?string { return $this->date_creation; }
    public function getStatut(): ?string { return $this->statut; }

    public function setArticleConfectionId(?int $article_confection_id): self { $this->article_confection_id = $article_confection_id; return $this; }
    public function setNomArticle(?string $nom_article): self { $this->nom_article = $nom_article; return $this; }
    public function setDescription(?string $description): self { $this->description = $description; return $this; }
    public function setPrixUnitaireAchat(?float $prix_unitaire_achat): self { $this->prix_unitaire_achat = $prix_unitaire_achat; return $this; }
    public function setUniteMesure(?string $unite_mesure): self { $this->unite_mesure = $unite_mesure; return $this; }
    public function setQuantiteStock(?int $quantite_stock): self { $this->quantite_stock = $quantite_stock; return $this; }
    public function setFournisseurId(?int $fournisseur_id): self { $this->fournisseur_id = $fournisseur_id; return $this; }
    public function setCategorieId(?int $categorie_id): self { $this->categorie_id = $categorie_id; return $this; }
    public function setDateCreation(?string $date_creation): self { $this->date_creation = $date_creation; return $this; }
    public function setStatut(?string $statut): self { $this->statut = $statut; return $this; }

    public function fromArray(array $data): self {
        $this->setArticleConfectionId($data['article_confection_id'] ?? null);
        $this->setNomArticle($data['nom_article'] ?? null);
        $this->setDescription($data['description'] ?? null);
        $this->setPrixUnitaireAchat($data['prix_unitaire_achat'] ?? null);
        $this->setUniteMesure($data['unite_mesure'] ?? null);
        $this->setQuantiteStock($data['quantite_stock'] ?? null);
        $this->setFournisseurId($data['fournisseur_id'] ?? null);
        $this->setCategorieId($data['categorie_id'] ?? null);
        $this->setDateCreation($data['date_creation'] ?? null);
        $this->setStatut($data['statut'] ?? null);
        return $this;
    }

    public function toArray(): array {
        return [
            'article_confection_id' => $this->article_confection_id,
            'nom_article' => $this->nom_article,
            'description' => $this->description,
            'prix_unitaire_achat' => $this->prix_unitaire_achat,
            'unite_mesure' => $this->unite_mesure,
            'quantite_stock' => $this->quantite_stock,
            'fournisseur_id' => $this->fournisseur_id,
            'categorie_id' => $this->categorie_id,
            'date_creation' => $this->date_creation,
            'statut' => $this->statut,
        ];
    }
}
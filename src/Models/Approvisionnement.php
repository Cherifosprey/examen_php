<?php
namespace App\Models;

class Approvisionnement {
    private $approvisionnement_id;
    private $fournisseur_id;
    private $article_confection_id;
    private $quantite_achetee;
    private $prix_unitaire_achat;
    private $date_approvisionnement;
    private $utilisateur_id;

    public ?string $fournisseur_nom = null;
    public ?string $article_confection_nom = null;
    public ?string $utilisateur_nom = null;

    public function getApprovisionnementId(): ?int { return $this->approvisionnement_id; }
    public function getFournisseurId(): ?int { return $this->fournisseur_id; }
    public function getArticleConfectionId(): ?int { return $this->article_confection_id; }
    public function getQuantiteAchetee(): ?int { return $this->quantite_achetee; }
    public function getPrixUnitaireAchat(): ?float { return $this->prix_unitaire_achat; }
    public function getDateApprovisionnement(): ?string { return $this->date_approvisionnement; }
    public function getUtilisateurId(): ?int { return $this->utilisateur_id; }

    public function setApprovisionnementId(?int $approvisionnement_id): self { $this->approvisionnement_id = $approvisionnement_id; return $this; }
    public function setFournisseurId(?int $fournisseur_id): self { $this->fournisseur_id = $fournisseur_id; return $this; }
    public function setArticleConfectionId(?int $article_confection_id): self { $this->article_confection_id = $article_confection_id; return $this; }
    public function setQuantiteAchetee(?int $quantite_achetee): self { $this->quantite_achetee = $quantite_achetee; return $this; }
    public function setPrixUnitaireAchat(?float $prix_unitaire_achat): self { $this->prix_unitaire_achat = $prix_unitaire_achat; return $this; }
    public function setDateApprovisionnement(?string $date_approvisionnement): self { $this->date_approvisionnement = $date_approvisionnement; return $this; }
    public function setUtilisateurId(?int $utilisateur_id): self { $this->utilisateur_id = $utilisateur_id; return $this; }

    public function fromArray(array $data): self {
        $this->setApprovisionnementId($data['approvisionnement_id'] ?? null);
        $this->setFournisseurId($data['fournisseur_id'] ?? null);
        $this->setArticleConfectionId($data['article_confection_id'] ?? null);
        $this->setQuantiteAchetee($data['quantite_achetee'] ?? null);
        $this->setPrixUnitaireAchat($data['prix_unitaire_achat'] ?? null);
        $this->setDateApprovisionnement($data['date_approvisionnement'] ?? null);
        $this->setUtilisateurId($data['utilisateur_id'] ?? null);
        return $this;
    }

    public function toArray(): array {
        return [
            'approvisionnement_id' => $this->approvisionnement_id,
            'fournisseur_id' => $this->fournisseur_id,
            'article_confection_id' => $this->article_confection_id,
            'quantite_achetee' => $this->quantite_achetee,
            'prix_unitaire_achat' => $this->prix_unitaire_achat,
            'date_approvisionnement' => $this->date_approvisionnement,
            'utilisateur_id' => $this->utilisateur_id,
        ];
    }
    
}
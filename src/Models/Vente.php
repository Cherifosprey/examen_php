<?php
namespace App\Models;

class Vente {
    private $vente_id;
    private $client_id;
    private $date_vente;
    private $total_vente;
    private $utilisateur_id;
    private $statut_paiement;
    private $mode_paiement;
    private $details_produits_vendus; 

    public ?string $client_nom = null;
    public ?string $utilisateur_nom = null;
    
    public function getVenteId(): ?int { return $this->vente_id; }
    public function getClientId(): ?int { return $this->client_id; }
    public function getDateVente(): ?string { return $this->date_vente; }
    public function getTotalVente(): ?float { return $this->total_vente; }
    public function getUtilisateurId(): ?int { return $this->utilisateur_id; }
    public function getStatutPaiement(): ?string { return $this->statut_paiement; }
    public function getModePaiement(): ?string { return $this->mode_paiement; }
    public function getDetailsProduitsVendus(): ?array { return $this->details_produits_vendus; } 

    public function setVenteId(?int $vente_id): self { $this->vente_id = $vente_id; return $this; }
    public function setClientId(?int $client_id): self { $this->client_id = $client_id; return $this; }
    public function setDateVente(?string $date_vente): self { $this->date_vente = $date_vente; return $this; }
    public function setTotalVente(?float $total_vente): self { $this->total_vente = $total_vente; return $this; }
    public function setUtilisateurId(?int $utilisateur_id): self { $this->utilisateur_id = $utilisateur_id; return $this; }
    public function setStatutPaiement(?string $statut_paiement): self { $this->statut_paiement = $statut_paiement; return $this; }
    public function setModePaiement(?string $mode_paiement): self { $this->mode_paiement = $mode_paiement; return $this; }
    public function setDetailsProduitsVendus($details_produits_vendus): self {
        if (is_string($details_produits_vendus)) {
            $this->details_produits_vendus = json_decode($details_produits_vendus, true);
        } else { 
            $this->details_produits_vendus = $details_produits_vendus;
        }
        return $this;
    }

    public function fromArray(array $data): self {
        $this->setVenteId($data['vente_id'] ?? null);
        $this->setClientId($data['client_id'] ?? null);
        $this->setDateVente($data['date_vente'] ?? null);
        $this->setTotalVente($data['total_vente'] ?? null);
        $this->setUtilisateurId($data['utilisateur_id'] ?? null);
        $this->setStatutPaiement($data['statut_paiement'] ?? null);
        $this->setModePaiement($data['mode_paiement'] ?? null);
        $this->setDetailsProduitsVendus($data['details_produits_vendus'] ?? null);
        return $this;
    }

    public function toArray(): array {
        return [
            'vente_id' => $this->vente_id,
            'client_id' => $this->client_id,
            'date_vente' => $this->date_vente,
            'total_vente' => $this->total_vente,
            'utilisateur_id' => $this->utilisateur_id,
            'statut_paiement' => $this->statut_paiement,
            'mode_paiement' => $this->mode_paiement,
            'details_produits_vendus' => json_encode($this->details_produits_vendus),
        ];
    }
}
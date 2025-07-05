<?php
namespace App\Models;

class Fournisseur {
    private $fournisseur_id;
    private $nom_entreprise;
    private $contact_personne;
    private $email;
    private $telephone;
    private $adresse;
    private $date_creation;
    private $statut; 

    public function getFournisseurId(): ?int { return $this->fournisseur_id; }
    public function getNomEntreprise(): ?string { return $this->nom_entreprise; }
    public function getContactPersonne(): ?string { return $this->contact_personne; }
    public function getEmail(): ?string { return $this->email; }
    public function getTelephone(): ?string { return $this->telephone; }
    public function getAdresse(): ?string { return $this->adresse; }
    public function getDateCreation(): ?string { return $this->date_creation; }
    public function getStatut(): ?string { return $this->statut; }

    public function setFournisseurId(?int $fournisseur_id): self { $this->fournisseur_id = $fournisseur_id; return $this; }
    public function setNomEntreprise(?string $nom_entreprise): self { $this->nom_entreprise = $nom_entreprise; return $this; }
    public function setContactPersonne(?string $contact_personne): self { $this->contact_personne = $contact_personne; return $this; }
    public function setEmail(?string $email): self { $this->email = $email; return $this; }
    public function setTelephone(?string $telephone): self { $this->telephone = $telephone; return $this; }
    public function setAdresse(?string $adresse): self { $this->adresse = $adresse; return $this; }
    public function setDateCreation(?string $date_creation): self { $this->date_creation = $date_creation; return $this; }
    public function setStatut(?string $statut): self { $this->statut = $statut; return $this; }

    public function fromArray(array $data): self {
        $this->setFournisseurId($data['fournisseur_id'] ?? null);
        $this->setNomEntreprise($data['nom_entreprise'] ?? null);
        $this->setContactPersonne($data['contact_personne'] ?? null);
        $this->setEmail($data['email'] ?? null);
        $this->setTelephone($data['telephone'] ?? null);
        $this->setAdresse($data['adresse'] ?? null);
        $this->setDateCreation($data['date_creation'] ?? null);
        $this->setStatut($data['statut'] ?? null);
        return $this;
    }

    public function toArray(): array {
        return [
            'fournisseur_id' => $this->fournisseur_id,
            'nom_entreprise' => $this->nom_entreprise,
            'contact_personne' => $this->contact_personne,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'adresse' => $this->adresse,
            'date_creation' => $this->date_creation,
            'statut' => $this->statut,
        ];
    }
}
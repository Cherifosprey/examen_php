<?php
namespace App\Models;

class Categorie {
    private $categorie_id;
    private $libelle; 
    private $description;
    private $date_creation;
    private $statut;

    public function getCategorieId(): ?int { return $this->categorie_id; }
    public function getLibelle(): ?string { return $this->libelle; } 
    public function getDescription(): ?string { return $this->description; }
    public function getDateCreation(): ?string { return $this->date_creation; }
    public function getStatut(): ?string { return $this->statut; }

    public function setCategorieId(?int $categorie_id): self { $this->categorie_id = $categorie_id; return $this; }
    public function setLibelle(?string $libelle): self { $this->libelle = $libelle; return $this; }
    public function setDescription(?string $description): self { $this->description = $description; return $this; }
    public function setDateCreation(?string $date_creation): self { $this->date_creation = $date_creation; return $this; }
    public function setStatut(?string $statut): self { $this->statut = $statut; return $this; }

    public function fromArray(array $data): self {
        $this->setCategorieId($data['categorie_id'] ?? null);
        $this->setLibelle($data['libelle'] ?? null); 
        $this->setDescription($data['description'] ?? null);
        $this->setDateCreation($data['date_creation'] ?? null);
        $this->setStatut($data['statut'] ?? null);
        return $this;
    }

    public function toArray(): array {
        return [
            'categorie_id' => $this->categorie_id,
            'libelle' => $this->libelle,
            'description' => $this->description,
            'date_creation' => $this->date_creation,
            'statut' => $this->statut,
        ];
    }
}
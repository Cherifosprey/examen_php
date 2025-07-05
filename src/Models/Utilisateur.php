<?php
namespace App\Models;

class Utilisateur {
    private $utilisateur_id;
    private $nom;
    private $prenom;
    private $email;
    private $mot_de_passe;
    private $telephone_portable;
    private $adresse;
    private $salaire;
    private $photo; 
    private $role; 
    private $date_creation;
    private $statut; 

    public function __construct(
        $utilisateur_id = null,
        $nom = null,
        $prenom = null,
        $email = null,
        $mot_de_passe = null,
        $telephone_portable = null,
        $adresse = null,
        $salaire = null,
        $photo = null,
        $role = null,
        $date_creation = null,
        $statut = 'actif'
    ) {
        $this->utilisateur_id = $utilisateur_id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mot_de_passe = $mot_de_passe;
        $this->telephone_portable = $telephone_portable;
        $this->adresse = $adresse;
        $this->salaire = $salaire;
        $this->photo = $photo;
        $this->role = $role;
        $this->date_creation = $date_creation;
        $this->statut = $statut;
    }

    public function getUtilisateurId(): ?int { return $this->utilisateur_id; }
    public function getNom(): ?string { return $this->nom; }
    public function getPrenom(): ?string { return $this->prenom; }
    public function getEmail(): ?string { return $this->email; }
    public function getMotDePasse(): ?string { return $this->mot_de_passe; }
    public function getTelephonePortable(): ?string { return $this->telephone_portable; }
    public function getAdresse(): ?string { return $this->adresse; }
    public function getSalaire(): ?float { return $this->salaire; }
    public function getPhoto(): ?string { return $this->photo; }
    public function getRole(): ?string { return $this->role; }
    public function getDateCreation(): ?string { return $this->date_creation; } 
    public function getStatut(): ?string { return $this->statut; }

    public function setUtilisateurId(int $utilisateur_id): void { $this->utilisateur_id = $utilisateur_id; }
    public function setNom(string $nom): void { $this->nom = $nom; }
    public function setPrenom(string $prenom): void { $this->prenom = $prenom; }
    public function setEmail(string $email): void { $this->email = $email; }
    public function setMotDePasse(string $mot_de_passe): void { $this->mot_de_passe = $mot_de_passe; }
    public function setTelephonePortable(string $telephone_portable): void { $this->telephone_portable = $telephone_portable; }
    public function setAdresse(string $adresse): void { $this->adresse = $adresse; }
    public function setSalaire(float $salaire): void { $this->salaire = $salaire; }
    public function setPhoto(string $photo): void { $this->photo = $photo; }
    public function setRole(string $role): void { $this->role = $role; }
    public function setDateCreation(string $date_creation): void { $this->date_creation = $date_creation; }
    public function setStatut(string $statut): void { $this->statut = $statut; }

    public function toArray(): array {
        return [
            'utilisateur_id' => $this->utilisateur_id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'email' => $this->email,
            'mot_de_passe' => null, 
            'telephone_portable' => $this->telephone_portable,
            'adresse' => $this->adresse,
            'salaire' => $this->salaire,
            'photo' => $this->photo,
            'role' => $this->role,
            'date_creation' => $this->date_creation,
            'statut' => $this->statut,
        ];
    }

    public function getNomComplet(): string {
        return trim($this->prenom . ' ' . $this->nom);
    }
}
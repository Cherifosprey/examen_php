<?php
namespace App\Models;

class Client {
    private $client_id;
    private $nom;
    private $prenom;
    private $telephone;
    private $email;
    private $adresse;
    private $date_creation;
    private $statut;

    public function __construct(
        $client_id = null, $nom = null, $prenom = null, $telephone = null, $email = null,
        $adresse = null, $date_creation = null, $statut = 'actif'
    ) {
        $this->client_id = $client_id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->adresse = $adresse;
        $this->date_creation = $date_creation;
        $this->statut = $statut;
    }

    public function getClientId(): ?int { return $this->client_id; }
    public function getNom(): ?string { return $this->nom; }
    public function getPrenom(): ?string { return $this->prenom; }
    public function getTelephone(): ?string { return $this->telephone; }
    public function getEmail(): ?string { return $this->email; }
    public function getAdresse(): ?string { return $this->adresse; }
    public function getDateCreation(): ?string { return $this->date_creation; }
    public function getStatut(): ?string { return $this->statut; }

    public function setClientId(int $id): void { $this->client_id = $id; }
    public function setNom(string $nom): void { $this->nom = $nom; }
    public function setPrenom(string $prenom): void { $this->prenom = $prenom; }
    public function setTelephone(string $tel): void { $this->telephone = $tel; }
    public function setEmail(string $email): void { $this->email = $email; }
    public function setAdresse(string $adresse): void { $this->adresse = $adresse; }
    public function setDateCreation(string $date): void { $this->date_creation = $date; }
    public function setStatut(string $statut): void { $this->statut = $statut; }

    public function toArray(): array {
        return [
            'client_id' => $this->client_id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'email' => $this->email,
            'telephone_portable' => $this->telephone,
            'adresse' => $this->adresse,
            'date_creation' => $this->date_creation,
            'statut' => $this->statut,
        ];
    }

    public static function fromArray(array $data): self {
        return new self(
            $data['client_id'] ?? null,
            $data['nom'] ?? null,
            $data['prenom'] ?? null,
            $data['telephone_portable'] ?? null,
            $data['email'] ?? null,
            $data['adresse'] ?? null,
            $data['date_creation'] ?? null,
            $data['statut'] ?? 'actif'
        );
    }
}
# 🚗 Car Rental API

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)
[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D%208.0-777BB4?logo=php)](https://php.net)
[![Laravel Version](https://img.shields.io/badge/Laravel-10.x-FF2D20?logo=laravel)](https://laravel.com)
[![Stripe Integration](https://img.shields.io/badge/Stripe-Integrated-635BFF?logo=stripe)](https://stripe.com)

Car Rental API est une API REST développée avec Laravel pour gérer un service de location de voitures. Elle permet aux utilisateurs de consulter les véhicules disponibles, effectuer des réservations, gérer leur profil et suivre l'état de leurs locations.

---
![License: MIT](https://maghreb.simplonline.co/_next/image?url=https%3A%2F%2Fsimplonline-v3-prod.s3.eu-west-3.amazonaws.com%2Fmedia%2Fimage%2Fjpg%2Frm117-nap-06-67ce45a57e798717872669.jpg&w=1280&q=75)
## 🛠️ Fonctionnalités

- 🔐 **Authentification** : Inscription et connexion des utilisateurs avec Laravel Sanctum.
- 🚘 **Gestion des voitures** : CRUD pour les voitures avec filtres par marque, modèle, année et disponibilité.
- 📅 **Gestion des locations** : CRUD pour les locations avec filtres par utilisateur, voiture et statut.
- 💳 **Gestion des paiements** : CRUD pour les paiements avec intégration de Stripe pour les paiements en ligne.
- 📚 **Documentation API** : Documentation complète avec Swagger.
- 🧪 **Tests unitaires** : Tests pour les contrôleurs et les fonctionnalités principales.

---

## 📋 Prérequis

- PHP >= 8.0
- Composer
- MySQL
- Laravel CLI
- Stripe CLI (pour les paiements en ligne)

---

## 🚀 Installation

1. **Cloner le dépôt** :
   ```bash
   git clone https://github.com/Youcode-Classe-E-2024-2025/belal-allala-CarRentalApi.git
   cd car-rental-api
   ```

2. **Installer les dépendances** :
   ```bash
   composer install
   ```

3. **Configurer l'environnement** :
   - Copiez le fichier `.env.example` vers `.env` :
     ```bash
     cp .env.example .env
     ```
   - Configurez les variables d'environnement dans `.env` (base de données, clés Stripe, etc.).

4. **Générer la clé d'application** :
   ```bash
   php artisan key:generate
   ```

5. **Exécuter les migrations et les seeders** :
   ```bash
   php artisan migrate --seed
   ```

6. **Démarrer le serveur** :
   ```bash
   php artisan serve
   ```

---

## 🎯 Utilisation

### 🔐 Authentification

- **Inscription** : `POST /api/register`
  ```json
  {
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123"
  }
  ```

- **Connexion** : `POST /api/login`
  ```json
  {
    "email": "john@example.com",
    "password": "password123"
  }
  ```

- **Profil utilisateur** : `GET /api/me` (nécessite un token d'authentification)

### 🚘 Voitures

- **Liste des voitures** : `GET /api/cars`
- **Créer une voiture** : `POST /api/cars`
- **Détails d'une voiture** : `GET /api/cars/{id}`
- **Mettre à jour une voiture** : `PUT /api/cars/{id}`
- **Supprimer une voiture** : `DELETE /api/cars/{id}`

### 📅 Locations

- **Liste des locations** : `GET /api/rentals`
- **Créer une location** : `POST /api/rentals`
- **Détails d'une location** : `GET /api/rentals/{id}`
- **Mettre à jour une location** : `PUT /api/rentals/{id}`
- **Supprimer une location** : `DELETE /api/rentals/{id}`

### 💳 Paiements

- **Liste des paiements** : `GET /api/payments`
- **Créer un paiement** : `POST /api/payments`
- **Détails d'un paiement** : `GET /api/payments/{id}`
- **Mettre à jour un paiement** : `PUT /api/payments/{id}`
- **Supprimer un paiement** : `DELETE /api/payments/{id}`

---

## 📚 Documentation API

La documentation de l'API est générée avec Swagger. Vous pouvez y accéder en visitant :
```
http://127.0.0.1:8000/api/documentation
```

---

## 🧪 Tests

Pour exécuter les tests unitaires :
```bash
php artisan test
```

---

## ⚙️ Configuration Stripe

Pour utiliser Stripe, vous devez configurer vos clés API dans le fichier `.env` :
```env
STRIPE_KEY=votre_clé_publique
STRIPE_SECRET=votre_clé_secrète
```

---

## 🐜 Licence

Ce projet est sous licence MIT. Voir le fichier [LICENSE](LICENSE) pour plus de détails.

---

## 👤 Auteur

- **Votre Nom** - [GitHub](https://github.com/votre-utilisateur)

---

## 🙏 Remerciements

- [Laravel](https://laravel.com) pour le framework.
- [Stripe](https://stripe.com) pour l'intégration des paiements.


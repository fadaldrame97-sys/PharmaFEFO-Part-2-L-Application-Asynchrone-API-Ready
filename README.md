PharmaFEFO - Application de gestion de stock

Ce projet est une application web de gestion de stock pour une pharmacie.
L’objectif est de gérer les lots de médicaments selon la méthode FEFO (First Expired First Out).

---

1. Description du projet

L’application permet de :
- ajouter des lots de médicaments
- voir les stocks disponibles
- gérer la quantité des produits
- suivre les dates d’expiration
- appliquer la logique FEFO automatiquement
- permettre la délivrance des produits
- afficher des alertes sur les produits proches de la péremption

---

2. Rôles utilisateurs

Il y a 3 rôles dans l’application :

- ADMIN : accès complet + rapports
- PHARMACIEN : gestion des lots + alertes
- PREPARATEUR : peut consulter et délivrer les produits disponibles

---

3. Fonctionnalités principales

- ajout de nouveaux lots via formulaire
- affichage des stocks en temps réel avec JavaScript
- filtre des lots (tout / critique / expiré)
- bouton “Délivrer” pour réduire le stock
- mise à jour automatique des données sans recharger la page
- gestion des lots expirés

---

4. API

Le projet utilise des routes API pour gérer les données :

- /api/stocks → liste des lots
- /api/stocks/add → ajouter un lot
- /api/stocks/checkout → délivrer un produit
- /api/v1/batches → filtres des lots
- /api/v1/stats → statistiques
- /api/admin/reports → rapport admin

---

5. Technologie utilisée

- PHP (MVC simple)
- MySQL
- JavaScript (fetch API)
- HTML / CSS
- TailwindCSS

---

6. Organisation du projet

- config : connexion base de données
- public : index.php + js + css
- src :
    - Controller (web et api)
    - Service (logique métier)
    - Repository (requêtes SQL)
    - Entity (modèles)
- templates : vues HTML

---

7. Lancement du projet

- importer la base de données
- configurer database.php
- lancer le serveur local (XAMPP ou autre)
- accéder à /public/index.php?route=login

---

8. Remarque

Le projet est encore en évolution.
Certaines fonctionnalités peuvent être améliorées comme le FEFO ou les statistiques en temps réel.

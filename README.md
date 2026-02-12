# TP Authentification Sécurisée - Université Paris 8

Bienvenue sur le projet d'authentification sécurisée. Ce projet implémente une interface de connexion et d'inscription complète, respectant les standards de sécurité actuels et offrant une expérience utilisateur moderne.


# Installation et Configuration

### Prérequis
- Un serveur local (WampServer, XAMPP, MAMP) avec PHP 8.x et MySQL.

# 1. Installation des fichiers
Clonez ce dépôt ou téléchargez les fichiers dans votre dossier serveur (ex: `C:/wamp64/www/TP_Auth`).

# 2. Base de Données
1. Ouvrez **phpMyAdmin**.
2. Créez une nouvelle base de données nommée **`tp_auth`**.
3. Importez le fichier **`tp_auth.sql`** fourni à la racine du projet.
4. Cela créera la table `utilisateurs` avec la structure nécessaire.

# 3. Configuration de la connexion
Par défaut, le projet est configuré pour WampServer (User: `root`, Password: vide).
Si votre configuration est différente, modifiez le fichier **`traitement.php`** (Lignes 5-6) :


php
$host = 'localhost'; 
$dbname = 'tp_auth'; 
$user = 'root'; // Votre utilisateur
$pass = '';     // Votre mot de passe

# 4. Structure du Projet
```text
/TP_Auth
│
├── index.php          # La Vue (Interface HTML/JS)
├── traitement.php     # Le Contrôleur (Logique PHP & BDD)
├── tp_auth.sql        # Export de la base de données
├── README.md          # Documentation
│
└── /static
    ├── style.css      # Feuilles de style & Animations
    ├── background.svg # Motif vectoriel des vagues
    └── logo.png       # Logo Université Paris 8

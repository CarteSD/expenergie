# ⚡ Expenergie - Site Web Professionnel ⚡

## 🌟 À propos
Site web vitrine pour **Expenergie**, une SARL spécialisée dans l'installation de **systèmes photovoltaïques** avec stockage d'énergie. Ce projet met en avant les services et l'expertise de l'entreprise dans le domaine des **énergies renouvelables**. 🌱

## 🚧 Version 2.0
Cette version implémente l'ensemble des fonctionnalités de la version 1.0 ainsi que le back-office.  
Le back-office permet aux personnes en ayant les codes d'authentification de gérer les différentes pages du site pouvant être personnalisées *(ajout, modification, suppression de questions ou exemples d'installations).*


## 🛠️ Technologies Utilisées

- **HTML5** 📄
- **CSS3** 🎨
- **TailwindCSS** 🌬️ - Framework CSS utilitaire
- **JavaScript** ⚙️ - Pour les interactions dynamiques
- **PHP** 🐘 - Langage backend
- **Twig** 🧩 - Moteur de templates


## ✅ Prérequis

Pour exécuter ce projet localement, vous aurez besoin de :

- **PHP >= 8.1** 🐘
- **Node.js** et **npm** (pour TailwindCSS) 📦
- Un serveur web local (**Apache/Nginx**) 🌐


## 🚀 Installation

1. **Clonez le dépôt** 📥
   ```bash
   git clone https://github.com/CarteSD/expenergie.git
   cd expenergie
    ```
   
2. **Installer les dépendances** 📦
    ```bash
    composer install
    npm install
    ```
   
3. **Compiler les assets** 🛠️
    ```bash
    npm run build
    ```
   
4. **Lancer le serveur** 🚀
    ```bash
    npm run start
    ```

## 📂 Structure du Projet

    expenergie/
    ├── src/           
    │   ├── templates/   # Templates Twig
    │   ├── Controllers/ # Contrôleurs
    │   └── Models/      # Modèles
    ├── public/        
    │   └── assets/
    │       ├── css/   # Fichiers CSS
    │       ├── img/   # Images
    │       └── js/    # Fichiers JS
    └── .env           # Variables d'environnement


## 👨‍💻 Auteur

- Estéban DESESSARD ([Portfolio](https://esteban-desessard.fr)) - Développement Web & Design


## 📝 License

Ce projet est la propriété de **Expenergie** - Tous droits réservés. 🚫
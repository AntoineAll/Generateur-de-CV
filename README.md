# 📄 CV GEN - Générateur de CV

### 📝 Résumé du Projet
**CV GEN** est une application web moderne et intuitive conçue pour simplifier la création de CV professionnels. 
Grâce à une interface de prévisualisation en temps réel, l'utilisateur peut remplir ses informations personnelles, ses expériences, 
ses formations et ses compétences tout en voyant le rendu final s'adapter instantanément sur une feuille A4 virtuelle. 

L'outil permet de choisir entre plusieurs thèmes design et offre une solution clé en main pour exporter le résultat final en format PDF de haute qualité.

---

### 🛠 Technologies utilisées
* **Backend** : PHP 8.x
* **Frontend** : HTML5, CSS3 (Bootstrap 5.3), JavaScript (ES6)
* **Moteur de rendu PDF** : Dompdf
* **Gestionnaire de dépendances** : Composer

**Note : Assure-toi d'avoir une version récente de PHP (8.0 ou plus recommandée). Vérifiez avec la commande suivante : php -v .**

---

### 📦 Installation de Composer et Dompdf
Le projet utilise la bibliothèque **Dompdf** pour transformer le rendu HTML/CSS en un fichier PDF propre. La gestion de cette dépendance se fait obligatoirement via **Composer**.

#### 1. Installation de Composer
Si tu n'as pas encore Composer, télécharge et installe-le depuis le site officiel : [getcomposer.org](https://getcomposer.org/).

#### 2. Installation de Dompdf
Une fois Composer installé, ouvre ton terminal à la racine du dossier de ton projet et exécute la commande suivante :

**composer require dompdf/dompdf**

Cette action va créer automatiquement :
Un dossier vendor/ (contenant les fichiers de la librairie).
Un fichier composer.json et composer.lock.

---

### 🚀 Lancement du projet en local
Tu peux tester l'application instantanément sans avoir besoin d'installer un serveur lourd comme WAMP, XAMPP ou MAMP grâce au serveur de développement intégré à PHP.

* Ouvre ton terminal ou ton invite de commande.
* Navigue jusqu'au dossier racine de ton projet.
* Lance le serveur avec la commande suivante : **php -S localhost:8000**
* Ouvre ton navigateur web et accède à l'adresse suivante : http://localhost:8000

---

### Copyrights
© 2026 Antoine ALLARD - Tous droits réservés.
# 🗳️ Vote en ligne – Application PHP

Ce projet est une plateforme de vote en ligne développée en **PHP**, permettant aux utilisateurs de :
- S’inscrire et se connecter
- Voter pour des candidats
- Visualiser les résultats en temps réel
- Recevoir des notifications par SMS (Twilio)
- Gérer les élections via un tableau de bord administrateur

---

## 📁 Structure du projet

vote-en-ligne/
│
├── index.php → Page d'accueil
├── register.php → Formulaire d'inscription
├── register_process.php → Traitement de l'inscription
├── login.php → Formulaire de connexion
├── connexion_handler.php → Traitement de la connexion
│
├── page_vote.php → Interface de vote
├── vote_handler.php → Traitement du vote
├── resultat_vote.php → Affichage des résultats
│
├── profil.php → Profil de l'utilisateur
├── page_candidature.php → Dépôt de candidature
├── candidature_handler.php → Traitement des candidatures
│
├── admin_login.php → Connexion admin
├── admin_register.php → Inscription admin
├── admin_dashboard.php → Tableau de bord admin
├── envoyerSMS().php → Fonction d’envoi de SMS
├── fetch_results.php → API pour récupérer les résultats
│
├── images/ → Dossier d’images utilisées
├── uploads/ → Dossier d’upload pour les documents ou images
├── vendor/ → Librairies PHP (Twilio) installées via Composer
│
├── style.css, styl.css, styles.css → Feuilles de style
├── script.js → Script JS pour l’interface


---

## 🛠️ Technologies utilisées

- 🐘 PHP 7+
- 🐬 MySQL (base de données)
- 🎨 HTML / CSS / JS
- ☁️ [Twilio API](https://www.twilio.com/) (pour les notifications SMS)
- 📦 Composer (gestionnaire de dépendances PHP)

---

## 🚀 Installation

1. Cloner le dépôt :

```bash
git clone https://github.com/TON_UTILISATEUR/vote-en-ligne.git

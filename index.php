<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil - Système de Vote en Ligne</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styl.css">
  <link rel="stylesheet" href="styles.css">
  <style>
              .btn-rejoindre {
    display: inline-block;
    padding: 12px 24px;
    font-size: 18px;
    color: white;
    background-color: #0e2be4;
    border-radius: 30px;
    text-decoration: none;
    transition: background-color 0.3s ease, transform 0.3s ease;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    animation: fadeInUp 2.5s ease-out;
    margin: 5px;
}

/* Animation pour le bouton au survol */
.btn-rejoindre:hover {
    background-color: #004d40;
    transform: translateY(-5px); /* Légère élévation du bouton au survol */
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.3);
}
/* Section des élections */
.courses {
  padding: 60px 20px;
  text-align: center;
}

.courses h2 {
  font-size: 2.5rem;
  margin-bottom: 10px;
}

.courses p {
  font-size: 1.1rem;
  color: #555;
  margin-bottom: 40px;
}

.courses-container {
  display: flex;
  justify-content: space-around;
  gap: 20px;
  flex-wrap: wrap;
}

.course-card {
  background-color: #f4f4f4;
  padding: 20px;
  border-radius: 10px;
  width: 300px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.course-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.course-image {
  width: 100%;
  height: auto;
  border-radius: 8px;
  object-fit: cover;  /* Assure que l'image couvre l'espace sans déformation */
  margin-bottom: 15px;
}

.course-card h3 {
  font-size: 1.5rem;
  margin-bottom: 10px;
}

.course-card p {
  font-size: 1rem;
  color: #777;
  margin-bottom: 20px;
}

.btn {
  background-color: #007bff;
  color: white;
  padding: 12px 25px;
  border-radius: 5px;
  text-transform: uppercase;
  font-weight: bold;
  text-decoration: none;
  display: inline-block;
  transition: background-color 0.3s ease;
}

.btn:hover {
  background-color: #0056b3;
}
/* Section des Services */
.feature {
  padding: 60px 20px;
  text-align: center;
}

.feature h2 {
  font-size: 2.5rem;
  margin-bottom: 10px;
  color: #333;
}

.feature p {
  font-size: 1.1rem;
  color: #555;
  margin-bottom: 40px;
}

.feature-cards {
  display: flex;
  justify-content: center;
  gap: 20px;
  flex-wrap: wrap;
}

.feature-card {
  background-color: #f9f9f9;
  padding: 20px;
  border-radius: 10px;
  width: 300px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  text-align: center;
}

.feature-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.feature-image {
  width: 100%;
  height: 360px; /* Fixe la hauteur de l'image */
  object-fit: cover; /* L'image couvre le conteneur sans déformation */
  border-radius: 10px; /* Bords arrondis pour un style cohérent */
  margin-bottom: 15px;
}

.feature-card h3 {
  font-size: 1.8rem;
  margin-bottom: 10px;
  color: #333;
}

.feature-card p {
  font-size: 1rem;
  color: #777;
  margin-bottom: 20px;
}

.btn {
  background-color: #007bff;
  color: white;
  padding: 12px 25px;
  border-radius: 5px;
  text-transform: uppercase;
  font-weight: bold;
  text-decoration: none;
  display: inline-block;
  transition: background-color 0.3s ease;
}

.btn:hover {
  background-color: #0056b3;
}



  </style>
</head>
<body>
<header>
        <div class="navbar">
            <div class="logo">
                <img src="images/logo iut.jpg" alt="Logo" />
            </div>
            <div class="menu-toggle" id="menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-links" id="nav-links">
                <li><a href="#home">Accueil</a></li>
                <li><a href="#about">À propos</a></li>
                <li><a href="#Mission">Mission</a></li>
                <li><a href="#election">Elections</a></li>
                <li><a href="profil.php"><i class="fas fa-user"><img src="" alt="Profil" class="icone-profil"></a></i></li>
            </ul>
            <div class="auth-btn">
                <a href="connexion.html" class="btn-connect">Me connecter</a>
               
            </div>
        </div>
    </header>
    <section class="banner" id="home">
            <div class="banner-text">
            <h1>Bienvenue au Système de Vote en Ligne de l’Université</h1>
            <p>Votez en toute sécurité, participez aux élections de manière simple et efficace.</p>
                <a href="register.php" class="btn-rejoindre">inscription</a>
                <a href="page_vote.php" class="btn-rejoindre">Vote</a>
            </div>
        </section>
        <section class="about" id="about">
            <div class="about-container">
                <div class="about-text">
                    <h2>Institut Universitaire de Technologie (IUT) de Douala</h2>
                    <p>


Institut Universitaire de Technologie (IUT) de Douala

L'IUT de Douala est un établissement d'enseignement supérieur au Cameroun, dédié à la formation pratique et professionnelle dans divers domaines technologiques et industriels. Depuis sa création, l'IUT s'est imposé comme un acteur de référence dans la formation des étudiants en ingénierie, en sciences appliquées et en gestion des technologies, contribuant activement au développement du tissu industriel et économique du Cameroun.
                    </p>
                </div>
                <div class="about-image">
                    <img src="images/appros.jpg" alt="Construction Image" />
                </div>
            </div>
        </section>
        <section class="services" id="Mission">
        <h2>Notre Mission</h2>
    <div class="services-container">
        <div class="service-card">
            <img src="images/securité.jpg" alt="Conception de plans" />
            <h3>Sécurité</h3>
            <p>Assurer un environnement de vote sécurisé pour tous les étudiants.</p>
        </div>
        <div class="service-card">
            <img src="images/assebilité.png" alt="Consultation" />
            <h3>Accessibilité</h3>
        <p>Permettre un accès simple au vote en ligne pour tous.</p>
        </div>
        <div class="service-card">
            <img src="images/transparence.jpg" alt="Construction" />
            <h3>Transparence</h3>
            <p>Garantir des résultats clairs et transparents pour chaque élection.</p>
        </div>
    </div>
</section>

<section class="feature" id="election">
    <h2>Nos Elections</h2>
    <p>Découvrez participez et accompagner nous dans nos differents activités.</p>
    <div class="feature-cards">
        <div class="feature-card">
            <img src="images/dep.jpg" alt="Service 1" class="feature-image" />
            <h3>Chef de departement</h3>
            <p>Des sessions de tutorat et des ressources pour vous aider à réussir vos examens et projets.</p>
            <a href="#" class="btn">En savoir plus</a>
        </div>
        <div class="feature-card">
            <img src="images/dept.jpg" alt="Service 2" class="feature-image" />
            <h3>Election miss IUT</h3>
            <p>Participez à nos événements et activités pour enrichir votre expérience universitaire.</p>
            <a href="#" class="btn">Voir les événements</a>
        </div>
        <div class="feature-card">
            <img src="images/miss.jpg" alt="Service 3" class="feature-image" />
            <h3>Election master IUT</h3>
            <p>Obtenez des conseils personnalisés pour bien démarrer votre carrière professionnelle après l'université.</p>
            <a href="#" class="btn">Découvrez nos services</a>
        </div>
    </div>
</section>



  <!-- Section Contact -->
  <section class="contact">
    <div class="contact-content">
      <h2>Contactez-nous</h2>
      <form class="contact-form">
        <label for="name">Nom</label>
        <input type="text" id="name" name="name" required>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        <label for="message">Message</label>
        <textarea id="message" name="message" required></textarea>
        <button type="submit" class="btn-primary">Envoyer</button>
      </form>
    </div>
    <div class="contact-image">
      <img src="vote.jpg" alt="Image de contact">
    </div>
  </section>
  <script>
  // Sélectionnez le menu et le bouton de menu
const menuToggle = document.getElementById('menu-toggle');
const navLinks = document.getElementById('nav-links');

// Ajoutez un écouteur d'événements pour le clic sur le bouton de menu
menuToggle.addEventListener('click', () => {
    // Alternez la classe 'active' sur les liens du menu
    navLinks.classList.toggle('active');
});

const timelineItems = document.querySelectorAll('.timeline-item');

window.addEventListener('scroll', () => {
    const triggerBottom = window.innerHeight / 5 * 4;

    timelineItems.forEach(item => {
        const itemTop = item.getBoundingClientRect().top;

        if (itemTop < triggerBottom) {
            item.classList.add('active');
        }
    });
});

    </script>
</body>
</html>


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription - Système de Vote en Ligne</title>
  <link rel="stylesheet" href="styler.css">
</head>
<body>

  <!-- Section d'Inscription -->
  <section class="signup-section">
    <div class="signup-content">
      <div class="signup-image">
        <img src="3.jpg" alt="Image d'inscription">
      </div>
      <div class="signup-form">
        <h2>Inscription</h2>
        <form action="inscription_handler.php" method="post" class="form">
          <label for="nom">Nom</label>
          <input type="text" id="nom" name="nom" required>

          <label for="prenom">Prénom</label>
          <input type="text" id="prenom" name="prenom" required>
 
          <label for="phone">Numéro de téléphone:</label>
          <input type="number" name="phone" id="phone" required>
  
          <label for="filiere">Filière</label>
          <input type="text" id="filiere" name="filiere" required>
      
          <label for="departement">Département</label>
          <select id="departement" name="departement" required>
            <option value="GI">GI</option>
            <option value="GRT">GRT</option>
            <option value="GEII">GEII</option>
            <option value="GBM">GBM</option>
          </select>

          <label for="statut">Statut</label>
          <select id="statut" name="statut" required>
            <option value="candidat">Candidat</option>
            <option value="electeur">Électeur</option>
          </select>

          <label for="sexe">Sexe</label>
          <select id="sexe" name="sexe" required>
            <option value="masculin">Masculin</option>
            <option value="feminin">Féminin</option>
          </select>

          <label for="motdepasse">Mot de Passe</label>
          <input type="password" id="motdepasse" name="motdepasse" required>

          <button type="submit" class="btn-submit">S'inscrire</button>
        </form>
                 
  

      </div>
    </div>
  </section>

</body>
</html>

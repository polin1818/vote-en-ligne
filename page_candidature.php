<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Candidature</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<section class="candidature-section">
    <div class="form-container">
        <h2>Soumettez votre Candidature</h2>
        <form action="candidature_handler.php" method="post" enctype="multipart/form-data">
            <label for="poste">Poste</label>
            <select id="poste" name="poste" required>
                <option value="">Sélectionnez un poste</option>
                <option value="Délégué Principal">Délégué Principal</option>
                <option value="Délégué Adjoint">Délégué Adjoint</option>
                <option value="Délégué de Sport">Délégué de Sport</option>
                <option value="Président du Département">Président du Département</option>
            </select>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <label for="photo">Photo de Candidature</label>
            <input type="file" id="photo" name="photo" accept="image/*" required>

            <button type="submit" class="btn-submit">Envoyer Candidature</button>
            <button type="submit" class="btn-submit"><a href="page_vote.php">vote</a></button>
        </form>
    </div>
    <div class="image-side">
        <img src="3.jpg" alt="Inscription Image">
    </div>
</section>

</body>
</html>

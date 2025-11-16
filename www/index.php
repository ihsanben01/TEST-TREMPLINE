<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact Agence</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">
    <form action="submit.php" method="POST" class="card">

        <div class="left">
            <h1>CONTACTEZ L’AGENCE</h1>

            <h3>VOS COORDONNÉES</h3>

            <div class="radio-group">
                <label><input type="radio" name="civilite" value="Mme"> Mme</label>
                <label><input type="radio" name="civilite" value="M"> M</label>
            </div>

            <div class="row">
                <input type="text" name="nom" placeholder="Nom" required>
                <input type="text" name="prenom" placeholder="Prénom" required>
            </div>

            <input type="email" name="email" placeholder="Adresse mail" required>
            <input type="text" name="phone" placeholder="Téléphone">

            <h3>DISPONIBILITÉS POUR UNE VISITE</h3>
<!-- Champ hidden pour envoyer les disponibilités -->
<input type="hidden" name="dispos" id="dispos">

<div class="dispo-selects">
    <select id="select-jour">
        <option>Lundi</option>
        <option>Mardi</option>
        <option>Mercredi</option>
        <option>Jeudi</option>
        <option>Vendredi</option>
    </select>

    <select id="select-heur">
        <option>7h</option>
        <option>8h</option>
        <option>9h</option>
        <option>10h</option>
    </select>

    <select id="select-minute">
        <option>0m</option>
        <option>15m</option>
        <option>30m</option>
    </select>

    <button type="button" class="btn-add" id="btnAdd">Ajouter Dispo</button>
</div>

<!-- Conteneur où les tags apparaîtront -->
<div id="tags" class="tags"></div>

<script>
let disponibilites = [];

// Mise à jour du champ hidden
function updateHiddenField() {
    document.getElementById('dispos').value = JSON.stringify(disponibilites);
}

// Ajout d'une disponibilité
document.getElementById('btnAdd').addEventListener('click', () => {
    const jour = document.getElementById('select-jour').value;
    const heur = document.getElementById('select-heur').value;
    const minute = document.getElementById('select-minute').value;

    const dispo = { jour, heur, minute };
    disponibilites.push(dispo);
    updateHiddenField();

    const tag = document.createElement('span');
    tag.className = "tag";
    tag.innerHTML = `${jour} à ${heur}${minute} ✕`;

    // Suppression d’un tag
    tag.addEventListener('click', () => {
        const index = disponibilites.indexOf(dispo);
        if (index > -1) disponibilites.splice(index, 1);
        tag.remove();
        updateHiddenField();
    });

    document.getElementById('tags').appendChild(tag);
});
</script>


        </div>


        <div class="right">

            <h3>VOTRE MESSAGE</h3>

            <div class="radio-group">
                <label><input type="radio" name="type" value="visite"> Demande de visite</label>
                <label><input type="radio" name="type" value="rappel"> Être rappelé</label>
                <label><input type="radio" name="type" value="photos"> Plus de photos</label>
            </div>

            <textarea name="message" placeholder="Votre message"></textarea>

            <button type="submit" class="btn-envoyer">ENVOYER</button>

        </div>

    </form>
</div>

</body>
</html>

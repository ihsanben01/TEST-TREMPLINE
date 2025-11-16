<?php
/************************************
 * 1. Connexion DB
 ************************************/
$host = "database";
$user = "root";
$pass = "verysecurepassword";
$dbname = "tremplin";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Erreur connexion : " . $conn->connect_error);
}

/************************************
 * 2. Récupération des données POST
 ************************************/
$civilite  = $_POST['civilite'] ?? null;
$nom       = trim($_POST['nom']);
$prenom    = trim($_POST['prenom']);
$email     = trim($_POST['email']);
$phone = trim($_POST['phone'] ?? "");

$type      = $_POST['type'] ?? "";    
$message   = trim($_POST['message'] ?? "");

$jour      = $_POST['jour'] ?? "";
$heur    = $_POST['heur'] ?? "";
$minute    = $_POST['minute'] ?? "";

/************************************
 * 3. INSERT dans contact
 ************************************/
$stmt = $conn->prepare("
    INSERT INTO contact (civilite, nom, prenom, email, phone, type_message, message)
    VALUES (?, ?, ?, ?, ?, ?, ?)
");
$stmt->bind_param("sssssss", $civilite, $nom, $prenom, $email, $phone, $type, $message);
$stmt->execute();

$contact_id = $stmt->insert_id;
$stmt->close();

/************************************
 * 4. INSERT dans disponibilite
 ************************************/





// ----- MULTI DISPONIBILITÉS -----
$dispos = json_decode($_POST['dispos'], true);

if (!empty($dispos)) {
    $stmt2 = $conn->prepare("
        INSERT INTO disponibilites (contact_id, jour, heur, minute)
        VALUES (?, ?, ?, ?)
    ");

    foreach ($dispos as $d) {
        // Chaque dispo contient : ['jour' => ..., 'heure' => ..., 'minute' => ...]
        $stmt2->bind_param(
            "isss",
            $contact_id,
            $d['jour'],
            $d['heur'],
            $d['minute']
        );
        $stmt2->execute();
    }

    $stmt2->close();
}

/************************************
 * 5. Confirmation
 ************************************/
echo "<h2>Votre demande a été enregistrée avec succès !</h2>";
echo "<p>Merci <strong>$prenom $nom</strong> pour votre message.</p>";
echo "<a href='index.php'>Retour</a>";

$conn->close();
?>

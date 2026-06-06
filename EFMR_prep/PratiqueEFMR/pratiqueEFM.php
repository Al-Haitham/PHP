<?php
$Srvr = 'localhost';
$dbname = 'University';
$Login = 'root';
$PW = '';

try {
    $cnx = new PDO("mysql:host=$Srvr;dbname=$dbname", $Login, $PW);
    $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête de sélection
    $query = "SELECT code_Pro, nom_Pro, Statut_Pro, Adresse_Pro, Date_Naissance, salaire FROM professeur";
    $stmt = $cnx->query($query);
    
    echo "<h1>Liste des professeurs</h1>";
    echo "<table border='1'>";
    echo "<tr>
            <th>code_Pro</th>
            <th>nom_Pro</th>
            <th>Statut_Pro</th>
            <th>Adresse_Pro</th>
            <th>Date_Naissance</th>
            <th>salaire</th>
          </tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>".$row['code_Pro']."</td>";
        echo "<td>".$row['nom_Pro']."</td>";
        echo "<td>".$row['Statut_Pro']."</td>";
        echo "<td>".$row['Adresse_Pro']."</td>";
        echo "<td>".$row['Date_Naissance']."</td>";
        echo "<td>".$row['salaire']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<p>(*)Pour les vacataires c'est le prix par heure</p>";

} catch (PDOException $e) {
    echo "Erreur : ".$e->getMessage();
}
?>
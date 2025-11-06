<!DOCTYPE html>
<html>
<head>
   <title>Capteur de sol</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
   <style>
      /* Style pour le corps de la page */
      body {
         font-family: Arial, sans-serif;
         margin: 0;
         padding: 0;
         background-color: #f2f2f2;
      }

      /* Style pour l'en-tête de la page */
      header {
         background-color: #333;
         color: #fff;
         padding: 20px;
         text-align: center;
      }

      /* Style pour le titre de la page */
      h1 {
         margin: 0;
         font-size: 36px;
      }

      /* Style pour le sous-titre de la page */
      h2 {
         margin: 0;
         font-size: 24px;
         color: #333;
      }

      /* Style pour le conteneur principal */
      #container {
         display: flex;
         flex-direction: row;
         justify-content: center;
         align-items: center;
         margin-top: 50px;
      }

      /* Style pour la colonne du tableau */
      .column {
         width: 50%;
         margin: 0 10px;
      }

      /* Style pour le tableau */
      table {
         border-collapse: collapse;
         margin: 0 auto;
         background-color: #fff;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
         width: 100%;
      }

      /* Style pour les cellules du tableau */
      th,
      td {
         padding: 10px;
         text-align: center;
         vertical-align: middle;
         border: 1px solid #ddd;
      }

      /* Style pour les en-têtes de colonnes du tableau */
      th {
         background-color: #333;
         color: #fff;
         font-weight: normal;
      }

      /* Style pour le conteneur du graphique */
      #graph {
         width: 100%;
         height: 400px;
         background-color: #fff;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      /* Style pour le bouton Actualiser */
      #refresh-button {
         background-color: #333;
         color: #fff;
         border: none;
         padding: 10px 20px;
         border-radius: 5px;
         font-size: 18px;
         cursor: pointer;
         transition: background-color 0.3s ease-in-out;
      }

      /* Style pour le bouton Actualiser au survol */
      #refresh-button:hover {
         background-color: #555;
      }
   </style>
</head>
<body>
   <header>
      <h1>Capteur de sol</h1>
   </header>
   <?php
   // Connexion à la base de données
   $dsn = 'sqlite:sol.db';
   $user = '';
   $password = '';
   $dbh = new PDO($dsn, $user, $password);

   // Récupération des 10 dernières valeurs de la base de données
   $stmt = $dbh->prepare("SELECT valeur, temps FROM capteur_sol ORDER BY id DESC LIMIT 10");
   $stmt->execute();
   $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

   // Dessin du graphique
   $temps = array_column($rows, 'temps');
   $valeurs = array_column($rows, 'valeur');
   ?>
   <div id="container">
      <div class="column" id="table-column">
         <h2>10 dernières valeurs</h2>
         <table>
            <tr>
               <th>Valeur</th>
               <th>Date et heure</th>
            </tr>
            <?php foreach ($rows as $row) : ?>
               <tr>
                  <td><?= $row['valeur'] ?></td>
                  <td><?= $row['temps'] ?></td>
               </tr>
            <?php endforeach ?>
         </table>
      </div>
      <div class="column" id="graph-column">
         <h2>Graphique</h2>
         <div id="graph"></div>
      </div>
   </div>
   <button id="refresh-button" onclick="location.reload()">Actualiser</button>
   <script>
      var temps = <?php echo json_encode($temps); ?>;
      var valeurs = <?php echo json_encode($valeurs); ?>;
      var trace = {
         x: temps,
         y: valeurs,
         mode: 'lines+markers',
         type: 'scatter'
      };
      var data = [trace];
      var layout = {
         xaxis: {
            title: 'Temps'
         },
         yaxis: {
            title: 'Valeur du capteur'
         }
      };
      Plotly.newPlot('graph', data, layout);
      var interval = setInterval(function() {
         // Mettre à jour la table et le graphique toutes les 5 secondes
         Plotly.deleteTraces('graph', 0);
         Plotly.addTraces('graph', [{
            x: temps,
            y: valeurs,
            mode: 'lines+markers',
            type: 'scatter'
         }]);
         <?php
         $stmt->execute();
         $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
         $temps = array_column($rows, 'temps');
         $valeurs = array_column($rows, 'valeur');
         ?>
         temps = <?php echo json_encode($temps); ?>;
         valeurs = <?php echo json_encode($valeurs); ?>;
      }, 5000);
   </script>
</body>
</html>

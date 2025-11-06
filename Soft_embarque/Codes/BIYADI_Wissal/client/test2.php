<!DOCTYPE html>
<html>
<head>
   <title>Capteur de température et d'humidité</title>
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
      .container {
         max-width: 800px;
         margin: 0 auto;
         padding: 20px;
         background-color: #fff;
         box-shadow: 0 0 10px rgba(0,0,0,0.2);
      }

      /* Style pour le graphique */
      #chart {
         width: 100%;
         height: 400px;
      }

      /* Style pour le tableau */
      table {
         border-collapse: collapse;
         width: 100%;
         margin-bottom: 20px;
      }

      th, td {
         text-align: left;
         padding: 8px;
         border-bottom: 1px solid #ddd;
      }

      th {
         background-color: #333;
         color: #fff;
      }

      tr:nth-child(even) {
         background-color: #f2f2f2;
      }
   </style>
</head>
<body>
   <header>
      <h1>Capteur de température et d'humidité</h1>
   </header>
   <div class="container">
      <h2>Dernières valeurs enregistrées</h2>
      <?php
         // Connecter à la base de données
         $conn = new PDO('sqlite:temperature_humidite.db');
         
         // Récupérer les 10 dernières valeurs de température et d'humidité
         $stmt = $conn->prepare('SELECT temperature, humidite, date FROM temperature_humidite ORDER BY id DESC LIMIT 10');
         $stmt->execute();
         $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
         
         // Fermer la connexion à la base de données
         $conn = null;
         
         // Afficher les données dans un tableau
         echo '<table>';
         echo '<tr><th>Date</th><th>Température</th><th>Humidité</th></tr>';
         foreach ($rows as $row) {
            echo '<tr>';
            echo '<td>'.$row['date'].'</td>';
            echo '<td>'.$row['temperature'].' &deg;C</td>';
            echo '<td>'.$row['humidite'].' %</td>';
            echo '</tr>';
         }
         echo '</table>';
         
         // Extraire les valeurs de température, d'humidité et de date dans des tableaux séparés pour le graphique
         $temperatures = array();
         $humidites = array();
         $dates = array();
         foreach ($rows as $row) {
            $temperatures[] = $row['temperature'];
            $humidites[] = $row['humidite'];
            $dates[] = $row['date'];
         }
         
         // Créer les données pour le graphique
         $data = array(
            array(
               'x' => $dates,
               'y' => $temperatures,
               'type' => 'scatter',
               'name' => 'Température'
            ),
            array(
               'x' => $dates,
               'y' => $humidites,
               'type' => 'scatter',
               'name' => 'Humidité'
            )
         );
         
         // Créer les options pour le graphique
         $layout = array(
            'title' => 'Température et humidité',
            'xaxis' => array(
               'title' => 'Date',
               'tickangle' => -45,
               'tickfont' => array(
                  'size' => 10
               ),
               'tickmode' => 'array',
               'tickvals' => $dates,
               'ticktext' => $dates
            ),
            'yaxis' => array(
               'title' => 'Valeur'
            )
         );
         
         // Afficher le graphique
         echo '<div id="chart"></div>';
         echo '<script>';
         echo 'var data = '.json_encode($data).';';
         echo 'var layout = '.json_encode($layout).';';
         echo 'Plotly.newPlot("chart", data, layout);';
         echo '</script>';
      ?>
   </div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Contrôle de la quantité d'eau</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
    }

    h1 {
      text-align: center;
      color: #2196f3;
      margin-top: 0;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    p {
      font-size: 24px;
      text-align: center;
      color: #555;
      margin-top: 50px;
    }

    .water-level {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 300px;
      margin-top: 50px;
      position: relative;
    }

    .water-level .bar {
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 10px;
      height: 200px;
      background-color: #2196f3;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .water-level .water {
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 10px;
      height: <?php echo $resultat * 20; ?>px;
      background-color: #2196f3;
      transition: height 1s ease-in-out;
    }

    .water-level p {
      position: absolute;
      top: 0;
      left: 50%;
      transform: translateX(-50%);
      font-size: 24px;
      font-weight: bold;
      color: #555;
      margin: 0;
      padding: 10px;
      background-color: #fff;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>
  <h1>Controle de la quantité d'eau</h1>

  <?php
  // Exécuter le code Python pour obtenir la quantité d'eau
  $commande = "sudo python3 /www/water_sensor.py";
  $resultat = exec($commande);
  ?>

  <div class="water-level">
    <div class="bar"></div>
    <div class="water"></div>
    <p><?php echo $resultat; ?> cm</p>
  </div>

  <p>La quantité d'eau dans le sol est de : <?php echo $resultat; ?> cm</p>
</body>
</html>

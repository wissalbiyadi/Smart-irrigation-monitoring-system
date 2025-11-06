<!DOCTYPE html>
<html>
<head>
   <title>Système d'arrosage automatique</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   <style>
      /* Style pour le corps de la page */
      body {
         font-family: Arial, sans-serif;
         margin: 0;
         padding: 0;

background-image: url('arrosage.png');
                        background-size: cover;
                        background-repeat: no-repeat;
                        background-position:center center;
min-height: 100vh;
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
       text-transform: uppercase;
      }

      /* Style pour le sous-titre de la page */
      h2 {
         margin: 0;
         font-size: 24px;
         color: #333;
         text-transform: uppercase;
      }

      /* Style pour le conteneur principal de la page */
      #container {
         max-width: 800px;
         margin: 0 auto;
         padding: 20px;
      }

      /* Style pour les boutons */
      .button {
         background-color: #333;
         border: none;
         color: #fff;
         padding: 10px 20px;
         text-align: center;
         text-decoration: none;
         display: inline-block;
         font-size: 16px;
         margin: 4px 2px;
         cursor: pointer;
         border-radius: 5px;
   }

      /* Style pour les liens */
      a {
         color: #333;
         text-decoration: none;
      }

      /* Style pour les icônes */
      .fa {
         display: inline-block;
         font-size: 48px;
         margin: 10px;
         transition: transform 1s ease-in-out;
      }

      .fa.active {
         transform: rotate(360deg);
      }
   </style>
</head>
<body>


   <header>
      <h1>Système d'arrosage automatique</h1>
   </header>
   <div id="container">
      <h2>Choisissez une option :</h2>
      <a href="sol1.php"><button class="button"><i class="fas fa-thermometer-half"></i>Sol</button></a>
      <a href="test2.php"><button class="button"><i class="fas fa-tachometer-alt"></i>Temperature et humidité</button></a>
      <a href="pompe.php"><button class="button"><i class="fas fa-tint"></i>Pompe</button></a>
   <a href="water_sensor.php"><button class="button"><i class="fas fa-tint"></i>Niveau d'eau</button></a>
   </div>
   <div class="animation">
      <i class="fas fa-cloud-rain"></i>
      <i class="fas fa-cloud-rain"></i>
      <i class="fas fa-cloud-rain"></i>
   </div>
   <script>
      // Script pour faire tourner les icônes de l'animation
      const icons = document.querySelectorAll('.fa');
      let index = 0;

      setInterval(() => {
         icons[index].classList.remove('active');
         index = (index + 1) % icons.length;
         icons[index].classList.add('active');
      }, 1000);
   </script>
</body>
</html>


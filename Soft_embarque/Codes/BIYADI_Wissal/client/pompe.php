
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contrôle de la pompe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
            font-size: 36px;
            color: #009688;
            margin-top: 50px;
        }
        form {
            margin: 0 auto;
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }
        label {
            font-size: 18px;
            display: block;
            margin-bottom: 10px;
            color: #555;
        }
        input[type=number] {
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-size: 18px;
            width: 100%;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }
        input[type=submit] {
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 18px;
            color: #fff;
            background-color: #009688;
            cursor: pointer;
            margin-top: 20px;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }
        input[type=submit]:hover {
            background-color: #00796b;
        }
        .message {
            font-size: 24px;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <h1>Contrôle de la pompe</h1>
    <form method="post" action="pompe.php">
        <label for="duree">Durée d'activation de la pompe (en secondes) :</label>
        <input type="number" id="duree" name="duree" required>
        <br><br>
        <input type="submit" name="demarrer" value="Démarrer">
        <input type="submit" name="arreter" value="Arrêter">
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($resultat == "active") {
                echo "<p class='message'>La pompe est active.</p>";
            } else {
                echo "<p class='message'>La pompe est éteinte.</p>";
            }
        }
    ?>
</body>
</html>

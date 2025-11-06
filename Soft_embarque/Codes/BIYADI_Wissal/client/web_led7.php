<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1252">
  <title>Contrôle des LEDs</title>
  <style type="text/css">
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
    }

    h1 {
      text-align: center;
      color: #555;
      margin-top: 0;
    }

    .led-container {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
    }

    .led {
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 180px;
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 20px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .led p {
      font-size: 24px;
      margin-bottom: 10px;
      text-align: center;
    }

    .led button {
      width: 100px;
      padding: 10px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      color: #fff;
      cursor: pointer;
      transition: all 0.2s ease-in-out;
    }

    .led button.on {
      background-color: #4caf50;
    }

    .led button.off {
      background-color: #f44336;
    }

    .led button:hover {
      transform: translateY(-2px);
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .led button:focus {
      outline: none;
    }
  </style>

  <?php
  if (isset($_GET['led']) && isset($_GET['onOff'])) {
    $led = $_GET['led'];
    $onOff = $_GET['onOff'];

    exec("/www/c-bin/test1 $led $onOff");

    if ($onOff == 1) {
      $etat_led = "allumée";
    } else {
      $etat_led = "éteinte";
    }

    echo "<script>alert('La LED #$led est $etat_led');</script>";
  }
  ?>
</head>
<body>
  <h1>Contrôle des LEDs</h1>

  <div class="led-container">
    <div class="led">
      <p>LED #0:</p>
      <button onclick="location.href='web_led7.php?led=0&onOff=1'" type="button" class="on">ON</button>
      <button onclick="location.href='web_led7.php?led=0&onOff=0'" type="button" class="off">OFF</button>
    </div>
    <div class="led">
      <p>LED #1:</p>
      <button onclick="location.href='web_led7.php?led=1&onOff=1'" type="button" class="on">ON</button>
      <button onclick="location.href='web_led7.php?led=1&onOff=0'" type="button" class="off">OFF</button>
    </div>
    <div class="led">
      <p>LED #2:</p>
      <button onclick="location.href='web_led7.php?led=2&onOff=1'" type="button" class="on">ON</button>
      <button onclick="location.href='web_led7.php?led=2&onOff=0'" type="button" class="off">OFF</button>
    </div>
    <div class="led">
      <p>LED #3:</p>
      <button onclick="location.href='web_led7.php?led=3&onOff=1'" type="button" class="on">ON</button>
      <button onclick="location.href='web_led7.php?led=3&onOff=0'" type="button" class="off">OFF</button>
    </div>
  </div>
</body>
</html>

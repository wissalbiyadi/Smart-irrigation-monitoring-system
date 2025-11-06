mport time
import datetime
import sqlite3
import RPi.GPIO as GPIO
import matplotlib.pyplot as plt

# Configuration du capteur Fc-28
pin = 17
GPIO.setmode(GPIO.BCM)
GPIO.setup(pin, GPIO.IN)
led1 = 18
led2 = 22
GPIO.setup(led1, GPIO.OUT)
GPIO.setup(led2, GPIO.OUT)

# Fonction pour allumer ou éteindre les LED en fonction de l'état passé en paramètre
def set_led_state(state):
    if state == 0:
        GPIO.output(led1, GPIO.HIGH)
        GPIO.output(led2, GPIO.HIGH)
        print("Les LED sont allumées")
        message_led = "La LED est allumée"
    else:
        GPIO.output(led1, GPIO.LOW)
        GPIO.output(led2, GPIO.LOW)
        print("Les LED sont éteintes")
        message_led = "La LED est éteinte"
    return message_led

# Connexion à la base de données
conn = sqlite3.connect('sol1.db')
c = conn.cursor()
# Création de la table s'il n'existe pas déjà
c.execute('''CREATE TABLE IF NOT EXISTS capteur_sol
             (id INTEGER PRIMARY KEY AUTOINCREMENT,
              valeur INTEGER,
              etat_led INTEGER,
              message_led TEXT,
              etat_pompe INTEGER,
              message_pompe TEXT,
              temps DATETIME DEFAULT CURRENT_TIMESTAMP)''')

# Capture de 10 valeurs pendant 10 secondes
valeurs = []
temps_debut = time.time()
while time.time() - temps_debut < 10:
    valeur = GPIO.input(pin)
    temps = datetime.datetime.now()
    valeurs.append((valeur, temps))
    print("Valeur du capteur : {} à {}".format(valeur, temps))
    
    # Allumer ou éteindre la LED en fonction de la valeur du capteur
    message_led = set_led_state(valeur)
    
    # Enregistrer l'état de la pompe sous forme de message dans la base de données
    if valeur == 0:
        message_pompe = "La pompe est désactivée"
        etat_pompe = 0
        etat_led = 0
    else:
        message_pompe = "La pompe est activée pendant une minute"
        etat_pompe = 1
        etat_led = 1
   c.execute("INSERT INTO capteur_sol (valeur, etat_led, message_led, etat_pompe, message_pompe, temps) VALUES (?, ?, ?, ?, ?, ?)", 
 (int(valeur), etat_led, message_led, etat_pompe, message_pompe, temps))
    conn.commit()
    time.sleep(1)

# Récupération des 10 dernières valeurs de la base de données
c.execute("SELECT valeur, etat_led, message_led, etat_pompe, message_pompe, temps FROM capteur_sol ORDER BY id DESC LIMIT 10")
rows = c.fetchall()

# Fermeture de la connexion à la base de données
conn.close()

# Extraction des valeurs, des états de la LED, des états de la pompe et des temps dans quatre listes séparées
valeurs = [row[0] for row in rows]
etats_led = [row[1] for row in rows]
messages_led = [row[2] for row in rows]
etats_pompe = [row[3] for row in rows]
messages_pompe = [row[4] for row in rows]
temps = [row[5] for row in rows]

# Dessin du graphique
plt.plot(temps, valeurs)
plt.title('Évolution de la valeur du capteur solaire, de l\'état de la LED et de l\'état de la pompe')
plt.xlabel('Temps')
plt.ylabel('Valeur / État')
plt.yticks([0, 1, 2], ['Capteur solaire', 'LED', 'Pompe'])
for i, message in enumerate(etats_led):
    plt.text(temps[i], valeurs[i], message, ha='left', va='bottom')

   plt.text(temps[i], 0.9, messages_led[i], ha='left', va='top')
    plt.text(temps[i], 1.1, messages_pompe[i], ha='left', va='top')
plt.show()




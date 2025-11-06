
import time
import datetime
import sqlite3
import RPi.GPIO as GPIO
import matplotlib.pyplot as plt

# Configuration du capteur Fc-28
pin = 17
GPIO.setmode(GPIO.BCM)
GPIO.setup(pin, GPIO.IN)

# Connexion à la base de données
conn = sqlite3.connect('sol.db')
c = conn.cursor()

# Création de la table s'il n'existe pas déjà
c.execute('''CREATE TABLE IF NOT EXISTS capteur_sol
             (id INTEGER PRIMARY KEY AUTOINCREMENT,
              valeur INTEGER,
              temps DATETIME DEFAULT CURRENT_TIMESTAMP)''')

# Capture de 10 valeurs pendant 10 secondes
valeurs = []
temps_debut = time.time()
while time.time() - temps_debut < 10:
    valeur = GPIO.input(pin)
    temps = datetime.datetime.now()
    valeurs.append((valeur, temps))
    print("Valeur du capteur du sol : {} à {}".format(valeur, temps))
    c.execute("INSERT INTO capteur_sol (valeur, temps) VALUES (?, ?)", (int(valeur), temps))
    conn.commit()
    time.sleep(1)

# Récupération des 10 dernières valeurs de la base de données
c.execute("SELECT valeur, temps FROM capteur_sol ORDER BY id DESC LIMIT 10")
rows = c.fetchall()

# Fermeture de la connexion à la base de données
conn.close()

# Extraction des valeurs et des temps dans deux listes séparées
valeurs = [row[0] for row in rows]
temps = [row[1] for row in rows]

# Dessin du graphique
plt.plot(temps, valeurs)
plt.xlabel('Temps')
plt.ylabel('Valeur du capteur')
plt.savefig('sol.png')
plt.show()

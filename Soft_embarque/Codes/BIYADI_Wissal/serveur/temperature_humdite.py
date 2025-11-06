

import sqlite3
import Adafruit_DHT
import matplotlib.pyplot as plt
from datetime import datetime
import time

# Connecter à la base de données
conn = sqlite3.connect('temperature_humidite.db')
c = conn.cursor()

# Créer la table s'il n'existe pas encore
c.execute('''CREATE TABLE IF NOT EXISTS temperature_humidite (id INTEGER PRIMARY KEY AUTOINCREMENT, temperature REAL, humidite REAL, date TEXT)''')

# Lire 10 valeurs de température et d'humidité
for i in range(10):
    # Lire la température et l'humidité à partir du capteur DHT11
    humidity, temperature = Adafruit_DHT.read_retry(11, 4)
    
    # Enregistrer la température, l'humidité et la date dans la base de données
    now = datetime.now()
    date_time = now.strftime("%Y-%m-%d %H:%M:%S")
    c.execute("INSERT INTO temperature_humidite (temperature, humidite, date) VALUES (?, ?, ?)", (temperature, humidity, date_time))
    conn.commit()
    
    # Attendre 1 seconde avant de lire la prochaine valeur
    time.sleep(1)

# Récupérer les 10 dernières valeurs de température et d'humidité
c.execute("SELECT temperature, humidite FROM temperature_humidite ORDER BY id DESC LIMIT 10")
rows = c.fetchall()

# Fermer la connexion à la base de données
conn.close()

# Extraire les valeurs de température et d'humidité dans deux listes séparées
temperatures = [row[0] for row in rows]
humidites = [row[1] for row in rows]

# Dessiner le graphique de température
plt.subplot(2, 1, 1)
plt.plot(temperatures, 'ro-')
plt.title('Température')

# Dessiner le graphique d'humidité
plt.subplot(2, 1, 2)
plt.plot(humidites, 'bo-')
plt.title('Humidité')

# Enregistrer les graphiques dans deux fichiers PNG
plt.tight_layout()
plt.savefig('temperature_humidité.png')


# Afficher les graphiques
plt.show()

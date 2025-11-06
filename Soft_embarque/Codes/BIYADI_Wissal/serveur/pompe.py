import serial
import time

# Ouvrir le port série
ser = serial.Serial('/dev/ttyACM0', 9600)

while True:
    # Demander à l'utilisateur la durée d'activation de la pompe
    duree = input("Entrez la durée d'activation de la pompe (en secondes): ")

    # Envoyer la durée à la pompe via le port série
    ser.write(duree.encode())

    # Attendre la réponse de la pompe
    etat = ser.readline().decode().strip()

    if etat == "active":
        print("La pompe est active.")
    else:
        print("La pompe est éteinte.")
    
    # Demander à l'utilisateur s'il souhaite continuer
    continuer = input("Voulez-vous continuer (o/n)? ")
    if continuer.lower() != "o":
        break

# Fermer le port série
ser.close()

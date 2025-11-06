import RPi.GPIO as GPIO
import time
 
GPIO.setmode(GPIO.BCM)
 
# Définition des broches pour le capteur ultrasonique
TRIG = 23
ECHO = 24
 
GPIO.setup(TRIG,GPIO.OUT)
GPIO.setup(ECHO,GPIO.IN)
 
def mesure_distance():
    # Envoi d'une impulsion de 10µs sur la broche TRIG
    GPIO.output(TRIG, True)
    time.sleep(0.00001)
    GPIO.output(TRIG, False)
 
    pulse_start = time.time()
    pulse_end = time.time()
 
    # Attente du signal sur la broche ECHO
    while GPIO.input(ECHO) == 0:
        pulse_start = time.time()
 
    while GPIO.input(ECHO) == 1:
        pulse_end = time.time()
 
    # Calcul de la durée de l'impulsion
    pulse_duration = pulse_end - pulse_start
 
    # Calcul de la distance en cm
    distance = pulse_duration * 17150
 
    return distance
 
try:
    while True:
        distance = mesure_distance()
        print("Distance : %.2f cm" % distance)
        
        # Ajouter le code pour ajuster l'arrosage en fonction de la distance mesurée
 
        time.sleep(1)
 
except KeyboardInterrupt:
    GPIO.cleanup()

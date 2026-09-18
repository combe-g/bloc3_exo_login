# bloc3_exo_login

Règles de gestion : 
* Le login est composé du nom de famille et de la première lettre du prénom séparés par un point.
* Minuscules obligatoires
* Caractères autorisés : a-z, é, è et ç
* Le nom de famille est limité à 20 caractères.

Jeux de test :
* Chaigneau Mathis => chaigneau.m
* &&ççéé@@ M => ççéé.m
* ABCDEFGHIJKLMNOPQRSTUVWXYZ ABC => abcdefghijklmnoprst.a

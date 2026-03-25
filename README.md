
# 🚗 Autorent - Veebirakendus

See on koolitööks olnud ja GitHubist kloonitud PHP-põhine autorendi infosüsteem, mis on seadistatud jooksma Debian Linux serveril.

## 🛠️ Süsteemi nõuded ja paigaldus

Projekti jooksutamiseks paigaldatakse  Debian järgmised komponendid:
* **Veebiserver:** Apache2
* **Andmebaas:** MariaDB / MySQL
* **Keel:** PHP (koos mysqli laiendusega)
* **Haldusliides:** phpMyAdmin

### 1. Tarkvara paigaldamine
Serverile paigaldatud vajalik tarkvara järgmiste käskudega:
```bash
sudo apt update
sudo apt install -y apache2 mariadb-server php libapache2-mod-php php-mysql phpmyadmin git 
```
### 2. Andmebaasi ja kasutaja seadistamine
Enne kui kloonin GitHubist andmebaasi, annan järgmiste käskudega andmebaasile kasutaja ning sellele vajalikud õigused:
 ```SQL
CREATE DATABASE car_rent; 
CREATE USER 'hannes'@'localhost' IDENTIFIED BY 'Passw0rd';
GRANT ALL PRIVILEGES ON autorent.* TO 'hannes'@'localhost'; FLUSH PRIVILEGES;
EXIT;
```

### 3. Projekti kloonimine GitHubist

Kuna GitHub nõuab parooli asemel **Tokenit**, loon GitHubis vajaliku tokeni ning kasutn järgmist meetodit:

1.  Liigu veebikausta: `cd /var/www/html`
    
2.  Eemalda vana index: `sudo rm index.html`
    
3.  Klooni projekt (asenda `TOKEN` oma GitHubi Personal Access Tokeniga):

```bash
sudo git clone https://hploompuu-spec:TOKEN@github.com/hploompuu-spec/car_rent.git  
```
NB!  Kuna soovin, et failid asuksid juurkaustas `/var/www/html` siis kasutan järgmisi käske, et kopeerida ja kustutada kaust `car_rent`
```bash
cd /var/www/html
sudo mv car_rent/* . 
sudo mv car_rent/.* . 2>/dev/null 
sudo rmdir car_rent
```

4.  Annan veebiserverile õigused faile lugeda ja kirjutada:

```bash
sudo chown -R www-data:www-data /var/www/html 
sudo chmod -R 755 /var/www/html
```

### 4. Andmebaasis seadistamine phpmyadmini kaudu

Nüüd avan brauseris `http://(masina ip aadress)/phpmyadmin` ja impordin DB kaustas oleva kõige ajakohasema andmebaasi faili `.sql` fail  vastloodud `car_rent` tabelisse.

### 5. Kontroll, kas andmebaas käivitub

Kontrollides brauseris `http://(masina ip aadress)` saab veenduda, et andmebaas töötab.
Aadressil `http://(masina ip aadress)/admin` käivitub ka administreerimisleht.



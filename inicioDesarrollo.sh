#!/bin/bash
clear
# Se añade el nombre de dominio al fichero /etc/hosts
sudo vi /etc/hosts
echo "Se ha añadido el nombre de dominio en /etc/hosts"
echo

# Se guarda el nombre del dominio
read -p "Nombre de dominio (Sin .): " dominio
echo "Se ha registrado el nombre de dominio"

# Se crea el usuario de la base de datos. Nombre será el dominio.
sudo -u postgres createuser -P $dominio
echo "Se ha creado el usuario " $dominio " de la base de datos."

# Se crea la base de datos con nombre del dominio.
sudo -u postgres createdb $dominio
echo "Se ha creado la basa de datos " $dominio " en postgresql."

# Se crea el sitio virtual web.
cd /etc/apache2/sites-available
sudo cp 000-default.conf $dominio.conf
echo "Se ha creado el sitio virtual web " $dominio ".conf."

# Se configura el sitio virtual.
sudo vi $dominio.conf
echo "Se ha configurado el sitio virtual creado."

# Se activa el sitio virtual.
sudo a2ensite $dominio.conf
echo "Se ha activado el sitio virtual."

# Se reinica apache.
sudo service apache2 restart
echo "Se reinicia apache."

# Se crea la carpeta del proyecto, junto con mas carpetas.
mkdir ~/web/$dominio
cd ~/web/$dominio
git init > /dev/null
echo Se crea repositorio local

mkdir  ~/web/$dominio/db
echo
read -p "Nombre del fichero SQL: " fich

touch ~/web/$dominio/db/$fich.sql
touch ~/web/$dominio/index.php
touch ~/web/$dominio/auxiliar.php

echo "Se crea el directorio del proyecto con el contenido necesario."



echo "sudo -u postgres psql -h localhost -U "  $dominio " -d " $dominio " < $fich.sql " > db/inyeccionSQL.sh
echo "sudo -u postgres psql -h localhost -U " $dominio " -d "$dominio  > db/acceso.sh

sudo chmod a+x db/inyeccionSQL.sh
sudo chmod a+x db/acceso.sh

echo
read -p "¿Desea enlazar repositorio con GITHUB? (si/no): " enla

if [ $enla == "si" ]
then

    read -p "Nombre del repositorio remoto para enlazar: " repo

    git remote add origin https://github.com/oscar490/$repo.git
    git add .
    git commit -m "Carga inicial"
    git push -u origin master
    echo Se ha enlazado perfectamente
    xdg-open https://github.com/oscar490/$repo.git
fi

#read -p "¿Desea enlazar un repositorio local a uno remoto existente?:(si/no) " loca

#if [ $loca == "si" ]
#then
#    read -p "Nombre del repositorio remoto: " remoto
#    git remote add origin https://github.com/oscar490/$remoto.git
#    git pull
#    echo Se ha enlazado el repositorio local $dominio con repositorio
#    echo remoto https://github.com/oscar490/$remoto.git
#    echo
#    xdg-open https://github.com/oscar490/$remoto.git
#fi
# Se abre el proyecto con atom.
echo Se ha creado la carpeta $dominio
atom ~/web/$dominio
xdg-open http://$dominio.local





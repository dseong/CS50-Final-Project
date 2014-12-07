#!/bin/sh
echo "Setting up database"
mysql --execute="DROP DATABASE IF EXISTS musicmates" --user="jharvard" --password="crimson"
mysql --execute="CREATE DATABASE musicmates" --user="jharvard" --password="crimson"
mysql --database="musicmates" --user="jharvard" --password="crimson" < dbsetup.sql
echo "Database setup done"
echo "Chmodding files"
chmod a+x ~
chmod a+rx ~/vhosts
chmod a+rx ~/vhosts/musicmates
chmod a+rx ~/vhosts/musicmates/public
chmod a+rx ~/vhosts/musicmates/public/css ~/vhosts/musicmates/public/fonts ~/vhosts/musicmates/public/img ~/vhosts/musicmates/public/js
chmod a+r ~/vhosts/musicmates/public/css/* ~/vhosts/musicmates/public/fonts/* ~/vhosts/musicmates/public/img/* ~/vhosts/musicmates/public/js/* ~/vhosts/musicmates/public/*
echo "Adding path to hosts file"
echo "Enter root password if prompted"
sudo sh -c "grep -q -F '127.0.0.1 musicmates' /etc/hosts || sudo echo '127.0.0.1 musicmates' >> /etc/hosts"

## CORE DB CLASS
File PATH: classes/class.db.php
Reference: https://code.google.com/p/php-pdo-wrapper-class/

## GENERATORS FOLDER
File: models_generator.py
generate the models phpclass for framework
modify them to configure the dbname,username,password

# types.xml 
the file types.xml allows the generator to define the pattern of validation to be used during the generation of the model
Are implemented the following types INT, VARCHAR, DATE, DATETIME

## MODELS GENERATOR
to install the mysqldb module in python write in terminal:
sudo apt-get install python-MySQLdb

## URL REWRITE
to enable the mod_rewrite in apache2 write in terminal: 
a2enmod rewrite

replace every occurrence of "AllowOverride None" with "AllowOverride all"
in /etc/apache2/sites-available/default

sudo service apache2 restart


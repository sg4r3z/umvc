#!/usr/bin/python

import xml.etree.ElementTree as ET
import string
import MySQLdb as db
import datetime as dt
import sys
import re
import os

run_mode_regex = re.compile("define\(\'?RUN_MODE\'?, \s?\'(.*)\'\);")
setting_type = re.compile("define\(\'?DB_Type\'?, \s?\'(.*)\'\);")
setting_hostname = re.compile("define\(\'?DB_Hostname\'?, \s?\'(.*)\'\);")
setting_username = re.compile("define\(\'?DB_Username\'?, \s?\'(.*)\'\);")
setting_password = re.compile("define\(\'?DB_Password\'?, \s?\'(.*)\'\);")
setting_name = re.compile("define\(\'?DB_Name\'?, \s?\'(.*)\'\);")

## INIZIALIZZO DIRNAME PER I MODELLI    
models_path = "../models"
validators_path = "../validators"

## LEGGO IL FILE DI CONFIGURAZIONE
in_file = open("../setting.inc.php","r")
setting = in_file.read()
in_file.close()

## ESTRAGGO IL RUN_MODE
trovato = run_mode_regex.search(setting)
if trovato == None:
	print "Impossibile recuperare dati di collegamento al db in setting.inc.php"
	exit(-1)

run_mode = trovato.group(1)

## ESTRAGGO LE CONFIGURAZIONI DB PER IL RUN_MODE

if run_mode == "debug":
	default_index = setting.find("default:")
	break_default_index = setting.rfind("break;")
	setting_db = setting[default_index:break_default_index]
else:
	case_index = setting.find("case '%s':" % run_mode)
	break_index = setting.find("break;")
	setting_db = setting[case_index:break_index]

## IMPOSTO LE VARIABILE RECUPERATE DAL SETTING
db_host = setting_hostname.search(setting_db).group(1)
db_username = setting_username.search(setting_db).group(1)
db_password = setting_password.search(setting_db).group(1)
db_name = setting_name.search(setting_db).group(1)
db_type = setting_type.search(setting_db).group(1)


## CHIEDO CONFERMA
##confirm = raw_input("Sto per sovrascrivere i file in /model del progetto, Continuare? (Y/N):\n")
confirm = raw_input("Quale modello devi rigenerare (Y - tutti/N nessuno):\n")


if confirm == 'N':
	sys.exit(0)

## DEFINISCO ALCUNE VARIABILI DEL GENERATORE
generator_version = "1.0"
	
## RECUPERO I PATTERN DA UTILIZZARE 
## PER GENERARE POI IL MODELLO 
## DI CLASSE 
tree = ET.parse('types.xml')
root = tree.getroot()
mysql = root.find(db_type)

## INIZIALIZZO IL DIZIONARIO DEI TIPI
types = {}
## INIZIALIZZO IL DIZIONARIO DI CLASSE
classes_fields = {}

## ESTRAGGO TUTTI I TIPI 
## E I PATTERN DAL FILE
## DI CONFIGURAZIONE
for type in mysql.iter('type'):
        types[type.find('name').text] = type.find('pattern').text

## CONNESSIONE AL DB MYSQL PER RECUPERARE I DATI
conn = db.connect(db_host,db_username,db_password,db_name)
c = conn.cursor()

## PATTERN DIMENSIONE CAMPI
patternDimensione = "^\w+(\(\d+\))?$"

## SE Y ESTRAI TUTTE LE TABELLE
## DAL DB 
c.execute("SHOW TABLES")
tabelle = c.fetchall()

for nomeTabella in tabelle:

       ## RECUPERO IL NOME DELLA TABELLA
       ## CHE MI FORNIRA POI IL NOME DELLA CLASSE
       nomeTabella = str(nomeTabella[0])
       ##print "Estraggo i dati da: %s" % nomeTabella 
       
       ## RECUPERA TUTTI I CAMPI DELLA TABELLA
       c.execute("SHOW COLUMNS FROM %s" % nomeTabella)
       
       ## AZZERO IL DIZIONARIO DI TABELLA
       class_field = {}
       
       ## TUPLA PER OGNI CAMPO DELLA TABELLA
       for campoTabella in c.fetchall():
		   
                ## RECUPERO TUTTI I VALORI
                nomeCampo = campoTabella[0]
                rawtipoCampo = campoTabella[1]
                nullCampo = campoTabella[2]
                chiaveCampo = campoTabella[3]
                defaultCampo = campoTabella[4]
                extraCampo = campoTabella[5]
                
                ## IMPOSTA LE VARIABILI CHE SERVIRANNO
                ## PER GENERARE LA CLASSE
                requiredCampo = 1
                patternCampo = ""
                                
                ## CONTROLLA SE IL TIPO HA UNA DIMENSIONE
                if string.find(rawtipoCampo,'(') != -1:
                
					## ESTRAI TIPO DI CAMPO E DIMENSIONE
					rawtipoCampo = string.split(rawtipoCampo, '(')
					tipoCampo = rawtipoCampo[0].upper()                        
					dimensioneCampo = string.split(rawtipoCampo[1],')')[0]
						
                else:
					tipoCampo = rawtipoCampo.upper()
					dimensioneCampo = "-1"
                                         
                ## CONTROLLA SE IL CAMPO PUO ESSERE NULLO
                if nullCampo == "NO":
                        requiredCampo_createnew = 1
                        ## NON NULL SOLO IN CREAZIONE
                        requiredCampo_modify = 0
                else:
                        requiredCampo_createnew = 0
                        requiredCampo_modify = 0
                
                ## RECUPERA IL PATTERN DAL DIZIONARIO
                patternCampo = types[tipoCampo]
                
                ## SE IL TIPO DI CAMPO HA DIMENSIONE
                ## IMPOSTA IL PATTERN CON  
                ## LE RIPETIZIONI CORRETTE
                if dimensioneCampo != "-1":
						
					## SE IL CAMPO E' NUMERICO
					## SE 255 REGEX +
					## SE 1 REGEX {1}
					## SE < 255 REGEX {1,NUMERO} RIPETIZIONE ESATTA
					
					if dimensioneCampo.isdigit():
						
						if dimensioneCampo == "255":
							patternCampo += "+"
						elif dimensioneCampo != "1":
							patternCampo += "{1,%s}" % dimensioneCampo
						else:
							patternCampo += "{%s}" % dimensioneCampo
							
					## DIMENSIONE COMPOSTA DA NUMERO,NUMERO
					
					else:
						
						separatore = "."	
						dimensioneTotale = dimensioneCampo.split(",",1)
						patternTotale = patternCampo.split(separatore,1)
						
						i=0
						patternCampo = ""
						for dimensione in dimensioneTotale:
							patternCampo += patternTotale[i]+"{%s}" % (dimensione)
							
							## AGGIUNGO IL SEPARATORE NEL PATTERN
							if i < len(dimensioneTotale)-1:
								patternCampo += "\%s" % (separatore)
							
							i=i+1

											
					## DEVI AGGIUNGERE GLI OPERATORI DI 
					## INIZIO E FINE REGEX ^ $
					patternCampo = '^' + patternCampo
					patternCampo = patternCampo + '$'
                        
                ## SE IL CAMPO E' AUTOINCREMENT DISABILITA
                ## IL REQUIRED IN CASO DI INSERIMENTO
                ## AUTOPOPOLATO DA DB
                if extraCampo == "auto_increment":
                        requiredCampo_createnew = 0  
                
                ## AGGIUNGO I CAMPI A DIZIONARIO DI TABELLA
                class_field[str(nomeCampo)] = { (tipoCampo,patternCampo,requiredCampo_createnew,requiredCampo_modify)}
       
       ## AGGIUNGO IL DIZIONARIO DI TABELLA
       ## AL DIZIONARIO DI CLASSE         
       classes_fields[str(nomeTabella)] = class_field
                     

## CICLO IL DIZIONARIO DI CLASSE
## PER OTTERE TUTTE LE TABELLE
## E I LORO CAMPI
for nomeTabella in classes_fields:
        
	## GENERO IL FILE DI CLASSE
	class_file = open(validators_path+"/validator.%s.php" % nomeTabella.lower(),"w")
	
	validator_array_php = "protected $_validator = array(\n"
	quantiCampi = len(classes_fields[nomeTabella])
	contaCampi = 0
	
	for nomeCampo in classes_fields[nomeTabella]:
			
			for valoreCampo in classes_fields[nomeTabella][nomeCampo]:
									
				if contaCampi < quantiCampi-1:
					validator_array_php += "\t\t\t\t\t\t\t\t\t\t'%s' => array('type' => \"%s\",'pattern' => \"/%s/\", 'createnew' => %s,'modify' => %s),\n" % (nomeCampo,valoreCampo[0],valoreCampo[1],valoreCampo[2],valoreCampo[3])
				else:
					validator_array_php += "\t\t\t\t\t\t\t\t\t\t'%s' => array('type' => \"%s\",'pattern' => \"/%s/\", 'createnew' => %s,'modify' => %s)\n\t\t\t\t\t\t\t\t);\n" % (nomeCampo,valoreCampo[0],valoreCampo[1],valoreCampo[2],valoreCampo[3])
				
				contaCampi = contaCampi+1                
	 
	now = dt.datetime.now()
	
	## SCRIVO INTESTAZIONE PHP
	class_file.write("<?php\n")
	
	## SCRIVO L'INTESTAZIONE DEL VALIDATORE
	class_file.write("/**\n")
	class_file.write(" * %s\n" % nomeTabella.upper())
	class_file.write(" * VALIDATOR generated: %s\n" % now.strftime("%d/%m/%Y %H:%M:%S"))
	class_file.write(" * GENERATOR version: %s\n" % generator_version)
	class_file.write(" */\n")

	## SCRIVO L'OGGETTO VALIDATORE
	class_file.write("\n\t class %sValidator extends Validator{\n\n\t\t %s \n\t}\n?>" % (nomeTabella.lower(),validator_array_php))
	class_file.close()   
	
	## CONTROLLA SE I MODELLI NON SONO PRESENTI	
	if os.path.exists(models_path+"/model.%s.php" % nomeTabella.lower()) == False:
	
		## GENERO L'OGGETTO DI MODELLO VUOTO
		class_file = open(models_path+"/model.%s.php" % nomeTabella.lower(),"w")
		
		## SCRIVO INTESTAZIONE PHP
		class_file.write("<?php\n")
		
		## SCRIVO L'INTESTAZIONE DEL VALIDATORE
		class_file.write("/**\n")
		class_file.write(" * %s\n" % nomeTabella.upper())
		class_file.write(" * MODEL generated: %s\n" % now.strftime("%d/%m/%Y %H:%M:%S"))
		class_file.write(" * GENERATOR version: %s\n" % generator_version)
		class_file.write(" */\n")

		## SCRIVO L'OGGETTO MODELLO
		class_file.write("\n\t class %s extends AppModel{\n\n\t\t protected $_db;\n\t\t public $_tableName = \"%s\";\n\t\t protected $_validator;\n\t}\n?>" % (nomeTabella.lower(), nomeTabella.lower()))
		class_file.close()
	

    

import  configparser
import os
config = configparser.ConfigParser()
# lets create that config file for next time...
DIR_PATH = os.path.dirname(os.path.realpath(__file__))
dir_path = os.path.dirname(os.path.realpath(__file__))
cfgfile = open(DIR_PATH+"/"+"attendance.ini",'w')

# add the settings to the structure of the file, and lets write it out...
config["SOFTWARE"]={"Author","M.Radaszkiewcz","Version","0.0.1","Date","2018.10.10"}
config["ROOM"]={"Room","206","Teacher","mradaszkiewicz","TecherId","1","School","Trenton Catholic Academy","SchoolId","1"}
with open('attendance.ini', 'w') as configfile:
    config.write(configfile)

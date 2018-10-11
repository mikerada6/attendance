import ConfigParser
import os
Config = ConfigParser.ConfigParser()
# lets create that config file for next time...
DIR_PATH = os.path.dirname(os.path.realpath(__file__))
dir_path = os.path.dirname(os.path.realpath(__file__))
cfgfile = open(DIR_PATH+"/"+"attendance.ini",'w')

# add the settings to the structure of the file, and lets write it out...
Config.add_section('Software')
Config.set('Software','Author',"M.Radaszkiewcz")
Config.set('Software','Version',"0.01")
Config.set('Software','Date',"2018.10.10")
Config.add_section('Room')
Config.set('Room','Number',206)
Config.set('Room','Teacher', "mradaszkiewicz")
Config.set('Room','TeacherID', "1")
Config.set('Room','School', "TCA")
Config.set('Room','SchoolID', "1")
Config.write(cfgfile)
cfgfile.close()
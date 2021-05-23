This is a project using composer doctrine DBAL package and symfony console which does followings
:
0

1 Creates Database with given database name. The command to create database is createdatabase on the console :

Command createdatabase is follow:

bin/console space createdatabase space databasename enter

2 Create Tabel with given tablename on the given existing database. The command to create table on the given database
name is createtable . Command createtable is follow :

bin/console space createtable spcae tablename space databasename enter

3 Insert info(firstname, lastname, email, website) in the given tablename of given databasename. The command for insert
data is follow :

bin/console space insert spcae tablename space databasename space firstname space lastname space email spcae webesite
enter

4 Display the data from the existing table of the given database name. The command to get data from given tablename and
databasename is getdata

Command getdata is follow:

bin/console space getdata space tablename space databasename. 



Command to see all command is bin/console enter

Available commands:

createdatabase :   createdatabase space databasename

createtable  :    createtable tablename space databasename

getdata    :      getdata tablename space databasename

help      :       Display help for a command

insert      :     insert space tablename spcae databasename space firstname space lastname space email space website

list       :      List commands




Localhost Info:


'driver' => 'pdo_mysql',

'host' => '127.0.0.1',

'user' => 'root',

'password' => '',

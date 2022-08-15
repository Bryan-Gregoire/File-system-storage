
# Computer project of 53735 and 54637

## Introduction

Projet of secure client / server file system storage. The application allows :

- new users to register in the system.
- users to connect to the system.
- authenticated users to store files.
- authenticated users to upload / delete / modify files.
- authenticated users to share their files with other users.

## Installation

Installation is the same as a standard Laravel project and requires an Apache/NGNIX server, a server  
MySQL, composer, NodejS and a terminal.

1) Clone this repository and go into the folder.
2) Copy the .env.example file to .env to define your database credentials.
Run `cp .env.example .env`
3) Import into the database the data from the "*installation/requests.sql*" script (this script automatically creates the user, the database data, creates the tables and populates the users table with the 3 accounts described below)
4) Run`chmod +x installation/install.sh && ./installation/install.sh`
5) Run`php artisan serv`
6) The site is accessible at the address: http://localhost:8000

The script " *installation/install.sh* " executes the installation commands of composer, nodes, give the necessary rights,  but can't do the other steps alone and assume these general apps are already installed.

## Security :
All information related to security can be found in the report in pdf format found in *installation/rapport_54637_53735.pdf*.

## Password:

We have created 3 accounts that are imported into requests.sql, the password for each is `aA1234567@`:

- Bryan Grégoire, 53735@etu.he2b.be, aA1234567@
- Billal Zidi, 54637@etu.he2b.be, aA1234567@
- Pierre Hauweele, phauweele@he2b.be, aA1234567@

The SQL queries create a user " `shareFiles` " whose password  
is " `t8AgECsq1Esqg98Fs3E/5qsdFb45dsv8B3c4CCp@` ".

# Authors
- 54637 Billal ZIDI 54637@etu.he2b.be
- 53735 Bryan GRÉGOIRE 53735@etu.he2b.be
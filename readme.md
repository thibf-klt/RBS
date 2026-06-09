# RBS
This is the website for R. Breton, a sophrology practitioner, so that she can display her credentials but also offer exercises to her clients.

# Project Structuration
app/
* controller/ : requests treatment
* model/ : Interactions with the database (mySQL).
* view/ : display files.
* config.php
* router.php

private/
* media/ : videos included in the exercises
* pdf/ : pdf included in the exercises

public/
* fonts/ : fonts used in the wesite
* images / : graphic assets
* js/ : JavaScript scripts
* sound/ : soundclips
* style/ : scss and css files

index.php : point of entry for the wesite

# Needed
- PHP 8.2 or over
- Composer
- MySQL
- Apache Server (LAMP, WAMP, ...)
- Node.js + npm (to compile the SCSS)

# Installation & Configuration
1. Clone the repository (using git clone)
2. Copy the file .env.examplen rename it .env and change with your own values 
3. Import data/RBS.sql into phpMyAdmin (or another application more to your liking)
4. Point the vhost towards the root file

# API
The API used in this website can be found at the following address:
https://quoteslate.vercel.app/api/quotes/random

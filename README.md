# chessable
Coding challenge

# Installation:
1. Download code
2. Make sure you have installed Docker and Docker Compose
3. Open terminal, switch to the folder with downloaded application code and execute 'docker-compose up -d'
4. Application will be available at http://localhost:8080/index.php (Please note, database initialization may take a few seconds)



# Notes regarding DB structure:
The DB scheme can be found in the html/migrations/db_scheme.sql. The table 'ci_sessions' needed for a CodeIgniter (CI) session library to serves sessions. In the scope of the challenge task 'bank_branch', 'customer' and 'transaction' tables were created. First, 'bank_branch' and second, 'customer' tables have relation 1:M and each customer has linked to him/her branch ID. However, transactions are not linked directly with branches, only through customers. It has meaning customer may perform the transaction in any branch he finds nearby, moreover, the transaction can be done only, so no one branch has been involved physically.

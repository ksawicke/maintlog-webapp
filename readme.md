#Komatsu NA Maintenance Log App

All new version of the Maintenance Log App.

The purpose of this application is to allow engineers to add service log entries to track SMR Updates, Fluid Entries, PM Services, and Component Changes performed to equipment.

The application was written in PHP and JavaScript and uses the following:
# CodeIgniter 3.1.5
# Bootstrap 3.3.7 (to ensure a responsive layout)
# jQuery
# DataTables
# jBox
# parsley.js validation

12/07/17 - While in development, the database structure is generated dynamically using RedbeanPHP. Changes that occur while in development may affect the final structure of tables. However there is a database dump updated from time to time under the 'db' folder in this repository while in development.
# PHP test

## 1. Installation
  - create an empty database named "phptest" on your MySQL server
  - import the dbdump.sql in the "phptest" database
  - put your MySQL server credentials in the constructor of DB class
  - run `composer install`
  - you can test the demo script in your shell using php file inside `public/scripts` folder
    - List news run `php public/scripts/list_news.php`
    - To add more news and comment run `php public/scripts/insert_test_data.php`
    - To delete news with comment run ` php public/scripts/delete_news.php 15` where `15` is the news ID
   

## Implementation
* Refactor code to make it more maintanable and the changes demonstrate the following:
  - Add Proper Directory segragation e.g Entity, Repository
  - The use of Repository Pattern
  - Add PS-4 autoloading remove the use of require, includes as it hard to read absolute paths we use namespace instead
  - Bootstrap DI (Dependency Injection) in SOLID principle this refers to (D) depency inverion
  - Group repetetive function/methods or codes (DO NOT REPEAT YOUR SELF) or Single Responsiblity principle
  - The use of Singleton
  - Add security handling for sql injection by using prepared statement

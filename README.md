# smart_reporting_test

Hi guys! 

To make the whole process work, follow the steps below.

The med_test folder contains all the files needed to create our docker container. There are 3 different folders: database, nginx, php-frm. All folders contains the Dockerfile and in the root folder we have docker-compose.yml

From there, just create the container.

The src folder contains the developed code. In my environment I created to run on the root "/", you can change the routes inside the controllers if you prefer.

Database script:
Create database symfony;
CREATE TABLE `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `initial_currency` varchar(8) NOT NULL,
  `final_currency` varchar(8) NOT NULL,
  `initial_value` decimal(20,2) NOT NULL,
  `final_value` decimal(20,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;


To run the application tests, just enter /src and type "php bin / phpunit". In this way you will run all 4 tests that I created;

I am also sending a third folder for you to see how the system and the execution of the tests should look.

Hope you like it!!

<?php

 require '../app/dbh.php';

 try{
   //Let's get .sql file with
   $sql = file_get_contents("../app/dbsql.sql");
   $conn->exec($sql);
   //echo "2. Table(s) creation: Success, Eight tables created!\n";
 }catch(Exception $e){
   echo " Connection failed ". $e->getMessage();
 }

 //inserting sample data

 try{
   //1/. Inserting sampple to user table

   $conn->exec("INSERT INTO user(firstname, lastname,email,password,level,regDate)
                         VALUES('Fadega','Afa','admin@gmail.com','admin','admin',DateTime('now'))");
   $conn->exec("INSERT INTO user(firstname, lastname,email,password,level,regDate)
                         VALUES('David','James','davidj@gmail.com','paspas','standard',DateTime('now'))");
   $conn->exec("INSERT INTO user(firstname, lastname,email,password,level,regDate)
                         VALUES('Helen','Berhe','helenb@gmail.com','secrete','standard',DateTime('now'))");

   $conn->exec("INSERT INTO user(firstname, lastname,email,password,level,regDate)
                         VALUES('Mike','Kifle','kmike@gmail.com','pass123','admin',DateTime('now'))");
   $conn->exec("INSERT INTO user(firstname, lastname,email,password,level,regDate)
                         VALUES('Roshan','Berih','roshan@gmail.com','paspas','standard',DateTime('now'))");
   $conn->exec("INSERT INTO user(firstname, lastname,email,password,level,regDate)
                         VALUES('John','Doe','johnd@gmail.com','secrete','standard',DateTime('now'))");

   //2. Inserting sample data to author table

   $conn->exec("INSERT INTO author(firstname, lastname,email) VALUES('James','Clear','james@gmail.com')");
   $conn->exec("INSERT INTO author(firstname, lastname,email) VALUES('David','James','davidj@gmail.com')");
   $conn->exec("INSERT INTO author(firstname, lastname,email) VALUES('J.K','Rowling','jkrow@gmail.com')");
   $conn->exec("INSERT INTO author(firstname, lastname,email) VALUES ('Mike','Kifle','kmike@gmail.com')");
   $conn->exec("INSERT INTO author(firstname, lastname,email) VALUES ('Roshan','Berih','roshan@gmail.com')");
   $conn->exec("INSERT INTO author(firstname, lastname,email) VALUES ('John','Doe','johnd@gmail.com')");

   //3. Inserting sample data to publisher table
   $conn->exec("INSERT INTO publisher(pname, city, country) VALUES('Penguin Random House','New York','USA')");
   $conn->exec("INSERT INTO publisher(pname, city, country) VALUES('Bloomsbury','London','UK')");
   $conn->exec("INSERT INTO publisher(pname, city, country) VALUES ('ACER Press','Camberwell','Australia')");
   $conn->exec("INSERT INTO publisher(pname, city, country) VALUES ('Ethicool Books','Ringwood North','Australia')");
   $conn->exec("INSERT INTO publisher(pname, city, country) VALUES ('Oxford University press','London','UK')");
   $conn->exec("INSERT INTO publisher(pname, city, country) VALUES ('Pearson Press','Manchester','UK')");
   $conn->exec("INSERT INTO publisher(pname, city, country) VALUES ('Harper Collins','London','UK')");

   //4.Inserting sample data to category table
   $conn->exec("INSERT INTO category(cname) VALUES('Fiction')");
   $conn->exec("INSERT INTO category(cname) VALUES('Non Fiction')");

   //5. Inserting sample data to genre table
   $conn->exec("INSERT INTO genre(gname, category_id) VALUES('Anthology',1)");
   $conn->exec("INSERT INTO genre(gname, category_id) VALUES('Biography',2)");
   $conn->exec("INSERT INTO genre(gname, category_id) VALUES('Diary',2)");
   $conn->exec("INSERT INTO genre(gname, category_id) VALUES('Guide',2)");
   $conn->exec("INSERT INTO genre(gname, category_id) VALUES('Encyclopedia',2)");
   $conn->exec("INSERT INTO genre(gname, category_id) VALUES('Classic',1)");
   $conn->exec("INSERT INTO genre(gname, category_id) VALUES('Fairytale',1)");
   $conn->exec("INSERT INTO genre(gname, category_id) VALUES('Fantasy',1)");
   $conn->exec("INSERT INTO genre(gname, category_id) VALUES('Drama',1)");
   $conn->exec("INSERT INTO genre(gname, category_id) VALUES('Journal',2)");
   $conn->exec("INSERT INTO genre(gname, category_id) VALUES('Horror',1)");

   //6. Inserting sample data to book table
   $conn->exec("INSERT INTO book(title, author_id,ISBN,publisher_id,category_id, genre_id,year, cover,price,condition)
                        VALUES('Atomic Habits',1,'Is192934-93483',1, 2, 4, 2018,'', 34.78,'New')");
   $conn->exec("INSERT INTO book(title, author_id,ISBN,publisher_id,category_id, genre_id,year, cover,price,condition)
                                              VALUES('Harry Potter',3,'178972-73283',1, 7, 4, 1997,'', 24.78,'New')");


   //7. Inserting sample data to cart table
   $conn->exec("INSERT INTO cart(user_id,book_id,quantity,dateOrdered) VALUES(2,1,1,DateTime('now'))");
   $conn->exec("INSERT INTO cart(user_id,book_id,quantity,dateOrdered) VALUES(6,2,3,DateTime('now'))");
   $conn->exec("INSERT INTO cart(user_id,book_id,quantity,dateOrdered) VALUES(5,1,1,DateTime('now'))");


   //8. Inserting sample data to comment table
   $conn->exec("INSERT INTO comment(comment,user_id,book_id,dateWritten)
                  VALUES('Atomic Habits is a great book',6,1,DateTime('now'))");
  $conn->exec("INSERT INTO comment(comment,user_id,book_id,dateWritten)
                  VALUES('Most amazing imagination book ever',5,2,DateTime('now'))");

   echo "1. Database creation: Success!\n";
   echo "2. Table(s) creation: Success, Eight tables created!\n";
   echo "3. Sample data insertion: Success!";
   $conn=null;

}catch(PDOException $e){
  echo "Error - sample data not intered - ".$e->getMessage();
  exit();
}

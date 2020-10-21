

<?php
  /*
      This script implements partial dashboard, this is only shown to loggedin users
  */
    require '../app/header.php';
    require '../app/dbh.php';
    require '../app/libcommon.php';
?>


    <div id="dashboard">

        <div id="dashside-left">
            <h2>BOOKSTORE</h2>
            <button class="dash-btn" id="user_btn" onclick="displayData(event, 'user')">Users</button>
            <button class="dash-btn" id="author_btn" onclick="displayData(event, 'author')">Authors</button>
            <button class="dash-btn" id="books_btn" onclick="displayData(event, 'book')">Books</button>
            <button class="dash-btn" id="category_btn" onclick="displayData(event, 'category')">Categores</button>
            <button class="dash-btn" id="publisher_btn" onclick="displayData(event, 'publisher')">Publishers</button>
            <button class="dash-btn" id="genre_btn" onclick="displayData(event, 'genre')">Genre</button>
            <button class="dash-btn" id="order_btn" onclick="displayData(event, 'order')">Orders</button>
            <button class="dash-btn" id="comment_btn" onclick="displayData(event, 'comment')">Comments</button>

        </div><!--END dashside-left-->

        <div id="dashside-right">


            <div id="middle" class="right-middle">
              <!-- <p>Automatic content to be placed here ... </p> -->
              <div class="users">
                  <h3>Users</h3>
                  <table class="db-table">
                    <tr>
                        <th> ID </th>
                        <th> First Name </th>
                        <th> Last Name </th>
                        <th> Email </th>
                        <th> Level </th>
                        <th> Action </th>
                    </tr>
                    <?php

                    $res = $conn->prepare('SELECT * FROM user');
                    $res->execute();
                    $data = $res->fetchAll(PDO::FETCH_ASSOC);


                   foreach($data as $row):?>
                        <tr>
                          <td><?php echo $row['user_id'];?></td>
                          <td><?php echo $row['firstname'];?></td>
                          <td><?php echo $row['lastname'];?></td>
                          <td><?php echo $row['email'];?></td>
                          <td><?php echo $row['level'];?></td>
                          <td>
                             <a class="edit" href="editUser.php?id=<?php echo $row['user_id'];?>">Edit</a>
                             <a class="delete" href="deleteUser.php?id=<?php echo $row['user_id'];?>">Delete</a>
                          </td>
                        </tr>

                      <?php endforeach; ?>
                    </table>

              </div>
              <div class="authors">
                <h3>Authors</h3>
                <table class="db-table">
                <tr>

                    <th>ID </th>
                    <th>First name </th>
                    <th>Last name </th>
                    <th>Email </th>
                    <th>Action</th>
                </tr>

                <?php

                $sql ='SELECT *FROM author';

                $res = $conn->prepare($sql);
                // $res = $conn->prepare('SELECT * FROM book');
                $res->execute();
                $data = $res->fetchAll(PDO::FETCH_ASSOC);
                // echo '<pre>';
                // print_r($data);
                foreach($data as $row):?>
                  <tr>
                    <td><?= $row['author_id'];?></td>
                    <td><?= $row['firstname'];?></td>
                    <td><?= $row['lastname'];?></td>
                    <td><?= $row['email'];?></td>
                    <td>
                       <a class="edit" href="../templates/editauthor.php?id=<?php echo $row['author_id'];?>">Edit</a>
                       <a class="delete" href="../app/deleteauthor.php?id=<?php echo $row['author_id'];?>">Delete</a>
                    </td>
                  </tr>

                <?php endforeach; ?>
                </table>

              </div>


              <div class="books">
                <h3>Books</h3>
                <table class="db-table">
                  <tr>
                      <th>Title </th>
                      <th>Author </th>
                      <th>Publisher </th>
                      <th>Category </th>
                      <th>Genre </th>
                      <th>Year</th>
                      <th>Action</th>
                  </tr>

                <?php
                // This query will display books, their publishers, categories, genre and price from different tables
                $sql ='SELECT book_id,title ,year, price, firstname, pname, cname, gname
                                FROM book b, author a, publisher p, category c, genre g
                                WHERE b.author_id = a.author_id AND
                                      b.publisher_id = p.publisher_id AND
                                      b.category_id = c.category_id AND
                                      b.genre_id = g.genre_id';

                $res = $conn->prepare($sql);
                // $res = $conn->prepare('SELECT * FROM book');
                $res->execute();
                while($row = $res->fetch(PDO::FETCH_ASSOC)){?>
                    <td><?=  $row['title'];?></td>
                    <td><?=  $row['firstname'];?></td>
                    <td><?=  $row['pname'];?></td>
                    <td><?=  $row['cname'];?></td>
                    <td><?=  $row['gname'];?></td>
                    <td><?= '$'.$row['year'];?></td>
                    <td>
                       <a class="edit" href="../templates/editbook.php?id=<?php echo $row['book_id'];?>">Edit</a>
                       <a class="delete" href="../app/deletebook.php?id=<?php echo $row['book_id'];?>">Delete</a>
                    </td>
                  </tr>
                <?php  }?>
                </table>
              </div>


              <div class="Categories">Categpries..</div>
              <div class="publishers">Publishers ..</div>
              <div class="orders">orders ..</div>
              <div class="genre">Genre ..</div>
              <div class="comments">Comments ..</div>
            </div> <!--END right-middle-->


            <div class="right-bottom">
              <div class="rt-books">
                  <h2>New Books </h2>
                  <h5>12 New Books</h5>
                  <p>24% Decrease </p>
              </div>

              <div class="rt-users">
                  <h2>New users </h2>
                  <h5>172 New Users</h5>
                  <p>24% Increase</p>
              </div>

              <div class="rt-authors">
                  <h2>New Authors </h2>
                  <h5>12 New Authors</h5>
                  <p>7% Decrease</p>
              </div>
              <div class="rt-publishers">
                  <h2>New New Publishers </h2>
                  <h5>0 New Books</h5>
                  <p> 0% Increase</p>
              </div>

              <div class="rt-orders">
                  <h2>New Orders </h2>
                  <h5>100 New Orders</h5>
                  <p>24% Increase</p>
              </div>

              <div class="rt-sales">
                <h2>Sales Summary </h2>
                <h5>101 New Orders</h5>
                <p>3% Increase</p>
              </div>

              <div class="rt-special">
                <h2>Sales Summary </h2>
                <h5>12 New Books</h5>
                <p>24% Increase</p>
              </div>
            </div> <!--END bottom-right-->
        </div><!--END dashside-right-->

    </div><!--END dashboard-->

<script src='../js/main.js'></script>

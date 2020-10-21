<?php

/*this scrip implements the shopping cart, where users can
add books to their shopping cart and remove as they want.
It doesn't have a checkout functionality for obvious reasons - lack of integration with payment system
*/

require '../app/dbh.php';

//adding an item to a shopping cart
if(isset($_POST['addtocart'])){
  if(isset($_SESSION['shopping_cart'])){
    //items exist in a shopping cart
    $item_array_id = array_column($_SESSION['shopping_cart'],"item_it");
    if(!in_array($_GET['id'],$item_array_id)){
      //if the book isn't already in the cart/array
      $count = count($_SESSION['shopping_cart']);
      $item_array = array(
        'bid'       =>   $_GET['id'],
        'bname'     =>   $_POST['hname'],
        'bprice'    =>   $_POST['hprice'],
        'bquantity' =>   $_POST['quantity']
      );
        //
        $_SESSION['shopping_cart'][$count] = $item_array;
    }else{
      echo '<script>alert("Item is already added")</script>';
      header('location:../templates/index.php');
    }

  }else{
    //This means that there is no book in the shopping cart
    //add books to the array, to be added to the session
    $item_array = array(
      'bid'       =>   $_GET['id'],
      'bname'     =>   $_POST['hname'],
      'bprice'    =>   $_POST['hprice'],
      'bquantity' =>   $_POST['quantity']
    );
    $_SESSION['shopping_cart'][0] = $item_array;

  }
}


//Remove an books from a shopping cart
if(isset($_GET['action'])){
  if($_GET['action']=='delete'){
    foreach ($_SESSION['shopping_cart'] as $key => $value) {
      if($value['bid'] == $_GET['id']){
        unset($_SESSION['shopping_cart'][$key]);
        echo '<script>alert("Selected book is removed")</script>';
        }
    }
  }
}

 ?>


	<?php
  //this statement queries multiple tables for information which is going to be displayed in the frontend
  $sql ='SELECT book_id,title ,year, price, firstname, pname, cname, gname,cover
                  FROM book b, author a, publisher p, category c, genre g
                  WHERE b.author_id = a.author_id AND
                        b.publisher_id = p.publisher_id AND
                        b.category_id = c.category_id AND
                        b.genre_id = g.genre_id';


  $res = $conn->prepare($sql);
  $res->execute(); ?>

  <div class="book-container">
  <?php
  //This block is responsible for displaying books in a grid format
  while($row = $res->fetch(PDO::FETCH_ASSOC)){?>
    <div class="book-item">
        <form method="post" action="../templates/index.php?action=add&id=<?php echo $row['book_id']; ?>">
              <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['cover'] ).'" alt="cover" class="responsive"/>';?>
              <p><?= $row['title'];?></p>
              <p>By<?= '' .$row['firstname'];?></p>
              <p>Publisher:<?=  $row['pname'];?></p>
              <p>Year: <?=  $row['year'];?></p>
              <p>Price: <?= '$'.$row['price'];?></p>
              <input type="text" name="quantity" value="1" style="width:70px;">
              <input type="hidden" name="hname" value=" <?php echo $row['title']; ?>">
              <input type="hidden" name="hprice" value=" <?php echo $row['price']; ?>">
              <input type="submit" name="addtocart" style="margin:5px 0px;padding:5px; background:#2a9d8f; border:none; color:white;" value="Add to Cart">
      </form>

  </div>
  <?php } ;?>
  </div>


<?php
//if shopping cart is not empty tell/show order details
if(!empty($_SESSION['shopping_cart'])){
  echo '   <h2 class="cart-info">Your order details</h2>';
} else{
  //tell customer no items are added to the cart yet
  echo '   <h2 class="cart-info">Your cart is empty</h2>';
}?>

    <?php
    //show items in a table format if cart is not empty
      if(!empty($_SESSION['shopping_cart'])){
        echo '<table class="db-table">
               <tr>
                   <th>Book Title</th>
                   <th>Quantity </th>
                   <th>Price </th>
                   <th>Total </th>
                   <th>Action</th>
              </tr> ';

        $total =0;
        foreach ($_SESSION['shopping_cart'] as $key => $value) {
        ?>
        <tr>
          <td><?php echo $value['bname'];?> </td>
          <td><?php echo $value['bquantity'];?> </td>
          <td><?php echo $value['bprice'];?> </td>
          <td><?php echo number_format($value['bquantity'] * $value['bprice'], 2);?> </td>
          <td> <a href="../templates/index.php?action=delete&id=<?php echo $value['bid']; ?>">Remove</a></td>

        </tr>
        <?php
        $total = $total + ($value['bquantity']*$value['bprice']);
      } ?>
      <tr>
        <td></td><td></td>
        <td> <span style="float:right;">Total</span> </td>
        <td> $<?php echo number_format($total, 2); ?> </td>
      </tr>

      <?php
      }

     ?>

  </table>

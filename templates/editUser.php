
<?php  require '../app/header.php';
    require '../app/dbh.php';
  // require '../templates/libcommon.php';
    $id= $_GET['id'];

   //To push data to the textfields from
    $sql = 'SELECT *FROM user WHERE user_id=:id';
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id'=>$id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<main>
        <h1>Update details</h1>

        <!-- <form name="my-form" action="../templates/editUser.inc.php" method="post"> -->
        <form name="my-form" action ="../app/editUser.inc.php" method="post">
            <div class="form-box">
                <label for="fname">First name</label>
                <input type="text" id="firstname" name="firstname" value="<?php echo $result['firstname'] ;?>" >
            </div>

            <div class="form-box">
                <label for="lname">Last name</label>
                <input type="text" id="lastname" name="lastname" value="<?php echo $result['lastname'] ;?>">
            </div>

            <div class="form-box">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $result['email'] ;?>">
            </div>
            <div class="form-box">
                <button type="submit" id="btnSend" name="idupdate" value="<?php echo $id;?>">Update</button>
            </div>


        </form>
    </main>



<?php require '../app/footer.php';?>

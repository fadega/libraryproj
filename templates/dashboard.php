<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DBoard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <script
      src="https://code.jquery.com/jquery-3.5.1.min.js"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
      crossorigin="anonymous"></script>
  </head>
  <body>
    <div id="dashboard">

        <div id="dashside-left">
            <h2>BOOKSTORE</h2>
            <a href="#">Users</a>
            <a href="#">Authors</a>
            <a href="#">Book</a>
            <a href="#">Categories</a>
            <a href="#">Publishers</a>
            <a href="#">Genres</a>
            <a href="#">Orders</a>
            <a href="#">Comments</a>
        </div><!--END dashside-left-->

        <div id="dashside-right">
            <div class="right-top">
              <input type="text" class="searchBox" name="searchBox"  placeholder="Search ....">
              <a href="#">Search</a>
              <a href="#">Fadega</a>
              <a href="#">Logout</a>
            </div> <!--END top-right-->

            <div id="middle" class="right-middle">
              <p>Automatic content to be placed here ... </p>
              <div class="users"></div>
              <div class="authors"></div>
              <div class="books"></div>
              <div class="Categories"></div>
              <div class="users"></div>
              <div class="users"></div>
              <div class="users"></div>
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




</html>

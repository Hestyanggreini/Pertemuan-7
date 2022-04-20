<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/0d95b64c38.js" crossorigin="anonymous"></script>
    <title>Hesty's Favorite Film</title>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
      body {
        font-family: 'Poppins', sans-serif;
        background-image: url('img/bg.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        color: white;
      }
      .card {
         border-radius: 15px;
         width: 16rem; 
         background-color: black;
         color: white;
         margin-top: 20px;
         margin-bottom: 20px;
         box-shadow: 6px 6px 15px -15px #FFFFFF;
      }
      .card img{
        width:  255px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
      }

      aside {
        float: left;
        width: 20%;
        margin-left: 70px;
      }
      
      .container {
        float: right;
        width: 70%;
        margin-right: 70px;
      }


    </style>
  </head>
  <body>
    <center>
      <br><br><h1><strong>Hesty's Favorite Film</strong></h1><br><br>
    </center>

    
    <div class="d-grid gap-2 d-md-flex justify-content-md-end me-lg-5 pe-lg-3">
      <button class="btn btn-primary" type="button"><i class="fas fa-plus"></i> Create Movie</button>
    </div>

    <!-- Side Controll -->
    <aside>
      <!-- Sorting Card -->
      <div class="card">
        <div class="card-header">
          <i class="fas fa-sort-alpha-down text-white"></i> Sorting
        </div>
        <div class="card-body">
          <p class="card-text">Sort by Movie Title</p>
          <select class="form-select" id="sort" aria-label="Default select example">
            <option value="ASC">Ascending</option>
            <option value="DESC">Descending</option>
          </select>
        </div>
      </div>
      <!-- Filter Card -->
      <div class="card">
        <div class="card-header">
          <i class="fas fa-filter"></i> Filters
        </div>
        <div class="card-body">
          <p class="card-text">Filter by Movie Rating</p>
          <select class="form-select mb-3" id="filter" aria-label="Default select example">
            <option class="text-muted" selected>Movie rating</option>
            <?php
              require_once 'db.php';
              $query = mysqli_query($conn, "SELECT DISTINCT rating FROM film");
              while ($row = mysqli_fetch_object($query)) :
            ?>
              <option value="<?= $row->rating; ?>"><?= $row->rating; ?></option>
            <?php endwhile; ?>
          </select>
          <p class="card-text">Search by Movie Title</p>
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="search" placeholder="Search title..." aria-label="Recipient's username" aria-describedby="button-addon2">
              <button class="btn btn-dark" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
            </div>
        </div>
      </div>
    </aside>

    <!-- Content -->
    <div class="container">
      <div class="row" id="content">
        <?php
          require_once 'db.php';
          $query = mysqli_query($conn, "SELECT * FROM film");
          while ($row = mysqli_fetch_object($query)) :
        ?>
        <!-- Card -->
        <div class="col-3">
          <div class="card">
              <a href="http://">
                <img src="img\6254cef77b45c.png" class="card-img-top" alt="">
              </a>
              <div class="card-body">
                <h4 class="card-title"><?= $row->title; ?> (<?= $row->release_year; ?>)</h4>
                <div class="row">
                  <div class="col-8">
                    <p class="card-text">Rating : <?= $row->rating; ?></p>
                  </div>
                  <div class="col-2"><a href="">
                    <i class="fas fa-edit text-warning"></i>
                    </a>
                  </div>
                  <div class="col-2"><a href="">
                    <i class="fas fa-trash-alt text-danger"></i>    
                    </a>
                  </div>
                </div> 
              </div>
            </div>
        </div>
        <?php endwhile; ?>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    
    <script type="text/javascript">
      $(document).ready(function() {
        $('#search').on('keyup', function() {
          $.ajax({
            type: 'POST',
            url: 'search.php',
            data: {
              search: $(this).val()
            },
            cache: false,
            success: function(data) {
              $('#content').html(data);
            }
          });
        });

        $('#filter').on('change', function() {
          $.ajax({
            type: 'POST',
            url: 'filter.php',
            data: {
              filter: $(this).val()
            },
            cache: false,
            success: function(data) {
              $('#content').html(data);
            }
          });
        });

        $('#sort').on('change', function() {
          $.ajax({
            type: 'POST',
            url: 'sort.php',
            data: {
              sort: $(this).val()
            },
            cache: false,
            success: function(data) {
              $('#content').html(data);
            }
          });
        });
      });
    </script>
  </body>
</html>
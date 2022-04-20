<?php
    if (isset($_POST['filter'])):
        require_once 'db.php';
        $filter = $_POST['filter'];

        $query = mysqli_query($conn, "SELECT * FROM film WHERE rating ='" . $filter . "'");
        while ($row = mysqli_fetch_object($query)):
?>
        <!-- Card -->
        <div class="col-3">
          <div class="card">
            <img src="img\6254cef77b45c.png" class="card-img-top" alt="...">
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
<?php
        endwhile;
    endif;
?>
<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body>
  <?php
    $q = $_GET['q'];
    $connect=mysqli_connect( "localhost",  "team04", "team04");
    mysqli_select_db($connect, "team04");
    $query= "select * from museum where name='".$q."'";
    $result=mysqli_query($connect, $query);
    $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
  ?>

  <h1 class="display-4"><?php echo $row['name']?></h1>
  <p class="lead" style="font-size: 1.5rem; margin-left: 5px;">
    <?php  echo $row['city'];?>
  </p>
  <div id="img">
    <img
      src="<?php echo $row['img']?>"
      style="width: 500px;">
  </div>
  <div id="Description" style="width: 80%; padding-top: 30px; padding-bottom: 30px">
    <p class="lead m-1" style="font-size:1.1rem;">
      <?php echo $row['info'];
      mysqli_free_result($result); ?>
    </p>
  </div>

  <hr style="border:3px solid #f1f1f1">

  <div id="TotalScore" class="m-3">
    <h1 class="display-4" style="font-size: 2.5rem; float:left;">Review</h1>
      <div class="wrap-star" style="margin-left: 10px; padding-top: 3px; padding-left: 140px;">
        <span class="star-rating">
        <?php 
            $query = "select museum, count(*), avg(score) from review where museum='".$q."'";
            $result = mysqli_query($connect, $query);
            $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
            $avg = round($row['avg(score)'], 1);
            $percent = $avg*20;
            echo '<span style="width:'.$percent.'%;"></span>'; 
        ?>
        </span>
      </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-6 col-12 comments-main pt-3 rounded">
        <?php 
          echo '<p class="lead">'.$avg.' average based on '.$row['count(*)'].' reviews.</p>';

          $query= "select * from review where museum='".$q."'";
          $result=mysqli_query($connect, $query);
            
          while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
            <ul class="p-0">
              <li>
                <div class="row comments mb-2">
                  <div class="col-md-2 col-sm-2 col-3 text-center user-img">
                    <img id="profile-photo" src="http://nicesnippets.com/demo/man03.png" class="rounded-circle" />
                  </div>
                  <div class="col-10 comment rounded mb-2">


                  <?php 
                   $i = 0;
                  while( $i < $row['score']){?>
                  <span class="fa fa-star checked"></span>
                  <?php
                  $i = $i + 1;
                   }?>

                    <p class="mb-0 text-white" style="font-size: 15px;"><?php echo $row['comment']; ?></p>
                  </div>
                </div>
              </li>
            </ul> 
            
        <?php
          }

          mysqli_free_result($result);
          mysqli_close($connect); 
        ?>
          
      </div>
    </div>
	</div>

</body>
</html>
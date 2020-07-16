<html>
<head>
  <link rel="stylesheet" href="css/style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="artist.js"></script>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/bootstrap.min.css"
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
        
        .btn-secondary {
      color: #fff;
      background-color: rgb(45, 24, 41);
      border-color:rgb(45, 24, 41);
    }
        </style>
</head>
<body>
<?php
        $c = $_GET['c'];
        $q = $_GET['q'];
        $p = $_GET['p'];

        $connect=mysqli_connect( "localhost",  "team04", "team04");
        mysqli_select_db($connect, "team04");
        $query= "select * from Artist where name='".$q."'";
        $result=mysqli_query($connect, $query);
        $query2 = "select * from ArtWork as A where artist='".$q."'AND A.museum in (select name From museum as M where M.country = '".$c."')"
        ;

        $group_by_popularity_query = "select popularity, count(*) from ArtWork as A where artist='".$q."' AND A.museum in (select name From museum as M where M.country = '".$c."') group by popularity;";
        $result2 = mysqli_query($connect, $query2);
        $result3 = mysqli_query($connect, $group_by_popularity_query);
        if($result){
            $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
        else{
            printf("Could not retrieve records: %s\n", mysqli_error($connect));
        }
?>  


<h1 id="ArtistName" class="display-4 mt-4 ml-5"><?php echo $row['name'];?></h1>
<div class="container ml-5 mr-5 mt-3" style="display: flex; align-items: center;">
<div>
        <img src="<?php echo $row['img'];?>" style="height:500px; margin-right:30px; float:left;">
        <table class="table" style="width: 300px; font-weight: normal;">
                <thead>
                    <tr>
                        <th>Style</th>
                        <th style="font-weight: normal;"><?php echo $row['style'];?></th>
                    </tr>
                    <tr>
                        <th>Birth</th>
                        <th style="font-weight: normal;"><?php echo $row['birth'];?></th>
                    </tr>
                    <tr>
                        <th>Death</th>
                        <th style="font-weight: normal;"><?php echo $row['death'];?></th>
                    </tr>
                </thead>
                <tbody>
                    </table>
                    <p class="lead">       
                    <?php echo $row['info'];?></p></div>

</div>



<?php 
  $i =1;
  while($i <= 3){
  $newArray1 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
  
  $count = $newArray1['count(*)'];
  if($count)
  $rating[$i] = $newArray1['count(*)'];
  else $rating[$i]=0;
  $i = $i +1;
}
?>
<div class="container ml-5 " >
<form action="sendMylist.php" method="GET" >
<section class="gallery-block cards-gallery">
           <div class="container ml-0">
               <div class="heading">

               <div style="display: -webkit-flex; display: flex; ">
                <h1 class="display-4 mt-5 mb-3" style="font-size: 2.5rem;">Artworks</h1>                  
                <div style="padding-left: 53%; margin-right:0px;">
    <table class="table" style="text-align:right; width: 300px; margin-right: 0px;">
    <thead>
        <tr>
            <th><span class="fa fa-star checked"></span></th>
            <th style="font-weight: normal;"><?php echo $rating[1];?></th>
        </tr>
        <tr>
        <th><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span></th>
            <th style="font-weight: normal;"><?php echo $rating[2];?></th>
        </tr>
        <tr>
        <th><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span></th>
            <th style="font-weight: normal;"><?php echo $rating[3];?></th>
        </tr>
    </thead>
    <tbody>
</table></div>  
                </div>
               </div>
               <div class="row">
<?php
while($newArray = mysqli_fetch_array($result2, MYSQLI_ASSOC)){

$id = $newArray['id'];
$title = $newArray['title'];
$artist = $newArray['artist'];
$museum = $newArray['museum'];
$popularity = $newArray['popularity'];
$img = $newArray['img'];


if($popularity == $p ||$p==0){
?>

<div class="col-md-6 col-lg-4">
        <div class="card border-0 transform-on-hover">  
            
                <label class="image-checkbox" style="position: relative;">
                
                        <img  src="<?php echo $img;?>" alt="Card Image" class="card-img-top" style="width:300px; height: 250px; object-fit: cover;">
                        <div class="custom-control custom-checkbox ml-1" style="position:absolute; left:0; top:0;">
                                <input type="checkbox" class="custom-control-input" name="image[]" value="<?php echo $museum;?>" />
                                <label class="custom-control-label"></label>
                        </div>        
                        </label>
                           <div class="card-body p-0 pb-5">
                                <h6 class="lead"><?php echo $title;?></h6>
                                <?php 
                   $i = 0;
                  while( $i < $popularity){?>
                  <span class="fa fa-star checked"></span>
                  <?php
                  $i = $i + 1;
                   }?>
                                </div>
                        </div>
                </div>   
<?php 
}
}
?>
        </div>
</div>
</section>
<div class="text-center"><input type="submit" name="submit" class="btn btn-secondary mt-4 mb-4 px-5 py-2"  value="Add"></div>

</form>
</div>



<script>
// image gallery
// init the state from the input
$(".image-checkbox").each(function () {
    if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
      $(this).addClass('image-checkbox-checked');
    }
    else {
      $(this).removeClass('image-checkbox-checked');
    }
  });
  
  // sync the state to the input
  $(".image-checkbox").on("click", function (e) {
    $(this).toggleClass('image-checkbox-checked');
    var $checkbox = $(this).find('input[type="checkbox"]');
    $checkbox.prop("checked",!$checkbox.prop("checked"))
  
    e.preventDefault();
  });
</script>

<?php
mysqli_free_result($result);
mysqli_free_result($result2);
mysqli_free_result($result3);
mysqli_close($connect); 
?>

</body>
</html>
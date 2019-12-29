<?php
    require_once 'connect.php';
    
    function displayFilm($category){
    global $connect;
    $sql = "select*from film";
    $rs = $connect -> query($sql);
    while($film = $rs->fetch_assoc()){
        if($category == $film['category'])
        {
        echo '<div class="product-slide">';
        echo '<img src="image/'.$film['image_film'].'" alt="First slide">';
        echo '<p>'.$film['name_film'].'</p>';
        echo '<div class="middle">';
        echo '<div class="text"><a href="details.php?id='.$film['id'].'">Details</a></div>';
        echo '<div class="text1"><a href="order.html"><i class="fas fa-band-aid"></i>Ticket</a></div>';
        echo '</div></div>';
        }
    }
}   
  function detailFilm(){
    global $connect;
    $sql = "select*from film where id =".$_GET['id'];
    $rs = $connect -> query($sql);
    while($film = $rs->fetch_assoc()){
        echo '<iframe class="video" width="560" height="315" src="'.$film['video_film'].'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            echo '<div class="video-title">';
            echo '<h1>'.$film['name_film'].'</h1>';
            echo '<small>PG-132 hr 21 minDecember 20, 2019</small>';
            echo '<div class="detail-video">';
            echo '<p> <b>'.$film['status_film'].'</b></p>';
            echo '<p><b>Directed By:</b> J.J. Abrams</p>';
            echo '<p><b>Age Range Allowed:</b>'.$film['age_film'].'</p>';
            echo '<p><b>Running Time:</b>'.$film['time_film'].'</p><p>';
            echo '<b>Genre:</b> Fantasy & Adventure & Sci-Fi & Action</p>';
            echo '<p><b>Gross Box Office:</b> $177,383,864</p>';
            echo '<p> <b> Release Date:</b> December 20, 2019</p></div> </div>';
    }
   
    }
   function displayTable(){
    global $connect;
    $sql = "select*from film";
    $rs = $connect -> query($sql);
    $i=0;
    while($film = $rs->fetch_assoc()){
            echo'<tr><th scope="row">'.++$i.'</th>';
            echo'<td>'.$film['name_film'].'</td>';
            echo'<td><img src="image/'.$film['image_film'].'" alt="" height="80px" width="80px"></td>';
            echo'<td> '.$film['video_film'].'</td>';
            // echo'<td class="text-crop">'.$film['time_film'].'</td>';
            echo'<td>'.$film['time_film'].'</td>';
            echo'<td>'.number_format($film['price_film']).'<ins>đ</ins></td>';
            echo'<td>'.$film['age_film'].'</td>';
            echo'<td>'.$film['category'].'</td>';
            echo'<td> <a href="addFilm.php?id='.$film['id'].'"><i class="fas fa-edit"></i></a></td>';
            echo'<td> <form method="post"><input type="text" name="delete" value="'.$film['id'].'" hidden><button><i class="fas fa-trash-alt"></i></button></form></td></tr>';
    }
   }
   function addFilm(){
    global $connect;
    $name = $_POST['name'];
    $image = $_POST['image'];
    $video = $_POST['video'];
    $summary = $_POST['summary'];
    $time = $_POST['time'];
    $price = $_POST['price'];
    $age = $_POST['age'];
    
     $sql = "INSERT INTO film(name_film,image_film,video_film,status_film,time_film,price_film,age_film,category) 
           VALUE ('$name','$image','$video','$summary','$time',$price,'$age','nowplay')";
    
    $connect->query($sql);
    echo "<script>alert('Added film ".$name." success')</script>";
   }
   function deleteFilm($index){
    global $connect;
    $sql = "DELETE FROM film WHERE id =".$index;
    $connect->query($sql); 
   }
   function updateFilm($id){
       global $connect;
    // $id = $_POST['id'];
    $name = $_POST['name'];
    $image = $_POST['image'];
    $video = $_POST['video'];
    $summary = $_POST['summary'];
    $time = $_POST['time'];
    $price = $_POST['price'];
    $age = $_POST['age'];
    $sql = "UPDATE film SET name_film = '$name',image_film ='$image', video_film = '$video',
            status_film = '$summary', time_film= '$time',price_film = $price,age_film = '$age' WHERE id = $id";
            // echo $sql;
    $connect->query($sql);
    
    header("Location: admin.php");
    // echo "<script>alert('Update film ".$name." success')</script>";
   }
?>
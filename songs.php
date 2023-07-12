<?php
    include 'inc/config.php';
    session_start();

    if (!isset($_SESSION['admin_id'])) {
    echo '<meta http-equiv="refresh" content="0; url= login.php">';
    }

    if(isset($_POST['submit'])){

        $musiq_id = $_POST['musiq_id'];

        $update_active = "UPDATE musiq SET active_yn = '1' WHERE musiq_id = '$musiq_id'";
        mysqli_query($conn, $update_active);
        echo mysqli_error($conn);
    }
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sweet Sound Musiq - Musiq | Sweet Sound Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
        ============================================ -->
    <link rel="shortcut icon" type="image/png" href="img/favicon.png">
    <!-- Google Fonts
        ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- font awesome CSS
        ============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- owl.carousel CSS
        ============================================ -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <!-- meanmenu CSS
        ============================================ -->
    <link rel="stylesheet" href="css/meanmenu/meanmenu.min.css">
    <!-- animate CSS
        ============================================ -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- normalize CSS
        ============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- wave CSS
        ============================================ -->
    <link rel="stylesheet" href="css/wave/waves.min.css">
    <link rel="stylesheet" href="css/wave/button.css">
    <!-- mCustomScrollbar CSS
        ============================================ -->
    <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- Notika icon CSS
        ============================================ -->
    <link rel="stylesheet" href="css/notika-custom-icon.css">
    <!-- Data Table JS
        ============================================ -->
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <!-- main CSS
        ============================================ -->
    <link rel="stylesheet" href="css/main.css">
    <!-- style CSS
        ============================================ -->
    <link rel="stylesheet" href="style.css">
    <!-- responsive CSS
        ============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS
        ============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
    <!-- Start Header Top Area -->
<?php
    include 'inc/header.php';
?>
    <!-- End Header Top Area -->

    <!-- Data Table area Start-->
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <h2>All Released Singles</h2>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Cover Art</th>
                                        <th>Artist</th>
                                        <th>Title & Link</th>
                                        <th>Genre</th>
                                        <th>Release Date</th>
                                        <th>Stats</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $sel_musiq = "SELECT * FROM musiq, artist WHERE musiq.artist_id = artist.artist_id AND musiq.musiq_type = 'Single' ORDER BY musiq_id DESC";
                                    $query_musiq = mysqli_query($conn, $sel_musiq);

                                    while($row = mysqli_fetch_array($query_musiq)){
                                ?>
                                        <tr>
                                            <td>
                                                <img src="../musiq/images/musiq_images/<?php echo $row['musiq_coverart'] ?>" alt="" width ="120px">
                                            </td>
                                            <td><a href="edit-artist.php?id=<?php echo $row['artist_id'] ?>"> <?php echo $row['artist_name'] ?></a></td>
                                            <td width="15px">
                                                <?php echo $row['musiq_title']?><br><br>
                                                <a href="../musiq/<?php echo $row['artist_name_slug'].'/'.$row['musiq_title_slug'] ?>" target="_Blank">https://www.sweetsound.co.za/musiq/<?php echo $row['artist_name_slug'].'/'.$row['musiq_title_slug'] ?></a>
                                                
                                            </td>
                                            <td><?php echo $row['musiq_genre'] ?></td>
                                            <td><?php echo $row['musiq_release_date'] ?>  </td>
                                            <td>
                                                <?php echo $row['musiq_page_views'] ?> Views<br>
                                                <?php echo $row['musiq_downloads'] ?> Downloads<br>
                                                <?php echo $row['musiq_plays'] ?> Plays<br>
                                                <?php echo $row['musiq_likes'] ?> Likes
                                            </td>
                                            <td>
                                                <a href="add-musiq-links.php?id=<?php echo $row['musiq_id']?>&id2=<?php echo $row['artist_name']?>" class="btn btn-warning notika-btn-warning"> Add Links</a><br><br>
                                            <?php
                                                if($row['active_yn']){
                                            ?>
                                                    <button class="btn btn-success notika-btn-success" disable>Active</button>
                                            <?php
                                                }else{
                                            ?>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="musiq_id" value="<?php echo $row['musiq_id'] ?>">
                                                        <button type="submit" name="submit" class="btn btn-danger notika-btn-danger" >Inactive</button>
                                                    </form>
                                            <?php
                                                }
                                            ?>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Cover Art</th>
                                        <th>Artists</th>
                                        <th>Title</th>
                                        <th>Genre</th>
                                        <th>Release Date</th>
                                        <th>Link</th>
                                        <th>Views</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Data Table area End-->
    <!-- Start Footer area-->
    <div class="footer-copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-copy-right">
                        <p>Copyright © 2021 | <a href="#">Sweet Sound Tech</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer area-->
    <!-- jquery
        ============================================ -->
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
        ============================================ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- wow JS
        ============================================ -->
    <script src="js/wow.min.js"></script>
    <!-- price-slider JS
        ============================================ -->
    <script src="js/jquery-price-slider.js"></script>
    <!-- owl.carousel JS
        ============================================ -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- scrollUp JS
        ============================================ -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- meanmenu JS
        ============================================ -->
    <script src="js/meanmenu/jquery.meanmenu.js"></script>
    <!-- counterup JS
        ============================================ -->
    <script src="js/counterup/jquery.counterup.min.js"></script>
    <script src="js/counterup/waypoints.min.js"></script>
    <script src="js/counterup/counterup-active.js"></script>
    <!-- mCustomScrollbar JS
        ============================================ -->
    <script src="js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- sparkline JS
        ============================================ -->
    <script src="js/sparkline/jquery.sparkline.min.js"></script>
    <script src="js/sparkline/sparkline-active.js"></script>
    <!-- flot JS
        ============================================ -->
    <script src="js/flot/jquery.flot.js"></script>
    <script src="js/flot/jquery.flot.resize.js"></script>
    <script src="js/flot/flot-active.js"></script>
    <!-- knob JS
        ============================================ -->
    <script src="js/knob/jquery.knob.js"></script>
    <script src="js/knob/jquery.appear.js"></script>
    <script src="js/knob/knob-active.js"></script>
    <!--  Chat JS
        ============================================ -->
    <script src="js/chat/jquery.chat.js"></script>
    <!--  todo JS
        ============================================ -->
    <script src="js/todo/jquery.todo.js"></script>
    <!--  wave JS
        ============================================ -->
    <script src="js/wave/waves.min.js"></script>
    <script src="js/wave/wave-active.js"></script>
    <!-- plugins JS
        ============================================ -->
    <script src="js/plugins.js"></script>
    <!-- Data Table JS
        ============================================ -->
    <script src="js/data-table/jquery.dataTables.min.js"></script>
    <script src="js/data-table/data-table-act.js"></script>
    <!-- main JS
        ============================================ -->
    <script src="js/main.js"></script>
    <!-- tawk chat JS
        ============================================ -->
    <script src="js/tawk-chat.js"></script>
</body>
</html>

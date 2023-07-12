<?php
    include 'inc/config.php';

    if (!isset($_SESSION['admin_id'])) {
        echo '<meta http-equiv="refresh" content="0; url= login.php">';
    }

    if (isset($_POST['submit'])) {

        $artist_name = mysqli_real_escape_string($conn,$_POST['artist_name']);

        $query_artist = "SELECT artist_name FROM artist WHERE artist_name = '$artist_name'";
        $result = mysqli_query($conn, $query_artist);
      
        if($row = mysqli_fetch_assoc($result)){

            echo ' Artist Already Exists';
        }else{
            if ($artist_name == 'Sweet Sound Musiq'){
                $artist_name_slug = "SSM";
            }elseif($artist_name == 'Young Stars Fam'){
                $artist_name_slug = "YSF"; 
            }else{ 
                $artist_name_slug =  preg_replace("/[\s-]+/", "", $artist_name);
            }
    
            $sml_whatsapp = mysqli_real_escape_string($conn,$_POST['sml_whatsapp']);
            $sml_facebook = mysqli_real_escape_string($conn,$_POST['sml_facebook']);
            $sml_twitter = mysqli_real_escape_string($conn,$_POST['sml_twitter']);
            $sml_instagram = mysqli_real_escape_string($conn,$_POST['sml_instagram']);
            $sml_tiktok = mysqli_real_escape_string($conn,$_POST['sml_tiktok']);
            $sml_youtube = mysqli_real_escape_string($conn,$_POST['sml_youtube']);
    
            $extension = explode(".", $_FILES['artist_image']['name']);
            $artist_image =  strtolower($artist_name_slug).'.'.end($extension);
            move_uploaded_file($_FILES['artist_image']['tmp_name'],'https://files.sweetsound.co.za/images/artist_images/'.$artist_image);
    
            $ins_artist = "INSERT INTO artist (artist_name, artist_name_slug, artist_image, artist_page_views)
                    VALUES ('$artist_name', '$artist_name_slug', '$artist_image', 0)";
            mysqli_query($conn, $ins_artist);
    
            $artist_id = mysqli_insert_id($conn);
    
            $ins_sml = "INSERT INTO social_media_link (artist_id, sml_whatsapp, sml_facebook, sml_twitter,sml_instagram, sml_tiktok, sml_youtube)
                        VALUES ('$artist_id', '$sml_whatsapp', '$sml_facebook', '$sml_twitter', '$sml_instagram', '$sml_tiktok', '$sml_youtube')";
            mysqli_query($conn, $ins_sml);
            echo mysqli_error($conn);
    
            echo '<meta http-equiv="refresh" content="0; url= add-artist.php">';
        }
    }
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sweet Sound Musiq - Add Artists | Sweet Sound Dashboard</title>
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
    <!-- mCustomScrollbar CSS
        ============================================ -->
    <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- jvectormap CSS
        ============================================ -->
    <link rel="stylesheet" href="css/jvectormap/jquery-jvectormap-2.0.3.css">
    <!-- notika icon CSS
        ============================================ -->
    <link rel="stylesheet" href="css/notika-custom-icon.css">
    <!-- main CSS
        ============================================ -->
    <link rel="stylesheet" href="css/main.css">
    <!-- wave CSS
        ============================================ -->
    <link rel="stylesheet" href="css/wave/waves.min.css">
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
    <!-- Form Element area Start-->
    <div class="form-element-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-element-list mg-t-30">
                            <div class="cmp-tb-hd">
                                <h2>Artist Profile</h2>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="nk-int-mk">
                                        <h2>Artist Name</h2>
                                    </div>
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="artist_name" class="form-control" data-mask="999-99-999-9999-9" placeholder="e.g Aureiiy Beeze">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="nk-int-mk">
                                        <h2>Artist Profile Picture</h2>
                                    </div>
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="fa fa-file"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="file" name="artist_image" class="form-control" data-mask="999.999.999.9999">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="nk-int-mk">
                                        <h2>Whatsapp Number</h2>
                                    </div>
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="fa fa-whatsapp"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="sml_whatsapp" class="form-control" data-mask="999-99-999-9999-9" placeholder="e.g +27639507534" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="nk-int-mk">
                                        <h2>Facebook Link</h2>
                                    </div>
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="fa fa-facebook"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="sml_facebook" class="form-control" data-mask="999.999.999.9999" placeholder="e.g https://facebook.com/SweetSoundFamily" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="nk-int-mk">
                                        <h2>Twitter Link</h2>
                                    </div>
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="fa fa-twitter"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="sml_twitter" class="form-control" data-mask="999.999.999.9999" placeholder="e.g https://twitter.com/sweetsoundfam" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="nk-int-mk">
                                        <h2>Instagram Link</h2>
                                    </div>
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="fa fa-instagram"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="sml_instagram" class="form-control" data-mask="999.999.999.9999" placeholder="e.g https://instagram.com/sweetsoundfam" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="nk-int-mk">
                                        <h2>Youtube Link</h2>
                                    </div>
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="fa fa-youtube"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="sml_youtube" class="form-control" data-mask="999.999.999.9999" placeholder="e.g https://www.youtube.com/channel/UCs9qpngdF5FwO26i27NwGOQ" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="nk-int-mk">
                                        <h2>Tik Tok Link</h2>
                                    </div>
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="fa fa-tiktok"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="sml_tiktok" class="form-control" data-mask="999.999.999.9999" placeholder="e.g https://www.tiktok.com/@philanderntsako" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><br><br>
                                    <div class="form-group ic-cmp-int form-elet-mg">
                                        <div class="form-ic-cmp">
                                        </div>
                                        <div class="nk-int-st text-center">
                                            <button type="submit" name="submit" class="btn btn-success notika-btn-success" style="font-size: 30px;">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Form Element area End-->
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
    <!-- jvectormap JS
		============================================ -->
    <script src="js/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="js/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="js/jvectormap/jvectormap-active.js"></script>
    <!-- sparkline JS
		============================================ -->
    <script src="js/sparkline/jquery.sparkline.min.js"></script>
    <script src="js/sparkline/sparkline-active.js"></script>
    <!-- flot JS
		============================================ -->
    <script src="js/flot/jquery.flot.js"></script>
    <script src="js/flot/jquery.flot.resize.js"></script>
    <script src="js/flot/jquery.flot.pie.js"></script>
    <script src="js/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/flot/jquery.flot.orderBars.js"></script>
    <script src="js/flot/curvedLines.js"></script>
    <script src="js/flot/flot-active.js"></script>
    <!-- knob JS
		============================================ -->
    <script src="js/knob/jquery.knob.js"></script>
    <script src="js/knob/jquery.appear.js"></script>
    <script src="js/knob/knob-active.js"></script>
    <!--  wave JS
		============================================ -->
    <script src="js/wave/waves.min.js"></script>
    <script src="js/wave/wave-active.js"></script>
    <!--  Chat JS
		============================================ -->
	<script src="js/chat/moment.min.js"></script>
    <script src="js/chat/jquery.chat.js"></script>
    <!--  todo JS
		============================================ -->
    <script src="js/todo/jquery.todo.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="js/main.js"></script>
	<!-- tawk chat JS
		============================================ -->
    <script src="js/tawk-chat.js"></script>
</body>
</html>

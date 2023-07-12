<?php
    include 'inc/config.php';
    session_start();

    if (!isset($_SESSION['admin_id'])) {
        echo '<meta http-equiv="refresh" content="0; url= login.php">';
    }

    $musiq_id = $_GET['id'];
    $artist_name = $_GET['id2'];

    if (isset($_POST['submit'])) {

        $link_genius_lyrics = mysqli_real_escape_string($conn,$_POST['link_genius_lyrics']);
        $link_spotify = mysqli_real_escape_string($conn,$_POST['link_spotify']);
        $link_youtube = mysqli_real_escape_string($conn,$_POST['link_youtube']);
        $link_audiomack = mysqli_real_escape_string($conn,$_POST['link_audiomack']);
        $link_youtubemusic = mysqli_real_escape_string($conn,$_POST['link_youtubemusic']);
        $link_applemusic = mysqli_real_escape_string($conn,$_POST['link_applemusic']);
        $link_deezer = mysqli_real_escape_string($conn,$_POST['link_deezer']);
        $link_amazonmusic = mysqli_real_escape_string($conn,$_POST['link_amazonmusic']);
        $link_itunes = mysqli_real_escape_string($conn,$_POST['link_itunes']);
        $link_presave = mysqli_real_escape_string($conn,$_POST['link_presave']);

        $update_links = "UPDATE musiq_link SET link_genius_lyrics = '$link_genius_lyrics', link_spotify = '$link_spotify', link_youtube = '$link_youtube', link_audiomack = '$link_audiomack', link_applemusic = '$link_applemusic', link_deezer = '$link_deezer', link_itunes = '$link_itunes', link_youtubemusic = '$link_youtubemusic', link_amazonmusic = '$link_amazonmusic', link_presave = '$link_presave' WHERE musiq_id = '$musiq_id'";
        mysqli_query($conn, $update_links);
        echo mysqli_error($conn);

        $update_album = "UPDATE album SET links_added = 1 WHERE musiq_id = '$musiq_id'";
        mysqli_query($conn, $update_album);
        echo mysqli_error($conn);

        echo '<meta http-equiv="refresh" content="30; url= musiq.php">';
      }
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sweet Sound Musiq - Upload Musiq | Sweet Sound Dashboard</title>
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
    <!-- summernote CSS
		============================================ -->
    <link rel="stylesheet" href="css/summernote/summernote.css">
    <!-- Range Slider CSS
		============================================ -->
    <link rel="stylesheet" href="css/themesaller-forms.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- Notika icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/notika-custom-icon.css">
    <!-- bootstrap select CSS
		============================================ -->
    <link rel="stylesheet" href="css/bootstrap-select/bootstrap-select.css">
    <!-- datapicker CSS
		============================================ -->
    <link rel="stylesheet" href="css/datapicker/datepicker3.css">
    <!-- Color Picker CSS
		============================================ -->
    <link rel="stylesheet" href="css/color-picker/farbtastic.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="css/chosen/chosen.css">
    <!-- notification CSS
		============================================ -->
    <link rel="stylesheet" href="css/notification/notification.css">
    <!-- dropzone CSS
		============================================ -->
    <link rel="stylesheet" href="css/dropzone/dropzone.css">
    <!-- wave CSS
		============================================ -->
    <link rel="stylesheet" href="css/wave/waves.min.css">
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

    $query_musiq = "SELECT * FROM musiq, musiq_link WHERE musiq_link.musiq_id = musiq.musiq_id AND musiq.musiq_id = '$musiq_id' LIMIT 1";
    $result = mysqli_query($conn, $query_musiq);
    $row = mysqli_fetch_assoc($result);
?>
    <!-- End Header Top Area -->

    <!-- Form Element area Start-->
    <div class="form-element-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-element-list">
                            <div class="cmp-tb-hd bcs-hd">
                                <h2>Upload musiq</h2>
                                <p></p>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="bootstrap-select fm-cmp-mg">
                                        <select class="selectpicker" data-live-search="true" name="artist_id">
                                            <option value="<?php echo $artist_name ?>"><?php echo $artist_name?></option>
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <h5>Title</h5>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="musiq_title" class="form-control" placeholder="e.g Falling For You" value="<?php echo $row['musiq_title'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <h5>Title Slug</h5>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="musiq_title_slug" class="form-control" placeholder="e.g FallingForYou" value="<?php echo $row['musiq_title_slug'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="bootstrap-select fm-cmp-mg">
                                        <select class="selectpicker" data-live-search="true" name="musiq_genre" required>
                                            <option value="<?php echo $row['musiq_genre'] ?>"><?php echo $row['musiq_genre'] ?></option>
                                            <option value="Hip-Hop">Hip-Hop</option>
                                            <option value="Gospel">Gospel</option>
                                            <option value="R&B">R&B</option>
                                            <option value="House">House</option>
                                            <option value="Afrobeat">Afrobeat</option>
                                            <option value="Poem">Poem</option>
                                            <option value="Poem">Amapiano</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <h5>Genius Lyrics</h5>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="link_genius_lyrics" class="form-control" placeholder="copy link from Genius Lyrics"  value="<?php echo $row['link_genius_lyrics'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <h5>Spotify</h5>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="link_spotify" class="form-control" placeholder="copy link from Spotify"  value="<?php echo $row['link_spotify'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <h5>Youtube</h5>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="link_youtube" class="form-control" placeholder="copy link from Youtube"  value="<?php echo $row['link_youtube'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <h5>Audiomack</h5>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="link_audiomack" class="form-control" placeholder="copy link from Audiomack" value="<?php echo $row['link_audiomack'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <h5>Apple Music</h5>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="link_applemusic" class="form-control" placeholder="copy link from Apple Music"  value="<?php echo $row['link_applemusic'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <h5>Deezer</h5>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="link_deezer" class="form-control" placeholder="copy link from Deezer"  value="<?php echo $row['link_deezer'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <h5>Amazon Music</h5>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="link_amazonmusic" class="form-control" placeholder="copy link from Amazon Music"  value="<?php echo $row['link_amazonmusic'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <h5>Itunes</h5>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="link_itunes" class="form-control" placeholder="copy link from Itunes"  value="<?php echo $row['link_itunes'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <h5>Youtube Music</h5>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="link_youtubemusic" class="form-control" placeholder="copy link from Youtube Music"  value="<?php echo $row['link_youtubemusic'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <h5>Release Date</h5>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="date" name="musiq_release_date" class="form-control" placeholder="copy link from Itunes"  value="<?php echo $row['musiq_release_date'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <h5>Pre-Save</h5>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="link_presave" class="form-control" placeholder="copy link from Sweet Sound Musiq"  value="<?php echo $row['link_presave'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int mg-t-15">
                                <button type="submit" name="submit" class="btn btn-success notika-btn-success">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
    <!-- Input Mask JS
		============================================ -->
    <script src="js/jasny-bootstrap.min.js"></script>
    <!-- icheck JS
		============================================ -->
    <script src="js/icheck/icheck.min.js"></script>
    <script src="js/icheck/icheck-active.js"></script>
    <!-- rangle-slider JS
		============================================ -->
    <script src="js/rangle-slider/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="js/rangle-slider/jquery-ui-touch-punch.min.js"></script>
    <script src="js/rangle-slider/rangle-active.js"></script>
    <!-- datapicker JS
		============================================ -->
    <script src="js/datapicker/bootstrap-datepicker.js"></script>
    <script src="js/datapicker/datepicker-active.js"></script>
    <!-- bootstrap select JS
		============================================ -->
    <script src="js/bootstrap-select/bootstrap-select.js"></script>
    <!--  color-picker JS
		============================================ -->
    <script src="js/color-picker/farbtastic.min.js"></script>
    <script src="js/color-picker/color-picker.js"></script>
    <!--  notification JS
		============================================ -->
    <script src="js/notification/bootstrap-growl.min.js"></script>
    <script src="js/notification/notification-active.js"></script>
    <!--  summernote JS
		============================================ -->
    <script src="js/summernote/summernote-updated.min.js"></script>
    <script src="js/summernote/summernote-active.js"></script>
    <!-- dropzone JS
		============================================ -->
    <script src="js/dropzone/dropzone.js"></script>
    <!--  wave JS
		============================================ -->
    <script src="js/wave/waves.min.js"></script>
    <script src="js/wave/wave-active.js"></script>
    <!--  chosen JS
		============================================ -->
    <script src="js/chosen/chosen.jquery.js"></script>
    <!--  Chat JS
		============================================ -->
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

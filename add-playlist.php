<?php
    include 'inc/config.php';
    session_start();

    if (!isset($_SESSION['admin_id'])) {
        echo '<meta http-equiv="refresh" content="0; url= login.php">';
    }

    if (isset($_POST['submit'])) {

        $playlist_title = mysqli_real_escape_string($conn,$_POST['playlist_title']);
        $playlist_smart_url = mysqli_real_escape_string($conn,$_POST['playlist_smart_url']);
        $playlist_about = mysqli_real_escape_string($conn,$_POST['playlist_about']);
        $date = date("h-i-s");
        $playlist_musiq_ids = "";
        foreach ($_POST['playlist_musiq_id'] as $song_id) {
          $playlist_musiq_ids .= $song_id.', ';
        }

        $extension = explode(".", $_FILES['playlist_coverart']['name']);
        $playlist_coverart =  'playlist_'.strtolower($playlist_smart_url).$date.'.'.end($extension);
        move_uploaded_file($_FILES['playlist_coverart']['tmp_name'],'../musiq/images/playlists_images/'.$playlist_coverart);

        $ins_playlist = "INSERT INTO playlists (playlist_title, playlist_smart_url, playlist_musiq_ids, playlist_coverart, playlist_about, playlist_date)
                    VALUES ('$playlist_title', '$playlist_smart_url', '$playlist_musiq_ids', '$playlist_coverart', '$playlist_about', NOW())";
        mysqli_query($conn, $ins_playlist);
        echo mysqli_error($conn);

        echo '<meta http-equiv="refresh" content="10; url= playlists.php">';
    }
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sweet Sound Musiq - Add Playlist | Sweet Sound Dashboard</title>
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
                                <h2>Add Playlist</h2>
                                <p></p>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <h5>Playlist Title</h5>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="playlist_title" class="form-control" placeholder="e.g Falling For You" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp" >
                                            <h5>Playlist Smart URL</h5>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="playlist_smart_url" class="form-control" placeholder="e.g PhiLander, Starvi or none" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                  <div class="form-group ic-cmp-int">
                                      <div class="form-ic-cmp">
                                          <h5>Playlist Cover art</h5>
                                      </div>
                                      <div class="nk-int-st">
                                          <input type="file" name="playlist_coverart" class="form-control" placeholder="Cover Art" required>
                                      </div>
                                  </div>
                              </div>
                              <?php
                                  $sql="SELECT * FROM musiq, artists WHERE artists.artist_id = musiq.artist_id";
                                  $result_set=mysqli_query($conn,$sql);
                              ?>
                                <div class="col-lg-6 col-md-3 col-sm-3 col-xs-12">
                                    <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                        <h2>Choose Songs To Add To Playlist</h2>
                                    </div>
                                    <div class="chosen-select-act fm-cmp-mg">
                                        <select class="chosen" multiple data-placeholder="Choose Songs To Add..." name="playlist_musiq_id[]">
                                            <option disabled>Select Musiq</option>
                                        <?php
                                            while($row=mysqli_fetch_array($result_set)){
                                        ?>
                                                <option value="<?php echo $row['musiq_id'] ?>">
                                                <?php
                                                    echo $row['artist_name'].' - '.$row['musiq_title'];
                                                    if(!empty($row['musiq_featured_artist'])){
                                                        echo '<br><small> (feat. '.$row['musiq_featured_artist'].')';
                                                    };
                                                    echo ' ['.$row['musiq_genre'].']';
                                                ?>
                                                </option>
                                          <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-4 col-sm-4 col-xs-12"><br>
                                    <div class="nk-int-mk">
                                        <h2>About Playlist</h2>
                                    </div>
                                    <div class="form-group ic-cmp-int form-elet-mg">
                                        <div class="form-ic-cmp">
                                            <i class="fa fa-file-text"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <textarea name="playlist_about" class="form-control" cols="10" rows="5" placeholder="About playlst"></textarea>
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

<?php
    include 'inc/config.php';
    session_start();
    // class FlxZipArchive extends ZipArchive {
    //   public function addDir($location, $name) 
    //   {
    //         $this->addEmptyDir($name);
    //         $this->addDirDo($location, $name);
    //   } 
    //   private function addDirDo($location, $name) 
    //   {
    //       $name .= '/';
    //       $location .= '/';
    //       $dir = opendir ($location);
    //       while ($file = readdir($dir))
    //       {
    //           if ($file == '.' || $file == '..') continue;
    //           $do = (filetype( $location . $file) == 'dir') ? 'addDir' : 'addFile';
    //           $this->$do($location . $file, $name . $file);
    //       }
    //   } 
    // }

    if (!isset($_SESSION['admin_id'])) {
        echo '<meta http-equiv="refresh" content="0; url= login.php">';
    }

    if (isset($_POST['submit'])) {

        $artist_id = $_GET['artist'];
        $musiq_id = $_GET['musiq'];
        $album_id = $_GET['album'];

        // $query_musiq = "SELECT * FROM musiq INNER JOIN artist ON musiq.artist_id = artist.artist_id WHERE musiq.musiq_id = '$musiq_id' AND musiq.musiq_id = '$artist_id' LIMIT 1";
        // $result_set = mysqli_query($conn,$query_musiq);
        // $row = mysqli_fetch_assoc($result_set);

        $query_artist = "SELECT * FROM artist, musiq WHERE artist.artist_id = '$artist_id' AND musiq.musiq_id = '$musiq_id'";
        $result = mysqli_query($conn, $query_artist);
        $row = mysqli_fetch_assoc($result);
        echo mysqli_error($conn);

        // $musiq_files = $_FILES['musiq_file']['name'];
        $musiq_titles = $_POST['musiq_title'];
        $musiq_genre = $row['musiq_genre'];
        $musiq_release_date = $row['musiq_release_date'];
        $musiq_coverart = $row['musiq_coverart'];
        $album_folder = $row['musiq_file'];

          foreach($musiq_titles as $key => $musiq_title){

            $musiq_title_name = mysqli_real_escape_string($conn,$musiq_title[$key]);
            // $musiq_file_temp = $_FILES['musiq_file']['tmp_name'][$key];
            // $extension2 = explode(".", $musiq_file);
            $musiq_filename =  $musiq_title.'.mp3';
            // move_uploaded_file($musiq_file_temp,'https://files.sweetsound.co.za/musiq/songs/singles/'.$musiq_filename);

            $arr = explode(" (", $musiq_title, 2);
            $musiq_title_slug_select = $arr[0];
            $musiq_title_slug = str_replace(' ','', $musiq_title_slug_select);

            $ins_musiq = "INSERT INTO musiq (artist_id, active_yn, musiq_type, musiq_title, musiq_title_slug, musiq_genre, musiq_coverart, musiq_file, musiq_release_date, musiq_downloads, musiq_plays, musiq_likes, musiq_page_views)
            VALUES ('$artist_id', 1, 'Album-Track', '$musiq_title', '$musiq_title_slug', '$musiq_genre', '$musiq_coverart', '$musiq_filename', '$musiq_release_date', 0, 0, 0, 0)";
            mysqli_query($conn, $ins_musiq);
            echo mysqli_error($conn);

            $musiq_id2 = mysqli_insert_id($conn);

            $ins_album = "INSERT INTO album_single (album_id, musiq_id)
                VALUES ('$album_id', '$musiq_id2')";
            mysqli_query($conn, $ins_album);
            echo mysqli_error($conn);

            $update_album = "UPDATE album SET songs_added = 1 WHERE musiq_id = '$musiq_id'";
            mysqli_query($conn, $update_album);
            echo mysqli_error($conn);
          }

          // $the_folder = '../musiq/songs/albums/'.$album_folder;
          // $zip_file_name = '../musiq/songs/albums/'.$album_folder.' (Album).zip';
          // $za = new FlxZipArchive;
          // $res = $za->open($zip_file_name, ZipArchive::CREATE);
          // if($res === TRUE) 
          // {
          //     $za->addDir($the_folder, basename($zip_file_name));
          //     $za->close();
          // }
          // else{
          // echo 'Could not create a zip archive';
          // }

          echo '<meta http-equiv="refresh" content="0; url= albums.php">';
    }
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sweet Sound song - Upload song | Sweet Sound Dashboard</title>
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
                                <h2>Upload Album</h2>
                                <p></p>
                            </div>
                            <div class="row" id="loop"></div>
                            
                            <?php
                                    $element = '
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">\\n
                                    <div class="form-group ic-cmp-int">\\n
                                        <div class="nk-int-st">\\n
                                            <input type="text" name="musiq_title[]" class="form-control" placeholder="Fire (feat. PhiLander, Starvi & Lula Creez)" required><br>\\n
                                        </div>\\n
                                    </div>\\n
                                </div>\\n
                                    ';
                                ?>
                                <!-- <input type="file" name="musiq_file[]" class="form-control" placeholder="Song File" required><br><br>\\n -->
                            <script>

                                var element = `<?php echo $element ?>`;
                                var container = document.getElementById("loop");
                                var number_of_songs = <?php echo $_GET['numberofsongs']?>;
                                for (var i = 0; i < number_of_songs; i++){
                                  container.innerHTML+=element;
                                }
                            </script>
                            <div class="form-example-int mg-t-15">
                                <button type="submit" name="submit" class="btn btn-success notika-btn-success">Submit</button>
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

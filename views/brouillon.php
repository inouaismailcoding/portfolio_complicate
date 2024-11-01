<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: BizPage
  * Template URL: https://bootstrapmade.com/bizpage-bootstrap-business-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body class="index-page">
<!-- NAVRBAR -->

 <?php include ASSETS.DIRECTORY_SEPARATOR."navbar.php"; ?> 
   
    
    <?php include ASSETS.DIRECTORY_SEPARATOR."footer.php"; ?>
    </div>
 

    <!-- ON CREE UN SCRIPT JS -->
    <script>
        let table=$('#table-Admin-Post')
       if($('#table-Admin-Post'))
       {
        $(function(){
            table.dataTable({
                dom:'fltrip',
                "order":[[0,"desc"]],
                "paging": true,
                "scrolly":200,
                "pageLength":3,
                "lengthMenu":[5,10,15,20,25,30],
                "pagingType":"simple_numbers"
            });
        });
       }
    </script>

    <script src="<?= SCRIPTS.'js'.DIRECTORY_SEPARATOR.'jquery.js' ;?>"></script>

    <script src="<?= SCRIPTS.'js'.DIRECTORY_SEPARATOR.'datatables.min.js' ;?>"></script>
    <script src="<?= SCRIPTS.'js/script.js' ;?>"></script>
 <!-- Vendor JS Files -->
 <script src="<?= ASSETS.'vendor'.DIRECTORY_SEPARATOR.'bootstrap'.DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'bootstrap.bundle.min.js' ;?>"></script>
  <script src="<?= ASSETS.'vendor'.DIRECTORY_SEPARATOR.'php-email-form'.DIRECTORY_SEPARATOR.'validate.js' ;?>"></script>
  <script src="<?= ASSETS.'vendor'.DIRECTORY_SEPARATOR.'aos'.DIRECTORY_SEPARATOR.'aos.js' ;?>"></script>
  <script src="<?= ASSETS.'vendor'.DIRECTORY_SEPARATOR.'purecounter'.DIRECTORY_SEPARATOR.'purecounter_vanilla.js ';?>"></script>
  <script src="<?= ASSETS.'vendor'.DIRECTORY_SEPARATOR.'glightbox'.DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'glightbox.min.js' ;?>"></script>
  <script src="<?= ASSETS.'vendor'.DIRECTORY_SEPARATOR.'imagesloaded'.DIRECTORY_SEPARATOR.'imagesloaded.pkgd.min.js' ;?>"></script>
  <script src="<?= ASSETS.'vendor'.DIRECTORY_SEPARATOR.'isotope-layout'.DIRECTORY_SEPARATOR.'isotope.pkgd.min.js' ;?>"></script>
  <script src="<?= ASSETS .'vendor'.DIRECTORY_SEPARATOR.'swiper'.DIRECTORY_SEPARATOR.'swiper-bundle.min.js' ;?>"></script>
   <!-- Main JS File -->
   <script src="<?= ASSETS.'js'.DIRECTORY_SEPARATOR.'main.js' ;?>"></script>

</body>
</html>
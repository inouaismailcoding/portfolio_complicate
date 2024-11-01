<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
  <!-- Favicons -->
  <link href="<?= SCRIPTS.DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'favicon.png' ;?>" rel="icon">
  <link href="<?= SCRIPTS .DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.'apple-touch-icon.png' ;?>" rel="apple-touch-icon">
  <!-- Fonts 
    <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


  
  -->
   <!-- Vendor CSS Files -->
  <link href="<?= SCRIPTS.'vendor'.DIRECTORY_SEPARATOR.'bootstrap'.DIRECTORY_SEPARATOR.'css'.DIRECTORY_SEPARATOR.'bootstrap.min.css';?>" rel="stylesheet">
  <link href="<?= SCRIPTS.'vendor'.DIRECTORY_SEPARATOR.'bootstrap-icons'.DIRECTORY_SEPARATOR.'bootstrap-icons.css'; ?>" rel="stylesheet">
  <link href="<?= SCRIPTS.'vendor'.DIRECTORY_SEPARATOR.'aos'.DIRECTORY_SEPARATOR.'aos.css';?>" rel="stylesheet">
  <link href="<?= SCRIPTS.'vendor'.DIRECTORY_SEPARATOR.'glightbox'.DIRECTORY_SEPARATOR.'css'.DIRECTORY_SEPARATOR.'glightbox.min.css' ?>" rel="stylesheet">
  <link href="<?= SCRIPTS.'vendor'.DIRECTORY_SEPARATOR.'swiper'.DIRECTORY_SEPARATOR.'swiper-bundle.min.css' ; ?>" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="<?= SCRIPTS.DIRECTORY_SEPARATOR.'css'.DIRECTORY_SEPARATOR.'main.css' ;?>   " rel="stylesheet">

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
<?= SCRIPTS.'vendor'.DIRECTORY_SEPARATOR.'swiper'.DIRECTORY_SEPARATOR.'swiper-bundle.min.css' ; ?>
 <?php include ASSETS.DIRECTORY_SEPARATOR."navbar.php"; ?> 
   
 <?= $contents; ?>
    <?php include ASSETS.DIRECTORY_SEPARATOR."footer.php"; ?>
    </div>
 

    <script src="<?= SCRIPTS.'js'.DIRECTORY_SEPARATOR.'jquery.js' ;?>"></script>

    <script src="<?= SCRIPTS.'js'.DIRECTORY_SEPARATOR.'datatables.min.js' ;?>"></script>
    <script src="<?= SCRIPTS.'js'.DIRECTORY_SEPARATOR.'script.js' ;?>"></script>
 <!-- Vendor JS Files -->
 <script src="<?= SCRIPTS.'vendor'.DIRECTORY_SEPARATOR.'bootstrap'.DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'bootstrap.bundle.min.js' ;?>"></script>
  <script src="<?= SCRIPTS.'vendor'.DIRECTORY_SEPARATOR.'php-email-form'.DIRECTORY_SEPARATOR.'validate.js' ;?>"></script>
  <script src="<?= SCRIPTS.'vendor'.DIRECTORY_SEPARATOR.'aos'.DIRECTORY_SEPARATOR.'aos.js' ;?>"></script>
  <script src="<?= SCRIPTS.'vendor'.DIRECTORY_SEPARATOR.'purecounter'.DIRECTORY_SEPARATOR.'purecounter_vanilla.js ';?>"></script>
  <script src="<?= SCRIPTS.'vendor'.DIRECTORY_SEPARATOR.'glightbox'.DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'glightbox.min.js' ;?>"></script>
  <script src="<?= SCRIPTS.'vendor'.DIRECTORY_SEPARATOR.'imagesloaded'.DIRECTORY_SEPARATOR.'imagesloaded.pkgd.min.js' ;?>"></script>
  <script src="<?= SCRIPTS.'vendor'.DIRECTORY_SEPARATOR.'isotope-layout'.DIRECTORY_SEPARATOR.'isotope.pkgd.min.js' ;?>"></script>
  <script src="<?= SCRIPTS .'vendor'.DIRECTORY_SEPARATOR.'swiper'.DIRECTORY_SEPARATOR.'swiper-bundle.min.js' ;?>"></script>
   <!-- Main JS File -->
   <script src="<?= SCRIPTS.'js'.DIRECTORY_SEPARATOR.'main.js' ;?>"></script>

</body>
</html>
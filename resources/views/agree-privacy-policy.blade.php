<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Privacy Policy | ND-YTSCAM APPLICATION</title>

       <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="{{ themeAsset('/') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ themeAsset('/') }}/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
        <link href="{{ themeAsset('/') }}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="{{ themeAsset('/') }}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="{{ themeAsset('/') }}/assets/vendor/venobox/venobox.css" rel="stylesheet">
        <link href="{{ themeAsset('/') }}/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="{{ themeAsset('/') }}/assets/vendor/aos/aos.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="{{ themeAsset('/') }}/assets/css/style.css" rel="stylesheet">

    </head>
    <body>
        <!-- ======= Header ======= -->
  <header id="header" class="fixed-top1 " style="background: #37517e;">
    <center><a href="/"><img style="max-height: 45px" src="{{ themeAsset('/') }}/assets/img/nd-ytscam-logo.png" alt="ND-YTSCAM"></a>   </center>
    <div class="container d-flex align-items-center">

      <center>
        <h1 class="logo mr-auto">
              
        </h1>
      </center>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <!-- .nav-menu -->

     <!-- <a href="/login" class="get-started-btn scrollto">Sign in</a> -->

    </div>
  </header><!-- End Header -->

  

  <main id="main">


    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up" style="padding-top: 20px;">

        <div class="section-title">
          <h2>Privacy Policy</h2>
        </div>

        <div class="row content">
          <div class="col-lg-12">            
            <p>
                This privacy policy will help you understand how <b>ND-YTSCAM</b> uses and protects the data you provide to us when you visit and use <b>ND-YTSCAM</b> application service. </p>
            <p>
                We reserve the right to change this policy at any given time, of which you will be promptly updated. If you want to make sure that you are up to date with the latest changes, we advise you to frequently visit this page.                
            </p> 
            <p>When user agree ND-YTSCAM privacy policy it includes the users are agreeing <a href="https://www.youtube.com/t/terms" target="_blank">YouTube's Terms of Service</a>.</p> 

<h3>          What User Data We Collect </h3>
<p>When you visit the website, we may collect the following data: </p>
<ul style="list-style: disc; padding-left: 25px;">
    <li> Your Name. </li>
    <li> Your Email address.</li>
</ul>
<p>We are authenticating user with Google oAuth 2 and get user data like email and name from the oAuth response. We are collecting user YouTube Channels, Videos and comments data using the <a href="https://developers.google.com/youtube/terms/developer-policies" target="_blank">YouTube Api Services.</a></p>

<p>We have followed Google <a href="https://policies.google.com/terms?hl=en-US#toc-using" target="_blank">Terms of Service</a> and <a href="https://policies.google.com/privacy?hl=en-US" target="_blank">Privacy Policy</a></p>
<p>ND-YTSCAM is not collecting any information about the user devices and not storing anything about devices. We also not storing any cookies in user browsers and devices.</p>

<h3>Why We Collect Your Data</h3>
<p>We are collecting your data for several reasons:</p>
<ul style="list-style: disc; padding-left: 25px;">
    <li>	To better understand your needs..</li>
    <li>	To improve our services and products..</li>
    <li>	To send you promotional emails containing the information we think you will find interesting..</li>
    <li>	To contact you to fill out surveys and participate in other types of market research..</li>
    <li>	To customize our <b>ND-YTSCAM</b> application according to your personal preferences.</li>
</ul>

<h3>Safeguarding and Securing the Data</h3>
<p><b>ND-YTSCAM</b> is committed to securing your data and keeping it confidential. <b>ND-YTSCAM</b> has done all in its power to prevent data theft, unauthorized access, and disclosure by implementing the latest technologies and software, which help us safeguard all the information we collect online.</p>
<p><b>Note: Except your name and email, we are not collecting/saving any of your information. </b></p>

<p>If any user want to remove their access for our ND-YTSCAM application, they can remove access from their gmail account in the Third pary management section. You can find the instruction <a href="security.google.com/settings/security/permissions" target="_blank">here</a>.
 
<h3>Restricting the Collection of your Personal Data</h3>
<p>At some point, you might wish to restrict the use and collection of your personal data. You can achieve this by doing the following:</p>
<p>When you are filling the forms on the website, make sure to check if there is a box which you can leave unchecked, if you don't want to disclose your personal information.</p>
<p>If you have already agreed to share your information with us, feel free to contact us via email and we will be more than happy to change this for you.</p>
<p><b>ND-YTSCAM</b> will not lease, sell or distribute your personal information to any third parties, unless we have your permission. We might do so if the law forces us. Your personal information will be used when we need to send you promotional materials if you agree to this privacy policy.</p>

<div class="row">
    <div class="col-md-2">
      <form method="post" action="{{ route('login_app') }}">
        <input type="hidden" name="id" value="{{ Request::route('userId') }}">
        @csrf
        <button type="submit" class="btn btn-info text-center">I AGREE</button>
      </form>
  </div>
  <div class="col-md-2">
    <a href="/" class="btn btn-danger">CANCEL</a>
  </div>
</div>

          </div>

        </div>

      </div>
    </section><!-- End About Us Section -->
    
   

    

  </main><!-- End #main -->

  

  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
  <div id="preloader"></div>



  <!-- Vendor JS Files -->
  <script src="{{ themeAsset('/') }}/assets/vendor/jquery/jquery.min.js"></script>
  <script src="{{ themeAsset('/') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ themeAsset('/') }}/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="{{ themeAsset('/') }}/assets/vendor/php-email-form/validate.js"></script>
  <script src="{{ themeAsset('/') }}/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="{{ themeAsset('/') }}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="{{ themeAsset('/') }}/assets/vendor/venobox/venobox.min.js"></script>
  <script src="{{ themeAsset('/') }}/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="{{ themeAsset('/') }}/assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ themeAsset('/') }}/assets/js/main.js"></script>
  <script>
    $('#pricingEnquiryModal').on('show.bs.modal', function (event) {
      $('#pricingEnquiryModal .sent-message').hide();
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('.modal-title').text('Contact for ' + recipient)
      modal.find('.modal-body input[id=recipient_name]').val(recipient)
    })
  </script>
    </body>
</html>

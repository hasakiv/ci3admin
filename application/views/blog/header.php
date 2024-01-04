<meta name="google-site-verification" content="ySUQLvOELXSU2Qb1S2juYf80wfHX0o4lJHQb2L2a7HI" />
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>" />
</head>
<body>
      <!--Main Navigation-->
  <header>
    <!-- Intro settings -->
    <style>
      #intro {
        /* Margin to fix overlapping fixed navbar */
        margin-top: 58px;
      }

      @media (max-width: 991px) {
        #intro {
          /* Margin to fix overlapping fixed navbar */
          margin-top: 45px;
        }
      }
    </style>

    <nav class="navbar navbar-expand-md bg-light">
  <a class="navbar-brand" href="<?php echo base_url();?>"><img src="https://anhsex2k.xyz/media/anhsex2k.png" height="40" alt="Logo" loading="lazy"
            style="margin-top: -3px;" /></a>
 
   <form action="<?php echo site_url('BlogController/search');?>" method = "post" class="form">
          <div class="input-group">
          <div class="form-outline">
            
            <input id="search-input" name = "keyword" type="search" id="form1" class="form-control" placeholder="Bạn muốn tìm gì?"/>
          </div>
          <button id="submit" type="submit" class="btn btn-primary" name="submit">
            Tìm
          </button>
</nav>

  
  </header>
  <!--Main Navigation-->
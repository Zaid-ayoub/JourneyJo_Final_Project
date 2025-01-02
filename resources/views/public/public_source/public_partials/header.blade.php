<head>
    <meta charset="utf-8">
    <title>JourneyJo</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/journeyjo.png') }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('public_assets/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('public_assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />
    

   

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('public_assets/css/style.css')}}" rel="stylesheet">
     {{-- <link href="{{asset('public_assets/css/bootstrap.min.css')}}" rel="stylesheet" /> 
    <link href="{{asset('public_assets/css/templatemo.css')}}" rel="stylesheet" />--}}
    <link href="{{asset('public_assets/css/custom.css')}}" rel="stylesheet" />
    <link href="{{asset('public_assets/css/slick.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public_assets/css/slick-theme.css')}}" rel="stylesheet" /> 


    <style>
        .package-item {
            transition: 0.4s ease;
            border: 1px solid #eee;
            background: #fff;
            position: relative;
            overflow: hidden;
        }

        .package-item::after {
            content: '';
            position: absolute;
            bottom: -100%;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #C77943, #240b36);
            transition: 0.3s ease;
        }

        .package-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 20px rgba(195, 20, 50, 0.1);
        }

        .package-item:hover::after {
            bottom: 0;
        }

        .package-item img {
            transition: 0.5s ease;
            filter: brightness(1);
        }

        .package-item:hover img {
            filter: brightness(1.1);
            transform: scale(1.05);
        }

        .package-item .h5 {
            transition: 0.3s;
        }

        .package-item:hover .h5 {
            color: #C77943;
        }

        
    </style>
</head>
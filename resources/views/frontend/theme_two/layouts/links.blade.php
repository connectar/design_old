


<!-- Load Roboto font -->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<!-- Load css styles -->
<link rel="stylesheet" type="text/css" href="{{asset('new_frontend_theme/css/bootstrap.css?1')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('new_frontend_theme/css/bootstrap-responsive.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('new_frontend_theme/css/style.css?1')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('new_frontend_theme/css/pluton.css')}}" />
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="css/pluton-ie7.css" />
<![endif]-->
<link rel="stylesheet" type="text/css" href="{{asset('new_frontend_theme/css/jquery.cslider.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('new_frontend_theme/css/jquery.bxslider.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('new_frontend_theme/css/animate.css')}}" />


{{-- Changa --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Changa:wght@400;500&display=swap" rel="stylesheet">
{{-- /Changa --}}



@stack('styles')


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">

<style>
    .icon {
    font-size: 30px;
    margin-right: 1px;
    }
    @media (max-width: 768px) {
      .custom-position-header-dropdown-menu
      {
      	position:relative !important;
      }
    }

	@if(app()->getLocale() == 'ar')

    body {
        font-family: 'Changa', sans-serif;
		line-height:1.5 !important;
    }
	@else
		body {
			font-family: 'Josefin Sans', sans-serif;
			line-height:1.5;
		}

	@endif
</style>



<!--
<script>
    src="https://code.jquery.com/jquery-3.5.1.slim.min.js">
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js">
</script> -->

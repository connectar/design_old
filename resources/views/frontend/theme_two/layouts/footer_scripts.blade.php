@stack('scripts')

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script> -->
<!-- Include javascript -->
<script src="{{asset('new_frontend_theme/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('new_frontend_theme/js/jquery.mixitup.js')}}"></script>
<script type="text/javascript" src="{{asset('new_frontend_theme/js/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('new_frontend_theme/js/modernizr.custom.js')}}"></script>
<script type="text/javascript" src="{{asset('new_frontend_theme/js/jquery.bxslider.js')}}"></script>
<script type="text/javascript" src="{{asset('new_frontend_theme/js/jquery.cslider.js')}}"></script>
<script type="text/javascript" src="{{asset('new_frontend_theme/js/jquery.placeholder.js')}}"></script>
<script type="text/javascript" src="{{asset('new_frontend_theme/js/jquery.inview.js')}}"></script>
<!-- Load google maps api and call initializeMap function defined in app.js -->
<!--<script async="" defer="" type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initializeMap"></script> -->
<!-- css3-mediaqueries.js for IE8 or older -->
<!--[if lt IE 9]>
    {{-- <script src="{{asset('new_frontend_theme/js/respond.min.js')}}"></script> --}}
<![endif]-->
<script type="text/javascript" src="{{asset('new_frontend_theme/js/app.js')}}"></script>





{{-- popups --}}
<div id="messenger-popup">
    <a href="https://facebook.com/messages/t/1655662691360507" target="_blank">
        <img src="{{asset('new_frontend_theme/images/unnamed.png')}}" alt="messenger Icon">
    </a>
</div>
        <div id="facebook_groups-popup">
    <a href="https://facebook.com/groups/connect4ar" target="_blank">
        <img src="{{asset('new_frontend_theme/images/facebook_groups.png')}}" alt="facebook_groups Icon">
    </a>
</div>
<div id="whatsapp-popup">
    <a href="https://api.whatsapp.com/send?phone=0201026177689" target="_blank">
        <img src="{{asset('new_frontend_theme/images/WhatsApp_Icon.png')}}" alt="WhatsApp Icon">
    </a>
</div>
{{-- /popups --}}

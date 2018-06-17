@if(\Session::has('guest_id'))
        <!DOCTYPE html>
<html>
<head>
    <title>SmartStay</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css"
          rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/guest.css')}}">
    <link rel="shortcut icon" href="{{asset('img/icon/icoTransparente.png')}}">
{{--    <script type="text/javascript" src="{{asset('css/styleSwiper.css') }}"></script>--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.3.5/tiny-slider.css">
    <meta name="viewport" content="height=device-height, initial-scale=1.0">
    {{--<meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
    <meta name="csrf-token" content="{{csrf_token()}}">
    <script>
    </script>

</head>
<body>
<div id="container">
    <div id="header">
        <nav>
            <div id="nav1">
                <h3><span>SmartStay</span> Hotel Jaume Balmes</h3>
            </div>
            <div id="nav2">
                <p><i class="fas fa-door-closed"
                      style="margin-right:5px"></i>{{\App\Guest::find(Session::get('guest_id'))->rooms[0]->number}}</p>
            </div>

        </nav>
        <div id="subMenu">

            <div id="subMenu1">
                <a href="{{url('logout')}}"><i class="fas fa-power-off"></i></a>
            </div>
            <div id="subMenu2">
                <div id="bttnHistory" v-if="history.length>0">
                    <i class="fas fa-history" v-if="history.length>0" @click="showHistory = !showHistory"></i>
                </div>
                <div id="inOut">

                    <label class="switch">

                        <input type="checkbox" v-model="statusRoom" @click="showOut">
                        <span class="slider"></span>
                    </label>
                </div>

            </div>
        </div>
    </div>
    <transition name="fade">
    <div id="main_container" v-if="!showHistory"><!-- v-bind:class="[!showMenuOut && !guestOut ? 'blur' : '']" -->
        @yield('content')
    </div>
    </transition>


    <housekeeping v-if="!statusRoom && showModalHK" @close="showModalHK = false">

    </housekeeping>

    <historyorders  v-if="showHistory && history.length>0" @close="closeHistory"></historyorders>

{{--@{{$data}}--}}
    <transition name="fade-out">
    <div id="loadingScreen" v-if="loadingScreen">
        <h2>Welcome</h2>
        <load-screen
                :animation-duration="1000"
                :size="60"
                color="#ff1d5e"
        />
    </div>
    </transition>
</div>

<script type="text/javascript" src="{{asset('js/app.js') }}"></script>
<script type="text/javascript" src="{{asset('js/swiper/dist/js/swiper.min.js') }}"></script>

<script>
    // var mySwiper = new Swiper('.swiper-container', {
    //     speed: 400,
    //     spaceBetween: 100,
    //     loop:true
    // });
</script>

</body>
</html>
@else
    <script>window.location = "{{ url('/') }}";</script>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8" />
   <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('paper') }}/img/apple-icon.png">
   <link rel="icon" type="image/png" href="{{ asset('paper') }}/img/favicon.png">
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
   <meta name="token" content="{{ csrf_token() }}">
   <title>PayU</title>
   <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
   name='viewport' />
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
   integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
   crossorigin="anonymous" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/brands.min.css"
   integrity="sha512-apX8rFN/KxJW8rniQbkvzrshQ3KvyEH+4szT3Sno5svdr6E/CP0QE862yEeLBMUnCqLko8QaugGkzvWS7uNfFQ=="
   crossorigin="anonymous" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css"
   integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA=="
   crossorigin="anonymous" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css"
   integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg=="
   crossorigin="anonymous" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css"
   integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg=="
   crossorigin="anonymous" />
   <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
   <!-- Select2 --->
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
   <!-- Date Range Picker -->
   <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
   <!-- CSS Files -->
   <link href="{{ asset('paper') }}/css/bootstrap.min.css" rel="stylesheet" />
   <link href="{{ asset('paper') }}/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
   <!-- CSS Just for demo purpose, don't include it in your project -->
   <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
   <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
   <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
   <link href="{{ asset('paper') }}/demo/demo.css" rel="stylesheet" />
   {{-- <link rel="stylesheet" href="{{ asset('css/navsidebar.css') }}"> --}}
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
   <style media="screen">
   body{
      color: #3f3f3f;
      background-color: #edf2f2;
   }
   .header-title{
      background-color: #3f3f3f;
      color: #fff;
   }
   .content-section{
      background-color: #fff;
   }
   .content-section .btn{
      background-color: #a6c307;
      color: #FFFFFF;
   }
   .content-section i{
      font-size: 35px;
   }

   .content-section h4{
      margin-top: 10px;
      font-weight: bold;
   }
   </style>
</head>
<body>
   <div type="hidden" id="map"></div>
   <div class="wrapper">
      <div class="content">
         <section class="mb-2">
            <div class="row">
               <div class="col text-center">
                  <div class="header-title p-2">
                     <svg height="43" viewBox="0 0 86 43" width="86" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><path d="m73.738 16.019a1 1 0 0 1 -1-1v-4.423h-.368c-2.287 0-3.138.378-3.138 2.461v4.876l-.001.031v1.069c-.001.037-.003.071-.003.11v6.813c0 .832-.16 1.494-.492 2.009-.623.961-1.858 1.398-3.834 1.4-1.975-.002-3.21-.439-3.833-1.399-.332-.515-.493-1.178-.493-2.01v-6.813c0-.039-.002-.073-.003-.11v-1.069l-.001-.03v-4.877c0-2.083-.85-2.46-3.138-2.46h-.72c-2.288 0-3.139.377-3.139 2.46v12.899c0 2.074.468 3.831 1.372 5.247 1.746 2.744 5.129 4.206 9.937 4.206h.036c4.808 0 8.19-1.462 9.937-4.206.904-1.416 1.372-3.173 1.372-5.247v-9.936z" fill="#a6c307"/><path d="m79.808 3.597h5.25v5.297h-5.25z"/><path d="m84.314 8.894-3.763-.001a.743.743 0 0 1 -.743-.744l.001-3.809c0-.41.333-.743.744-.743l3.762.001c.41 0 .743.333.743.744l-.001 3.81c0 .41-.333.742-.743.742m-5.014-5.296-2.556-.001a.505.505 0 0 1 -.504-.505v-2.587c0-.28.227-.505.505-.505l2.556.001c.278 0 .505.226.505.505l-.001 2.587a.505.505 0 0 1 -.505.505" fill="#a6c307"/><path d="m0 10.592h17.96v24.503h-17.96z"/><path d="m14.605 18.444c0 3.06-.782 4.72-4.904 4.72h-6.347v-7.9c0-1.095.408-1.503 1.503-1.503h4.844c3.106 0 4.904.767 4.904 4.683m-4.905-7.852h-5.472c-2.924 0-4.228 1.304-4.228 4.228v18.783c0 1.13.363 1.492 1.493 1.492h.37c1.129 0 1.491-.362 1.491-1.492v-7.307h6.347c5.634 0 8.258-2.496 8.258-7.852 0-5.357-2.624-7.852-8.258-7.852m20.062 16.061v2.575c0 2.1-.778 3.314-4.756 3.314-2.628 0-3.906-.95-3.906-2.907 0-2.146 1.282-2.982 4.572-2.982zm-4.756-10.675c-2.168 0-3.528.272-4.043.375-.913.198-1.294.449-1.294 1.487v.296c0 .407.06.688.189.886.15.231.393.348.72.348.16 0 .345-.026.566-.082.521-.13 2.188-.4 4.01-.4 3.273 0 4.608.907 4.608 3.13v1.982h-4.127c-5.307 0-7.778 1.79-7.778 5.634 0 3.728 2.552 5.781 7.186 5.781 5.507 0 7.963-1.874 7.963-6.077v-7.321c0-4.064-2.617-6.04-8-6.04zm26.15.875c-.234-.293-.676-.334-1.12-.334h-.332c-1.104 0-1.537.34-1.782 1.4l-3.068 12.756c-.383 1.567-.921 1.854-1.842 1.854-1.128 0-1.58-.27-2.029-1.86l-3.474-12.756c-.288-1.068-.712-1.394-1.817-1.394h-.296c-.446 0-.89.041-1.118.339-.228.297-.15.742-.033 1.179l3.512 12.866c.66 2.462 1.442 4.5 4.369 4.5.546 0 1.051-.076 1.471-.218-.887 2.791-1.79 4.023-4.453 4.296-.54.045-.891.122-1.087.385-.203.272-.157.661-.084 1.01l.073.33c.159.762.43 1.235 1.286 1.235.09 0 .187-.005.29-.013 3.976-.26 6.107-2.401 7.353-7.388l4.253-17.013c.101-.436.162-.88-.071-1.174m27.648-7.963h-5.066c-.552 0-1 .447-1 1l-.001.706h.351c2.288 0 3.139.378 3.139 2.461v2.963h2.575a1 1 0 0 0 1-1l.002-5.128a1 1 0 0 0 -1-1.001" fill="#a6c307"/></g></svg>
                  </div>
               </div>
            </div>
         </section>
         <div class="container text-center">
            <section class="mb-2">
               <div class="row">
                  <div class="col">
                     <div class="header-title">
                        <h3 class="m-0">ESTADO</h3>
                     </div>
                     <div class="content-section py-3">
                        <div class="row">
                           <div class="col text-center">
                              <i class="{{$data['icon']}} text-{{$data['type']}}" aria-hidden="true"></i>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col text-center">
                              <h4 class="text-{{$data['type']}}">{{$data['title']}}</h4>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </div>
   </div>

   <!--   Core JS Files   -->
   <script src="{{ asset('paper') }}/js/core/jquery.min.js"></script>
   <script src="{{ asset('paper') }}/js/core/popper.min.js"></script>
   {{-- <script src="{{ asset('js/adminlte.min.js') }}"></script> --}}
   <script src="{{ asset('js') }}/app.js"></script>
   <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
   <!-- Date Range Picker  -->
   <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
   <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
   <script src="{{ asset('paper') }}/js/core/bootstrap.min.js"></script>
   <script src="{{ asset('paper') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
   <!--  Google Maps Plugin    -->
   <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
   <!-- Chart JS -->
   <script src="{{ asset('paper') }}/js/plugins/chartjs.min.js"></script>
   <!--  Notifications Plugin    -->
   <script src="{{ asset('paper') }}/js/plugins/bootstrap-notify.js"></script>
   <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
   <script src="{{ asset('paper') }}/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>

   <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
   <script src="{{ asset('paper') }}/demo/demo.js"></script>
   {{-- <link href="{{ asset('css') }}/app.css" rel="stylesheet" /> --}}
   <!-- Latest compiled and minified JavaScript -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
   <style>
   .swal2-container {
      z-index: 10000;
   }
   </style>
   <!-- Sharrre libray -->
   <!-- <script src="../assets/demo/jquery.sharrre.js"></script> -->
   <script>
   $('.btn-filter').click(() => $('.form-filter').toggle('slow'))
   </script>
   <!-- Select2  -->
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   <script src="{{ asset('js') }}/script.js"></script>
   <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   <!-- Map --->
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAn2Ai1D1n0FwIhCV4T3xNkLjFtLeIJ5_k&libraries=places">
   </script>

   <script type="text/javascript">

   </script>
</body>
</html>

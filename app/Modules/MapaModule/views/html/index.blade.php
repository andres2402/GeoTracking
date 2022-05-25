@extends('layouts.app', [
'class' => '',
'elementActive' => 'index'
])

@section('content')

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                </div>

                <!-- <div class="sidebar" data-color="white">
                    <div class="sidebar-wrapper">
                        <ul class="nav">
                            <li>

                            </li>
                        </ul>
                    </div>
                </div> -->

                <style>
                    #map {
                        height: 500px;
                        width: 100%;
                    }
                </style>
                <div>
                    <script>
                        function iniciarMap() {
                            var coord = {
                                lat: 11.005405581389534,
                                lng: -74.81021361080757
                            };
                            var map = new google.maps.Map(document.getElementById('map'), {
                                zoom: 16,
                                center: coord
                            });
                            var marker = new google.maps.Marker({
                                position: coord,
                                map: map
                            });
                        }
                    </script>

                    <div id="map"></div>
                    <script src="script.js"></script>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDaeWicvigtP9xPv919E-RNoxfvC-Hqik&callback=iniciarMap"></script>
                </div>
            </div>
        </div>
    </div>
    @endsection
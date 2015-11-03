
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Test crawler</title>
    </head>
    <style>
        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            font-size: 13px;
            font-family: arial;
        }

        #panel {
            width: 100%;
            float: left;
            clear: both;
            padding: 5px;
            box-sizing: border-box;
        }

        #panel > img {
            width: 16px;
            height: 16px;
        }

        #content {
            position: absolute;
            left: 0;
            top: 40px;
            right: 0;
            bottom: 10px;
        }

        .selector {
            float: left;
            margin-right: 20px;
        }
        #map-container {
            padding: 6px;
            border-width: 1px;
            border-style: solid;
            border-color: #ccc #ccc #999 #ccc;
            -webkit-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
            -moz-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
            box-shadow: rgba(64, 64, 64, 0.1) 0 2px 5px;
            width: calc(100% - 300px);
            float: left;
            box-sizing: border-box;
        }
        #main_map {
            width: 100%;
            height: 100%;
            box-sizing: border-box;
        }
        .title {
            border-bottom: 1px solid #e0ecff;
            overflow: hidden;
            width: 256px;
            cursor: pointer;
            padding: 2px 0;
            display: block;
            color: #000;
            text-decoration: none;
        }
        .title:visited {
            color: #000;
        }
        .title:hover {
            background: #e0ecff;
        }
        #timetaken {
            color: #f00;
        }
        .info {
            width: 200px;
        }
        .info img {
            border: 0;
        }
        .info-body {
            width: 200px;
            height: 200px;
            line-height: 200px;
            margin: 2px 0;
            text-align: center;
            overflow: hidden;
        }
        .info-img {
            height: 220px;
            width: 200px;
        }

        .country {
            text-transform: uppercase;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="///maps.google.com/maps/api/js?sensor=true"></script>
    <script src="https://hpneo.github.io/gmaps/gmaps.js"></script>
    <script type="text/javascript" src="http://travels.devco.net/markerclusterer_compiled.js"></script>

    <body>
        <div id="panel">
            <img id="loading" src="{{asset('src/ajax-loader.gif')}}" />
            <div class="selector">
                <select name="" id="country">
                    <option value="">Country</option>
                </select>
            </div>
            <!--            <div class="selector">
                            <span>State</span>
                            <select name="" id="">
                                <option value="">All</option>
                                <option value="">Florida</option>
                                <option value="">California</option>
                                <option value="">New York</option>
                            </select>
                        </div>-->
            <div class="selector">
                <span>City</span>
                <select name="" id="city">
                    <option value="">City</option>
                </select>
            </div>
            <div class="selector">
                <select name="" id="mall">
                    <option value="">Mall</option>
                </select>
            </div>
            <div class="selector">
                <select name="" id="number">
                    <option value="">Limit(1000)</option>
                    <option value="">2000</option>
                    <option value="">5000</option>
                    <option value="">10000</option>
                    <option value="">All</option>
                </select>
            </div>

        </div>
        <div id="content">

            <!--            <div id="mall">
                            <div id="markerlist">
            
                            </div>
                            <select name="" id="mall">
                                <option value="">Please select</option>
                            </select>
                        </div>-->
            <div id="main_map"></div>
        </div>

    </body>

</html>
<script type="text/javascript">

$(document).ready(function () {
    $('#loading').hide();
    map = new GMaps({
        div: '#main_map',
        lat: 40.088344977,
        lng: -75.393434309,
        zoom: 10,
    });
});
window.onload = function () {
    var map;

    $.ajax({
        beforeSend: function (xhr) {
            $('#loading').show();
        },
        type: 'GET',
        url: '<?php echo url('getCountry') ?>',
        dataType: 'json',
        success: function (response)
        {
            $.each(response, function (key, value) {
                var html = '<option class="country" value="' + value + '">' + value + '</option>';
                $('#country').append(html);
            });
            $('#loading').hide();
        }
    });
}

$(document).ready(function () {
    $(document).on('change', '#country', function (e) {
        e.preventDefault();
        var country = $(this).val();
        if (country !== '') {
            $.ajax({
                beforeSend: function (xhr) {
                    $('#loading').show();
                    $('#mall').empty();
                    $('#city').empty();
                    $('#city').append('<option value="">City</option>');
                    $('#mall').append('<option value="">Mall</option>');
                },
                type: 'GET',
                url: '<?php echo url('getCityByCountry') ?>',
                dataType: 'json',
                data: {country: country},
                success: function (response)
                {
                    var cnt = Object.keys(response).length;
                    if (cnt > 1) {
                        $.each(response, function (key, value) {
                            var html = '<option value="' + value + '">' + value + '</option>';
                            $('#city').append(html);
                            $('#loading').hide();
                        });
                    } else {
                        $.ajax({
                            beforeSend: function (xhr) {
                                $('#loading').show();
                                $('#mall').empty();
                                $('#mall').append('<option value="">Mall</option>');
                            },
                            type: 'GET',
                            url: '<?php echo url('getMallByCountry') ?>',
                            dataType: 'json',
                            data: {country: country},
                            success: function (response)
                            {
                                $.each(response, function () {
                                    var html = '<option mall_id="' + this.mall_id + '" lat="' + this.lat + '" lng="' + this.lng + '">' + this.name + ' (' + this.totalImage + ')</option>';
                                    // var html = '<a href=""><li id="' + this.mall_id + '" lat="' + this.lat + '" lng="' + this.lng + '">' + this.name + '</li></a>';
                                    $('#mall').append(html);
                                });
                                $('#loading').hide();
                            }
                        });
                    }
                }
            });
        }
    });

    $(document).on('change', '#city', function (e) {
        e.preventDefault();
        var city = $(this).val();
        if (city !== '') {
            $.ajax({
                beforeSend: function (xhr) {
                    $('#loading').show();
                    $('#mall').empty();
                    $('#mall').append('<option value="">Mall</option>');
                },
                type: 'GET',
                url: '<?php echo url('getMallByCity') ?>',
                dataType: 'json',
                data: {city: city},
                success: function (response)
                {
                    $.each(response, function () {
                        var html = '<option mall_id="' + this.mall_id + '" lat="' + this.lat + '" lng="' + this.lng + '">' + this.name + ' (' + this.totalImage + ')</option>';
                        // var html = '<a href=""><li id="' + this.mall_id + '" lat="' + this.lat + '" lng="' + this.lng + '">' + this.name + '</li></a>';
                        $('#mall').append(html);
                    });
                    $('#loading').hide();
                }
            });
        }
    });

    $(document).on('change', '#mall', function (e) {
        e.preventDefault();
        // var mall_id = $(this).attr('mall_id');
        var number = $('#number').find(":selected").text();
        var mall_id = $('#mall').find(":selected").attr('mall_id');
        var map;
        var lat = $('#mall').find(":selected").attr('lat');
        var lng = $('#mall').find(":selected").attr('lng');

        $.ajax({
            beforeSend: function (xhr) {
                $('#loading').show();
            },
            type: 'GET',
            url: '<?php echo url('getImagesByMall2') ?>',
            dataType: 'json',
            data: {mall_id: mall_id, number: number},
            success: function (response)
            {
                map = new GMaps({
                    div: '#main_map',
                    lat: lat,
                    lng: lng,
                    zoom: 10,
                    markerClusterer: function (map) {
                        options = {
                            gridSize: 40,
                            maxZoom: 14
                        }

                        return new MarkerClusterer(map, [], options);

                    },
                });

                var markers_data = [];
                var url = "http://52.74.188.116/image?image_id=";
                if (response.length > 0) {
                    for (var i = 0; i < response.length; i++) {
                        if (response[i].latitude !== '' && response[i].longitude !== '') {

                            markers_data.push({
                                lat: response[i].latitude,
                                lng: response[i].longitude,
                                infoWindow: {
                                    content: '<img src=' + response[i].url + ' height="150" width="150"/><br><a target="_blank" href=' + url + response[i].image_id + '>View detail</a>'
                                            // content: "<div style='background-image: url("+response[i].url+"); height=100px; width=100px'></div><br><a href=' + url + response[i].image_id + '>View detail</a>',
                                },
                            });
                        }
                    }
                }
                map.addMarkers(markers_data);

                $('#loading').hide();
            }
        });
    });

    $(document).on('change', '#number', function (e) {
        e.preventDefault();
        // var mall_id = $(this).attr('mall_id');
        var number = $('#number').find(":selected").text();
        var mall_id = $('#mall').find(":selected").attr('mall_id');
        var map;
        var lat = $('#mall').find(":selected").attr('lat');
        var lng = $('#mall').find(":selected").attr('lng');

        $.ajax({
            beforeSend: function (xhr) {
                $('#loading').show();
            },
            type: 'GET',
            url: '<?php echo url('getImagesByMall2') ?>',
            dataType: 'json',
            data: {mall_id: mall_id, number: number},
            success: function (response)
            {
                map = new GMaps({
                    div: '#main_map',
                    lat: lat,
                    lng: lng,
                    zoom: 10,
                    markerClusterer: function (map) {
                        options = {
                            gridSize: 40,
                            maxZoom: 14
                        }

                        return new MarkerClusterer(map, [], options);

                    },
                });

                var markers_data = [];
                var url = "http://52.74.188.116/image?image_id=";
                if (response.length > 0) {
                    for (var i = 0; i < response.length; i++) {
                        if (response[i].latitude !== '' && response[i].longitude !== '') {

                            markers_data.push({
                                lat: response[i].latitude,
                                lng: response[i].longitude,
                                infoWindow: {
                                    content: '<img src=' + response[i].url + ' height="150" width="150"/><br><a target="_blank" href=' + url + response[i].image_id + '>View detail</a>'
                                            // content: "<div style='background-image: url("+response[i].url+"); height=100px; width=100px'></div><br><a href=' + url + response[i].image_id + '>View detail</a>',
                                },
                            });
                        }
                    }
                }
                map.addMarkers(markers_data);

                $('#loading').hide();
            }
        });
    });

    $(document).on('click', '#mall-list li', function (e) {
        e.preventDefault();
        var mall_id = $(this).attr('id');
        var number = $('#number').find(":selected").text();
        var map;
        var lat = $(this).attr('lat');
        var lng = $(this).attr('lng');

        $.ajax({
            beforeSend: function (xhr) {
                $('#loading').show();
            },
            type: 'GET',
            url: '<?php echo url('getImagesByMall') ?>',
            dataType: 'json',
            data: {mall_id: mall_id, number: number},
            success: function (response)
            {
                map = new GMaps({
                    div: '#main_map',
                    lat: lat,
                    lng: lng,
                    markerClusterer: function (map) {
                        options = {
                            gridSize: 40,
                            maxZoom: 14
                        }

                        return new MarkerClusterer(map, [], options);

                    },
                });

                var markers_data = [];
                var url = "http://128.199.215.18/image?image_id=";
                if (response.length > 0) {
                    for (var i = 0; i < response.length; i++) {
                        if (response[i].latitude !== '' && response[i].longitude !== '') {

                            markers_data.push({
                                lat: response[i].latitude,
                                lng: response[i].longitude,
                                infoWindow: {
                                    content: '<img src=' + response[i].url + ' height="150" width="150"/><br><a href=' + url + response[i].image_id + '>View detail</a>'
                                            // content: "<div style='background-image: url("+response[i].url+"); height=100px; width=100px'></div><br><a href=' + url + response[i].image_id + '>View detail</a>',
                                },
                            });
                        }
                    }
                }
                map.addMarkers(markers_data);

                $('#loading').hide();
            }
        });
    });


});


</script>
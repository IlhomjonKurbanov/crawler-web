
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Test crawler</title>
    </head>
    <style>
        #panel {
            width: 100%;
            float: left;
            clear: both;
            padding: 10px;
            box-sizing: border-box;
        }
        #content {
            width: 100%;
            float: left;
            clear: both;
            box-sizing: border-box;
        }
        #mall {
            width: 300px;
            float: left;
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
            height: 600px;
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
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="///maps.google.com/maps/api/js?sensor=true"></script>
    <script src="https://hpneo.github.io/gmaps/gmaps.js"></script>
    <script type="text/javascript" src="http://travels.devco.net/markerclusterer_compiled.js"></script>

    <body>
        <div id="panel">
            <div class="selector">
                <span>Country</span>
                <select name="" id="country">
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

                </select>
            </div>
        </div>
        <div id="content">
            <div id="mall">
                <div id="markerlist">

                </div>
                <ul id="mall-list">

                </ul>
            </div>
            <div id="map-container">
                <div id="main_map"></div>
            </div>
        </div>

    </body>

</html>
<script type="text/javascript">

    $(document).ready(function () {
        map = new GMaps({
            div: '#main_map',
            lat: 40.088344977,
            lng: -75.393434309,
        });
    });
    window.onload = function () {
        var map;

        $.ajax({
            type: 'GET',
            url: '<?php echo url('getCountry') ?>',
            dataType: 'json',
            success: function (response)
            {
                $.each(response, function (key, value) {
                    var html = '<option value="' + value + '">' + value + '</option>';
                    $('#country').append(html);
                });
            }
        });
    }

    $(document).ready(function () {
        $(document).on('change', '#country', function (e) {
            e.preventDefault();
            var country = $(this).val();
            $.ajax({
                beforeSend: function (xhr) {
                    $('#city').empty();
                },
                type: 'GET',
                url: '<?php echo url('getCityByCountry') ?>',
                dataType: 'json',
                data: {country: country},
                success: function (response)
                {
                    $.each(response, function (key, value) {
                        var html = '<option value="' + value + '">' + value + '</option>';
                        $('#city').append(html);
                    });
                }
            });
        });

        $(document).on('change', '#city', function (e) {
            e.preventDefault();
            var city = $(this).val();
            $.ajax({
                beforeSend: function (xhr) {
                    $('#mall-list').empty();
                },
                type: 'GET',
                url: '<?php echo url('getMallByCity') ?>',
                dataType: 'json',
                data: {city: city},
                success: function (response)
                {
                    $.each(response, function () {
                        var html = '<a href=""><li id="' + this.mall_id + '">' + this.name + '</li></a>';
                        $('#mall-list').append(html);
                    });
                }
            });
        });

        $(document).on('click', '#mall-list li', function (e) {
            e.preventDefault();
            var mall_id = $(this).attr('id');
            var map;

            $.ajax({
                type: 'GET',
                url: '<?php echo url('getImagesByMall') ?>',
                dataType: 'json',
                data: {mall_id: mall_id},
                success: function (response)
                {
                    map = new GMaps({
                        div: '#main_map',
                        lat: 40.088344977,
                        lng: -75.393434309,
                        markerClusterer: function (map) {
                            options = {
                                gridSize: 40
                            }

                            return new MarkerClusterer(map, [], options);
                        }
                    });


                    var markers_data = [];
                    var url = "http://128.199.215.18/public/index.php/image?image_id=";
                    if (response.length > 0) {
                        for (var i = 0; i < response.length; i++) {
                            if (response[i].latitude !== '' && response[i].longitude !== '') {
                                markers_data.push({
                                    lat: response[i].latitude,
                                    lng: response[i].longitude,
                                    infoWindow: {
                                        
                                        content: '<a href='+url+response[i].image_id+'><img src=' + response[i].url + ' /></a>'
                                    },
                                });
                            }
                        }
                    }
                    map.addMarkers(markers_data);
                }
            });
        });


    });


</script>

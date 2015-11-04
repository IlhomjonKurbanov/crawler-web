$(document).ready(function () {
    $("#draggable-1").draggable({helper: 'clone',
        stop: function (e) {
            var point = new google.maps.Point(e.pageX, e.pageY);
            var ll = overlay.getProjection().fromContainerPixelToLatLng(point);
            placeCircle(ll, 'node');
        }
    });

    $("#draggable-2").draggable({helper: 'clone',
        stop: function (e) {
            var point = new google.maps.Point(e.pageX, e.pageY);
            var ll = overlay.getProjection().fromContainerPixelToLatLng(point);
            placeCircle(ll, 'poi');
        }
    });

    $("#draggable-3").draggable({helper: 'clone',
        stop: function (e) {
            var NorthEast = new google.maps.Point(e.pageX + 60, e.pageY + 60);
            var NorthWest = new google.maps.Point(e.pageX - 60, e.pageY + 60);
            var SouthWest = new google.maps.Point(e.pageX - 60, e.pageY - 60);
            var SouthEast = new google.maps.Point(e.pageX + 60, e.pageY - 60);

            var NEBounds = overlay.getProjection().fromContainerPixelToLatLng(NorthEast);
            var NWBounds = overlay.getProjection().fromContainerPixelToLatLng(NorthWest);
            var SWBounds = overlay.getProjection().fromContainerPixelToLatLng(SouthWest);
            var SEBounds = overlay.getProjection().fromContainerPixelToLatLng(SouthEast);

            placeRectangle(NEBounds.lat(), SEBounds.lat(), SEBounds.lng(), NWBounds.lng(), 'rec');
        }
    });
});

var $map;
var $latlng;
var overlay;
var c = 1;
var baseUrl = 'http://localhost/crawler/public/';
function cuniq() {
    var d = new Date(),
            m = d.getMilliseconds() + "",
            u = ++d + m + (++c === 10000 ? (c = 1) : c);
    return u;
}
function initialize() {
    var $latlng = new google.maps.LatLng(44.856474, -93.241643);
    var myOptions = {
        zoom: 15,
        center: $latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
            position: google.maps.ControlPosition.TOP_LEFT
        },
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.LARGE,
            position: google.maps.ControlPosition.LEFT_TOP
        },
        scaleControl: true,
        scaleControlOptions: {
            position: google.maps.ControlPosition.TOP_LEFT
        },
        streetViewControl: false,
        panControl: false,
    };
    $map = new google.maps.Map(document.getElementById("map_canvas"),
            myOptions);

    overlay = new google.maps.OverlayView();
    overlay.draw = function () {
    };
    overlay.setMap($map);
}

function placeCircle(location, type) {
    var color = null;
    if (type === 'node') {
        color = '#FF0000';
    } else if (type === 'poi')
    {
        color = '#0000FF';
    }
    if (type === 'node' || type === 'poi')
    {
        var cityCircle = new google.maps.Circle({
            strokeColor: color,
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: color,
            fillOpacity: 0.35,
            map: $map,
            //position: location,
            center: location,
            radius: 60,
            editable: true,
            draggable: true,
        });
        cityCircle.set('id', cuniq());
        cityCircle.set('type', type);
        saveCirle(cityCircle);
        google.maps.event.addListener(cityCircle, 'center_changed', function ()
        {
            //console.log(cityCircle.getCenter());
        });
        google.maps.event.addListener(cityCircle, 'radius_changed', function ()
        {
            saveCirle(cityCircle);
        });
        google.maps.event.addListener(cityCircle, 'dragend', function ()
        {

            saveCirle(cityCircle);
        });
    }
}

function placeRectangle(north, south, east, west, type)
{
    console.log(north, south, east, west);
    var cityRectangle = new google.maps.Rectangle({
        strokeColor: '#008000',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#008000',
        fillOpacity: 0.35,
        map: $map,
        //position: location,
        bounds: {
            north: north,
            south: south,
            east: east,
            west: west,
        },
        //radius: 60,
        editable: true,
        draggable: true,
    });
    cityRectangle.set('id', cuniq());
    cityRectangle.set('type', type);
    saveRectangle(cityRectangle);
    google.maps.event.addListener(cityRectangle, 'bounds_changed', function ()
    {
        //saveRectangle(cityRectangle);
    });

    google.maps.event.addListener(cityRectangle, 'dragend', function ()
    {

        saveRectangle(cityRectangle);
        //console.log(cityRectangle.getBounds().getNorthEast().lat());
    });

}

function saveRectangle(cityRectangle)
{
    var NElat = cityRectangle.getBounds().getNorthEast().lat();
    var NElng = cityRectangle.getBounds().getNorthEast().lng();
    var SWlat = cityRectangle.getBounds().getSouthWest().lat();
    var SWlng = cityRectangle.getBounds().getSouthWest().lng();

    var id = cityRectangle.get('id');
    var type = cityRectangle.get('type');

    $.ajax({
        type: 'POST',
        url: baseUrl + 'saveRectangle',
        data: {
            NElat: NElat, NElng: NElng, SWlat: SWlat, SWlng: SWlng, id: id, type: type
        },
        success: function (response)
        {
            console.log(response);
        },
        error: function ()
        {

        }
    });
}
function saveCirle(cityCircle)
{
    var lat = cityCircle.getCenter().lat();
    var lng = cityCircle.getCenter().lng();
    var radius = cityCircle.getRadius();
    var id = cityCircle.get('id');
    var type = cityCircle.get('type');
    console.log(lat);
    console.log(lng);
    console.log(radius);
    console.log(id);
    console.log(type);
    $.ajax({
        type: 'POST',
        url: baseUrl + 'saveCircle',
        data: {
            lat: lat, lng: lng, radius: radius, id: id, type: type
        },
        success: function (response)
        {
            console.log(response);
        },
        error: function ()
        {

        }
    });
}


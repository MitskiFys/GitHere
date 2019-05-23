<div type="text/javascript" charset="utf-8" id="mapContainer"></div>
<script>
    // Initialize the platform object:
    //var userName = '<?php //echo $message;?>//';
    //console.log(userName);
    var platform = new H.service.Platform({
        'app_id': 'Sjq1qubybM30IKePxhZS',
        'app_code': '2rjVHKIGNlifRQyLrxOilQ'
    });

    var maptypes = platform.createDefaultLayers();

    var map = new H.Map(
        document.getElementById('mapContainer'),

        maptypes.normal.map,
        {
            zoom: 19,
            center: { lng: 30, lat: 50 },
        });

    var ui = H.ui.UI.createDefault(map, maptypes);

    var mapEvents = new H.mapevents.MapEvents(map);

    var behavior = new H.mapevents.Behavior(mapEvents);


    // Define a callback function to process the routing response:
    var onResult = function(result) {
        var route,
            routeShape,
            startPoint,
            endPoint,
            linestring;
        if(result.response.route) {
            // Pick the first route from the response:
            route = result.response.route[0];
            // Pick the route's shape:
            routeShape = route.shape;

            // Create a linestring to use as a point source for the route line
            linestring = new H.geo.LineString();

            // Push all the points in the shape into the linestring:
            routeShape.forEach(function(point) {
                var parts = point.split(',');
                linestring.pushLatLngAlt(parts[0], parts[1]);
            });

            // Retrieve the mapped positions of the requested waypoints:
            startPoint = route.waypoint[0].mappedPosition;
            endPoint = route.waypoint[1].mappedPosition;

            // Create a polyline to display the route:
            var routeLine = new H.map.Polyline(linestring, {
                style: { strokeColor: 'blue', lineWidth: 10 }
            });

            // Create a marker for the start point:
            var startMarker = new H.map.Marker({
                lat: startPoint.latitude,
                lng: startPoint.longitude
            });

            // Create a marker for the end point:
            var endMarker = new H.map.Marker({
                lat: endPoint.latitude,
                lng: endPoint.longitude
            });

            // Add the route polyline and the two markers to the map:
            map.addObjects([routeLine, startMarker, endMarker]);

            // Set the map's viewport to make the whole route visible:
            map.setViewBounds(routeLine.getBounds());
        }
    };

    // Get an instance of the routing service:
    var router = platform.getRoutingService();

    // Call calculateRoute() with the routing parameters,
    // the callback and an error callback function (called if a
    // communication error occurs):


    navigator.geolocation.getCurrentPosition(function(position) {
        var length = position.coords.longitude;
        var latitude = position.coords.latitude;
        var icon = new H.map.Icon('https://img.icons8.com/color/48/000000/marker.png');
        map.setCenter({lng: length, lat: latitude});
        var marker = new H.map.Marker({ lat: latitude, lng: length }, { icon: icon });
        map.addObject(marker);

        var routingParameters = {
            // The routing mode:
            'mode': 'fastest;pedestrian',
            // The start point of the route:
            'waypoint0': 'geo!'+latitude+','+length,
            // The end point of the route:
            'waypoint1': 'geo!55.790075,37.599758',
            // To retrieve the shape of the route we choose the route
            // representation mode 'display'
            'representation': 'display'
        };

        router.calculateRoute(routingParameters, onResult,
            function(error) {
                alert(error.message);
            });

    });

</script>
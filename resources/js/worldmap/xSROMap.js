// Increase performance with too many markers
L.Marker.addInitHook(function(){
    if(this.options.virtual){
        // setup virtualization after marker was added
        this.on('add',function(){
            this._updateIconVisibility = function() {
                if(this._map == null)
                    return;
                isVisible = this._map.getBounds().contains(this.getLatLng()),
                wasVisible = this._wasVisible,
                icon = this._icon,
                iconParent = this._iconParent,
                shadow = this._shadow,
                shadowParent = this._shadowParent;
                // remember parent of icon 
                if (!iconParent) {
                    iconParent = this._iconParent = icon.parentNode;
                }
                if (shadow && !shadowParent) {
                    shadowParent = this._shadowParent = shadow.parentNode;
                }
                // add/remove from DOM on change
                if (isVisible != wasVisible) {
                    if (isVisible){
                        iconParent.appendChild(icon);
                        if (shadow){
                            shadowParent.appendChild(shadow);
                        }
                    }else{
                        iconParent.removeChild(icon);
                        if (shadow){
                            shadowParent.removeChild(shadow);
                        }
                    }
                    this._wasVisible = isVisible;
                }
            };
            // on map size change, remove/add icon from/to DOM
            this._map.on('resize moveend zoomend', this._updateIconVisibility, this);
            this._updateIconVisibility();
        }, this);
    }
});
/*
 * Silkroad map handler.
 */
var xSROMap = function(){
    'use strict';
    // image host url location
    var imgHost = '../image/worldmap/';
    // map handler
    var map;
    // current tile layer
    var mapLayer;
    var coordGoBack;
    var lastMarkerSelected;
    // mapping
    var mappingLayers = {};
    var mappingMarkers = {
        'npc':{},
        'tp':{},
        'player':{}
    };
    var mappingShapes = {};
    // xSRO Map conversions
    var CoordMapToSRO = function(latlng){
        // world layer
        if(mapLayer == mappingLayers[''])
            return CoordsGameToSRO({'posX':(latlng.lng - 135) * 192,'posY':(latlng.lat - 91) * 192});
        // dungeon layer
        return {'x':(latlng.lng*192-128*192)*10,'y':(latlng.lat*192-127*192)*10,'z':mapLayer.options.posZ,'region':mapLayer.options.region};
    };
    var CoordSROToMap = function(coords) {
        var lng,lat;
        // dungeon?
        if(coords.region > 32767)
        {
            lng = (128 * 192 + coords.x / 10) / 192;
            lat = (127 * 192 + coords.y / 10) / 192;
            return [lat,lng];
        }
        // world coord type
        if(coords.posY && coords.posX)
        {
            lat = ( coords.posY / 192 ) + 91;
            lng = ( coords.posX / 192 ) + 135;
        }
        else
        {
            lng = (coords.region & 0xFF) + coords.x / 1920;
            lat = ( (coords.region >> 8) & 0xFF) + coords.y / 1920 - 1;
        }
        return [lat,lng];
    };
    var CoordsGameToSRO = function(gameCoords) {
        gameCoords['x'] = Math.round(Math.abs(gameCoords.posX) % 192.0 * 10.0);
        if (gameCoords.posX < 0.0)
            gameCoords.x = 1920 - gameCoords.x;
        gameCoords['y'] = Math.round(Math.abs(gameCoords.posY) % 192.0 * 10.0);
        if (gameCoords.posY < 0.0)
            gameCoords.y = 1920 - gameCoords.y;
        gameCoords['z'] = 0;

        var xSector = Math.round((gameCoords.posX - gameCoords.x / 10.0) / 192.0 + 135);
        var ySector = Math.round((gameCoords.posY - gameCoords.y / 10.0) / 192.0 + 92);

        gameCoords['region'] = (ySector << 8) | xSector;
        return gameCoords;
    };
    // initialize layer setup
    var initLayers = function(id){
        // map base
        map = L.map('map', {
            crs: L.CRS.Simple,
            minZoom:0,maxZoom:9,zoomControl:false
        });
        new L.Control.Zoom({ position: 'topright' }).addTo(map);
        new L.Control.Fullscreen({
            position: 'topright',
            title:{
                'false':'Fullscreen',
                'true':'Exit'
            }
        }).addTo(map);
        // Fix circle drawing on CRS.Simple
        L.LatLng.prototype.distanceTo = function (currentPostion) {
            var dx = currentPostion.lng - this.lng;
            var dy = currentPostion.lat - this.lat;
            return Math.sqrt(dx*dx+dy*dy);
        }
        // Fix Tile layer inversed
        var SRLayer = L.TileLayer.extend({
            getTileUrl: function(tile) {
                tile.y = -tile.y;
                return L.TileLayer.prototype.getTileUrl.call(this, tile);
            }
        });
        // 192 map units x 256 tiles = 49152 game units (coords)
        var mapSize = 49152;
        map.fitBounds([[0,0],[mapSize,mapSize]]);

        // Default layer
        mapLayer = new SRLayer(imgHost+'{z}/{x}x{y}.jpg', {
            attribution: '<a href="#">World Map</a>'
        });
        mappingLayers[''] = mapLayer;

        map.addLayer(mapLayer);
        map.setView([91,135], 8);

        // Area layers
        // cave donwhang
        mappingLayers['32769'] = new SRLayer(imgHost+'d/{z}/dh_a01_floor01_{x}x{y}.jpg', {
            attribution: '<a href="#">Donwhang Stone Cave [1F]</a>',
            posZ:0,
            overlap:[
                new SRLayer(imgHost+'d/{z}/dh_a01_floor02_{x}x{y}.jpg', {
                attribution: '<a href="#">Donwhang Stone Cave [2F]</a>',
                posZ:115}),
                new SRLayer(imgHost+'d/{z}/dh_a01_floor03_{x}x{y}.jpg', {
                attribution: '<a href="#">Donwhang Stone Cave [3F]</a>',
                posZ:230}),
                new SRLayer(imgHost+'d/{z}/dh_a01_floor04_{x}x{y}.jpg', {
                attribution: '<a href="#">Donwhang Stone Cave [4F]</a>',
                posZ:345})
            ]
        });
        // cave jangan
        mappingLayers['32775'] = new SRLayer(imgHost+'d/{z}/qt_a01_floor01_{x}x{y}.jpg', {
            attribution: '<a href="#">Underground Level 1 of Tomb of Qui-Shin [B1]</a>'
        });
        mappingLayers['32774'] = new SRLayer(imgHost+'d/{z}/qt_a01_floor02_{x}x{y}.jpg', {
            attribution: '<a href="#">Underground Level 2 of Tomb of Qui-Shin [B2]</a>'
        });
        mappingLayers['32773'] = new SRLayer(imgHost+'d/{z}/qt_a01_floor03_{x}x{y}.jpg', {
            attribution: '<a href="#">Underground Level 3 of Tomb of Qui-Shin [B3]</a>'
        });
        mappingLayers['32772'] = new SRLayer(imgHost+'d/{z}/qt_a01_floor04_{x}x{y}.jpg', {
            attribution: '<a href="#">Underground Level 4 of Tomb of Qui-Shin [B4]</a>'
        });
        mappingLayers['32771'] = new SRLayer(imgHost+'d/{z}/qt_a01_floor05_{x}x{y}.jpg', {
            attribution: '<a href="#">Underground Level 5 of Tomb of Qui-Shin [B5]</a>'
        });
        mappingLayers['32770'] = new SRLayer(imgHost+'d/{z}/qt_a01_floor06_{x}x{y}.jpg', {
            attribution: '<a href="#">Underground Level 6 of Tomb of Qui-Shin [B6]</a>'
        });
        // job temple
        var jobPath = imgHost+'d/{z}/rn_sd_egypt1_01_{x}x{y}.jpg';
        mappingLayers['32784'] = new SRLayer(jobPath,{
            attribution: '<a href="#">Temple</a>'
        });
        mappingLayers['32783'] = new SRLayer(imgHost+'d/{z}/rn_sd_egypt1_02_{x}x{y}.jpg', {
            attribution: '<a href="#">Sanctum of Seth</a>'
        });
        mappingLayers['32782'] = new SRLayer(jobPath,{
            attribution: '<a href="#">Sanctum of Haroeris</a>'
        });
        mappingLayers['32781'] = new SRLayer(jobPath,{
            attribution: '<a href="#">Sanctum of Isis</a>'
        });
        mappingLayers['32780'] = new SRLayer(jobPath,{
            attribution: '<a href="#">Sanctum of Anubis</a>'
        });
        mappingLayers['32779'] = new SRLayer(jobPath,{
            attribution: '<a href="#">Sanctum of Blue Eye</a>'
        });
        // cave generated by fortress war
        mappingLayers['32785'] = new SRLayer(imgHost+'d/{z}/fort_dungeon01_{x}x{y}.jpg', {
            attribution: '<a href="#">Cave of Meditation [1F]</a>'
        });
        // mountain flame
        mappingLayers['32786'] = new SRLayer(imgHost+'d/{z}/flame_dungeon01_{x}x{y}.jpg', {
            attribution: '<a href="#">Flame Mountain</a>'
        });
        // jupiter rooms
        mappingLayers['32787'] = new SRLayer(imgHost+'d/{z}/rn_jupiter_02_{x}x{y}.jpg', {
            attribution: '<a href="#">The Earth\'s Room</a>'
        });
        mappingLayers['32788'] = new SRLayer(imgHost+'d/{z}/rn_jupiter_03_{x}x{y}.jpg', {
            attribution: '<a href="#">Yuno\'s Room</a>'
        });
        mappingLayers['32789'] = new SRLayer(imgHost+'d/{z}/rn_jupiter_04_{x}x{y}.jpg', {
            attribution: '<a href="#">Jupiter\'s Room</a>'
        });
        mappingLayers['32790'] = new SRLayer(imgHost+'d/{z}/rn_jupiter_01_{x}x{y}.jpg', {
            attribution: '<a href="#">Zealots Hideout</a>'
        });
        // 32791 - GM's Room
        // 32792 - Fortress Prison
        // Bahdag room
        mappingLayers['32793'] = new SRLayer(imgHost+'d/{z}/RN_ARABIA_FIELD_02_BOSS_{x}x{y}.jpg', {
            attribution: '<a href="#">Kalia\'s Hideout</a>'
        });
    };
    // initialize UI controls
    var initControls = function(){
        // move back to the last pointer
        L.easyButton({
            states:[{
                icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 576" style="vertical-align:middle"><path fill="#5b5b5b" d="M444.52 3.52L28.74 195.42c-47.97 22.39-31.98 92.75 19.19 92.75h175.91v175.91c0 51.17 70.36 67.17 92.75 19.19l191.9-415.78c15.99-38.39-25.59-79.97-63.97-63.97z"/></svg>',
                title: 'Go Back',
                onClick: function(){
                    setView(coordGoBack);
                }
            }]
        }).addTo(map);
    };
    var initEvents = function(){
        // show SRO coordinates on click
        map.on('click', function (e){
            // add game coords
            var coord = CoordMapToSRO(e.latlng);
            var content = '[<b> X:'+coord.x+" , Y:"+coord.y+" , Z:"+coord.z+" , Region: "+coord.region+' </b>]';
            if(coord.region <= 32767)
                content = "(<b> PosX:"+coord.posX+" , PosY:"+coord.posY+" </b>)<br>"+content;
            // link shortcut
            var copyLink = '<a class="leaflet-popup-copy-button" title="Copy Link" href="#" onClick="xSROMap.LinkToClipboard('+coord.x+','+coord.y+','+coord.z+','+coord.region+')"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 576" style="vertical-align:middle"><path d="M320 448v40c0 13.255-10.745 24-24 24H24c-13.255 0-24-10.745-24-24V120c0-13.255 10.745-24 24-24h72v296c0 30.879 25.121 56 56 56h168zm0-344V0H152c-13.255 0-24 10.745-24 24v368c0 13.255 10.745 24 24 24h272c13.255 0 24-10.745 24-24V128H344c-13.2 0-24-10.8-24-24zm120.971-31.029L375.029 7.029A24 24 0 0 0 358.059 0H352v96h96v-6.059a24 24 0 0 0-7.029-16.97z"/></svg></a>';
            // show popup
            L.popup().setLatLng(e.latlng).setContent(copyLink+content).openOn(map);
        });
        // tracking all shapes created with toolbar at the current layer
        map.on('pm:create',function(e){
            var shape = e.layer;
            shape['xMap'] = {'layer':mapLayer,'type':e.shape,'id':shape._leaflet_id};
            // normalize
            if(e.shape == "Line")
                shape.xMap.type = "Polyline";

            addShapeEditListener(shape);
        });
        // remove
        map.on('pm:remove',function(f){
            delete mappingShapes[f.layer.xMap.id];
        });
    };
    var setInitialView = function(coord) {
        var GET = function(parameter){
            var items = location.search.substr(1).split("&");
            for (var i = 0; i < items.length; i++) {
                var tmp = items[i].split("=");
                if (tmp[0] === parameter)
                    return decodeURIComponent(tmp[1]);
            }
            return null;
        };
        // Reading GET's from coordinates link
        var x = parseFloat(GET("x"));
        var y = parseFloat(GET("y"));
        // filter
        if(!isNaN(x) && !isNaN(y)){
            var z = parseFloat(GET("z"));
            var r = parseFloat(GET("region"));
            if(!isNaN(z) && !isNaN(r))
                setView(fixCoords(x,y,z,r));
            else
                setView(fixCoords(x,y));
        }
        else{
            // Parameters not found, set predefined view
            setView(coord);
        }
    };
    // Set the map layer
    var setMapLayer = function (tileLayer){
        // Do nothing
        if(tileLayer == null) return;
        // Different from current layer?
        if(mapLayer != tileLayer)
        {
            // Clear map
            map.eachLayer(function(layer){
                map.removeLayer(layer);
            });
            // Set the new layer
            mapLayer = tileLayer;
            map.addLayer(mapLayer);

            // init highlight
            lastMarkerSelected = null;
            // Add markers from the new layer
            for (var type in mappingMarkers){
                for (var id in mappingMarkers[type]){
                    var marker = mappingMarkers[type][id];
                    if(marker.options.xMap.layer == mapLayer){
                        marker.addTo(map);
                    }
                }
            }
            // Add shape layers
            for (var id in mappingShapes){
                var shape = mappingShapes[id];
                if(shape.xMap.layer == mapLayer){
                    shape.addTo(map);
                }
            }
        }
    };
    // Return the layer from the specified silkroad coordinate
    var getLayer = function (coord){
        if(coord.region > 32767)
        {
            var layer = mappingLayers[''+coord.region];
            if(layer)
            {
                // check if has overlap at same region
                if(layer.options.overlap)
                {
                    var layers = layer.options.overlap;
                    // check the Z position
                    for (var i = 0; i < layers.length; i++) {
                        if (coord.z < layers[i].options.posZ)
                            break;
                        layer = layers[i];
                    }
                }
                else
                {
                    layer.options['posZ'] = 0;
                }
                // add/override layer region
                layer.options['region'] = coord.region;
            }
            return layer;
        }
        return mappingLayers[''];
    };
    // Set the view using a silkroad coord
    var setView = function (coord){
        // track navigation
        coordGoBack = coord;
        // update layer
        setMapLayer(getLayer(coord));
        // center view
        map.panTo(CoordSROToMap(coord),8);
    };
    var flyView = function (coord){
        // track navigation
        coordGoBack = coord;
        // update layer
        setMapLayer(getLayer(coord));
        // center view
        map.flyTo(CoordSROToMap(coord),8,{duration:2.5});
    };
    // Fix coordinates, return internal silkroad coords
    var fixCoords = function(x,y,z,region) {
        // Fix negative region
        if(region < 0)
            region += 65536;
        // Check coord type
        if(region == null){
            // using x,y as game coords
            return CoordsGameToSRO({'posX':x,'posY':y});
        }
        // using x,y,z,region internal silkroad coords
        return {'x':x,'y':y,'z':z,'region':region};
    };
    // Copy text to clipboard
    var toClipboard = function(text){
        var e = document.createElement('textarea');
        e.value = text;
        document.body.appendChild(e);
        e.select();
        document.execCommand('copy');
        document.body.removeChild(e);
    };
    var addShapeEditListener = function(shape){
        // create register
        mappingShapes[shape.xMap.id] = shape;

        // add popup to marker types only
        if(shape.xMap.type == 'Marker'){
            shape.on('click',function(e){
                // add game coords
                var coord = CoordMapToSRO(e.latlng);
                var content = '[<b> X:'+coord.x+" , Y:"+coord.y+" , Z:"+coord.z+" , Region: "+coord.region+' </b>]';
                if(coord.region <= 32767)
                    content = "(<b> PosX:"+Math.round(coord.posX)+" , PosY:"+Math.round(coord.posY)+" </b>)<br>"+content;
                // add leaflet ID to check differences quickly
                content = '&lt; <b>Marker ID:'+shape.xMap.id+"</b> &gt;<br>" + content;
                L.popup().setLatLng(e.latlng).setContent(content).openOn(map);
            });
        }

        // edit
        shape.on('pm:edit',function(f){
            mappingShapes[f.target.xMap.id] = f.target;
        });

        // polyline/polygons
        shape.on('pm:vertexremoved',function(f){
            if(f.target._latlngs.length == 0)
                delete mappingShapes[f.target.xMap.id];
        });
    };
    return{
        // Initialize silkroad world map
        init:function(id,x=114,y=47.25,z=null,region=null){
            // init stuffs
            initLayers(id);
            initControls();
            initEvents();
            window.onload = setInitialView(fixCoords(x,y,z,region));
        },
        SetZoomLimit:function(minZoom,maxZoom){
            // Check min max values
            if(minZoom < 0) minZoom = 0;
            if(maxZoom > 9) maxZoom = 9;
            // Check wrong values
            if(minZoom > maxZoom){
                var temp = minZoom;
                minZoom = maxZoom;
                maxZoom = temp;
            }
            map.options.minZoom = minZoom;
            map.options.maxZoom = maxZoom;
        },
        // Set the view quickly
        SetView:function(x,y,z=null,region=null){
            // Remove highlight if exists
            if(lastMarkerSelected){
                L.DomUtil.removeClass(lastMarkerSelected._icon, 'leaflet-marker-selected');
                lastMarkerSelected = null;
            }
            // view
            setView(fixCoords(x,y,z,region));
        },
        // Set the view flying
        FlyView:function(x,y,z=null,region=null){
            // Remove highlight if exists
            if(lastMarkerSelected){
                L.DomUtil.removeClass(lastMarkerSelected._icon, 'leaflet-marker-selected');
                lastMarkerSelected = null;
            }
            // view
            flyView(fixCoords(x,y,z,region));
        },
        AddNPC(id,html,x,y,z=null,region=null){
            // Add only new ones
            if(!mappingMarkers['npc'][id]){
                var coord = fixCoords(x,y,z,region);
                // create dimensions
                var iconNPC = new L.Icon({
                    iconUrl: imgHost+'icon/mm_sign_npc.png',
                    iconSize:   [6,6], // (w,h)
                    iconAnchor: [3,3], // (w/2,h/2)
                    popupAnchor:[0,-3] // (0,-h/2)
                });
                // create marker virtualized
                var marker = L.marker(CoordSROToMap(coord),{icon:iconNPC,pmIgnore:true,virtual:true}).bindPopup(html);
                // Check if is from the current layer
                var layer = getLayer(coord);
                if(layer == mapLayer)
                    marker.addTo(map);
                marker.options['xMap'] = {"layer":layer,'coordinates':coord};
                // keep register to not get lost on changing layers
                mappingMarkers['npc'][id] = marker;
            }
        },
        GoToNPC(id){
            var marker = mappingMarkers['npc'][id];
            // check if exists and has a valid layer
            if(marker && marker.options.xMap.layer){
                setView(marker.options.xMap.coordinates);
                // Add/remove highlight
                if(lastMarkerSelected)
                {
                    // reset
                    lastMarkerSelected._icon.style.zIndex =  lastMarkerSelected._icon._leaflet_pos.y;
                    L.DomUtil.removeClass(lastMarkerSelected._icon, 'leaflet-marker-selected');
                }
                lastMarkerSelected = marker;
                marker._icon.style.zIndex = Object.keys(mappingMarkers['npc']).length;
                L.DomUtil.addClass(marker._icon, 'leaflet-marker-selected');
                return true;
            }
            return false;
        },
        AddTeleport(html,type,x,y,z=null,region=null){
            var coord = fixCoords(x,y,z,region);
            // create icon
            var iconNPC;
            switch(type){
                case 1: // fortress 
                    iconNPC = new L.Icon({ iconUrl: imgHost+'icon/fort_worldmap.png', iconSize: [23,45], iconAnchor: [12,17], popupAnchor:[0,-17] });
                    break;
                case 2: // gate of ress
                    iconNPC = new L.Icon({ iconUrl: imgHost+'icon/strut_revival_gate.png', iconSize: [24,24], iconAnchor: [12,12], popupAnchor:[0,-12] });
                    break;
                case 3: // gate of glory
                    iconNPC = new L.Icon({ iconUrl: imgHost+'icon/strut_glory_gate.png', iconSize: [24,24], iconAnchor: [12,12], popupAnchor:[0,-12] });
                    break;
                case 4: // fortress small
                    iconNPC = new L.Icon({ iconUrl: imgHost+'icon/fort_small_worldmap.png', iconSize: [20,31], iconAnchor: [10,15], popupAnchor:[0,-15] });
                    break;
                case 5: // ground teleport
                    iconNPC = new L.Icon({ iconUrl: imgHost+'icon/map_world_icontel.png', iconSize: [22,23], iconAnchor: [11,12], popupAnchor:[0,-12] });
                    break;
                case 6: // tahomet
                    iconNPC = new L.Icon({ iconUrl: imgHost+'icon/tahomet_gate.png', iconSize: [26,28], iconAnchor: [13,14], popupAnchor:[0,-14] });
                    break;
                case 0: // gate
                default:
                    iconNPC = new L.Icon({ iconUrl: imgHost+'icon/xy_gate.png', iconSize: [24,24], iconAnchor: [12,12], popupAnchor:[0,-12] });
                    break;
            }
            // create marker virtualized
            var marker = L.marker(CoordSROToMap(coord),{icon:iconNPC,pmIgnore:true,virtual:true}).bindPopup(html);
            // Check if is from the current layer
            var layer = getLayer(coord);
            if(layer == mapLayer)
                marker.addTo(map);
            marker.options['xMap'] = {"layer":layer,'coordinates':coord};
            // keep register to not get lost on changing layers
            var id = Object.keys(mappingMarkers['tp']).length;
            mappingMarkers['tp'][id] = marker;
        },
        AddPlayer(id,html,x,y,z=null,region=null){
            // Add only new ones
            if(!mappingMarkers['player'][id]){
                var coord = fixCoords(x,y,z,region);
                // create dimensions
                var iconNPC = new L.Icon({
                    iconUrl: imgHost+'icon/mm_sign_otherplayer.png',
                    iconSize:   [6,6],
                    iconAnchor: [3,3],
                    popupAnchor:[0,-3]
                });
                // create marker virtualized
                var marker = L.marker(CoordSROToMap(coord),{icon:iconNPC,pmIgnore:true,virtual:true}).bindPopup(html);
                // Check if is from the current layer
                var layer = getLayer(coord);
                if(layer == mapLayer)
                    marker.addTo(map);
                marker.options['xMap'] = {"layer":layer,'coordinates':coord};
                // keep register to not get lost on changing layers
                mappingMarkers['player'][id] = marker;
            }
        },
        MovePlayer(id,x,y,z=null,region=null){
            var marker = mappingMarkers['player'][id];
            // check if exists and has a valid layer
            if(marker && marker.options.xMap.layer){
                // update the position
                marker.options.xMap.coord = fixCoords(x,y,z,region);
                marker.setLatLng(CoordSROToMap(marker.options.xMap.coord));
                // check if there is a layer change
                var newLayer = getLayer(marker.options.xMap.coord);
                if(marker.options.xMap.layer != newLayer){
                    // add it to the current layer
                    if(newLayer == mapLayer){
                        marker.addTo(map);
                    }
                    // remove it from the current layer
                    else if(marker.options.xMap.layer == mapLayer){
                        map.eachLayer(function(layer){
                            if(layer == marker)
                                map.removeLayer(layer);
                        });
                    }
                    // update layer
                    marker.options.xMap.layer = newLayer;
                }
            }
        },
        GoToPlayer(id){
            var marker = mappingMarkers['player'][id];
            // check if exists and has a valid layer
            if(marker && marker.options.xMap.layer){
                setView(marker.options.xMap.coordinates);
                // Add/remove highlight
                if(lastMarkerSelected)
                {
                    // reset
                    lastMarkerSelected._icon.style.zIndex =  lastMarkerSelected._icon._leaflet_pos.y;
                    L.DomUtil.removeClass(lastMarkerSelected._icon, 'leaflet-marker-selected');
                }
                lastMarkerSelected = marker;
                marker._icon.style.zIndex = Object.keys(mappingMarkers['player']).length;
                L.DomUtil.addClass(marker._icon, 'leaflet-marker-selected');
                return true;
            }
            return false;
        },
        RemovePlayer(id){
            var marker = mappingMarkers['player'][id];
            if(marker && marker.options.xMap.layer){
                // delete from the current layer
                if (marker.options.xMap.layer == mapLayer){
                    // Goes through every object and remove it
                    map.eachLayer(function(layer){
                        if(layer == marker)
                            map.removeLayer(layer);
                    });
                }
                // delete from register
                delete mappingMarkers['player'][id]; 
            }
        },
        LinkToClipboard(x,y,z=null,region=null){
            var coord = fixCoords(x,y,z,region);
            toClipboard(window.location.href.split(/\?|#/)[0]+'?x='+coord.x+'&y='+coord.y+'&z='+coord.z+'&region='+coord.region);
        },
        // Toolbar for drawing and editing geometry shapes
        ShowDrawingToolbar(position,drawMarker,drawCircleMarker,drawPolyline,drawRectangle,drawPolygon,drawCircle,canEdit,canDrag,canCut,canDelete){
            map.pm.addControls({
                position:position,
                drawMarker:drawMarker,
                drawCircleMarker:drawCircleMarker,
                drawPolyline:drawPolyline,
                drawRectangle:drawRectangle,
                drawPolygon:drawPolygon,
                drawCircle:drawCircle,
                editMode:canEdit,
                dragMode:canDrag,
                cutPolygon:canCut,
                removalMode:canDelete
            });
        },
        HideDrawingToolbar(){
            var f = false;
            map.pm.addControls({
                drawMarker:f,
                drawCircleMarker:f,
                drawPolyline:f,
                drawRectangle:f,
                drawPolygon:f,
                drawCircle:f,
                editMode:f,
                dragMode:f,
                cutPolygon:f,
                removalMode:f
            });
        },
        AddDrawingShape(type,param1,param2=null){
            var shape;
            switch(type){
                case "Marker":
                    var coord = fixCoords(param1[0],param1[1],param1[2],param1[3]); 

                    shape = L.marker(CoordSROToMap(coord),{virtual:true});
                    shape['xMap'] = {layer:getLayer(coord)};
                    break;
                case "Polyline":
                case "Polygon":
                    var latlngs = [];
                    for (var i = 0; i < param1.length; i++)
                        latlngs.push(CoordSROToMap(fixCoords(param1[i][0],param1[i][1],param1[i][2],param1[i][3])));

                    shape = type == "Polyline"?L.polyline(latlngs,{virtual:true}):L.polygon(latlngs,{virtual:true});
                    shape['xMap'] = {layer:getLayer(fixCoords(param1[0][0],param1[0][1],param1[0][2],param1[0][3]))};
                    break;
                case "Circle":
                    var coord = fixCoords(param1[0],param1[1],param1[2],param1[3]); 

                    shape = L.circle(CoordSROToMap(coord),param2/192,{virtual:true});
                    shape['xMap'] = {layer:getLayer(coord)};
                    break
                default:
                    return;
            }
            shape.xMap["type"] = type;
            shape.xMap["id"] = new Date().getUTCMilliseconds();
            mappingShapes[shape.xMap.id] = shape;

            // add
            if(shape.xMap.layer == mapLayer)
                shape.addTo(map);

            addShapeEditListener(shape);
        },
        // Returns the all shapes from the current map layer
        GetDrawingShapes(){
            var shapes = [];
            for (var id in mappingShapes){
                var shape = mappingShapes[id];
                if(shape.xMap.layer == mapLayer)
                    shapes.push(shape);
            }
            return shapes;
        },
        ConvertLatLngToCoords(latlng){
            return CoordMapToSRO(latlng);
        },
        ClearDrawingShapes(){
            // Remove one by one
            for (var id in mappingShapes){
                var shape = mappingShapes[id];
                if(shape.xMap.layer == mapLayer){
                    map.eachLayer(function(layer){
                        if(layer == shape)
                            map.removeLayer(layer);
                    });
                }
            }
            mappingShapes = {};
        }
    };
}();
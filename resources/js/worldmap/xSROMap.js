L.Marker.addInitHook(function () {
    if (this.options.virtual) {
        this.on('add', function () {
            this._updateIconVisibility = function () {
                if (this._map == null) {
                    return;
                }
                isVisible = this._map.getBounds().contains(this.getLatLng());
                wasVisible = this._wasVisible;
                icon = this._icon;
                iconParent = this._iconParent;
                shadow = this._shadow;
                shadowParent = this._shadowParent;
                if (!iconParent) {
                    iconParent = this._iconParent = icon.parentNode;
                }
                if (shadow && !shadowParent) {
                    shadowParent = this._shadowParent = shadow.parentNode;
                }
                if (isVisible != wasVisible) {
                    if (isVisible) {
                        iconParent.appendChild(icon);
                        if (shadow) {
                            shadowParent.appendChild(shadow);
                        }
                    } else {
                        iconParent.removeChild(icon);
                        if (shadow) {
                            shadowParent.removeChild(shadow);
                        }
                    }
                    this._wasVisible = isVisible;
                }
            };
            this._map.on('resize moveend zoomend', this._updateIconVisibility, this);
            this._updateIconVisibility();
        }, this);
    }
});
/*
 * Silkroad map handler.
 */
let xSROMap = function () {
    'use strict';
    let imgHost = '/../image/worldmap/';
    let map;
    let mapLayer;
    let coordGoBack;
    let lastMarkerSelected;
    let mappingLayers = {};
    let mappingMarkers = {
        'npc': {},
        'tp': {},
        'player': {}
    };
    let mappingShapes = {};
    let CoordMapToSRO = function (latlng) {
        let coords = {};
        if (mapLayer == mappingLayers[''])
            return CoordsGameToSRO({'posX': (latlng.lng - 135) * 192, 'posY': (latlng.lat - 91) * 192});
        return {
            'x': (latlng.lng * 192 - 128 * 192) * 10,
            'y': (latlng.lat * 192 - 127 * 192) * 10,
            'z': mapLayer.options.posZ,
            'region': mapLayer.options.region
        };
    };
    let CoordSROToMap = function (coords) {
        let lng, lat;
        if (coords.region > 32767) {
            lng = (128 * 192 + coords.x / 10) / 192;
            lat = (127 * 192 + coords.y / 10) / 192;
            return [lat, lng];
        }
        if (coords.posY && coords.posX) {
            lat = (coords.posY / 192) + 91;
            lng = (coords.posX / 192) + 135;
        } else {
            lng = (coords.region & 0xFF) + coords.x / 1920;
            lat = ((coords.region >> 8) & 0xFF) + coords.y / 1920 - 1;
        }
        return [lat, lng];
    };
    let CoordsGameToSRO = function (gameCoords) {
        gameCoords['x'] = Math.round(Math.abs(gameCoords.posX) % 192.0 * 10.0);
        if (gameCoords.posX < 0.0)
            gameCoords.x = 1920 - gameCoords.x;
        gameCoords['y'] = Math.round(Math.abs(gameCoords.posY) % 192.0 * 10.0);
        if (gameCoords.posY < 0.0)
            gameCoords.y = 1920 - gameCoords.y;
        gameCoords['z'] = 0;

        let xSector = Math.round((gameCoords.posX - gameCoords.x / 10.0) / 192.0 + 135);
        let ySector = Math.round((gameCoords.posY - gameCoords.y / 10.0) / 192.0 + 92);

        gameCoords['region'] = (ySector << 8) | xSector;
        return gameCoords;
    };
    let initLayers = function (id) {
        map = L.map('map', {
            crs: L.CRS.Simple,
            minZoom: 0, maxZoom: 8, zoomControl: false
        });
        new L.Control.Zoom({position: 'topright'}).addTo(map);
        L.LatLng.prototype.distanceTo = function (currentPostion) {
            let dx = currentPostion.lng - this.lng;
            let dy = currentPostion.lat - this.lat;
            return Math.sqrt(dx * dx + dy * dy);
        };
        let SRLayer = L.TileLayer.extend({
            getTileUrl: function (tile) {
                tile.y = -tile.y;
                return L.TileLayer.prototype.getTileUrl.call(this, tile);
            }
        });
        let mapSize = 49152;
        map.fitBounds([[0, 0], [mapSize, mapSize]]);

        mapLayer = new SRLayer(imgHost + '{z}/{x}x{y}.jpg');
        mappingLayers[''] = mapLayer;

        map.addLayer(mapLayer);
        map.setView([91, 135], 8);

        // Area layers
        // cave donwhang
        mappingLayers['32769'] = new SRLayer(imgHost + 'd/{z}/dh_a01_floor01_{x}x{y}.jpg', {
            attribution: '<a href="#">Donwhang Stone Cave [1F]</a>',
            posZ: 0,
            overlap: [
                new SRLayer(imgHost + 'd/{z}/dh_a01_floor02_{x}x{y}.jpg', {
                    attribution: '<a href="#">Donwhang Stone Cave [2F]</a>',
                    posZ: 115
                }),
                new SRLayer(imgHost + 'd/{z}/dh_a01_floor03_{x}x{y}.jpg', {
                    attribution: '<a href="#">Donwhang Stone Cave [3F]</a>',
                    posZ: 230
                }),
                new SRLayer(imgHost + 'd/{z}/dh_a01_floor04_{x}x{y}.jpg', {
                    attribution: '<a href="#">Donwhang Stone Cave [4F]</a>',
                    posZ: 345
                })
            ]
        });
        // cave jangan
        mappingLayers['32775'] = new SRLayer(imgHost + 'd/{z}/qt_a01_floor01_{x}x{y}.jpg', {
            attribution: '<a href="#">Underground Level 1 of Tomb of Qui-Shin [B1]</a>'
        });
        mappingLayers['32774'] = new SRLayer(imgHost + 'd/{z}/qt_a01_floor02_{x}x{y}.jpg', {
            attribution: '<a href="#">Underground Level 2 of Tomb of Qui-Shin [B2]</a>'
        });
        mappingLayers['32773'] = new SRLayer(imgHost + 'd/{z}/qt_a01_floor03_{x}x{y}.jpg', {
            attribution: '<a href="#">Underground Level 3 of Tomb of Qui-Shin [B3]</a>'
        });
        mappingLayers['32772'] = new SRLayer(imgHost + 'd/{z}/qt_a01_floor04_{x}x{y}.jpg', {
            attribution: '<a href="#">Underground Level 4 of Tomb of Qui-Shin [B4]</a>'
        });
        mappingLayers['32771'] = new SRLayer(imgHost + 'd/{z}/qt_a01_floor05_{x}x{y}.jpg', {
            attribution: '<a href="#">Underground Level 5 of Tomb of Qui-Shin [B5]</a>'
        });
        mappingLayers['32770'] = new SRLayer(imgHost + 'd/{z}/qt_a01_floor06_{x}x{y}.jpg', {
            attribution: '<a href="#">Underground Level 6 of Tomb of Qui-Shin [B6]</a>'
        });
        // job temple
        let jobPath = imgHost + 'd/{z}/rn_sd_egypt1_01_{x}x{y}.jpg';
        mappingLayers['32784'] = new SRLayer(jobPath, {
            attribution: '<a href="#">Temple</a>'
        });
        mappingLayers['32783'] = new SRLayer(imgHost + 'd/{z}/rn_sd_egypt1_02_{x}x{y}.jpg', {
            attribution: '<a href="#">Sanctum of Seth</a>'
        });
        mappingLayers['32782'] = new SRLayer(jobPath, {
            attribution: '<a href="#">Sanctum of Haroeris</a>'
        });
        mappingLayers['32781'] = new SRLayer(jobPath, {
            attribution: '<a href="#">Sanctum of Isis</a>'
        });
        mappingLayers['32780'] = new SRLayer(jobPath, {
            attribution: '<a href="#">Sanctum of Anubis</a>'
        });
        mappingLayers['32779'] = new SRLayer(jobPath, {
            attribution: '<a href="#">Sanctum of Blue Eye</a>'
        });
        // cave generated by fortress war
        mappingLayers['32785'] = new SRLayer(imgHost + 'd/{z}/fort_dungeon01_{x}x{y}.jpg', {
            attribution: '<a href="#">Cave of Meditation [1F]</a>'
        });
        // mountain flame
        mappingLayers['32786'] = new SRLayer(imgHost + 'd/{z}/flame_dungeon01_{x}x{y}.jpg', {
            attribution: '<a href="#">Flame Mountain</a>'
        });
        // jupiter rooms
        mappingLayers['32787'] = new SRLayer(imgHost + 'd/{z}/rn_jupiter_02_{x}x{y}.jpg', {
            attribution: '<a href="#">The Earth\'s Room</a>'
        });
        mappingLayers['32788'] = new SRLayer(imgHost + 'd/{z}/rn_jupiter_03_{x}x{y}.jpg', {
            attribution: '<a href="#">Yuno\'s Room</a>'
        });
        mappingLayers['32789'] = new SRLayer(imgHost + 'd/{z}/rn_jupiter_04_{x}x{y}.jpg', {
            attribution: '<a href="#">Jupiter\'s Room</a>'
        });
        mappingLayers['32790'] = new SRLayer(imgHost + 'd/{z}/rn_jupiter_01_{x}x{y}.jpg', {
            attribution: '<a href="#">Zealots Hideout</a>'
        });
        // 32791 - GM's Room
        // 32792 - Fortress Prison
        // Bahdag room
        mappingLayers['32793'] = new SRLayer(imgHost + 'd/{z}/RN_ARABIA_FIELD_02_BOSS_{x}x{y}.jpg', {
            attribution: '<a href="#">Kalia\'s Hideout</a>'
        });
    };
    let initControls = function () {
        L.easyButton({
            states: [{
                icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 576" style="vertical-align:middle"><path fill="#5b5b5b" d="M444.52 3.52L28.74 195.42c-47.97 22.39-31.98 92.75 19.19 92.75h175.91v175.91c0 51.17 70.36 67.17 92.75 19.19l191.9-415.78c15.99-38.39-25.59-79.97-63.97-63.97z"/></svg>',
                title: 'Go Back',
                onClick: function () {
                    setView(coordGoBack);
                }
            }]
        }).addTo(map);
    };
    let initEvents = function () {
        // show SRO coordinates on click
        map.on('pm:create', function (e) {
            let shape = e.layer;
            shape['xMap'] = {'layer': mapLayer, 'type': e.shape};
            mappingShapes[shape._leaflet_id] = shape;

            // add popup to marker types only
            if (e.shape == 'Marker') {
                shape.on('click', function (e) {
                    let coord = CoordMapToSRO(e.latlng);
                    let content = '[<b> X:' + coord.x + " , Y:" + coord.y + " , Z:" + coord.z + " , Region: " + coord.region + ' </b>]';
                    if (coord.region <= 32767)
                        content = "(<b> PosX:" + coord.posX + " , PosY:" + coord.posY + " </b>)<br>" + content;
                    content = '&lt; <b>Marker ID:' + shape._leaflet_id + "</b> &gt;<br>" + content;
                    L.popup().setLatLng(e.latlng).setContent(content).openOn(map);
                });
            }

            shape.on('pm:edit', function (f) {
                mappingShapes[f.target._leaflet_id] = f.target;
            });
        });
        map.on('pm:remove', function (e) {
            delete mappingShapes[e.layer._leaflet_id];
        });
    };
    let setInitialView = function (coord) {
        // let GET = function (parameter) {
        //     let items = location.search.substr(1).split("&");
        //     for (let i = 0; i < items.length; i++) {
        //         let tmp = items[i].split("=");
        //         if (tmp[0] === parameter)
        //             return decodeURIComponent(tmp[1]);
        //     }
        //     return null;
        // };
        // let x = parseFloat(GET("x"));
        // let y = parseFloat(GET("y"));
        // if (!isNaN(x) && !isNaN(y)) {
        //     let z = parseFloat(GET("z"));
        //     let r = parseFloat(GET("region"));
        //     if (!isNaN(z) && !isNaN(r)) {
        //         setView(fixCoords(x, y, z, r));
        //     } else {
        //         setView(fixCoords(x, y, 0, 0));
        //     }
        // } else {
        setView(coord);
        // }
    };
    let setMapLayer = function (tileLayer) {
        if (tileLayer == null) return;
        if (mapLayer != tileLayer) {
            map.eachLayer(function (layer) {
                map.removeLayer(layer);
            });
            mapLayer = tileLayer;
            map.addLayer(mapLayer);

            lastMarkerSelected = null;
            for (let type in mappingMarkers) {
                for (let id in mappingMarkers[type]) {
                    let marker = mappingMarkers[type][id];
                    if (marker.options.xMap.layer == mapLayer) {
                        marker.addTo(map);
                    }
                }
            }
            for (let id in mappingShapes) {
                let shape = mappingShapes[id];
                if (shape.xMap.layer == mapLayer) {
                    shape.addTo(map);
                }
            }
        }
    };
    let getLayer = function (coord) {
        if (coord.region > 32767) {
            let layer = mappingLayers['' + coord.region];
            if (layer) {
                if (layer.options.overlap) {
                    let layers = layer.options.overlap;
                    for (let i = 0; i < layers.length; i++) {
                        if (coord.z < layers[i].options.posZ)
                            break;
                        layer = layers[i];
                    }
                } else {
                    layer.options['posZ'] = 0;
                }
                layer.options['region'] = coord.region;
            }
            return layer;
        }
        return mappingLayers[''];
    };
    let setView = function (coord) {
        coordGoBack = coord;
        setMapLayer(getLayer(coord));
        map.panTo(CoordSROToMap(coord), 8);
    };
    let flyView = function (coord) {
        coordGoBack = coord;
        setMapLayer(getLayer(coord));
        map.flyTo(CoordSROToMap(coord), 8, {duration: 2.5});
    };
    let fixCoords = function (x, y, z, region) {
        if (region < 0)
            region += 65536;
        if (region == 0) {
            return CoordsGameToSRO({'posX': x, 'posY': y});
        }
        return {'x': x, 'y': y, 'z': z, 'region': region};
    };
    return {
        init: function (id, x = 114, y = 47.25, z = 0, region = 0) {
            initLayers(id);
            initControls();
            initEvents();
            window.onload = setInitialView(fixCoords(x, y, z, region));
        },
        SetView: function (x, y, z = 0, region = 0) {
            if (lastMarkerSelected) {
                L.DomUtil.removeClass(lastMarkerSelected._icon, 'leaflet-marker-selected');
                lastMarkerSelected = null;
            }
            setView(fixCoords(x, y, z, region));
        },
        FlyView: function (x, y, z = 0, region = 0) {
            if (lastMarkerSelected) {
                L.DomUtil.removeClass(lastMarkerSelected._icon, 'leaflet-marker-selected');
                lastMarkerSelected = null;
            }
            flyView(fixCoords(x, y, z, region));
        },
        AddNPC(id, html, x, y, z = 0, region = 0) {
            if (!mappingMarkers['npc'][id]) {
                let coord = fixCoords(x, y, z, region);
                let iconNPC = new L.Icon({
                    iconUrl: imgHost + 'icon/mm_sign_npc.png',
                    iconSize: [6, 6],
                    iconAnchor: [3, 3],
                    popupAnchor: [0, -3]
                });
                let marker = L.marker(CoordSROToMap(coord), {
                    icon: iconNPC,
                    pmIgnore: true,
                    virtual: true
                }).bindPopup(html);
                let layer = getLayer(coord);
                if (layer == mapLayer)
                    marker.addTo(map);
                marker.options['xMap'] = {"layer": layer, 'coordinates': coord};
                mappingMarkers['npc'][id] = marker;
            }
        },
        GoToNPC(id) {
            let marker = mappingMarkers['npc'][id];
            if (marker && marker.options.xMap.layer) {
                setView(marker.options.xMap.coordinates);
                if (lastMarkerSelected) {
                    lastMarkerSelected._icon.style.zIndex = lastMarkerSelected._icon._leaflet_pos.y;
                    L.DomUtil.removeClass(lastMarkerSelected._icon, 'leaflet-marker-selected');
                }
                lastMarkerSelected = marker;
                marker._icon.style.zIndex = Object.keys(mappingMarkers['npc']).length;
                L.DomUtil.addClass(marker._icon, 'leaflet-marker-selected');
            }
        },
        AddTeleport(html, type, x, y, z = 0, region = 0) {
            let coord = fixCoords(x, y, z, region);
            let iconNPC;
            switch (type) {
                case 1: // fortress
                    iconNPC = new L.Icon({
                        iconUrl: imgHost + 'icon/fort_worldmap.png',
                        iconSize: [23, 45],
                        iconAnchor: [12, 17],
                        popupAnchor: [0, -17]
                    });
                    break;
                case 2: // gate of ress
                    iconNPC = new L.Icon({
                        iconUrl: imgHost + 'icon/strut_revival_gate.png',
                        iconSize: [24, 24],
                        iconAnchor: [12, 12],
                        popupAnchor: [0, -12]
                    });
                    break;
                case 3: // gate of glory
                    iconNPC = new L.Icon({
                        iconUrl: imgHost + 'icon/strut_glory_gate.png',
                        iconSize: [24, 24],
                        iconAnchor: [12, 12],
                        popupAnchor: [0, -12]
                    });
                    break;
                case 4: // fortress small
                    iconNPC = new L.Icon({
                        iconUrl: imgHost + 'icon/fort_small_worldmap.png',
                        iconSize: [20, 31],
                        iconAnchor: [10, 15],
                        popupAnchor: [0, -15]
                    });
                    break;
                case 5: // ground teleport
                    iconNPC = new L.Icon({
                        iconUrl: imgHost + 'icon/map_world_icontel.png',
                        iconSize: [22, 23],
                        iconAnchor: [11, 12],
                        popupAnchor: [0, -12]
                    });
                    break;
                case 6: // tahomet
                    iconNPC = new L.Icon({
                        iconUrl: imgHost + 'icon/tahomet_gate.png',
                        iconSize: [26, 28],
                        iconAnchor: [13, 14],
                        popupAnchor: [0, -14]
                    });
                    break;
                case 0: // gate
                default:
                    iconNPC = new L.Icon({
                        iconUrl: imgHost + 'icon/xy_gate.png',
                        iconSize: [24, 24],
                        iconAnchor: [12, 12],
                        popupAnchor: [0, -12]
                    });
                    break;
            }
            let marker = L.marker(CoordSROToMap(coord), {icon: iconNPC, pmIgnore: true, virtual: true}).bindPopup(html);
            let layer = getLayer(coord);
            if (layer == mapLayer)
                marker.addTo(map);
            marker.options['xMap'] = {"layer": layer, 'coordinates': coord};
            let id = Object.keys(mappingMarkers['tp']).length;
            mappingMarkers['tp'][id] = marker;
        },
        AddPlayer(id, html, x, y, z = 0, region = 0) {
            if (!mappingMarkers['player'][id]) {
                let coord = fixCoords(x, y, z, region);
                let iconNPC = new L.Icon({
                    iconUrl: imgHost + 'icon/mm_sign_otherplayer.png',
                    iconSize: [6, 6],
                    iconAnchor: [3, 3],
                    popupAnchor: [0, -3]
                });
                let marker = L.marker(CoordSROToMap(coord), {
                    icon: iconNPC,
                    pmIgnore: true,
                    virtual: true
                }).bindPopup(html);
                let layer = getLayer(coord);
                if (layer == mapLayer)
                    marker.addTo(map);
                marker.options['xMap'] = {"layer": layer, 'coordinates': coord};
                mappingMarkers['player'][id] = marker;
            }
        },
        MovePlayer(id, x, y, z = 0, region = 0) {
            let marker = mappingMarkers['player'][id];
            if (marker && marker.options.xMap.layer) {
                marker.options.xMap.coord = fixCoords(x, y, z, region);
                marker.setLatLng(CoordSROToMap(marker.options.xMap.coord));
                let newLayer = getLayer(marker.options.xMap.coord);
                if (marker.options.xMap.layer != newLayer) {
                    if (newLayer == mapLayer) {
                        marker.addTo(map);
                    }
                    else if (marker.options.xMap.layer == mapLayer) {
                        map.eachLayer(function (layer) {
                            if (layer == marker)
                                map.removeLayer(layer);
                        });
                    }
                    marker.options.xMap.layer = newLayer;
                }
            }
        },
        RemovePlayer(id) {
            let marker = mappingMarkers['player'][id];
            if (marker && marker.options.xMap.layer) {
                if (marker.options.xMap.layer == mapLayer) {
                    map.eachLayer(function (layer) {
                        if (layer == marker)
                            map.removeLayer(layer);
                    });
                }
                delete mappingMarkers['player'][id];
            }
        },
        getMarkerByPlayerName(playerName) {
            $.each(mappingMarkers['player'], function (key, value) {
                if (value.getPopup().getContent().toLowerCase().indexOf(playerName.toLowerCase()) >= 0) {
                    flyView(value.options.xMap.coordinates);
                    return value.getPopup().getContent();
                }
            });
            return false;
        },
    };
}();

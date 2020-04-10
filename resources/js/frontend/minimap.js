// PosX, posY (in game coordinate)
// or
// X, Y, Z, RegionID (internal game coordinates)
function createSRCoord(x, y, z = null, region = null) {
    // fix negative regions
    if (region < 0)
        region = 65535 + region + 1;

    // fill coordinate info
    let srCoord = {};
    if (region == null) {
        srCoord['posX'] = x;
        srCoord['posY'] = y;

        srCoord['x'] = Math.round(Math.abs(x) % 192.0 * 10.0);
        if (x < 0)
            srCoord.x = 1920 - srCoord.x;
        srCoord['y'] = Math.round(Math.abs(y) % 192.0 * 10.0);
        if (y < 0)
            srCoord.y = 1920 - srCoord.y;
        srCoord['z'] = 0;

        srCoord['xSector'] = Math.round((x - srCoord.x / 10.0) / 192.0 + 135);
        srCoord['ySector'] = Math.round((y - srCoord.y / 10.0) / 192.0 + 92);

        srCoord['region'] = (srCoord.ySector << 8) | srCoord.xSector;
    } else {
        // we guess is an internal coordinate
        srCoord['x'] = x;
        srCoord['y'] = y;
        srCoord['z'] = z;
        srCoord['region'] = region;

        srCoord['xSector'] = Math.round(region & 0xFF);
        srCoord['ySector'] = Math.round(region >> 8);
        srCoord['posX'] = (srCoord.xSector - 135) * 192 + x / 10;
        srCoord['posY'] = (srCoord.ySector - 92) * 192 + y / 10;
    }
    return srCoord;
}

// Load an image to draw into the canvas
function DrawImage(canvasContext, src, x, y, width, height) {
    let img = new Image();
    img.onload = function () {
        canvasContext.drawImage(img, x, y, width, height);
    };
    img.src = src;
}

// Creates a canvas using a silkroad coordinate
function createMinimapCanvas(imgHost, elementId, width, height, x, y, z = null, region = null) {
    let srCoord = createSRCoord(x, y, z, region);
    // init canvas
    let canvas = document.createElement("canvas");
    canvas.width = width;
    canvas.height = height;
    canvas.className = 'img-thumbnail';
    let canvasContext = canvas.getContext("2d");

    // center view
    let tileCount = 2;
    let tileSizeW = width / tileCount;
    let tileSizeH = height / tileCount;
    let tileAvg = parseInt(tileCount / 2) + 1;

    // center view
    let relativePosX = Math.round((srCoord.posX % 192.0) * tileSizeW / 192.0);
    if (srCoord.posX < 0)
        relativePosX += tileSizeW;
    let relativePosY = Math.round((srCoord.posY % 192.0) * tileSizeH / 192.0);
    if (srCoord.posY < 0)
        relativePosY += tileSizeH;
    let marginX = Math.round(tileSizeW / 2.0 - tileSizeW - relativePosX);
    let marginY = Math.round(tileSizeH / 2.0 - tileSizeH * 2 + relativePosY);
    // Fix margin for any tile count
    if (tileCount % 2 == 0) {
        marginX -= tileSizeW / 2;
        marginY -= tileSizeH / 2;
    }

    // Create the canvas (render map)
    let i = 0;
    for (let ySector = srCoord.ySector + tileAvg; ySector >= srCoord.ySector - tileAvg; ySector--) {
        let j = 0;
        for (var xSector = srCoord.xSector - tileAvg; xSector <= srCoord.xSector + tileAvg; xSector++) {
            // at this way, the path will support worldmap only
            DrawImage(canvasContext, imgHost + xSector + "x" + ySector + ".jpg", parseInt(j * tileSizeW + marginX), parseInt(i * tileSizeH + marginY), tileSizeW, tileSizeH);
            j++;
        }
        i++;
    }
    document.getElementById(elementId).appendChild(canvas);
}

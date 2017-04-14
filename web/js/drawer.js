function Drawer(objects) {

    //todo test
    objects = {
        xSize: 100,
        ySize: 50,
        tiles: '12345678901234567890123456789012345678901234567890',
        tilesize: 30
    };

    var drawer = this,
        ScreenPos = {x:0,y:0},
        $canvas = jQuery('#canvas'),
        context = document.getElementById('canvas').getContext('2d'),
        xSize = objects.xSize,
        ySize = objects.ySize,
        tiles = objects.tiles,
        tilesize = objects.tilesize,
        w = window.innerWidth,
        h = window.innerHeight,
        move = false,
        moveStart = {x:0,y:0},
        moveScreenStart = {x:0,y:0},
        templates = {
            circle: '<circle cx="#cx#" cy="#cy#" r="' + (tilesize / 2 - 4) + '" fill="#color#"/>',
            rect: '<rect x="#cx#" y="#cy#" width="' + (tilesize - 2) + '" height="' + (tilesize - 2) + '" fill="#color#" />'
        };

    context.canvas.width  = w;
    context.canvas.height = h;


    /** public methods */
    this.redraw = function () {
        //debug
        var time = performance.now();

        w = window.innerWidth;
        h = window.innerHeight;

        context.canvas.width  = w;
        context.canvas.height = h;

        context.fillStyle = "#000000";
        context.fillRect(0, 0, w, h);

        var xMin = -Math.floor(ScreenPos.x / tilesize),
            yMin = -Math.floor(ScreenPos.y / tilesize),
            xMax = (w - Math.floor(ScreenPos.x)) / tilesize + 1,
            yMax = (h - Math.floor(ScreenPos.y)) / tilesize + 1;

        for (var x = xMin; x <= xMax; x++) {
            for (var y = yMin; y <= yMax; y++) {
                this.drawTile(x, y);
            }
        }

        //debug
        time = performance.now() - time;
        console.log('Время выполнения = ', time);
    };

    this.drawTile = function (x, y) {
        var draw = true;

        switch (this.getTile(x, y)) {
            case '1':
                context.fillStyle = "#008800";
                break;
            case '2':
                context.fillStyle = "#008800";
                break;
            case '3':
                context.fillStyle = "#007700";
                break;
            default:
                context.fillStyle = "#222222";
        }
        if (draw) {
            context.fillRect((x-1) * tilesize + 1 + Math.floor(ScreenPos.x), (y-1) * tilesize + 1 + Math.floor(ScreenPos.y), tilesize - 1, tilesize - 1);
        }
    };

    this.getTile = function (x, y) {
        var char = tiles.charAt((x - 1) * xSize + y-1);
        return (char === '') ? ' ' : char;
    };


    /** private methods */
    this.init = function() {
        this.redraw();
    };

    jQuery(window).resize(function () {
        drawer.redraw();
    });

    $canvas.contextmenu(function () {
        event.preventDefault();
    });

    $canvas.mousedown(function (e) {
        //right mouse button
        if (e.which == '3') {
            move = true;
            moveStart.x = e.screenX;
            moveStart.y = e.screenY;
            moveScreenStart.x = ScreenPos.x;
            moveScreenStart.y = ScreenPos.y;
        }
    });

    $canvas.mouseup(function (e) {
        if (e.which == '3') {
            move = false;
        }
    });

    $canvas.mouseout(function () {
        move = false;
    });

    $canvas.mousemove(function (e) {
        if (move) {
            var deltaX = e.screenX - moveStart.x,
                deltaY = e.screenY - moveStart.y;

            ScreenPos.x = moveScreenStart.x + deltaX;
            ScreenPos.y = moveScreenStart.y + deltaY;

            drawer.redraw();
        }
    });
}

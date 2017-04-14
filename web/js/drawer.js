function Drawer(objects) {

    //todo test
    objects = {
        xSize: 100,
        ySize: 50,
        tiles: '12345678901234567890123456789012345678901234567890',
        tilesize: 30
    };

    var d = this,
        xScreen = 0,
        yScreen = 0,
        context = document.getElementById('canvas').getContext('2d'),
        xSize = objects.xSize,
        ySize = objects.ySize,
        tiles = objects.tiles,
        tilesize = objects.tilesize,
        w = window.innerWidth,
        h = window.innerHeight,
        templates = {
            circle: '<circle cx="#cx#" cy="#cy#" r="' + (tilesize / 2 - 4) + '" fill="#color#"/>',
            rect: '<rect x="#cx#" y="#cy#" width="' + (tilesize - 2) + '" height="' + (tilesize - 2) + '" fill="#color#" />'
        };

    context.canvas.width  = w;
    context.canvas.height = h;


    /** public methods */
    this.getTile = function (x, y) {
        var char = tiles.charAt((x - 1) * xSize + y-1);
        return (char === '') ? ' ' : char;
    };

    this.redraw = function () {
        //debug
        var time = performance.now();

        w = window.innerWidth;
        h = window.innerHeight;

        context.canvas.width  = w;
        context.canvas.height = h;

        context.fillStyle = "#000000";
        context.fillRect(0, 0, w, h);

        var xMin = Math.floor(xScreen),
            yMin = Math.floor(yScreen),
            xMax = (w - Math.floor(xScreen)) / tilesize + 1,
            yMax = (h - Math.floor(yScreen)) / tilesize + 1;

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
            context.fillRect((x-1) * tilesize + 1, (y-1) * tilesize + 1, tilesize - 1, tilesize - 1);
        }
    };


    /** private methods */
    this.init = function() {
        this.redraw();
    };

    $(window).resize(function () {
        d.redraw();
    });

}

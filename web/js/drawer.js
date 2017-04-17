function Drawer(data) {

    //todo выбор направления взгляда

    //todo test
    data = {
        xSize: 100,
        ySize: 50,
        tiles: '1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890',
        units: [
            {id: 1, x: 2, y: 3, type: 'soldier', speed: 4},
            {id: 2, x: 2, y: 4, type: 'sniper', speed: 4},
            {id: 3, x: 5, y: 5, type: 'soldier', speed: 4}
        ],
        vision: [
            {x: 1, y: 2},
            {x: 2, y: 2},
            {x: 3, y: 2},
            {x: 1, y: 3},
            {x: 2, y: 3},
            {x: 3, y: 3},
            {x: 1, y: 4},
            {x: 2, y: 4},
            {x: 3, y: 4}
        ],
        tilesize: 30
    };

    var
        ScreenPos = {x: 0, y: 0},
        $canvas = jQuery('#canvas'),
        context = document.getElementById('canvas').getContext('2d'),
        xSize = data.xSize,
        ySize = data.ySize,
        tiles = data.tiles,
        vision = data.vision,
        tilesize = data.tilesize,
        units = data.units,
        orders = [],
        selectedUnit = false,
        w = window.innerWidth,
        h = window.innerHeight,
        move = false,
        moveStart = {x: 0, y: 0},
        moveScreenStart = {x: 0, y: 0},
        endvar;

    context.canvas.width = w;
    context.canvas.height = h;


    /** public methods */
    this.getOrders = function () {
        return orders;
    };

    this.init = function () {
        redraw();
    };

    this.redraw = function () {
        redraw();
    };




    function redraw() {
        //debug
        // var time = performance.now();

        w = window.innerWidth;
        h = window.innerHeight;

        context.canvas.width = w;
        context.canvas.height = h;

        context.fillStyle = "#000000";
        context.fillRect(0, 0, w, h);

        drawAllTiles();
        drawVision();
        drawAllUnits();
        drawAllOrders();
        drawSelectedUnit();

        //debug
        // time = performance.now() - time;
        // console.log('Время выполнения = ', time);
    }

    function drawAllTiles() {
        var xMin = -Math.floor(ScreenPos.x / tilesize),
            yMin = -Math.floor(ScreenPos.y / tilesize),
            xMax = (w - Math.floor(ScreenPos.x)) / tilesize + 1,
            yMax = (h - Math.floor(ScreenPos.y)) / tilesize + 1;

        for (var x = xMin; x <= xMax; x++) {
            for (var y = yMin; y <= yMax; y++) {
                drawTile(x, y);
            }
        }
    }

    function drawVision() {
        vision.forEach(function (v) {
            context.fillStyle = 'rgba(200, 200, 200, 0.4)';
            context.fillRect(v.x * tilesize + 1 + Math.floor(ScreenPos.x), v.y * tilesize + 1 + Math.floor(ScreenPos.y), tilesize - 1, tilesize - 1);
        });
    }

    function drawAllOrders() {
        orders.forEach(function (order) {
            context.beginPath();
            context.arc(order.unit_x * tilesize + tilesize / 2 + Math.floor(ScreenPos.x), order.unit_y * tilesize + tilesize / 2 + Math.floor(ScreenPos.y), tilesize / 2 - 6, 0, 2 * Math.PI, false);
            context.fillStyle = 'green';
            context.fill();

            context.beginPath();
            context.arc(order.unit_new_x * tilesize + tilesize / 2 + Math.floor(ScreenPos.x), order.unit_new_y * tilesize + tilesize / 2 + Math.floor(ScreenPos.y), tilesize / 2 - 6, 0, 2 * Math.PI, false);
            context.fillStyle = 'green';
            context.fill();

            context.beginPath();
            context.moveTo(order.unit_x * tilesize + tilesize / 2 + Math.floor(ScreenPos.x), order.unit_y * tilesize + tilesize / 2 + Math.floor(ScreenPos.y));
            context.lineTo(order.unit_new_x * tilesize + tilesize / 2 + Math.floor(ScreenPos.x), order.unit_new_y * tilesize + tilesize / 2 + Math.floor(ScreenPos.y));
            context.strokeStyle = 'green';
            context.stroke();
        });
    }

    function drawSelectedUnit() {
        if (selectedUnit !== false) {
            context.beginPath();
            context.arc(selectedUnit.x * tilesize + tilesize / 2 + Math.floor(ScreenPos.x), selectedUnit.y * tilesize + tilesize / 2 + Math.floor(ScreenPos.y), tilesize / 2 - 6, 0, 2 * Math.PI, false);
            context.fillStyle = 'red';
            context.fill();

            //draw posible move
            var speed = selectedUnit.speed;
            for (var x = selectedUnit.x - speed; x <= selectedUnit.x + speed; x++) {
                for (var y = selectedUnit.y - speed; y <= selectedUnit.y + speed; y++) {
                    if (isCanMove(selectedUnit, x, y)) {
                        context.beginPath();
                        context.arc(x * tilesize + tilesize / 2 + Math.floor(ScreenPos.x), y * tilesize + tilesize / 2 + Math.floor(ScreenPos.y), tilesize / 2 - 2, 0, 2 * Math.PI, false);
                        context.fillStyle = 'rgba(200, 200, 200, 0.5)';
                        context.fill();
                    }
                }
            }
        }
    }

    function drawAllUnits() {
        units.forEach(function (unit) {
            drawUnit(unit);
        });
    }

    function drawUnit(unit) {
        var color = 'red';
        switch (unit.type) {
            case 'sniper':
                color = 'gray';
                break;
            case 'soldier':
            default:
                color = 'blue';
                break;
        }

        context.beginPath();
        context.arc(unit.x * tilesize + tilesize / 2 + Math.floor(ScreenPos.x), unit.y * tilesize + tilesize / 2 + Math.floor(ScreenPos.y), tilesize / 2 - 2, 0, 2 * Math.PI, false);
        context.fillStyle = color;
        context.fill();
    }

    function drawTile(x, y) {
        var draw = true;

        switch (getTile(x, y)) {
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
            context.fillRect((x - 1) * tilesize + 1 + Math.floor(ScreenPos.x), (y - 1) * tilesize + 1 + Math.floor(ScreenPos.y), tilesize - 1, tilesize - 1);
        }
    }

    function getTile(x, y) {
        var char = tiles.charAt((x - 1) * xSize + y - 1);
        return (char === '') ? ' ' : char;
    }

    function getUnit(x, y) {
        var u = false;
        units.forEach(function (unit) {
            if (unit.x == x && unit.y == y) {
                u = unit;
            }
        });
        return u;
    }

    function setOrder(unit, x, y) {
        //check distance
        if (!isCanMove(unit, x, y)){
            return false;
        }

        var consilienceOrderId = false,
            newOrder = {
                unit_id: unit.id,
                unit_x: unit.x,
                unit_y: unit.y,
                unit_new_x: x,
                unit_new_y: y
            };

        orders.forEach(function (order, index) {
            if (order.unit_id == unit.id) {
                consilienceOrderId = index;
            }
        });

        if (consilienceOrderId === false) {
            orders.push(newOrder);
        } else {
            orders[consilienceOrderId] = newOrder;
        }

        return true;
    };


    /** private methods */

    function isCanMove(u, x, y) {
        if (getDistance(u.x, u.y, x, y) > u.speed)
            return false;
        if (u.x == x && u.y == y)
            return false;

        return true;
    }

    function getDistance(x1, y1, x2, y2) {
        return Math.floor(Math.sqrt((x2 - x1) * (x2 - x1) + (y2 - y1) * (y2 - y1)));
    }


    /** jQuery functions */
    jQuery(window).resize(function () {
        redraw();
    });

    $canvas.contextmenu(function () {
        event.preventDefault();
    });

    $canvas.mousedown(function (e) {
        //right mouse button
        if (e.which == '3') {
            move = true;
            moveStart.x = e.offsetX;
            moveStart.y = e.offsetY;
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
            var deltaX = e.offsetX - moveStart.x,
                deltaY = e.offsetY - moveStart.y;

            ScreenPos.x = moveScreenStart.x + deltaX;
            ScreenPos.y = moveScreenStart.y + deltaY;

            redraw();
        }
    });

    $canvas.click(function (e) {
        var x = Math.floor((e.offsetX - ScreenPos.x) / tilesize),
            y = Math.floor((e.offsetY - ScreenPos.y) / tilesize),
            u = getUnit(x, y);

        if (u === false && selectedUnit !== false) {
            if (setOrder(selectedUnit, x, y)) {
                selectedUnit = false;
            }
        } else {
            selectedUnit = u;
        }
        redraw();
    });
}

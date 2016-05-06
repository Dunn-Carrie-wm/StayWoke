var engine;
function main() {
    engine = new Engine("canvas", 800, 480);
    engine.resize();
    engine.setClearColor('gray');
    engine.setAutoResize(true);

    engine.init = init;
    engine.update = update;
    engine.render = render;

    engine.start();
}

//GLOBAL VARIABLES GO HERE:
var player;
var world;
var tiles = [];

var background;

function init() {
    var playersheet = new SpriteSheet("res/sprite_player.png");
    player = new Player(new Vector(0, 0), 32, 32, playersheet);
    world = new World();

    var tilesheet = new SpriteSheet("res/sprite_background.png");
    var tileblock = new SpriteSheet("res/sprite_block.png");
    var tilespike = new SpriteSheet("res/sprite_spike.png");


    tiles[2] = new Tile(new Sprite(tilesheet, 0, 0, 32, 32));
    tiles[10] = new Tile(new Sprite(tileblock, 0, 0, 32, 32));
    tiles[3] = new Tile(new Sprite(tilespike, 0, 0, 32, 32));


    background = new Sprite(new SpriteSheet("res/gradient.png"), 0, 0, 800, 480);
}

function update() {
    player.update();
}

function render(context) {
    engine.clear();
    background.render(context, 0, 0);
    world.render(context, player.position.sub(new Vector(12 * 32, 7 * 32)).scale(-1));
    player.render(context);
}

//OBJECT FUNCTIONS GO HERE:
function Player(position, width, height, spritesheet) {
    this.position = position;
    this.width = width;
    this.height = height;

    this.sprites = [];
    this.sprites[0] = new Sprite(spritesheet, 0, 0, 32, 32);
    /*this.sprites[1] = new Sprite(spritesheet, 16 * 1, 24 * 0, 16, 24);
    this.sprites[2] = new Sprite(spritesheet, 16 * 2, 24 * 0, 16, 24);
    this.sprites[3] = new Sprite(spritesheet, 16 * 3, 24 * 0, 16, 24);
    this.sprites[4] = new Sprite(spritesheet, 16 * 0, 24 * 1, 16, 24);
    this.sprites[5] = new Sprite(spritesheet, 16 * 1, 24 * 1, 16, 24);
    this.sprites[6] = new Sprite(spritesheet, 16 * 2, 24 * 1, 16, 24);
    this.sprites[7] = new Sprite(spritesheet, 16 * 3, 24 * 1, 16, 24);
    this.sprites[8] = new Sprite(spritesheet, 16 * 0, 24 * 2, 16, 24);
    this.sprites[9] = new Sprite(spritesheet, 16 * 1, 24 * 2, 16, 24);
    this.sprites[10] = new Sprite(spritesheet, 16 * 2, 24 * 2, 16, 24);
    this.sprites[11] = new Sprite(spritesheet, 16 * 3, 24 * 2, 16, 24);
    this.sprites[12] = new Sprite(spritesheet, 16 * 0, 24 * 3, 16, 24);
    this.sprites[13] = new Sprite(spritesheet, 16 * 1, 24 * 3, 16, 24);
    this.sprites[14] = new Sprite(spritesheet, 16 * 2, 24 * 3, 16, 24);
    this.sprites[15] = new Sprite(spritesheet, 16 * 3, 24 * 3, 16, 24);*/

    this.update = function() {
        if(engine.key("W")) this.position.y -= 2;
        if(engine.key("S")) this.position.y += 2;
        if(engine.key("A")) this.position.x -= 2;
        if(engine.key("D")) this.position.x += 2;

        //COLLISION CODE
        var playerBox = new AABB(this.position.x, this.position.y, this.width, this.height);
        var x = Math.floor(this.position.x / 32);
        var y = Math.floor(this.position.y / 32);
        for(var i = Math.max(0, x - 2); i < Math.min(world.map[0].length, x + 3); i++) {
            for (var j = Math.max(0, y - 2); j < Math.min(world.map.length, y + 3); j++) {
                var tileBox = new AABB(i * 32, j * 32, 32, 32);
                if(world.map[j][i] >= 10 && playerBox.getCollision(tileBox)) {
                    var mtv = playerBox.getTranslationVector(tileBox);
                    this.position = this.position.add(mtv);
                }
            }
        }
    };

    this.render = function(context) {
        this.sprites[0].render(context, 12 * 32, 7 * 32, this.width, this.height);
    };
}

function Tile(sprite, solid) {
    this.sprite = sprite;
    this.solid = solid || false;
    this.width = 32;
    this.height = 32;
    this.render = function(context, x, y, width, height) {
        this.sprite.render(context, x, y, width, height);
    };
}

function World() {
    this.map = [
        [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
        [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
        [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
        [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
        [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
        [10,10,10,10,0,0,0,10,10,10,10,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
        [0,0,0,0,0,0,0,0,0,0,0,10,10,10,10,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
        [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,10,10,10,10,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
        [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,10,10,10,10,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
        [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,10,10,10,10,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
        [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,10,10,10,10,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
        [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
        [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
        [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
        [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,3,3,3,3,3,3,10,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
        [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,10,10,10,10,10,0,10,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
    ];

    for (var i=0;i<this.map.length;i++){
        for (var j=0;j<this.map[0].length;j++) {
        if (this.map[i][j] == 0 && Math.random() < .12)this.map[i][j] = 2;
            }
        }

    this.getWidth = function() {
        return this.map[0].length;
    };
    this.getHeight = function() {
        return this.map.length;
    };
    this.render = function(context, offset) {
        var tileWidth = 32;
        var tileHeight = 32;
        var firstTileX = Math.max(Math.floor((-1 * offset.x) / tileWidth), 0);
        var lastTileX = Math.min(firstTileX + (engine.canvas.width / tileWidth) + 1, this.getWidth());
        var firstTileY = Math.max(Math.floor((-1 * offset.y) / tileHeight), 0);
        var lastTileY = Math.min(firstTileY + (engine.canvas.height / tileHeight) + 1, this.getHeight());
        for(var i = firstTileY; i < lastTileY; i++) {
            for(var j = firstTileX; j < lastTileX; j++) {
                var id = this.map[i][j];
                var tileX = j * tileWidth + offset.x;
                var tileY = i * tileHeight + offset.y;
                var tile = tiles[id];


                if(tile == undefined) console.log(id);
                if(id == 0) {
                    //if(Math.random() < .9) tile.render(context, tileX, tileY);
                }
                    else if (id == 2) {
                    if(Math.random() < .8) tile.render(context, tileX, tileY);
                }
                else {
                    tile.render(context, tileX, tileY);
                }
            }
        }
    };
}

function AABB(x, y, w, h) {
    this.x = x;
    this.y = y;
    this.width = w;
    this.height = h;

    this.getCollision = function(b) {
        if(this.x >= b.x + b.width || this.y >= b.y + b.height || this.x + this.width <= b.x || this.y + this.height <= b.y) return false;
        return true;
    }

    this.getTranslationVector = function(b) {
        var mtv = new Vector(0, 0);

        var amin = this.getMin();
        var amax = this.getMax();
        var bmin = b.getMin();
        var bmax = b.getMax();

        var left = bmin.x - amax.x;
        var right = bmax.x - amin.x;
        var top = bmin.y - amax.y;
        var bottom = bmax.y - amin.y;

        if(Math.abs(left) < right) mtv.x = left;
        else mtv.x = right;
        if(Math.abs(top) < bottom) mtv.y = top;
        else mtv.y = bottom;

        if(Math.abs(mtv.x) < Math.abs(mtv.y)) mtv.y = 0;
        else mtv.x = 0;

        return mtv;
    }

    this.getMin = function() {
        return new Vector(this.x, this.y);
    }
    this.getMax = function() {
        return new Vector(this.x + this.width, this.y + this.height);
    }
}
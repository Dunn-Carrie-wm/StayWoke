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
var player = new Player(0, 0, 32, 32);

function init() {

}

function update() {
    player.update();
}

function render(context) {
    engine.clear();
    player.render(context);
}

//OBJECT FUNCTIONS GO HERE:
function Player(x, y, width, height) {
    this.x = x;
    this.y = y;
    this.width = width;
    this.height = height;

    this.update = function() {
        if(engine.key("W")) this.y -= 1;
        if(engine.key("S")) this.y += 1;
        if(engine.key("A")) this.x -= 1;
        if(engine.key("D")) this.x += 1;
    };

    this.render = function(context) {
        context.fillRect(this.x, this.y, this.width, this.height);
    };
}
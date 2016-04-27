var engine;
function main() {
    engine = new Engine("canvas", 240, 160);
    engine.resize();
    engine.setClearColor('black');
    engine.setAutoResize(true);

    engine.init = init;
    engine.update = update;
    engine.render = render;

    engine.start();
}

function init() {

}

function update() {

}

function render() {

}
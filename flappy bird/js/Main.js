//taille scene
const wST = 500,
    hST = 700;

let textures;
let grnd;
let bird;
let pipe;
let go;
let gr;
let bg;
let life = 3;
let score = 2;
let viebird = []
let rtop, rbot //hitbox pipe
//mvt bird
let angle = 0,
    amplitude = 60;
let phase = 0;
let vx = 3;
let vy = 0,
    acc = 0.2,
    impulsion = -5

//v
let x = 0,
    y = 0;


const app = new PIXI.Application({
    width: wST,
    height: hST,
    backgroundColor: 0x33CC11
});

document.body.appendChild(app.view);

//chargement des textures
const loader = PIXI.Loader.shared;
//my SpriteSheet est id de la textures
loader.add('mySpriteSheet', 'Assets/flappy_bird.json');
loader.load((loader, ressources) => {

    console.log(ressources);
    textures = ressources.mySpriteSheet.textures;

    console.log(textures);
    init()

    // creategrid()
})

function creategrid() {

    /*  for (i=0;i<35;i++)
{
    let test = new PIXI.Sprite(textures['bird0.png']);
    app.stage.addChild(test);
    test.x = x;
    test.y = y;
    x = x + test.width
if (x >= 500)
{x=0;
y = y + test.height
}}*/
    let tEnnemis = []
    for (let i = 0; i < 35; i++) {
        let test = new PIXI.Sprite(textures['bird0.png']);
        app.stage.addChild(test);
        test.x = (i % 7) * test.width
        test.y = Math.floor(i / 7) * test.height;
        tEnnemis.push(test)
    }
    tEnnemis[3].alpha = 0.3;
    tEnnemis[17].rotation = 0.3;
}





function init() {
    createbg()
    createbird()
    createpipe()
    creategrnd()
    creatego()
    creategr()
    createvie()


    //test couleur
    let l = [1, 2, 3, 4, 5, 6, 7, 8, 9, "A", "B", "C", "D", "E", "F"]
    let cl = "0x";
    for (i = 0; i < 7; i++) {
        r = rdm(0, 14);
        // console.log(r);
        r = Math.round(r);
        //console.log(l);
        cl = cl + l[r]
    }



    console.log(cl);
    bird.tint = cl;

    //event
    window.addEventListener('keydown', function (evt) {
        if (evt.keyCode === 32) {
            vy = impulsion;
            phase = 1;
        }
    })


    //animation
    app.ticker.add(() => {
        grnd.x -= 2;
        // grnd %= 120;
        if (grnd.x < -120) {
            grnd.x = 0;
        }

        //collision 
        if (collide(bird.getBounds(), rtop.getBounds()) ||
            collide(bird.getBounds(), rbot.getBounds()) ||
            collide(bird.getBounds(), grnd.getBounds())) {
            bird.y = 350;
            life -= 1;
            if (life == -1) {
                go.alpha = 1;
                phase = 0;
                gr.alpha = 0;
                bird.alpha = 0;
            } else {
                viebird[life].alpha = 0.2
                pipe.x = 500;
                pipe.y = hST * 0.5 + rdm(-200, 200)

                //color
                cl = "0x";
                for (i = 0; i < 7; i++) {
                    r = rdm(0, 14);
                    // console.log(r);
                    r = Math.round(r);
                    //console.log(l);
                    cl = cl + l[r]
                }
                console.log(cl);
                bird.tint = cl;

            }
        }



        if (phase == 0) {
            bird.y = 300 + Math.sin(angle) * amplitude;
            angle += 0.05;
            pipe.alpha = 0;
            gr.alpha = 1;
        } else {
            pipe.alpha = 1;
            gr.alpha = 0;
            bird.y += vy;
            bird.rotation = vy * 0.05;
            vy += acc;

            pipe.x -= score;
            if (pipe.x < -200) {
                pipe.x = 500;
                pipe.y = hST * 0.5 + rdm(-200, 200)
                score += 0.5

            }
            if (bird.y > 700) {
                bird.y = 350;
                life -= 1;
            }
            if (bird.y < 10) {
                bird.y = 10;
            }
        }
        /*
        if (life == 2){
            viebird[0].alpha = 0.2
        }
        if (life == 1){
            viebird[1].alpha = 0.2
        }
        if (life == 0){
            viebird[2].alpha = 0.2
        }*/
        // viebird[life].alpha = 0.2

        if (life == -1) {
            go.alpha = 1;
            phase = 0;
            gr.alpha = 0;
            bird.alpha = 0;
        }

    })

    console.log(collide({
        x: 0,
        y: 0,
        width: 100,
        height: 100
    }, {
        x: 0,
        y: 101,
        width: 100,
        height: 100
    }))

}

function rdm(min, max) {
    return Math.random() * (max - min) + min

}

function collide(r1, r2) {
    if (r1.width + r1.x < r2.x ||
        r1.height + r1.y < r2.y ||
        r2.width + r2.x < r1.x ||
        r2.height + r2.y < r1.y) {
        return false
    }
    return true

    //on peut enlever le if et mettre la condition dans le return 

}



function createbg() {
    bg = new PIXI.Sprite(textures['background.png']);
    app.stage.addChild(bg);

}

function creategrnd() {
    grnd = new PIXI.Sprite(textures['ground.png']);
    app.stage.addChild(grnd);
    grnd.y = 650;


}

function creategr() {
    gr = new PIXI.Sprite(textures['get_ready.png']);
    app.stage.addChild(gr);
    gr.anchor.set(0.5);
    gr.y = hST * 0.5;
    gr.x = wST * 0.5;
}

function creatego() {
    go = new PIXI.Sprite(textures['game_over.png']);
    app.stage.addChild(go);
    go.alpha = 0;
    go.anchor.set(0.5);
    go.y = hST * 0.5;
    go.x = wST * 0.5;
}

function createpipe() {
    pipe = new PIXI.Sprite(textures['pipe.png']);
    app.stage.addChild(pipe);
    pipe.x = 350;
    pipe.y = -hST * (-0.3);
    pipe.anchor.set(0.5);


    rtop = new PIXI.Graphics();
    pipe.addChild(rtop);
    rtop.x = -45;
    rtop.y = -573;
    rtop.beginFill(0, 0.5);
    rtop.drawRect(0, 0, 89, 486);


    rbot = new PIXI.Graphics();
    pipe.addChild(rbot);
    rbot.x = -45;
    rbot.y = 87;
    rbot.beginFill(0, 0.5);
    rbot.drawRect(0, 0, 89, 486);


}


function createbird() {
    bird = new PIXI.AnimatedSprite([
        textures['bird0.png'],
        textures['bird1.png'],
        textures['bird2.png'],
        textures['bird3.png']
    ]);

    app.stage.addChild(bird);
    bird.anchor.set(0.5);
    bird.x = 250;
    bird.y = 500;
    bird.rotation = 0;
    bird.alpha = 1;
    bird.animationSpeed = 0.1;
    bird.play();


}

function createvie() {
    for (let i = 0; i < 3; i++) {
        let vie = new PIXI.Sprite(textures['bird0.png']);
        app.stage.addChild(vie);
        vie.x = (i % 7) * vie.width + 350
        vie.y = 675;
        viebird.push(vie)
        vie.width = vie.width * 0.60;
        vie.height = vie.height * 0.60;
    }

}
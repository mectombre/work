//inport
import ball from "./balls.js";
import pad from "./pad.js";
import G from "./G.js";
import brick from "./brick.js";

//test couleur 
function rdm(min, max) {
    return Math.random() * (max - min) + min

}

function rdmColor() {
    let l = [1, 2, 3, 4, 5, 6, 7, 8, 9, "A", "B", "C", "D", "E", "F"]
    let cl = "0x";
    for (let i = 0; i < 7; i++) {
        let r = rdm(0, 14);
        r = Math.round(r);
        cl = cl + l[r]
        // console.log(cl)

    }
    return cl
}
// création de l'appli pixi

const app = new PIXI.Application({
    width: G.wst,
    height: G.hst,
    backgroundColor: rdmColor(),
    antialias: true
});
document.body.appendChild(app.view);



//ui
let b = new ball(300, 200, 20, rdmColor(), 135, 6);
app.stage.addChild(b);


let p = new pad(0, 200, 20, rdmColor());
app.stage.addChild(p);


let br = new brick(150, 100, 90, 45, rdmColor());
app.stage.addChild(br);

//création des bricks
const tbrick = []
const couleur = [0x00FF00, 0xFFFF00, 0xFF0000];
const cx = (G.wst - (G.wst / 12) - 5 * 45) * 0.5
for (let i = 0; i < 3; i++) {
    for (let j = 0; j < 6; j++) {
        const br2 = new brick(10 + j * (G.wst / 12), i * -100, 90, 45, couleur[i],(i === 0 && j === 3 ? 'big': undefined));
        app.stage.addChild(br2);
        tbrick.push(br2)
    }
}
console.log(tbrick);


//event 

//clavier 
window.addEventListener('keydown', (e) => {
    if (e.keyCode === 39) {
        p.sens = 1;
    } else if (e.keyCode === 37) {
        p.sens = -1;
    }

})
window.addEventListener('keyup', function (e) {
    if (e.keyCode === 39 || p.sens === -1) {
        p.sens = 0;
    } else if (e.keyCode === 37 || p.sens === 1) {
        p.sens = 0;
    }

})
let useMouse =true;
let mouseX
//souris
window.addEventListener('mousemove', (e) => {
    //console.log(e.clientX);

    p.sens = 0;
    mouseX = e.clientX;
    //p.movemouse(e.clientX);
})

//boucle

function gameloop() {
    requestAnimationFrame(gameloop);
    b.move();

    if(useMouse === false){
       p.move(); 
    }else {
        p.movemouse(mouseX);
    }
    
    
    //colision
    if (G.collide(b, br)) {
        //si collision je recherche la face touché
        const faceCollide = G.faceCollide(b.line, br)
        if (faceCollide !== false) {
            b.changeDirection(faceCollide);
            app.stage.removeChild(br);
        }




    }
    if (G.collide(b, p)) {
        //si collision je recherche la face touché
        const faceCollide = G.faceCollide(b.line, p)
        if (faceCollide !== false) {
            b.changeDirection(faceCollide);
        }




    }

    for (let k = 0; k < tbrick.length; k++) {
        if (G.collide(b, tbrick[k])) {
            {

                const faceCollide2 = G.faceCollide(b.line, tbrick[k])
                //console.log(faceCollide2)
                if (faceCollide2 !== false) {
                    b.changeDirection(faceCollide2)
                    //  console.log("sa marche")
                    app.stage.removeChild(tbrick[k]);
                    if(br.bonus !== false)p.applyBigBonus


                    tbrick.splice(k, 1);



                    break;

                }
            }


        }
    }


}





//lance le gameloop
gameloop()
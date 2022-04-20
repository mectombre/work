import G from "./G.js";

// Création d'une classe 
export default class ball extends PIXI.Graphics {
    //constructeur d'instence
    /**
     * @param {number} x : position en x
     * @param {number} y : position en y
     * @param {number} radius : rayon de la balle
     * @param {number} color  : couleur de la balle
     * @param {number} angle  : angle en deg (pour le vecteur)
     * @see htttps://www.bidon.fr
     * 
     * @example
     * let b = new ball (100,100,20,0xFFFFFF,135)
     * b.move();
     * app.stage.Addchild(b); 
     */
    constructor(x, y, radius, color, angle,speed) {
        console.log("nouvelle ball");
        console.log(x, y, radius, color, angle);

        //invoque la classe parent
        super();

        //positionnement de la balle
        this.x = x;
        this.y = y;

        //stocker le rayon et la couleur
        this.radius = radius;
        this.color = color;
        this.speed = speed;


        const a = angle / 180 * Math.PI;
        this.vector = {
            x: Math.cos(a),
            y: Math.sin(a)
        }
        this._draw()
    }

    //dessinner la balle
    _draw() {
        this.beginFill(this.color);
        this.drawCircle(0, 0, this.radius)
    }
    move() {
        this.x += this.vector.x * this.speed;
        this.y += this.vector.y * this.speed;

        if (this.x <= this.radius || this.x >=  G.wst- this.radius) this.vector.x *= -1

        if (this.y <= this.radius || this.y >= G.hst - this.radius) this.vector.y *= -1
    }

    //ligne entre t et t-1
    get line(){
        let currentX = this.x + this.vector.x * this.radius;
        let currentY = this.y + this.vector.y * this.radius;

        let previousX = this.x - this.vector.x * this.radius;
        let previousY = this.y - this.vector.y * this.radius;

        return [{x:currentX,y:currentY},{x:previousX,y:previousY}]
    }

    //fct pour que la balle change de direction
    changeDirection(direction) {
        if(direction === G.FaceCollide.left || direction === G.FaceCollide.right ) 
        {//console.log("left ou right");
        this.vector.x *= -1;
        }

        if(direction === G.FaceCollide.top || direction === G.FaceCollide.bottom ) {this.vector.y *= -1;
            //console.log("haut ou bas")
        }
    }
}

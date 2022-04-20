import G from "./G.js";

export default class brick extends PIXI.Graphics {

    constructor(x,y,width, height, color,bonus = undefined) {
       // console.log("nouveaux brick");
       // console.log(x,width, height, color);

        //invoque la classe parent
        super();

        //positionnement du pad
        this.x = x;
        this.bonus = bonus;
        this.y = y;
        //stocker la taille et la couleur
        this.color = color;
        this.w = width;
        this.h = height;

        this.draw()

    }

    draw() {
        
        this.beginFill(this.color);
        if (this.bonus != undefined){
        this.lineStyle(3,0xFFFFFF);
        console.log("bonus")
        }
        this.drawRect(this.x, G.hst/2,this.w,this.h );

    }
}

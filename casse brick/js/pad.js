import G from "./G.js";

export default class pad extends PIXI.Graphics {

    constructor(x,width, height, color) {
        console.log("nouveaux pad");
        console.log(x,width, height, color);

        //invoque la classe parent
        super();

        //positionnement du pad
        this.x = x;
        
        //stocker la taille et la couleur
        this.color = color;
        this.w = width;
        this.h = height;
        this.draw()

        this._sens = 0
        this.vX = 5
    }

    

    draw() {
        this.beginFill(this.color);
        this.drawRect(this.x, G.hst-35,this.w,this.h );

    }

    movemouse(speed) {
        this.x = speed - this.width/2*0.1}
    move() {
   /*if (p._sens = 0){
            this.x = speed - this.width/2
        }
        */

        //this.x += this._sens * this.vx

        this.x = Math.max(0, Math.min(G.wst - this.w,this.x + this.vX * this._sens));

    }
    applyBigBonus(){
        gsap.to(this.scale,0.3,{x:2,ease:"back.easeOut(1.7)"})
    }

    get sens() {
        return this._sens;
    }

    set sens(value) {
        if(value < -1 || value >1)console.warn("mauvaise val")
        this._sens = Math.max(-1,Math.min(1,value))
    }

}


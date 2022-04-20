export default class G {
    static get wst(){
        return 800;
    }

    static get hst(){
        return 600;
    }

    
    // ////////////////////////////////////////////////////////////////////
    // ////////////////////////////////////////////////////////////////////
    // COLLISIONS /////////////////////////////////////////////////////////
    /** EnumÃ©ration pour savoir quelle est la face en collision avec la balle */
    static FaceCollide = {top:'top', bottom:'bottom', left:'left', right:'right'};

    /** Collision primaire (optimisÃ©e) */
    static collide(elt1, elt2){
        const r1 = elt1.getBounds();
        const r2 = elt2.getBounds();
        if(
            r1.x + r1.width < r2.x ||
            r2.x + r2.width < r1.x ||
            r1.y + r1.height < r2.y ||
            r2.y + r2.height < r1.y
        ) return false;
    
        return true;
    }
    /** Fonction pour tester la collision entre une ligne (balle vecteur) et une brique  */
    static faceCollide(line, elt){
        const p1 = line[0];
        const p2 = line[1];
        const r = elt.getBounds();

        // VÃ©rifie si intersection ligne haut
        if(G._isLinesIntersecting(p1, p2, {x:r.x, y:r.y}, {x:r.x + r.width, y:r.y})) return G.FaceCollide.top;
        // VÃ©rifie si intersection ligne bas
        if(G._isLinesIntersecting(p1, p2, {x:r.x, y:r.y + r.height}, {x:r.x + r.width, y:r.y + r.height})) return G.FaceCollide.bottom;
        // VÃ©rifie si ligne gauche
        if(G._isLinesIntersecting(p1, p2, {x:r.x, y:r.y}, {x:r.x, y:r.y + r.height})) return G.FaceCollide.left;
        // VÃ©rifie si ligne droite
        if(G._isLinesIntersecting(p1, p2, {x:r.x + r.width, y:r.y}, {x:r.x + r.width, y:r.y + r.height})) return G.FaceCollide.right;

        // Aucune intersection
        return false;
    }
    /** Collision qui permet de savoir sur quelle face de la brique la collsion a lieu */
    static _isLinesIntersecting(p1, p2, p3, p4) {
        function CCW(p1, p2, p3) {
            return (p3.y - p1.y) * (p2.x - p1.x) > (p2.y - p1.y) * (p3.x - p1.x);
        }
        return (CCW(p1, p3, p4) != CCW(p2, p3, p4)) && (CCW(p1, p2, p3) != CCW(p1, p2, p4));
    }
}
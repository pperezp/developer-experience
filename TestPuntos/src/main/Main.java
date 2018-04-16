package main;

public class Main {

    public static void main(String[] args) {
        int nivel_limite = 40;
        int base = 3;
        long nivel;
        long nivel_actual = -1;
        
        for (int puntos = 0; true; puntos++) {
            nivel = Math.round((Math.log(puntos) / Math.log(base)));
            
            if(nivel_actual != nivel){
                if(nivel >= 0){
                    System.out.println("Nivel "+nivel+": --> "+puntos);
                }
            }
            
            if(nivel == nivel_limite){
                break;
            }
            
            nivel_actual = nivel;
        }
    }
    
}

package main;

public class Main {

    public static void main(String[] args) {
        int nivel_limite = 100;
        long nivel;
        long nivel_actual = -1;
        
        for (int puntos = 0; true; puntos++) {
            nivel = (int)(Math.sqrt(puntos) * 0.3f);
            
            if(nivel_actual != nivel){
                System.out.println("Nivel "+nivel+": --> "+puntos);
            }
            
            if(nivel == nivel_limite){
                break;
            }
            
            nivel_actual = nivel;
        }
    }
    
}

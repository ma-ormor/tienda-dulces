package marco.servicio.modelo;

public class Mensaje{
  private String cuerpo;
  
  public Mensaje(String cuerpo) {
  	this.cuerpo = cuerpo;
	}//builder

	public String getCuerpo() {return cuerpo;}
}//class
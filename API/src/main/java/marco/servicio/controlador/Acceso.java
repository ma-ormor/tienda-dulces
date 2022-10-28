package marco.servicio.controlador;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import marco.servicio.interfaz.RepositorioUsuario;
import marco.servicio.modelo.Mensaje;
import marco.servicio.modelo.Usuario;

@RestController @RequestMapping("/acceso")
public class Acceso{
	@Autowired RepositorioUsuario usuarios;
	
	@PostMapping
  public Mensaje entrar(
    @RequestParam(value="alias") String alias,
    @RequestParam(value="contraseña") String contrasena
  ) {
		String cuerpo = "entrar " + alias + " " + contrasena;
		Usuario usuario = usuarios.findByAlias(alias); 
		
		if(
			usuario != null && usuario.getContrasena().equals(contrasena)) 
			  return new Mensaje("Correto");
  	return new Mensaje(cuerpo);
  }//method
	
	@PutMapping
  public Mensaje salir(
    @RequestParam(value="id_usuario") String claveUsuario
  ) {
		String cuerpo = "salir " + claveUsuario;
		
  	return new Mensaje(cuerpo);
  }//method
}//class
package marco.servicio.controlador;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import marco.servicio.interfaz.RepositorioUsuario;
import marco.servicio.modelo.Mensaje;
import marco.servicio.modelo.Usuario;

@RestController @RequestMapping("/usuario")
public class ServicioUsuario{
	@Autowired private RepositorioUsuario usuarios;
	
	@GetMapping
  public Iterable<Usuario> leer() {
		return usuarios.findAll();
  }//method
	
	@PostMapping
  public Mensaje crear(
    @RequestParam(value="alias") String alias,
    @RequestParam(value="contraseña") String contrasena
  ) {
		Usuario nuevo = new Usuario();
		
		nuevo.setAlias(alias);
		nuevo.setContrasena(contrasena);
		nuevo.setRol("cliente");

		usuarios.save(nuevo);
		
  	return new Mensaje("Registrado");
  }//method
	
	@PutMapping
  public Mensaje actualizar(
    @RequestParam(value="id") int clave,
    @RequestParam(value="alias") String alias,
    @RequestParam(value="contraseña") String contrasena
  ) {
		Usuario usuario = usuarios.findById(clave).get();
		
		usuario.setClave(clave);
		usuario.setAlias(alias);
		usuario.setContrasena(contrasena);
		usuario.setRol("cliente");
		
		usuarios.save(usuario);
		
  	return new Mensaje("Actualizado");
  }//method
	
	@DeleteMapping
  public Mensaje borrar(@RequestParam(value="id") int clave) {
		String cuerpo = "borrar "+clave;
		
		usuarios.deleteById(clave);
		
  	return new Mensaje(cuerpo);
  }//method
}//class
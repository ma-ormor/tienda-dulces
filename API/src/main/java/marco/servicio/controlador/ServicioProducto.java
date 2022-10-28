package marco.servicio.controlador;

import java.util.NoSuchElementException;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import marco.servicio.interfaz.RepositorioProducto;
import marco.servicio.modelo.Mensaje;
import marco.servicio.modelo.Producto;

@RestController @RequestMapping("/producto")
public class ServicioProducto{
	@Autowired private RepositorioProducto productos;
	
	@GetMapping
  public Iterable<Producto> leerTodos() {
  	return productos.findAll(); 
  }//method
	
	@GetMapping("/{id}")
	public Producto leer(@PathVariable("id") int clave) {
		return productos.findById(clave).get();
	}

	@PostMapping
  public Mensaje crear(
    @RequestParam(value="nombre") String nombre,
    @RequestParam(value="descripcion") String descripcion,
    @RequestParam(value="cantidad") int cantidad,
    @RequestParam(value="costo") double costo
  ) {
		String cuerpo = "Creado";
		Producto nuevo = new Producto();
		
		nuevo.setNombre(nombre);
		nuevo.setDescripcion(descripcion);
		nuevo.setCantidad(cantidad);
		nuevo.setCosto(costo);
		
		productos.save(nuevo);
		
  	return new Mensaje(cuerpo);
  }//method
	
	@PutMapping
  public Mensaje actualizar(
    @RequestParam(value="id") int clave,
    @RequestParam(value="nombre") String nombre,
    @RequestParam(value="descripcion") String descripcion,
    @RequestParam(value="cantidad") int cantidad,
    @RequestParam(value="costo") double costo
  ) {
		String cuerpo = "Actualizado";
		Producto producto = productos.findById(clave).get();
		
		if(producto == null) return new Mensaje("Error");

		producto.setNombre(nombre);
		producto.setDescripcion(descripcion);
		producto.setCantidad(cantidad);
		producto.setCosto(costo);

		productos.save(producto);

  	return new Mensaje(cuerpo);
  }//method
	
	@DeleteMapping
  public Mensaje borrar(@RequestParam(value="id") int clave) {
		String cuerpo = "borrar " + clave;
		
		productos.deleteById(clave); 
		
  	return new Mensaje(cuerpo);
  }//method
}//class
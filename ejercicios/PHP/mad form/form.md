# Código de `form.html`

```
<!DOCTYPE html>
<html>
  <head>
    <title>Formulario</title>
  </head>

  <body>
    <h1>Ejemplo de formulario</h1>
    <p>Por favor, rellene los siguientes datos y haga click en el botón Enviar.</p>

    <form action="procesar_formulario.php" method="post">
      <label for="nombre">Nombre</label>
      <input type="text" name="nombre" id="nombre" value="" />

      <label for="apellido">Apellido</label>
      <input type="text" name="apellido" id="apellido" value="" />

      <label for="password1">Contraseña</label>
      <input type="password" name="password1" id="password1" value="" />

      <label for="password2">Repita la contraseñaa</label>
      <input type="password" name="password2" id="password2" value="" />

      <label for="gustaChocolate">Me gusta el chocolate:</label>
      <input type="radio" name="chocolate" id="gustaChocolate" value="S" />
      <label for="noGustaChocolate">No me gusta el chocolate:</label>
      <input type="radio" name="chocolate" id="noGustaChocolate" value="N" />

      <label for="rangoEdad">Rango de edad</label>
      <select name="rangoEdad" id="rangoEdad" size="1">
        <option value="infante">Infante</option>
        <option value="adolescente">Adolescente</option>
        <option value="adulto">Adulto</option>
        <option value="mayor">Mayor</option>
      </select>

      <label for="deporte">&iquest;Practicas deporte&#63</label>
      <input type="checkbox" name="deporte" id="deporte" value="S&iacute;" />

      <label for="comentarios">&iquest;Alg&uacute;n comentario?</label>
      <textarea name="comentarios" id="comentarios" rows="4" cols="50"> </textarea>

      <input type="submit" name="botonDeEnvio" id="botonDeEnvio"
      value="Enviar datos" />
      <input type="reset" name="bontonDeReset" id="botonDeReset"
      value="Vaciar formulario" />
    </form>
  </body>
</html>
```

# Código de `procesar_formulario.php`

```

```

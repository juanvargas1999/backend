<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil</title>
  <link rel="stylesheet" href="../../css/estilos_admin_doc.css">
  <link rel="stylesheet" href="../../css/estilo_perfil.css">
</head>
<body>

  <?php include 'nav.php'; ?>

  <div class="contenido">
    <h1>Perfil del Usuario</h1>

    <div class="perfil-grid">
      <!-- Columna izquierda - Datos del usuario -->
      <div class="datos-usuario">
        <div class="campo-dato">
          <span class="etiqueta">Nombre</span>
          <span class="valor">Juan Pérez</span>
        </div>
        <div class="campo-dato">
          <span class="etiqueta">Edad</span>
          <span class="valor">30</span>
        </div>
        <div class="campo-dato">
          <span class="etiqueta">Cédula</span>
          <span class="valor">1234567890</span>
        </div>
        <div class="campo-dato">
          <span class="etiqueta">Correo</span>
          <span class="valor">juan.perez@email.com</span>
        </div>
        <div class="campo-dato">
          <span class="etiqueta">Aspirante a Cargo</span>
          <span class="valor">Desarrollador Web</span>
        </div>
        <div class="campo-dato">
          <span class="etiqueta">Área</span>
          <span class="valor">Tecnología</span>
        </div>
      </div>

      <!-- Columna derecha - Foto y botón -->
      <div class="seccion-foto">
        <div class="foto-perfil">
          <img src="../../img/foto_perfil.jpg" alt="Foto de perfil">
        </div>
        <button class="btn-cambiar">Cambiar Contraseña</button>
      </div>
    </div>
  </div>

</body>
</html>
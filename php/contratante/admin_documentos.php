<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrar Documentos</title>
  
  <link rel="stylesheet" href="../../../css/estilos_admin_doc.css">
</head>
<body>

  <?php include 'nav.php'; ?>

  <!-- Contenido principal -->
  <div class="contenido">
    <h1>Administrar Documentos</h1>

    <table>
      <thead>
        <tr>
          <th>Documento</th>
          <th>Estado</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Documento1.pdf</td>
          <td>Pendiente</td>
          <td><button class="btn">Ver</button></td>
        </tr>
        <tr>
          <td>Documento2.docx</td>
          <td>Aprobado</td>
          <td><button class="btn">Descargar</button></td>
        </tr>
        <tr>
          <td>Documento3.xlsx</td>
          <td>Rechazado</td>
          <td><button class="btn">Revisar</button></td>
        </tr>
      </tbody>
    </table>
  </div>

</body>
</html>

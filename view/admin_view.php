<?php
class AdminView{
    function mostrarPanelAdmin($autores, $libros){
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Panel de Administración</title>
            <link rel="stylesheet" href="./css/style.css">
            </head>
        <body>
        <h1>Panel de Administración (ABM)</h1>
        
        <p>
            <a href="router.php?action=logout">[ Cerrar Sesión ]</a> | 
            <a href="router.php?action=showLibros">Ir a la Vista Pública</a>
        </p>
        <hr>

        <h2>
            Administrar Autores
            <a href="router.php?action=agregarAutorForm" style="margin-left: 20px;">[ + Agregar Autor ]</a>
        </h2>
        
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <!--<th>ID</th>-->
                    <th>Nombre</th>
                    <th>Nacionalidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($autores as $autor): ?> 
                <tr>
                    <!--<td><?= htmlspecialchars($autor->id_autor) ?></td>-->
                    <td><?= htmlspecialchars($autor->nombre . ' ' . $autor->apellido) ?></td>
                    <td><?= htmlspecialchars($autor->nacionalidad) ?></td>
                    <td>
                        <a href="router.php?action=editarAutorForm/<?= $autor->id_autor ?>">Editar</a> | 
                        
                        <a href="router.php?action=eliminarAutor/<?= $autor->id_autor ?>" 
                           onclick="return confirm('¿Está seguro de eliminar a este autor?');">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <hr>

        <h2>
            Administrar Libros
            <a href="router.php?action=agregarLibroForm" style="margin-left: 20px;">[ + Agregar Libro ]</a>
        </h2>
        
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Género</th>
                    <th>Año</th>
                    <th>Editorial</th>
                    <th>Autor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($libros as $libro): ?> 
                <tr>
                    <td><?= htmlspecialchars($libro->titulo) ?></td>
                    <td><?= htmlspecialchars($libro->genero) ?></td>
                    <td><?= htmlspecialchars($libro->anio_publicacion) ?></td>
                    <td><?= htmlspecialchars($libro->editorial) ?></td>
                    <td>
                        <?= htmlspecialchars($libro->nombre_autor . ' ' . $libro->apellido_autor) ?>
                    </td>
                    <td>
                        <a href="router.php?action=editarLibroForm/<?= $libro->id_libro ?>">
                            Editar
                        </a>
                        <a href="router.php?action=eliminarLibro/<?= $libro->id_libro ?>"
                        onclick="return confirm('¿Está seguro de eliminar este libro?');">
                        Eliminar
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        </body>
        </html>
        <?php
    }
}
?>
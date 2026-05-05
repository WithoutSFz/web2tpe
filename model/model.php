<?php
include_once 'config.php';
class Model {
    protected $db;

    function __construct(){
        $this->db = new PDO('mysql:host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
        $this->createDatabase();
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        $this->deploy();
    }

    function createDatabase(){
        $sql = 'CREATE DATABASE IF NOT EXISTS ' . DB_NAME . ' CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci';
        $this->db->exec($sql);
    }

    function deploy(){
        $query= $this->db->query('SHOW TABLES');
        $tables=$query->fetchAll();

        if (count($tables)==0){
            $sql = <<<END

            --
            -- Estructura de tabla para la tabla `autores`
            --

            CREATE TABLE `autores` (
            `id_autor` int(11) NOT NULL,
            `nombre` varchar(100) NOT NULL,
            `apellido` varchar(100) NOT NULL,
            `nacionalidad` varchar(50) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            -- --------------------------------------------------------

            --
            -- Estructura de tabla para la tabla `libros`
            --

            CREATE TABLE `libros` (
            `id_libro` int(11) NOT NULL,
            `titulo` varchar(150) NOT NULL,
            `genero` varchar(50) NOT NULL,
            `anio_publicacion` int(11) NOT NULL,
            `editorial` varchar(100) NOT NULL,
            `id_autor` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            -- --------------------------------------------------------

            --
            -- Estructura de tabla para la tabla `usuarios`
            --

            CREATE TABLE `usuarios` (
            `id_usuario` int(11) NOT NULL,
            `email` varchar(100) NOT NULL,
            `password` varchar(255) NOT NULL,
            `rol` varchar(50) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            --
            -- Volcado de datos para la tabla `usuarios`
            --

            INSERT INTO `usuarios` (`id_usuario`, `email`, `password`, `rol`) VALUES
            (1, 'webadmin', '\$2y\$10\$X0uGZPuF2KrPk5IrOFQMrOITK.A47HKGO8Z202eNap9zZE.FgtCPS', 'admin');

            --
            -- Índices para tablas volcadas
            --

            --
            -- Indices de la tabla `autores`
            --
            ALTER TABLE `autores`
            ADD PRIMARY KEY (`id_autor`);

            --
            -- Indices de la tabla `libros`
            --
            ALTER TABLE `libros`
            ADD PRIMARY KEY (`id_libro`),
            ADD UNIQUE KEY `id_autor` (`id_autor`);

            --
            -- Indices de la tabla `usuarios`
            --
            ALTER TABLE `usuarios`
            ADD PRIMARY KEY (`id_usuario`);

            --
            -- AUTO_INCREMENT de las tablas volcadas
            --

            --
            -- AUTO_INCREMENT de la tabla `autores`
            --
            ALTER TABLE `autores`
            MODIFY `id_autor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

            --
            -- AUTO_INCREMENT de la tabla `libros`
            --
            ALTER TABLE `libros`
            MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT;

            --
            -- AUTO_INCREMENT de la tabla `usuarios`
            --
            ALTER TABLE `usuarios`
            MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

            --
            -- Restricciones para tablas volcadas
            --

            --
            -- Filtros para la tabla `libros`
            --
            ALTER TABLE `libros`
            ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id_autor`);
            COMMIT;
            END;

            $this->db->exec($sql);
        }
    }
}
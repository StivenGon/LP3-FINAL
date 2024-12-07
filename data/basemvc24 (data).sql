--
-- Base de datos: `bibliochida`
--


--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_roles`, `nombre`) VALUES (1, 'Administrador');

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO
    `usuario` (
        `id_usuario`,
        `alias`,
        `clave`,
        `id_roles`
    )
VALUES (
        1,
        'admin',
        '$2y$10$KhjbF5ve6XXWmY1ZAL.Vu.AsrVt6jvP8WMWSkPWwDHN9UIDkVHeCi',
        1
    );

COMMIT;
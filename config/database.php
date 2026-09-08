<?php

/**
 * Returns the database connection.
 *
 * If the connection already exists, it is used.
 * This avoids creating a new connection every time.
 *
 * @return PDO The PDO database connection.
 */
function getPDO(): PDO
{
    static $pdo = null;

    if ($pdo === null) {

        $pdo = new PDO('sqlite:' . DB_PATH);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    return $pdo;
}

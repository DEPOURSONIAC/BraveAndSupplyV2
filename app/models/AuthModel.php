<?php

function createUser(string $name, string $email, string $address, string $hashed_password): bool {
    /*
        Crée un nouvel utilisateur.
    */

    $db = getPDO();

    try {
        $created = false;

        if (!emailExists($email)) {
            $sql = "INSERT INTO users ( name, email, password, address) VALUES (?, ?, ?, ?)";

            $stmt = $db->prepare($sql);

            $created = $stmt->execute([$name, $email, $hashed_password,$address,]);
        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $created;
}

function emailExists(string $email): bool
{
    /*
        Vérifie si une adresse email
        est déjà utilisée.
    */

    $db = getPDO();

    try {
        $sql = "SELECT 1 FROM users WHERE email = ? LIMIT 1";

        $stmt = $db->prepare($sql);
        $stmt->execute([$email]);

        $exists = $stmt->fetch() !== false;

    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $exists;
}

function getUserByEmail(string $email): ?array
{
    /*
        Retourne un utilisateur
        à partir de son adresse email.
    */

    $db = getPDO();

    try {

        $user = null;

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";

            $stmt = $db->prepare($sql);
            $stmt->execute([$email]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $user = $result;
            }
        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $user;
}
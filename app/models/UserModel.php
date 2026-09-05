<?php

function getUserById(int $user_id): ?array
{
    /*
        Retourne un utilisateur
        à partir de son identifiant.
    */

    $db = getPDO();
    $user = null;

    try {
        $sql = "SELECT * FROM users WHERE id = ? LIMIT 1";

        $stmt = $db->prepare($sql);
        $stmt->execute([$user_id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $user = $result;
        }

    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $user;
}


function getAllUsers(): array
{
    /*
        Retourne tous les utilisateurs.
    */

    $db = getPDO();
    $users = [];

    try {
        $sql = "SELECT * FROM users ORDER BY id DESC";

        $stmt = $db->query($sql);

        if ($stmt) {
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $users;
}


function updateUser(int $user_id, string $name, string $email, string $address,?string $passwordHash = null): bool 
{
    /*
        Met à jour les informations
        d'un utilisateur.

        Le mot de passe doit déjà être hashé
        avant d'arriver dans cette fonction.
    */

    $db = getPDO();
    $updated = false;

    try {
        $name = trim($name);
        $email = strtolower(trim($email));
        $address = trim($address);

        if ($user_id > 0 && $name !== '' && $email !== '' && $address !== '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if ($passwordHash !== null) {
                $sql = "UPDATE users SET name = ?, email = ?, address = ?, password = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";

                $stmt = $db->prepare($sql);

                $updated = $stmt->execute([$name, $email, $address, $passwordHash, $user_id]);

            } else {
                $sql = "UPDATE users SET name = ?, email = ?, address = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";

                $stmt = $db->prepare($sql);

                $updated = $stmt->execute([$name, $email, $address, $user_id]);
            }
        }

    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $updated;
}


function deleteUser(int $user_id): bool
{
    /*
        Supprime
        un utilisateur.
    */

    $db = getPDO();
    $deleted = false;

    try {
        if ($user_id > 0) {
            $sql = "DELETE FROM users WHERE id = ?";

            $stmt = $db->prepare($sql);

            $deleted = $stmt->execute([$user_id]);
        }

    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $deleted;
}
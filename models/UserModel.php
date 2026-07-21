<?php

function getUserById(int $id): ?array
{
    /*
        Retourne un utilisateur
        à partir de son identifiant.
    */

    $db = getPDO();

    $sql = "SELECT id, name, email, password, address, role, created_at FROM users WHERE id = ? LIMIT 1";

    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $user = $result ?: null;

    return $user;
}

function getAllUsers(): array
{
    /*
        Retourne tous les utilisateurs.
    */

    $db = getPDO();

    $sql = "SELECT * FROM users ORDER BY id DESC";

    $stmt = $db->query($sql);

    $users = [];

    if ($stmt) {
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $users;
}

function updateUser(int $id, string $name, string $email, string $password, string $address): bool
{
    /*
        Met à jour
        un utilisateur.
    */

    $db = getPDO();

    $updated = false;

    $email = strtolower(trim($email));

    if (!empty($name) && !empty($email) && !empty($address) && !empty($password) && filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {

            try {

            $sql = "UPDATE users SET name = ?, email = ?, password = ?, address = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";

            $stmt = $db->prepare($sql);

            $updated = $stmt->execute([$name, $email, $password, $address, $id]);

        } catch (PDOException $e) {
            error_log(__FUNCTION__ . '(): ' . $e->getMessage());
        }
    }

    return $updated;
}

function deleteUser(int $id): bool
{
    /*
        Supprime
        un utilisateur.
    */

    $db = getPDO();

    $deleted = false;

    try {

        $sql = "DELETE FROM users WHERE id = ?";

        $stmt = $db->prepare($sql);

        $deleted = $stmt->execute([$noU]);

    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $deleted;
}
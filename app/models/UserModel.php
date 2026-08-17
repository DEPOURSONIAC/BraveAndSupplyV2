<?php

function getUserById(int $user_id): ?array
{
    /*
        Retourne un utilisateur
        à partir de son identifiant.
    */

    $db = getPDO();

    try {
        $sql = "SELECT * FROM users WHERE id = ? LIMIT 1";
        
        $stmt = $db->prepare($sql);
        $stmt->execute([$user_id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $user = $result ?: null;

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
    
    try {
        $sql = "SELECT * FROM users ORDER BY id DESC";

        $stmt = $db->query($sql);

        $users = [];
        
        if ($stmt) {
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
        }

    return $users;
}

function updateUser(int $user_id, string $name, string $email, string $password, string $address): bool {
    /*
        Met à jour
        un utilisateur.
    */

    $db = getPDO();

    try {
        $updated = false;

        $email = strtolower(trim($email));

        if (!empty($name) && !empty($email) && !empty($address) && !empty($password) &&filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = "UPDATE users SET name = ?, email = ?, password = ?, address = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?";
            $stmt = $db->prepare($sql);

            $updated = $stmt->execute([$name, $email, $password, $address,$user_id,]);       
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

    try {
        $deleted = false;

        $sql = "DELETE FROM users WHERE id = ?";

        $stmt = $db->prepare($sql);

        $deleted = $stmt->execute([$user_id]);
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $deleted;
}
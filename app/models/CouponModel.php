<?php

function getCouponByCode(string $code): ?array
{
    /*
        Retourne un coupon
        à partir de son code.
    */

    $db = getPDO();

    try {
        $coupon = null;

        if (!empty($code)) {
            $sql = "SELECT * FROM coupons WHERE code = ? LIMIT 1";

            $stmt = $db->prepare($sql);
            $stmt->execute([$code]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $coupon = $result ?: null;
            
        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $coupon;
}

function validateCoupon(string $code): ?array
{
    /*
        Vérifie qu'un coupon existe
        avant son utilisation.
    */

    try {
        $valid_coupon = null;

        if (!empty($code)) {
            $coupon = getCouponByCode($code);

            if ($coupon) {
                $valid_coupon = $coupon;
            }
        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $valid_coupon;
}

function applyCoupon(float $total, string $code): float
{
    /*
        Applique la réduction
        sur le montant total.
    */

    try {
        $new_total = $total;

        if ($total >= 0 && !empty($code)) {
            $coupon = validateCoupon($code);

            if ($coupon) {
                $reduce = (float) $coupon['reduce'];

                $new_total = $total - ($total * $reduce / 100);

                $new_total = max(0, $new_total);
            }
        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $new_total;
}

function createCoupon(string $code, float $reduce): bool
{
    /*
        Crée un nouveau coupon.
    */

    $db = getPDO();

    try {
        $created = false;

        if (!empty($code) && $reduce > 0 && $reduce <= 100) {
            $sql = "INSERT INTO coupons (code, reduce) VALUES (?, ?)";

            $stmt = $db->prepare($sql);

            $created = $stmt->execute([$code, $reduce,]);

        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $created;
}

function deleteCoupon(string $code): bool
{
    /*
        Supprime un coupon.
    */

    $db = getPDO();

    try {
        $deleted = false;

        if (!empty($code)) {
            $sql = "DELETE FROM coupons WHERE code = ?";

            $stmt = $db->prepare($sql);

            $deleted = $stmt->execute([$code]);

        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $deleted;
}
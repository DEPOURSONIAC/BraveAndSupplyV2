<?php

function getCouponByCode(string $code): ?array
{
    /*
        Retourne un coupon
        à partir de son code.
    */

    $db = getPDO();

    $coupon = null;

    if (!empty($code)) {

        $sql = "SELECT * FROM coupons WHERE code = ? LIMIT 1";

        $stmt = $db->prepare($sql);
        $stmt->execute([$code]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $coupon = $result ?: null;
    }

    return $coupon;
}

function validateCoupon(string $code): ?array
{
    /*
        Vérifie qu'un coupon existe
        avant son utilisation.
    */

    $coupon = getCouponByCode($code);

    $validCoupon = null;

    if ($coupon) {
        $validCoupon = $coupon;
    }

    return $validCoupon;
}

function applyCoupon(float $total, string $code): float
{
    /*
        Applique la réduction
        sur le montant total.
    */

    $coupon = validateCoupon($code);

    $newTotal = $total;

    if ($coupon) {

        $reduce = (float) $coupon['reduce'];

        $newTotal = $total - ($total * $reduce / 100);

        $newTotal = max(0, $newTotal);
    }

    return $newTotal;
}

function createCoupon(string $code, float $reduce): bool
{
    /*
        Crée un nouveau coupon.
    */

    $db = getPDO();

    $created = false;

    if (!empty($code) && $reduce > 0 && $reduce <= 100) {

        try {

            $sql = "INSERT INTO coupons (code, reduce) VALUES (?, ?)";

            $stmt = $db->prepare($sql);

            $created = $stmt->execute([$code, $reduce ]);

        } catch (PDOException $e) {
            error_log(__FUNCTION__ . '(): ' . $e->getMessage());
        }
    }

    return $created;
}

function deleteCoupon(string $code): bool
{
    /*
 -       Supprime un coupon.
    */

    $db = getPDO();

    $sql = "DELETE FROM coupons WHERE code = ? ";

    $stmt = $db->prepare($sql);

    $deleted = $stmt->execute([$code]);

    return $deleted;
}
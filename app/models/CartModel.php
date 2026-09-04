<?php

function getCouponByCode(string $code): ?array
{
    """
    Obtenir le coupon via le code
    """

    $db = getPDO();

    try {
        $coupon = null;

        $code = strtoupper(trim($code));

        if ($code !== '') {
            $sql = "SELECT id, code, reduce FROM coupons WHERE code = ? LIMIT 1";

            $stmt = $db->prepare($sql);
            $stmt->execute([$code]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $coupon = $result;
            }
        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $coupon;
}


function validateCoupon(string $code): ?array
{
    """
    Valider le coupon
    """

    $valid_coupon = null;

    if ($code !== '') {
        $code = strtoupper(trim($code));

        $coupon = getCouponByCode($code);

        if ($coupon) {
            $reduce = (int) $coupon['reduce'];

            if ($reduce >= 1 && $reduce <= 100) {
                $valid_coupon = $coupon;
            }
        }
    }

    return $valid_coupon;
}


function applyCoupon(float $total, string $code): float
{
    """
    Applique le coupon
    """
    $new_total = $total;

    if ($total >= 0) {
        $coupon = validateCoupon($code);

        if ($coupon) {
            $reduce = (int) $coupon['reduce'];

            $new_total = $total - ($total * $reduce / 100);
            $new_total = max(0, round($new_total, 2));
        }
    }

    return $new_total;
}


function createCoupon(string $code, int $reduce): bool
{
    """
    Crée le coupon
    """
    $db = getPDO();

    try {
        $created = false;

        $code = strtoupper(trim($code));

        if ($code !== '' && $reduce >= 1 && $reduce <= 100) {
            $sql = "INSERT INTO coupons (code, reduce) VALUES (?, ?)";

            $stmt = $db->prepare($sql);

            $created = $stmt->execute([$code, $reduce]);
        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $created;
}


function deleteCoupon(string $code): bool
{
    """
    Supp le coupon
    """
    $db = getPDO();
    
    try {
        $deleted = false;

        $code = strtoupper(trim($code));

        if ($code !== '') {
            $sql = "DELETE FROM coupons WHERE code = ?";

            $stmt = $db->prepare($sql);

            $deleted = $stmt->execute([$code]);
        }
    } catch (PDOException $e) {
        error_log(__FUNCTION__ . '(): ' . $e->getMessage());
    }

    return $deleted;
}
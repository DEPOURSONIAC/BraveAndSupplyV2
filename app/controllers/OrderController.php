<?php

function showOrder(int $order_id): void
{
    /*
        Affiche les détails d'une commande.
    */
    $user_id = (int) $_SESSION['id'];

    if ($order_id <= 0) {
        redirect('account');
    }

    $order_details = getOrderById($order_id, $user_id);

    if ($order_details === null) {
        redirect('account');
    }

    $order = $order_details['order'];
    $items = $order_details['items'];

    $status_labels = [
        'pending'   => 'En attente',
        'paid'      => 'Payée',
        'shipped'   => 'Expédiée',
        'delivered' => 'Livrée',
        'cancelled' => 'Annulée'
    ];

    $status = $order['status'];
    $status_label = $status_label[$status] ?? 'Inconnu';

    
    $total_items = 0;

    foreach ($items as $item) {
        $quantity = (int) $item['quantity'];

        $total_items += $quantity;
    }

    view('user/account/order', [
        'order'       => $order,
        'items'       => $items,
        'status'      => $status,
        'status_label' => $status_label,
        'total_items'  => $total_items,
    ]);
}



    

    


    

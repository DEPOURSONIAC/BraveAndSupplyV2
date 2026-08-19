async function readAccount(event) {

    const link = event.target.closest('a');

    if (!link) {
        return;
    }

    event.preventDefault();
    
    // Loading the page itself
    
    const currentActive = document.querySelector('.account-menu a.active');

    if (currentActive) {
        currentActive.classList.remove('active');
    }

    link.classList.add('active');

    try {

        const response = await fetch(link.href); // Wait an answser of the server

        if (!response.ok) {
            throw new Error(`HTTP error: ${response.status}`);
        }

        const accountText = await response.text();

        console.log(response);
        console.log('Status code:', response.status, 'Status text:', response.statusText);

        document.getElementById('account-content').innerHTML = accountText; // write in the HTML page

    } catch (error) {

        console.error('Error:', error);

    }
}

// Change the quantity with JavaScript because it will help with AJAX

// -----
// Modification du panier
// -----

async function updateCart(form, quantity) {

    const product_id = form.querySelector('input[name="product_id"]');

    const data = new URLSearchParams();

    data.append('product_id', product_id.value);
    data.append('quantity', quantity);

    const response = await fetch(form.action, {
        method: 'POST',
        body: data
    });

    if (!response.ok) {
        throw new Error(`HTTP error: ${response.status}`);
    }

    const result = await response.json();

    console.log('Réponse updateCart :', result);

    // Ligne du produit modifié
    const product_row = document.querySelector(
        `tr[data-product-id="${product_id.value}"]`
    );

    if (product_row) {

        const product = result.cart.products.find(
            product => Number(product.id) === Number(product_id.value)
        );

        if (product) {

            const product_total = product_row.querySelector('.product-total');

            product_total.textContent =
                Number(product.total_by_product).toFixed(2) + ' €';
        }
    }

    // Nombre d'articles
    const account_table_count =
        document.getElementById('account_table_count');

    if (account_table_count) {
        account_table_count.textContent =
            result.cart_count + ' article(s)';
    }

    // Total panier
    const cart_total =
        document.getElementById('cart_total');

    if (cart_total) {
        cart_total.textContent =
            Number(result.cart.total).toFixed(2) + ' €';
    }

    return result;
}


// -----
// Change la quantité
// -----

async function changeQuantity(event) {

    if (event.type === 'click') {

        if (!event.target.classList.contains('quantity-plus') && !event.target.classList.contains('quantity-minus')) {
            return;
        }

        const form = event.target.closest('form');
        const input = form.querySelector('.quantity-input');

        if (event.target.classList.contains('quantity-plus')) {

            input.value = Number(input.value) + 1;

        } else {

            if (Number(input.value) <= 1) {
                return;
            }

            input.value = Number(input.value) - 1;
        }

        await updateCart(form, input.value);
    }


    else if (event.type === 'change') {

        if (!event.target.classList.contains('quantity-input')) {
            return;
        }

        const form = event.target.closest('form');

        // Evite une quantité invalide
        if (Number(event.target.value) < 1) {
            event.target.value = 1;
        }

        await updateCart(form, event.target.value);
    }
}


// -----
// Supp le produit
// -----


async function removeProductFromCart(event) {

    event.preventDefault();

    const form = event.currentTarget;

    const product_id = form.querySelector('input[name="product_id"]').value;

    const data = new URLSearchParams();

    data.append('product_id', product_id);

    try {

        const response = await fetch(form.action, {
            method: 'POST',
            body: data
        });

        if (!response.ok) {
            throw new Error(`HTTP error: ${response.status}`);
        }

        const result = await response.json();

        console.log('Réponse removeProductFromCart :', result);

        if (!result.success) {
            return;
        }

        // Supprime la ligne du tableau
        const product_row = document.querySelector(`tr[data-product-id="${product_id}"]`);

        if (product_row) {
            product_row.remove();
        }

        // Mise à jour du nombre d'articles
        const account_table_count = document.getElementById('account_table_count');

        if (account_table_count) {
            account_table_count.textContent = result.cart_count + ' article(s)';
        }

        // Mise à jour du total
        const cart_total = document.getElementById('cart_total');

        if (cart_total) {
            cart_total.textContent = Number(result.cart.total).toFixed(2) + ' €';
        }

    } catch (error) {
        console.error('Erreur lors de la suppression du produit :', error);
    }
}


// -----
// Event
// -----

document.addEventListener('click', changeQuantity);
document.addEventListener('change', changeQuantity);
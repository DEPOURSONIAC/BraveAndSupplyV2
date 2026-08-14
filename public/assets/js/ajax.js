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

async function updateCart(form, quantity) {

    const productId = form.querySelector('input[name="product_id"]');

    const data = new URLSearchParams();

    data.append('product_id', productId.value);
    data.append('quantity', quantity);

    const response = await fetch(form.action, {
        method: 'POST',
        body: data
    });

    if (!response.ok) {

        throw new Error(`HTTP error: ${response.status}`);
    }

    const result = await response.json();

    const productRow = document.querySelector(`tr[data-product-id="${productId.value}"]`);

    if (productRow) {

            const product = result.cart.products.find(
                product => Number(product.id) === Number(productId.value)
            );

            if (product) {
                const productTotal = productRow.querySelector('.product-total');

                productTotal.textContent =  Math.round(product.totalByProduct * 100) / 100 + ' €';
            }
        }

    document.getElementById('account-table-count').innerHTML = result.cartCount + " article(s)";
    document.getElementById('cartTotal').innerHTML = Math.round(result.cart.total * 100) / 100;

    return result;

}


async function changeQuantity(event) {

    if (event.type === 'click') {

        if (!event.target.classList.contains('quantity-plus') && !event.target.classList.contains('quantity-minus')) {
            return 0;
        }

        const form = event.target.closest('form');
        const input = form.querySelector('.quantity-input');

        if (event.target.classList.contains('quantity-plus')) {

            input.value = Number(input.value) + 1;
        }

        else if (event.target.classList.contains('quantity-minus')) {

            if (Number(input.value) <= 1) {
                return 0;
            }

            input.value = Number(input.value) - 1;
        }

        
        const result = await updateCart(form, input.value);

        console.log(result);
    }


    else if (event.type === 'change') {

        if (!event.target.classList.contains('quantity-input')) {
            return 0;
        }

        const form = event.target.closest('form');

        const result = await updateCart(form, event.target.value);

        console.log(result);
    }
}

async function removeProductFromCart(event) {

    event.preventDefault();

    const link = event.currentTarget;

    const productId = link.dataset.productId;

    const data = new URLSearchParams();

    data.append('product_id', productId);

    const response = await fetch(link.href, {
        method: 'POST',
        body: data
    });

    if (!response.ok) {
        throw new Error(`HTTP error: ${response.status}`);
    }

    const result = await response.json();

    console.log(result);

    if (result.success) {

        const productRow = link.closest('tr');

        if (productRow) {
            productRow.remove();
        }

        document.getElementById('account-table-count').innerHTML = result.cartCount + " article(s)";
        document.getElementById('cartTotal').innerHTML = Math.round(result.cart.total * 100) / 100;
    }
}
document.addEventListener('click', changeQuantity);
document.addEventListener('change', changeQuantity);
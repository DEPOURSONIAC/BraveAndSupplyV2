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

const plusButtons = document.querySelectorAll('.quantity-plus');
const minusButtons = document.querySelectorAll('.quantity-minus');




/*
async function updateProdcutInCart(event){

    const link = event.target.closest('a');

    if (!link) {
        return;
    }

    event.preventDefault();

    try {

        const response = await fetch(".php",{
            method: 'POST',
            headers: {"Content-Type": "application/x-www-form-urlencoded"},
            body: ""
        }); // Wait an answser of the server

        if (!response.ok) {
            throw new Error(`HTTP error: ${response.status}`);
        }

        const accountText = await response.text();

    } catch (error) {

        console.error('Error:', error);

    }
}

*/
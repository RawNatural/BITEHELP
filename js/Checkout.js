/**
 * I THINK THIS WHOLE FILE IS REDUNDANT FOR THIS SITE. AND OTHER ONE PRODUCT STORES USING THE SAME TEMPLATE. I MADE A BETTER ONE THAT USES PHP.
 */

/* global Cookie */

/**
 * Module pattern for Checkout functions
 */
var Checkout = (function () {
    "use strict";

    var pub;

    // Public interface
    pub = {};

    function clearCart(){
        window.sessionStorage.removeItem("cart");
        window.location.reload();
    }

    /**
     * Create an HTML table representing the current cart
     *
     * @param itemList an array of items to display
     * @return {string} HTML representing itemList as a table
     */
    function makeItemHTML(itemList) {
        let clearCartElement = $("#clearCart");
        clearCartElement.html('<button style="/*border-radius: 20px;*/ font-size: x-small; border: 1px solid #c0c0c0; cursor: pointer" onclick="/*window.sessionStorage.removeItem(\'cart\');*/ window.location.href=\'index.php\';">EDIT</button>')
        var html, totalPrice, item;
        item = itemList[0];
        html = "<table style='color: whitesmoke'>";
        html += "<tr><th>Item</th><th>Price (AUD)</th><th>Quantity</th></tr>";
        html += "<tr><td>" + item.title + "</td><td class='money'>$" + item.price + "</td><td>"+ item.quantity +"</td></tr>";

        // Fix rounding errors
        totalPrice = item.price * item.quantity;
        totalPrice = Math.round(totalPrice * 100) / 100;
        html += "<tr><th>Total Price:</th><td class='money'>$" + totalPrice + "</td></tr>";
        window.sessionStorage.setItem("price", totalPrice);
        html += "</table>";

        html += "<style> th, td{ padding: 15px; }</style>";
        return html;
    }

    /**
     * Setup function for the Checkout
     *
     * Fetches the current cart from the cookie, and displays it.
     * If there is no current cart, display a message to say so.
     */
    pub.setup = function () {
        //Unset previous order details
        window.sessionStorage.removeItem('payerName')
        window.sessionStorage.removeItem('email')

        var itemList, cartElement;
        itemList = window.sessionStorage.getItem("cart");
        cartElement = $("#cart");
        if (itemList) {
            itemList = JSON.parse(itemList);
            cartElement.html(makeItemHTML(itemList));
            document.getElementById('payBtn').removeAttribute('disabled');
        } else {
            cartElement.html("<p>There are no items in your cart</p>");
            $("#checkoutForm").css({display : "none"});
        }
    };

    // Expose public interface
    return pub;
}());

// The usual ready event handling to call Checkout.setup
$(document).ready(Checkout.setup);
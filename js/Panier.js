$(document).ready(function(){
    
 // initialize the cart as an empty array
 let cart = [];

 // get all the "add to cart" buttons
 const addToCartButtons = document.querySelectorAll(".add-to-cart");
 
 // add click event listener to each "add to cart" button
 addToCartButtons.forEach((button) => {
   button.addEventListener("click", addToCartClicked);
 });
 
 // add to cart clicked function
 function addToCartClicked(event) {
   // get the name, price, and quantity of the product clicked
   const name = event.target.getAttribute("data-name");
   const price = event.target.getAttribute("data-prix");
   const quantity = 1;
 
   // check if the product is already in the cart
   const index = cart.findIndex((item) => item.name === name);
   if (index > -1) {
     // if it's in the cart, update the quantity
     cart[index].quantity += quantity;
   } else {
     // if it's not in the cart, add it
     cart.push({ name, price, quantity });
   }
 
   // update the cart modal
   updateCart();
 }
 
 // update cart function
 function updateCart() {
   // get the cart table element
   const cartTable = document.querySelector(".show-cart");
 
   // initialize the cart table body and total price
   let cartTableBody = "";
   let totalPrice = 0;
 
   // loop through the cart array and create the table rows
   cart.forEach((item) => {
     cartTableBody += `
       <tr>
         <td>${item.name}</td>
         <td>${item.price}</td>
         <td>${item.quantity}</td>
         <td><button class="btn btn-danger remove-item" data-name="${item.name}">X</button></td>
       </tr>
     `;
     totalPrice += item.price * item.quantity;
   });
 
   // update the cart table and total price
   cartTable.innerHTML = cartTableBody;
   document.querySelector(".total-cart").textContent = totalPrice;
 
   // add click event listener to each "remove item" button
   const removeItemButtons = document.querySelectorAll(".remove-item");
   removeItemButtons.forEach((button) => {
     button.addEventListener("click", removeItemClicked);
   });
 
   // show the cart modal
   $("#cart").modal("show");
 }
 
 // remove item clicked function
 function removeItemClicked(event) {
   // get the name of the product to be removed
   const name = event.target.getAttribute("data-name");
 
   // remove the product from the cart
   const index = cart.findIndex((item) => item.name === name);
   if (index > -1) {
     cart.splice(index, 1);
   }
 
   // update the cart modal
   updateCart();
 }
 

});
 
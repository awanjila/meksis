<template>
  <div class="cart-container">
    <div class="cart-header">
      <h2>Shopping Cart</h2>
      <button class="close-btn" @click="$emit('close')">
        <font-awesome-icon :icon="['fas', 'times']" />
      </button>
    </div>

    <div v-if="cartItems.length === 0" class="empty-cart">
      <font-awesome-icon :icon="['fas', 'shopping-cart']" />
      <p>Your cart is empty</p>
    </div>

    <div v-else class="cart-content">
      <div class="cart-items">
        <div v-for="item in cartItems" :key="item.id" class="cart-item">
          <div class="item-image-container">
            <img :src="item.image" :alt="item.name" class="item-image">
          </div>
          <div class="item-details">
            <h3>{{ item.name }}</h3>
            <p class="price">Ksh {{ item.price }}</p>
            <div class="quantity-controls">
              <button @click="updateQuantity(item.id, item.quantity - 1)" :disabled="item.quantity <= 1">-</button>
              <span>{{ item.quantity }}</span>
              <button @click="updateQuantity(item.id, item.quantity + 1)">+</button>
            </div>
          </div>
          <button class="remove-btn" @click="removeItem(item.id)">
            <font-awesome-icon :icon="['fas', 'trash']" />
          </button>
        </div>
      </div>

      <div class="cart-footer">
        <div class="cart-total">
          <span>Total:</span>
          <span class="total-amount">Ksh {{ cartTotal }}</span>
        </div>
        <button class="checkout-btn" @click="proceedToCheckout">
          Proceed to Checkout
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { computed } from 'vue';
import { useCartStore } from '../../store/cart';
import { faTimes, faShoppingCart, faTrash } from '@fortawesome/free-solid-svg-icons';
import { library } from '@fortawesome/fontawesome-svg-core';

library.add(faTimes, faShoppingCart, faTrash);

export default {
  name: 'Cart',
  emits: ['close', 'checkout'],
  setup(props, { emit }) {
    const cartStore = useCartStore();

    const cartItems = computed(() => cartStore.cartItems);
    const cartTotal = computed(() => cartStore.cartTotal);

    const updateQuantity = (itemId, newQuantity) => {
      if (newQuantity < 1) return;
      cartStore.updateQuantity(itemId, newQuantity);
    };

    const removeItem = (itemId) => {
      cartStore.removeFromCart(itemId);
    };

    const proceedToCheckout = () => {
      emit('checkout');
    };

    return {
      cartItems,
      cartTotal,
      updateQuantity,
      removeItem,
      proceedToCheckout
    };
  }
}
</script>

<style scoped>
.cart-container {
  position: fixed;
  top: 0;
  right: 0;
  width: 400px;
  height: 100vh;
  background: white;
  box-shadow: -2px 0 10px rgba(0,0,0,0.1);
  display: flex;
  flex-direction: column;
  z-index: 1000;
  font-family: 'Poppins', sans-serif;
}

.cart-header {
  padding: 1.5rem;
  border-bottom: 1px solid #eee;
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #f8f9fa;
}

.cart-header h2 {
  margin: 0;
  font-size: 1.5rem;
  color: #333;
  font-weight: 600;
}

.close-btn {
  background: none;
  border: none;
  font-size: 1.2rem;
  cursor: pointer;
  color: #666;
  transition: color 0.3s ease;
}

.close-btn:hover {
  color: #333;
}

.empty-cart {
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 1.5rem;
  color: #666;
  padding: 2rem;
}

.empty-cart svg {
  font-size: 4rem;
  color: #ddd;
}

.empty-cart p {
  font-size: 1.2rem;
  margin: 0;
}

.cart-content {
  display: flex;
  flex-direction: column;
  height: 100%;
}

.cart-items {
  flex: 1;
  overflow-y: auto;
  padding: 1.5rem;
  scrollbar-width: thin;
  scrollbar-color: #ddd #f8f9fa;
}

/* Custom scrollbar for Webkit browsers */
.cart-items::-webkit-scrollbar {
  width: 6px;
}

.cart-items::-webkit-scrollbar-track {
  background: #f8f9fa;
}

.cart-items::-webkit-scrollbar-thumb {
  background-color: #ddd;
  border-radius: 6px;
}

.cart-item {
  display: flex;
  gap: 1rem;
  padding: 1rem;
  border-bottom: 1px solid #eee;
  transition: background-color 0.3s ease;
}

.cart-item:hover {
  background-color: #f8f9fa;
}

.item-image-container {
  width: 80px;
  height: 80px;
  overflow: hidden;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.item-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.item-image:hover {
  transform: scale(1.05);
}

.item-details {
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.item-details h3 {
  margin: 0 0 0.5rem 0;
  font-size: 1rem;
  font-weight: 600;
  color: #333;
}

.price {
  color: #25D366;
  font-weight: bold;
  margin: 0.5rem 0;
  font-size: 1.1rem;
}

.quantity-controls {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  margin-top: 0.5rem;
}

.quantity-controls button {
  width: 30px;
  height: 30px;
  border: 1px solid #ddd;
  background: white;
  cursor: pointer;
  border-radius: 4px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  transition: all 0.3s ease;
}

.quantity-controls button:hover:not(:disabled) {
  background-color: #f0f0f0;
  border-color: #ccc;
}

.quantity-controls button:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.quantity-controls span {
  min-width: 30px;
  text-align: center;
  font-weight: 500;
}

.remove-btn {
  background: none;
  border: none;
  color: #ff4444;
  cursor: pointer;
  font-size: 1rem;
  transition: color 0.3s ease;
  align-self: flex-start;
  padding: 0.5rem;
}

.remove-btn:hover {
  color: #cc0000;
}

.cart-footer {
  padding: 1.5rem;
  border-top: 1px solid #eee;
  background-color: #f8f9fa;
}

.cart-total {
  display: flex;
  justify-content: space-between;
  margin-bottom: 1.5rem;
  font-size: 1.2rem;
  font-weight: 600;
  color: #333;
}

.total-amount {
  color: #25D366;
  font-weight: bold;
}

.checkout-btn {
  width: 100%;
  padding: 1rem;
  background-color: #25D366;
  color: white;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease;
  font-weight: 600;
  font-size: 1rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.checkout-btn:hover {
  background-color: #1ea84d;
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(37, 211, 102, 0.2);
}

.checkout-btn:active {
  transform: translateY(0);
}
</style> 
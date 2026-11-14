<template>
  <div class="cart-page">
    <div v-if="cartItems.length === 0" class="cart-empty">
      <font-awesome-icon :icon="['fas', 'shopping-cart']" class="cart-empty-icon" />
      <h2>Your cart is empty</h2>
      <a href="/store" class="btn-shop">Continue Shopping</a>
    </div>

    <div v-else class="cart-content">
      <div class="cart-table">
        <div class="cart-row cart-head">
          <span>Product</span>
          <span>Price</span>
          <span>Quantity</span>
          <span>Total</span>
          <span></span>
        </div>

        <div v-for="item in cartItems" :key="item.id" class="cart-row cart-item">
          <div class="cart-product">
            <img v-if="item.image" :src="item.image" :alt="item.name">
            <span class="cart-product-name">{{ item.name }}</span>
          </div>
          <span class="cart-price">Ksh {{ item.price }}</span>
          <div class="quantity-control">
            <button type="button" :disabled="item.quantity <= 1" @click="updateQuantity(item.id, item.quantity - 1)">-</button>
            <span>{{ item.quantity }}</span>
            <button type="button" @click="updateQuantity(item.id, item.quantity + 1)">+</button>
          </div>
          <span class="cart-line-total">Ksh {{ item.price * item.quantity }}</span>
          <button type="button" class="remove-btn" aria-label="Remove item" @click="removeFromCart(item.id)">
            <font-awesome-icon :icon="['fas', 'trash']" />
          </button>
        </div>
      </div>

      <div class="cart-summary">
        <div class="subtotal">
          <span>Subtotal</span>
          <strong>Ksh {{ cartTotal }}</strong>
        </div>
        <a href="/checkout" class="btn-checkout">Proceed to Checkout</a>
      </div>
    </div>
  </div>
</template>

<script>
import { computed } from 'vue';
import { useCartStore } from '../../store/cart';
import { faShoppingCart, faTrash } from '@fortawesome/free-solid-svg-icons';
import { library } from '@fortawesome/fontawesome-svg-core';

library.add(faShoppingCart, faTrash);

export default {
  name: 'CartPage',
  setup() {
    const cartStore = useCartStore();
    return {
      cartItems: computed(() => cartStore.cartItems),
      cartTotal: computed(() => cartStore.cartTotal),
      updateQuantity: (itemId, quantity) => cartStore.updateQuantity(itemId, Math.max(1, quantity)),
      removeFromCart: (itemId) => cartStore.removeFromCart(itemId)
    };
  }
}
</script>

<style scoped>
* {
  border-radius: 0 !important;
  box-sizing: border-box;
}

.cart-page {
  color: var(--charcoal);
  font-family: 'Arial Narrow', sans-serif;
}

.cart-empty {
  text-align: center;
  padding: 60px 20px;
  border: 1px solid #e5e5e5;
}

.cart-empty-icon {
  font-size: 64px;
  color: var(--royal-yellow);
  margin-bottom: 20px;
}

.cart-empty h2 {
  font-size: 24px;
  font-weight: 700;
  text-transform: uppercase;
  margin-bottom: 24px;
}

.cart-table {
  border: 1px solid #e5e5e5;
}

.cart-row {
  display: grid;
  grid-template-columns: 3fr 1.2fr 1.5fr 1.2fr 50px;
  align-items: center;
  gap: 16px;
  padding: 16px 20px;
}

.cart-head {
  background: var(--charcoal);
  color: var(--white);
  font-size: 13px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.cart-item + .cart-item {
  border-top: 1px solid #e5e5e5;
}

.cart-product {
  display: flex;
  align-items: center;
  gap: 16px;
}

.cart-product img {
  width: 70px;
  height: 70px;
  object-fit: cover;
  flex-shrink: 0;
}

.cart-product-name {
  font-weight: 700;
  text-transform: uppercase;
}

.quantity-control {
  display: inline-flex;
  align-items: center;
  border: 1px solid var(--charcoal);
  width: fit-content;
}

.quantity-control button {
  width: 34px;
  height: 34px;
  background: var(--white);
  border: none;
  color: var(--charcoal);
  font-size: 16px;
  font-weight: 700;
  cursor: pointer;
}

.quantity-control button:hover:not(:disabled) {
  background: var(--royal-yellow);
}

.quantity-control button:disabled {
  opacity: 0.4;
  cursor: not-allowed;
}

.quantity-control span {
  min-width: 36px;
  text-align: center;
  font-weight: 700;
}

.cart-line-total {
  font-weight: 700;
}

.remove-btn {
  background: none;
  border: none;
  color: var(--charcoal);
  cursor: pointer;
  padding: 8px;
}

.remove-btn:hover {
  color: #c0392b;
}

.cart-summary {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 20px;
  margin-top: 30px;
}

.subtotal {
  display: flex;
  align-items: center;
  gap: 24px;
  font-size: 18px;
  text-transform: uppercase;
}

.btn-checkout,
.btn-shop {
  display: inline-block;
  padding: 14px 28px;
  background: var(--royal-yellow);
  border: 1px solid var(--royal-yellow);
  color: var(--charcoal);
  text-decoration: none;
  font-size: 13px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: all 0.2s;
}

.btn-checkout:hover,
.btn-shop:hover {
  background: transparent;
  color: var(--royal-yellow);
}

@media (max-width: 768px) {
  .cart-head {
    display: none;
  }

  .cart-row {
    grid-template-columns: 1fr 1fr;
    gap: 12px;
  }

  .cart-product {
    grid-column: 1 / -1;
  }

  .cart-summary {
    align-items: stretch;
  }

  .btn-checkout {
    text-align: center;
  }
}
</style>

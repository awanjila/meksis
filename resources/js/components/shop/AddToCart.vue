<template>
  <div class="add-to-cart">
    <div class="quantity-selector">
      <button type="button" @click="decreaseQuantity" :disabled="quantity <= 1" aria-label="Decrease quantity">-</button>
      <input type="number" v-model="quantity" min="1" max="99" aria-label="Quantity" @change="validateQuantity">
      <button type="button" @click="increaseQuantity" aria-label="Increase quantity">+</button>
    </div>
    <button type="button" class="add-to-cart-btn" @click="addToCart">
      <font-awesome-icon :icon="['fas', 'shopping-cart']" />
      Add to Cart
    </button>
  </div>
</template>

<script>
import { ref } from 'vue';
import { useCartStore } from '../../store/cart';
import { faShoppingCart } from '@fortawesome/free-solid-svg-icons';
import { library } from '@fortawesome/fontawesome-svg-core';

library.add(faShoppingCart);

export default {
  name: 'AddToCart',
  props: {
    product: {
      type: Object,
      required: true
    }
  },
  setup(props) {
    const cartStore = useCartStore();
    const quantity = ref(1);

    const validateQuantity = () => {
      quantity.value = Math.min(99, Math.max(1, Number(quantity.value) || 1));
    };

    const increaseQuantity = () => {
      quantity.value = Math.min(99, quantity.value + 1);
    };

    const decreaseQuantity = () => {
      if (quantity.value > 1) quantity.value--;
    };

    const addToCart = () => {
      cartStore.addToCart({
        id: props.product.id,
        name: props.product.product_name,
        price: props.product.selling_price,
        image: props.product.image_url || props.product.product_image,
        quantity: quantity.value
      });
    };

    return {
      quantity,
      validateQuantity,
      increaseQuantity,
      decreaseQuantity,
      addToCart
    };
  }
}
</script>

<style scoped>
.add-to-cart {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 12px;
  margin-top: 8px;
}

.quantity-selector {
  display: flex;
  align-items: center;
  border: 1px solid #e0e0e0;
}

.quantity-selector button {
  padding: 8px 14px;
  border: none;
  background: #f5f5f5;
  color: var(--charcoal);
  font-weight: 700;
  cursor: pointer;
}

.quantity-selector button:hover:not(:disabled) {
  background: var(--royal-yellow);
}

.quantity-selector button:disabled {
  opacity: 0.4;
  cursor: not-allowed;
}

.quantity-selector input {
  width: 56px;
  text-align: center;
  border: none;
  border-left: 1px solid #e0e0e0;
  border-right: 1px solid #e0e0e0;
  padding: 8px;
  color: var(--charcoal);
}

.add-to-cart-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 18px;
  background: var(--royal-yellow);
  color: var(--charcoal);
  border: none;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  cursor: pointer;
  transition: background 0.2s;
}

.add-to-cart-btn:hover {
  background: var(--charcoal);
  color: var(--white);
}
</style>

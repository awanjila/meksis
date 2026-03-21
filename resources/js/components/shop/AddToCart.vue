<template>
  <div class="add-to-cart">
    <div class="quantity-selector">
      <button @click="decreaseQuantity" :disabled="quantity <= 1">-</button>
      <input type="number" v-model="quantity" min="1" @change="validateQuantity">
      <button @click="increaseQuantity">+</button>
    </div>
    <button class="add-to-cart-btn" @click="addToCart">
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
      if (quantity.value < 1) quantity.value = 1;
    };

    const increaseQuantity = () => {
      quantity.value++;
    };

    const decreaseQuantity = () => {
      if (quantity.value > 1) quantity.value--;
    };

    const addToCart = () => {
      cartStore.addToCart({
        id: props.product.id,
        name: props.product.product_name,
        price: props.product.selling_price,
        image: props.product.product_image,
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
  align-items: center;
  gap: 1rem;
  margin: 1rem 0;
}

.quantity-selector {
  display: flex;
  align-items: center;
  border: 1px solid #ddd;
  border-radius: 4px;
}

.quantity-selector button {
  padding: 0.5rem 1rem;
  border: none;
  background: #f5f5f5;
  cursor: pointer;
}

.quantity-selector button:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.quantity-selector input {
  width: 50px;
  text-align: center;
  border: none;
  border-left: 1px solid #ddd;
  border-right: 1px solid #ddd;
  padding: 0.5rem;
}

.add-to-cart-btn {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 1.5rem;
  background-color: #25D366;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.add-to-cart-btn:hover {
  background-color: #128C7E;
}
</style> 
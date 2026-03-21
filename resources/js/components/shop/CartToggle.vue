<template>
  <div class="cart-toggle">
    <button class="cart-toggle-btn" @click="toggleCart">
      <font-awesome-icon :icon="['fas', 'shopping-cart']" />
      <span v-if="itemCount > 0" class="cart-count">{{ itemCount }}</span>
    </button>
  </div>
</template>

<script>
import { computed } from 'vue';
import { useCartStore } from '../../store/cart';
import { faShoppingCart } from '@fortawesome/free-solid-svg-icons';
import { library } from '@fortawesome/fontawesome-svg-core';

library.add(faShoppingCart);

export default {
  name: 'CartToggle',
  emits: ['toggle-cart'],
  setup(props, { emit }) {
    const cartStore = useCartStore();
    
    const itemCount = computed(() => cartStore.itemCount);
    
    const toggleCart = () => {
      console.log('Cart toggle clicked');
      emit('toggle-cart');
    };
    
    return {
      itemCount,
      toggleCart
    };
  }
}
</script>

<style scoped>
.cart-toggle {
  position: relative;
  display: inline-block;
}

.cart-toggle-btn {
  background: none;
  border: none;
  color: #333;
  font-size: 1.2rem;
  cursor: pointer;
  padding: 0.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
}

.cart-count {
  position: absolute;
  top: -5px;
  right: -5px;
  background-color: #ff4444;
  color: white;
  border-radius: 50%;
  width: 18px;
  height: 18px;
  font-size: 11px;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style> 
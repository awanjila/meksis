<template>
  <a href="/cart" class="cart-link" aria-label="Cart">
    <font-awesome-icon :icon="['fas', 'shopping-cart']" />
    <span v-if="itemCount > 0" class="cart-count">{{ itemCount }}</span>
  </a>
</template>

<script>
import { computed } from 'vue';
import { useCartStore } from '../../store/cart';
import { faShoppingCart } from '@fortawesome/free-solid-svg-icons';
import { library } from '@fortawesome/fontawesome-svg-core';

library.add(faShoppingCart);

export default {
  name: 'CartLink',
  setup() {
    const cartStore = useCartStore();
    return { itemCount: computed(() => cartStore.itemCount) };
  }
}
</script>

<style scoped>
.cart-count {
  position: absolute;
  top: -4px;
  right: -6px;
  min-width: 18px;
  height: 18px;
  padding: 0 4px;
  background: var(--royal-yellow);
  color: var(--charcoal);
  font-size: 11px;
  font-weight: 700;
  line-height: 18px;
  text-align: center;
}
</style>

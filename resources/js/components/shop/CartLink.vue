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

<template>
  <div class="product-card">
    <a :href="`/show/product-1/${product.slug}`" class="card-image">
      <img :src="product.image_url" :alt="product.product_name" loading="lazy">
    </a>
    <div class="card-body">
      <p class="card-category">{{ product.category?.category_name }}</p>
      <h3 class="card-title">
        <a :href="`/show/product-1/${product.slug}`">{{ product.product_name }}</a>
      </h3>
      <div class="card-footer">
        <span class="card-price">Ksh {{ product.selling_price }}</span>
        <span v-if="product.is_orderable" class="card-status">Available</span>
      </div>
      <div class="card-actions">
        <a :href="`/show/product-1/${product.slug}`" class="btn btn-dark">View details</a>
        <button
          v-if="product.is_orderable"
          type="button"
          class="btn btn-yellow"
          @click="addToCart"
        >
          {{ added ? 'Added' : 'Add to cart' }}
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';
import { useCartStore } from '../../store/cart';

export default {
  name: 'ProductCard',
  props: {
    product: { type: Object, required: true }
  },
  setup(props) {
    const cartStore = useCartStore();
    const added = ref(false);

    const addToCart = () => {
      cartStore.addToCart({
        id: props.product.id,
        name: props.product.product_name,
        price: props.product.selling_price,
        image: props.product.image_url,
        quantity: 1
      });
      added.value = true;
      setTimeout(() => (added.value = false), 1500);
    };

    return { added, addToCart };
  }
}
</script>

<style scoped>
.product-card {
  background: var(--white);
  border: 1px solid #e5e5e5;
  display: flex;
  flex-direction: column;
  height: 100%;
  transition: border-color 0.2s, box-shadow 0.2s;
}

.product-card:hover {
  border-color: var(--charcoal);
  box-shadow: 0 6px 24px rgba(0, 0, 0, 0.08);
}

.card-image {
  display: block;
  aspect-ratio: 1 / 1;
  background: #f4f4f4;
  overflow: hidden;
}

.card-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s;
}

.product-card:hover .card-image img {
  transform: scale(1.03);
}

.card-body {
  padding: 16px;
  display: flex;
  flex-direction: column;
  gap: 8px;
  flex: 1;
}

.card-category {
  font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
  font-size: 11px;
  color: #888;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin: 0;
}

.card-title {
  font-size: 0.95rem;
  font-weight: 700;
  color: var(--charcoal);
  text-transform: uppercase;
  line-height: 1.3;
  margin: 0;
  min-height: 2.6em;
}

.card-title a {
  color: inherit;
  text-decoration: none;
}

.card-title a:hover {
  text-decoration: underline;
}

.card-footer {
  margin-top: auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-top: 10px;
  border-top: 1px solid #f0f0f0;
}

.card-price {
  font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
  font-size: 1.05rem;
  font-weight: 700;
  color: var(--charcoal);
}

.card-status {
  font-size: 11px;
  font-weight: 700;
  color: #1f8a4c;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.card-actions {
  display: flex;
  gap: 8px;
  margin-top: 4px;
}

.btn {
  flex: 1;
  text-align: center;
  padding: 10px 8px;
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  text-decoration: none;
  border: none;
  cursor: pointer;
  transition: background 0.2s, color 0.2s;
}

.btn-dark {
  background: var(--charcoal);
  color: var(--white);
}

.btn-dark:hover {
  background: #000;
}

.btn-yellow {
  background: var(--royal-yellow);
  color: var(--charcoal);
}

.btn-yellow:hover {
  background: var(--charcoal);
  color: var(--white);
}
</style>

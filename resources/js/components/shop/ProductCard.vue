<template>
  <div class="product-card">
    <a :href="`/show/product-1/${product.slug}`" class="card-image-wrapper">
      <img :src="product.image_url" :alt="product.product_name">
    </a>
    <div class="card-content">
      <h3 class="card-title">
        <a :href="`/show/product-1/${product.slug}`">{{ product.product_name }}</a>
      </h3>
      <p class="card-price">Ksh {{ product.selling_price }}</p>
      <add-to-cart v-if="product.is_orderable" :product="product"></add-to-cart>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ProductCard',
  props: {
    product: { type: Object, required: true }
  }
}
</script>

<style scoped>
.product-card {
  background: var(--white);
  border: 1px solid #e0e0e0;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  transition: border-color 0.2s, box-shadow 0.2s;
}

.product-card:hover {
  border-color: var(--royal-yellow);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.card-image-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
  aspect-ratio: 3 / 4;
  background: #f5f5f5;
}

.card-image-wrapper img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.card-content {
  padding: 20px;
  display: flex;
  flex-direction: column;
  gap: 10px;
  flex: 1;
}

.card-title {
  font-size: 1.05rem;
  font-weight: 700;
  color: var(--charcoal);
  text-transform: uppercase;
  line-height: 1.3;
  margin: 0;
}

.card-title a {
  color: inherit;
  text-decoration: none;
}

.card-price {
  font-weight: 700;
  color: var(--charcoal);
  margin: 0;
}
</style>

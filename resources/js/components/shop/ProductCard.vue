<template>
  <div class="col-lg-4 col-md-6 mb-80">
    <div class="product-list">
      <div class="image-product">
        <a :href="`/show/product-1/${product.slug}`">
          <img :src="product.image_url" :alt="product.product_name">
        </a>
      </div>
      <div class="content-desc text-center">
        <h2 class="loop-product-title pt-15">
          <a :href="`/show/product-1/${product.slug}`">{{ product.product_name }}</a>
        </h2>
        <span class="price">Ksh {{ product.selling_price }}</span>
        <add-to-cart v-if="product.is_orderable" :product="product"></add-to-cart>
      </div>
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

<template>
  <div class="trust-bar">
    <div v-for="item in items" :key="item.title" class="trust-item">
      <h4 class="trust-title">{{ item.title }}</h4>
      <p class="trust-text">{{ item.text }}</p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ShopTrustBar',
  data() {
    return {
      items: [
        { title: 'Quality Products', text: 'Engineered for durability and long service life.' },
        { title: 'Fast Delivery', text: 'Quick dispatch to your site across Kenya.' },
        { title: 'Expert Advice', text: 'Our team helps you choose the right product.' },
        { title: 'Secure Ordering', text: 'Order online and we confirm details by email.' }
      ]
    };
  }
}
</script>

<style scoped>
.trust-bar {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 24px;
  border-top: 1px solid #e5e5e5;
  padding-top: 32px;
}

.trust-item {
  border-top: 3px solid var(--royal-yellow);
  padding-top: 14px;
}

.trust-title {
  font-size: 0.85rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  color: var(--charcoal);
  margin: 0 0 6px;
}

.trust-text {
  font-size: 0.8rem;
  line-height: 1.5;
  color: #666;
  margin: 0;
}

@media (max-width: 768px) {
  .trust-bar {
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
  }
}
</style>

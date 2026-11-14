<template>
  <section class="service-areas-section">
    <div class="container">
      <div class="section-header">
        <span class="section-kicker">SEO SERVICES &amp; COVERAGE</span>
        <h2 class="section-title">Steel &amp; GRP Water Tanks Delivered Across Kenya</h2>
        <p class="section-subtitle">
          Meksis Engineering supplies, installs and delivers steel tanks and GRP tanks to every major town and city in Kenya.
          Tell us where you are and we will confirm delivery and installation timelines for your location.
        </p>
      </div>

      <div class="tag-group">
        <h3 class="tag-group-title">Products</h3>
        <div class="tags">
          <a v-for="product in products" :key="product.label" :href="product.href" class="tag tag-product">{{ product.label }}</a>
        </div>
      </div>

      <div class="tag-group">
        <h3 class="tag-group-title">Areas we serve</h3>
        <div class="tags">
          <span v-for="town in towns" :key="town" class="tag">{{ town }}</span>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const products = [
  { label: 'Steel Tanks', href: '/store' },
  { label: 'GRP Tanks', href: '/store' }
]

const towns = [
  'Nairobi', 'Mombasa', 'Kisumu', 'Nakuru', 'Eldoret', 'Thika', 'Machakos', 'Kiambu',
  'Ruiru', 'Kitale', 'Garissa', 'Malindi', 'Kilifi', 'Lamu', 'Nyeri', 'Meru', 'Embu',
  'Kitui', 'Kakamega', 'Bungoma', 'Busia', 'Kisii', 'Migori', 'Homa Bay', 'Kericho',
  'Bomet', 'Nanyuki', 'Naivasha', 'Athi River', 'Kajiado', 'Narok', 'Voi', 'Isiolo',
  'Murang\'a', 'Kerugoya', 'Iten', 'Kapsabet', 'Lodwar', 'Wajir', 'Limuru'
]
</script>

<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.service-areas-section {
  padding: 80px 0;
  background: #fff;
  font-family: Arial, sans-serif;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

.section-header {
  text-align: center;
  margin-bottom: 40px;
}

.section-kicker {
  display: inline-block;
  font-size: 12px;
  letter-spacing: 2px;
  font-weight: 700;
  color: rgb(26, 26, 26);
  background: rgb(250, 218, 94);
  padding: 6px 12px;
  margin-bottom: 14px;
}

.section-title {
  font-family: 'Arial Narrow', Arial, sans-serif;
  font-size: 38px;
  text-transform: uppercase;
  color: rgb(26, 26, 26);
  margin-bottom: 14px;
}

.section-subtitle {
  max-width: 760px;
  margin: 0 auto;
  font-size: 16px;
  line-height: 1.7;
  color: #555;
}

.tag-group {
  margin-bottom: 32px;
}

.tag-group-title {
  font-family: 'Arial Narrow', Arial, sans-serif;
  font-size: 18px;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: rgb(26, 26, 26);
  margin-bottom: 14px;
  padding-left: 12px;
  border-left: 4px solid rgb(250, 218, 94);
}

.tags {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
}

.tag {
  display: inline-block;
  padding: 8px 16px;
  font-size: 14px;
  color: rgb(26, 26, 26);
  background: #f5f5f5;
  border: 1px solid #e2e2e2;
  text-decoration: none;
  transition: background 0.2s, border-color 0.2s;
}

.tag:hover {
  background: rgb(250, 218, 94);
  border-color: rgb(250, 218, 94);
}

.tag-product {
  background: rgb(26, 26, 26);
  color: #fff;
  border-color: rgb(26, 26, 26);
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.tag-product:hover {
  background: rgb(250, 218, 94);
  border-color: rgb(250, 218, 94);
  color: rgb(26, 26, 26);
}

@media (max-width: 768px) {
  .service-areas-section {
    padding: 56px 0;
  }

  .section-title {
    font-size: 28px;
  }
}
</style>

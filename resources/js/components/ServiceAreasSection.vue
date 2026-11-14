<template>
  <section class="service-areas-section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">We Deliver and Supply GRP and Steel Tanks</h2>
        <p class="section-subtitle">We deliver and supply GRP and steel tanks to all major towns across Kenya:</p>
      </div>

      <div class="tags">
        <span v-for="town in towns" :key="town" class="tag">{{ town }}</span>
      </div>
    </div>
  </section>
</template>

<script setup>
const towns = [
  'Nairobi', 'Mombasa', 'Kisumu', 'Nakuru', 'Eldoret', 'Thika', 'Machakos', 'Kiambu',
  'Nyeri', 'Meru', 'Embu', 'Kakamega', 'Kisii', 'Kericho', 'Naivasha', 'Kitale',
  'Malindi', 'Garissa', 'Nanyuki', 'Kitui', 'Bungoma', 'Migori', 'Homa Bay', 'Narok'
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
  margin-bottom: 36px;
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

.tags {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 10px;
}

.tag {
  display: inline-block;
  padding: 8px 16px;
  font-size: 14px;
  color: rgb(26, 26, 26);
  background: #f5f5f5;
  border: 1px solid #e2e2e2;
  transition: background 0.2s, border-color 0.2s;
}

.tag:hover {
  background: rgb(250, 218, 94);
  border-color: rgb(250, 218, 94);
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

<template>
  <section class="services-section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">OUR PRODUCTS</h2>
        <p class="section-subtitle">
          Premium steel water storage solutions for industrial and commercial use
        </p>
      </div>

      <div class="carousel-wrapper">
        <div v-if="loading" class="loading-state">
          <div class="spinner"></div>
          <p>Loading products...</p>
        </div>

        <transition-group
          v-else
          name="slide-fade"
          tag="div"
          class="carousel-track"
        >
          <div
            v-for="(batch, batchIndex) in batches"
            :key="batchIndex"
            v-show="currentBatch === batchIndex"
            class="services-batch"
          >
            <div
              v-for="(service, index) in batch"
              :key="`${batchIndex}-${index}`"
              class="service-card"
            >
              <div class="card-image-wrapper">
                <img
                  :src="service.image || '/images/services/default.jpg'"
                  :alt="service.title || service.name"
                  class="card-image"
                />
              </div>

              <div class="card-content">
                <h3 class="card-title">
                  {{ service.title || service.name }}
                </h3>

                <p
                  class="card-description"
                  v-html="truncateDescription(service.description)"
                ></p>

                <a
                  :href="`/show/product/${service.slug}`"
                  class="card-link"
                >
                  VIEW DETAILS
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <line x1="5" y1="12" x2="19" y2="12" />
                    <polyline points="12 5 19 12 12 19" />
                  </svg>
                </a>
              </div>
            </div>
          </div>
        </transition-group>

        <!-- Navigation -->
        <button
          class="carousel-nav prev"
          @click="prevBatch"
          :disabled="currentBatch === 0"
        >
          ‹
        </button>

        <button
          class="carousel-nav next"
          @click="nextBatch"
          :disabled="currentBatch === batches.length - 1"
        >
          ›
        </button>

        <!-- Dots -->
        <div class="carousel-dots">
          <button
            v-for="(_, index) in batches"
            :key="index"
            :class="['dot', { active: currentBatch === index }]"
            @click="goToBatch(index)"
          />
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { ref, computed, onMounted } from 'vue'
import axios from 'axios'

export default {
  name: 'ServicesCarousel',
  setup() {
    const currentBatch = ref(0)
    const services = ref([])
    const loading = ref(true)

    const truncateDescription = (html) => {
      if (!html) return ''
      const div = document.createElement('div')
      div.innerHTML = html
      const text = div.textContent || ''
      return text.length > 100 ? text.slice(0, 100) + '...' : text
    }

    const fetchServices = async () => {
      try {
        const { data } = await axios.get('/api/services')
        services.value = data
      } catch {
        services.value = [
          { id: 1, name: 'Elevated Pressed Steel Tanks', slug: 'elevated-pressed-steel-tanks', description: 'High-capacity water storage tanks elevated for gravity-fed water distribution systems.', image: '/images/services/tank-elevated.jpg' },
          { id: 2, name: 'Galvanized Steel Tanks', slug: 'galvanized-steel-tanks', description: 'Corrosion-resistant hot-dipped galvanized steel tanks for long-lasting water storage.', image: '/images/services/tank-galvanized.jpg' },
          { id: 3, name: 'GRP Water Tanks', slug: 'grp-water-tanks', description: 'Glass Reinforced Plastic tanks - lightweight, durable and corrosion-resistant.', image: '/images/services/tank-grp.jpg' },
          { id: 4, name: 'Ground Level Tanks', slug: 'ground-level-tanks', description: 'Large capacity underground or ground-level water storage solutions.', image: '/images/services/tank-ground.jpg' },
          { id: 5, name: 'Rooftop Tanks', slug: 'rooftop-tanks', description: 'Lightweight rooftop water storage tanks for commercial and residential buildings.', image: '/images/services/tank-rooftop.jpg' },
          { id: 6, name: 'Steel Fabrication', slug: 'steel-fabrication', description: 'Custom steel fabrication services for industrial and commercial applications.', image: '/images/services/steel-fab.jpg' }
        ]
      } finally {
        loading.value = false
      }
    }

    const batches = computed(() => {
      const size = 3
      const out = []
      for (let i = 0; i < services.value.length; i += size) {
        out.push(services.value.slice(i, i + size))
      }
      return out
    })

    const nextBatch = () => {
      if (currentBatch.value < batches.value.length - 1) {
        currentBatch.value++
      }
    }

    const prevBatch = () => {
      if (currentBatch.value > 0) {
        currentBatch.value--
      }
    }

    const goToBatch = (i) => (currentBatch.value = i)

    onMounted(fetchServices)

    return {
      loading,
      currentBatch,
      batches,
      nextBatch,
      prevBatch,
      goToBatch,
      truncateDescription
    }
  }
}
</script>

<style scoped>
.services-section {
  padding: 60px 0 40px 0;
  background: var(--white);
}

.container {
  max-width: 1200px;
  padding: 0 50px;
  margin: auto;
}

.section-header {
  text-align: center;
  margin-bottom: 50px;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 900;
  color: var(--charcoal);
  margin-bottom: 16px;
  text-transform: uppercase;
  letter-spacing: 2px;
  position: relative;
  display: inline-block;
}

.section-subtitle {
  max-width: 600px;
  margin: 16px auto 0;
  color: #666;
  font-size: 1rem;
  line-height: 1.6;
  text-transform: uppercase;
  font-weight: bold;
}

.carousel-wrapper {
  position: relative;
  width: 100%;
}

.loading-state {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 20px;
  padding: 60px 20px;
  color: #888;
  min-height: 400px;
}

.spinner {
  width: 48px;
  height: 48px;
  border: 4px solid #444;
  border-top-color: var(--royal-yellow);
  animation: spin 0.8s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

.carousel-track {
  position: relative;
  width: 100%;
}

.services-batch {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
}

.service-card {
  background: var(--white);
  overflow: hidden;
  display: flex;
  flex-direction: column;
  transition: all 0.2s;
  border: 1px solid #e0e0e0;
}

.service-card:hover {
  border-color: var(--royal-yellow);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.card-image-wrapper {
  width: 100%;
  aspect-ratio: 16 / 10;
  background: #333;
  display: flex;
  align-items: center;
  justify-content: center;
}

.card-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.card-content {
  padding: 24px;
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.card-title {
  font-size: 1.1rem;
  font-weight: 700;
  color: var(--charcoal);
  text-transform: uppercase;
  line-height: 1.3;
}

.service-card:hover .card-title {
  color: var(--charcoal);
}

.card-description {
  color: #666;
  font-size: 0.9rem;
  line-height: 1.5;
  flex: 1;
}

.service-card:hover .card-description {
  color: #333;
}

.card-link {
  margin-top: auto;
  font-weight: 700;
  color: var(--charcoal);
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.1s;
  padding: 8px 0;
  text-transform: uppercase;
  font-size: 0.85rem;
}

.card-link:hover {
  color: var(--charcoal);
  gap: 12px;
}

.card-link svg {
  transition: transform 0.1s;
}

.card-link:hover svg {
  transform: translateX(4px);
}

.carousel-nav {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: var(--royal-yellow);
  color: var(--charcoal);
  border: none;
  width: 44px;
  height: 44px;
  cursor: pointer;
  z-index: 10;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  font-weight: bold;
}

.carousel-nav:hover:not(:disabled) {
  background: var(--white);
}

.carousel-nav:disabled {
  opacity: 0.3;
  cursor: not-allowed;
}

.carousel-nav.prev { left: -22px }
.carousel-nav.next { right: -22px }

.carousel-dots {
  display: flex;
  justify-content: center;
  gap: 8px;
  margin-top: 30px;
}

.dot {
  width: 12px;
  height: 12px;
  background: #444;
  border: none;
  cursor: pointer;
  transition: all 0.1s;
  padding: 0;
}

.dot:hover:not(.active) {
  background: #666;
}

.dot.active {
  background: var(--royal-yellow);
  width: 36px;
}

/* Slide transitions */
.slide-fade-enter-active {
  transition: all 0.3s ease;
}

.slide-fade-leave-active {
  transition: all 0.2s ease;
  position: absolute;
}

.slide-fade-enter-from {
  opacity: 0;
  transform: translateX(20px);
}

.slide-fade-leave-to {
  opacity: 0;
  transform: translateX(-20px);
}

/* Responsive Design */
@media (max-width: 1024px) {
  .container {
    padding: 0 24px;
  }

  .services-batch {
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
  }
}

@media (max-width: 768px) {
  .services-section {
    padding: 40px 0 30px 0;
  }

  .section-title {
    font-size: 1.75rem;
  }

  .services-batch {
    grid-template-columns: 1fr;
    gap: 20px;
  }

  .carousel-nav {
    display: none;
  }

  .card-content {
    padding: 20px;
  }

  .card-title {
    font-size: 1rem;
  }
}
</style>

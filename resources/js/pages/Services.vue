<template>
  <section class="services-section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">OUR PRODUCTS</h2>
        <p class="section-subtitle">
          Premium steel water storage solutions for industrial and commercial use
        </p>
      </div>

      <div v-if="loading" class="loading-state">
        <div class="spinner"></div>
        <p>Loading products...</p>
      </div>

      <div v-else>
        <!-- Services Grid -->
        <div class="services-grid">
          <div
            v-for="service in paginatedServices"
            :key="service.slug"
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
              <h3 class="card-title">{{ service.title || service.name }}</h3>
              <p class="card-description" v-html="truncateDescription(service.description)"></p>
              <a :href="`/show/product/${service.slug}`" class="card-link">
                VIEW DETAILS
                <i class="fas fa-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>

        <!-- Pagination Controls -->
        <div v-if="totalPages > 1" class="pagination-wrapper">
          <button 
            class="pagination-btn"
            @click="goToPage(currentPage - 1)"
            :disabled="currentPage === 1"
            aria-label="Previous page"
          >
            <i class="fas fa-chevron-left"></i>
          </button>

          <div class="pagination-numbers">
            <button
              v-for="page in displayedPages"
              :key="page"
              @click="goToPage(page)"
              :class="['page-number', { active: currentPage === page, ellipsis: page === '...' }]"
              :disabled="page === '...'"
            >
              {{ page }}
            </button>
          </div>

          <button 
            class="pagination-btn"
            @click="goToPage(currentPage + 1)"
            :disabled="currentPage === totalPages"
            aria-label="Next page"
          >
            <i class="fas fa-chevron-right"></i>
          </button>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import axios from 'axios'

const currentPage = ref(1)
const itemsPerPage = ref(8)
const services = ref([])
const loading = ref(true)

// Helper function to decode HTML entities
const decodeHtmlEntities = (text) => {
  const textarea = document.createElement('textarea')
  textarea.innerHTML = text
  return textarea.value
}

// Helper function to strip HTML tags
const stripHtmlTags = (html) => {
  const div = document.createElement('div')
  div.innerHTML = html
  return div.textContent || div.innerText || ''
}

// Truncate description to uniform length
const truncateDescription = (description) => {
  if (!description) return ''
  
  let cleanText = stripHtmlTags(description)
  cleanText = decodeHtmlEntities(cleanText)
  cleanText = cleanText.trim()
  
  const maxLength = 120
  if (cleanText.length > maxLength) {
    return cleanText.substring(0, maxLength).trim() + '...'
  }
  
  return cleanText
}

const fetchServices = async () => {
  try {
    loading.value = true
    const response = await axios.get('/api/services')
    // Fix image paths - remove incorrect path prefix if exists (same as Header.vue)
    services.value = response.data.map(service => {
      if (service.image) {
        // Fix image URLs by removing the incorrect path (same logic as Header.vue)
        service.image = service.image.replace('/wabe_digital_agency/upload/service_image/', '/upload/service_image/')
        // Also handle other variations
        service.image = service.image.replace('/wabe_digital_agency', '')
      }
      return service
    })
  } catch (error) {
    console.error('Error fetching services:', error)
    // Fallback to hardcoded services if API fails
    services.value = [
      { title: 'Elevated Pressed Steel Tanks', description: 'High-capacity water storage tanks elevated for gravity-fed water distribution systems.', image: '/images/services/tank-elevated.jpg', slug: 'elevated-pressed-steel-tanks' },
      { title: 'Galvanized Steel Tanks', description: 'Corrosion-resistant hot-dipped galvanized steel tanks for long-lasting water storage.', image: '/images/services/tank-galvanized.jpg', slug: 'galvanized-steel-tanks' },
      { title: 'GRP Water Tanks', description: 'Glass Reinforced Plastic tanks - lightweight, durable and corrosion-resistant.', image: '/images/services/tank-grp.jpg', slug: 'grp-water-tanks' },
      { title: 'Ground Level Tanks', description: 'Large capacity underground or ground-level water storage solutions.', image: '/images/services/tank-ground.jpg', slug: 'ground-level-tanks' },
      { title: 'Rooftop Tanks', description: 'Lightweight rooftop water storage tanks for commercial and residential buildings.', image: '/images/services/tank-rooftop.jpg', slug: 'rooftop-tanks' },
      { title: 'Steel Fabrication', description: 'Custom steel fabrication services for industrial and commercial applications.', image: '/images/services/steel-fab.jpg', slug: 'steel-fabrication' }
    ]
  } finally {
    loading.value = false
  }
}

const totalPages = computed(() => {
  return Math.ceil(services.value.length / itemsPerPage.value)
})

const paginatedServices = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value
  const end = start + itemsPerPage.value
  return services.value.slice(start, end)
})

const displayedPages = computed(() => {
  const pages = []
  const total = totalPages.value
  const current = currentPage.value
  
  if (total <= 7) {
    for (let i = 1; i <= total; i++) {
      pages.push(i)
    }
  } else {
    if (current <= 3) {
      for (let i = 1; i <= 5; i++) pages.push(i)
      pages.push('...')
      pages.push(total)
    } else if (current >= total - 2) {
      pages.push(1)
      pages.push('...')
      for (let i = total - 4; i <= total; i++) pages.push(i)
    } else {
      pages.push(1)
      pages.push('...')
      for (let i = current - 1; i <= current + 1; i++) pages.push(i)
      pages.push('...')
      pages.push(total)
    }
  }
  
  return pages
})

const goToPage = (page) => {
  if (page >= 1 && page <= totalPages.value) {
    currentPage.value = page
    window.scrollTo({ top: 0, behavior: 'smooth' })
  }
}

onMounted(() => {
  fetchServices()
})
</script>

<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.services-section {
  padding: 80px 0;
  background: var(--charcoal);
  font-family: 'Arial Narrow', sans-serif;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 50px;
}

/* Section Header */
.section-header {
  text-align: center;
  margin-bottom: 60px;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 900;
  color: var(--white);
  margin-bottom: 16px;
  text-transform: uppercase;
  letter-spacing: 2px;
}

.section-subtitle {
  font-size: 1rem;
  color: #999;
  max-width: 600px;
  margin: 0 auto;
  line-height: 1.7;
  text-transform: uppercase;
  font-weight: bold;
}

/* Loading State */
.loading-state {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 20px;
  padding: 80px 20px;
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

/* Services Grid */
.services-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 2px;
  background: #444;
  margin-bottom: 60px;
}

.service-card {
  background: white;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  transition: background 0.1s;
}

.service-card:hover {
  background: var(--royal-yellow);
}

.card-image-wrapper {
  position: relative;
  width: 100%;
  height: 220px;
  overflow: hidden;
  background: #333;
}

.card-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.card-content {
  padding: 24px;
  flex: 1;
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

.card-description {
  font-size: 0.9rem;
  color: #666;
  line-height: 1.6;
  flex: 1;
}

.service-card:hover .card-description {
  color: #333;
}

.card-link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  color: var(--charcoal);
  text-decoration: none;
  font-size: 0.85rem;
  font-weight: 700;
  transition: all 0.1s;
  align-self: flex-start;
  margin-top: 8px;
  text-transform: uppercase;
}

.card-link:hover {
  gap: 12px;
}

.card-link i {
  transition: transform 0.1s;
}

.card-link:hover i {
  transform: translateX(4px);
}

/* Pagination */
.pagination-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  flex-wrap: wrap;
}

.pagination-btn {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 10px 16px;
  background: var(--royal-yellow);
  border: none;
  color: var(--charcoal);
  font-size: 0.9rem;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.1s;
}

.pagination-btn:hover:not(:disabled) {
  background: var(--white);
}

.pagination-btn:disabled {
  opacity: 0.4;
  cursor: not-allowed;
}

.pagination-numbers {
  display: flex;
  gap: 4px;
  align-items: center;
}

.page-number {
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #333;
  border: none;
  color: var(--white);
  font-size: 0.9rem;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.1s;
}

.page-number:hover:not(.active):not(.ellipsis) {
  background: var(--royal-yellow);
  color: var(--charcoal);
}

.page-number.active {
  background: var(--royal-yellow);
  color: var(--charcoal);
}

.page-number.ellipsis {
  background: transparent;
  cursor: default;
  color: #666;
}

/* Responsive Design */
@media (max-width: 768px) {
  .services-section {
    padding: 60px 0;
  }

  .container {
    padding: 0 20px;
  }

  .section-title {
    font-size: 1.75rem;
  }

  .services-grid {
    grid-template-columns: 1fr;
    gap: 1px;
  }

  .card-content {
    padding: 20px;
  }

  .page-number {
    width: 36px;
    height: 36px;
    font-size: 0.85rem;
  }
}
</style>
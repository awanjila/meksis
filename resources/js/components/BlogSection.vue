<template>
  <section class="blog-section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">LATEST NEWS</h2>
        <p class="section-subtitle">
          Industry insights and updates from Meksis Engineering
        </p>
      </div>

      <div class="carousel-wrapper">
        <div v-if="loading" class="loading-state">
          <div class="spinner"></div>
          <p>Loading articles...</p>
        </div>
        
        <transition-group v-else name="slide-fade" tag="div" class="carousel-track">
          <div
            v-for="(batch, batchIndex) in batches"
            :key="batchIndex"
            v-show="currentBatch === batchIndex"
            class="blog-batch"
          >
            <article
              v-for="(blog, index) in batch"
              :key="`${batchIndex}-${index}`"
              class="blog-card"
            >
              <div class="card-image-wrapper">
                <img 
                  :src="blog.image || '/images/blog/default.jpg'" 
                  :alt="blog.name" 
                  class="card-image" 
                />
              </div>
              <div class="card-content">
                <div class="card-meta">
                  <span class="meta-date">
                    {{ formatDate(blog.created_at) }}
                  </span>
                </div>
                <h3 class="card-title">{{ blog.name }}</h3>
                <p class="card-excerpt">{{ truncateExcerpt(blog.meta_description) }}</p>
                <a 
                  v-if="blog.slug" 
                  :href="`/show/blog/${blog.slug}`" 
                  class="card-link"
                >
                  READ MORE
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
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                  </svg>
                </a>
              </div>
            </article>
          </div>
        </transition-group>

        <!-- Navigation Arrows -->
        <button 
          v-if="batches.length > 1"
          class="carousel-nav prev" 
          @click="prevBatch" 
          :disabled="currentBatch === 0"
          aria-label="Previous"
        >
          ‹
        </button>

        <button 
          v-if="batches.length > 1"
          class="carousel-nav next" 
          @click="nextBatch"
          :disabled="currentBatch === batches.length - 1"
          aria-label="Next"
        >
          ›
        </button>

        <!-- Dots Indicator -->
        <div v-if="batches.length > 1" class="carousel-dots">
          <button
            v-for="(batch, index) in batches"
            :key="`dot-${index}`"
            :class="['dot', { active: currentBatch === index }]"
            @click="goToBatch(index)"
          ></button>
        </div>
      </div>

      <div class="section-footer">
        <a href="/blogs" class="view-all-link">
          VIEW ALL NEWS
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </a>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'

const currentBatch = ref(0)
const blogs = ref([])
const loading = ref(true)

// Helper function to decode HTML entities
const decodeHtmlEntities = (text) => {
  if (!text) return ''
  const textarea = document.createElement('textarea')
  textarea.innerHTML = text
  return textarea.value
}

// Helper function to strip HTML tags
const stripHtmlTags = (html) => {
  if (!html) return ''
  const div = document.createElement('div')
  div.innerHTML = html
  return div.textContent || div.innerText || ''
}

// Truncate excerpt to uniform length
const truncateExcerpt = (excerpt) => {
  if (!excerpt) return ''
  
  // Decode HTML entities and strip tags
  let cleanText = stripHtmlTags(excerpt)
  cleanText = decodeHtmlEntities(cleanText)
  
  // Trim whitespace
  cleanText = cleanText.trim()
  
  // Truncate to 140 characters
  const maxLength = 140
  if (cleanText.length > maxLength) {
    return cleanText.substring(0, maxLength).trim() + '...'
  }
  
  return cleanText
}

// Format date
const formatDate = (date) => {
  if (!date) return 'Recent'
  const d = new Date(date)
  return d.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' })
}

const batches = computed(() => {
  const batchSize = 3
  const result = []
  for (let i = 0; i < blogs.value.length; i += batchSize) {
    result.push(blogs.value.slice(i, i + batchSize))
  }
  return result
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

const goToBatch = (index) => {
  currentBatch.value = index
}

onMounted(async () => {
  try {
    loading.value = true
    const res = await fetch('/api/blogs')
    const data = await res.json()
    
    // Debug: Log blogs with missing slugs
    const missingSlug = data.filter(blog => !blog.slug)
    if (missingSlug.length > 0) {
      console.warn('Blogs missing slugs:', missingSlug)
    }
    
    blogs.value = data
  } catch (error) {
    console.error('Error fetching blogs:', error)
    blogs.value = []
  } finally {
    loading.value = false
  }
})
</script>

<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.blog-section {
  padding: 60px 0 40px 0;
  background: var(--white);
  position: relative;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 50px;
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
}

.section-subtitle {
  font-size: 1rem;
  color: #666;
  max-width: 500px;
  margin: 0 auto;
  line-height: 1.6;
  text-transform: uppercase;
  font-weight: bold;
}

.carousel-wrapper {
  position: relative;
  width: 100%;
  min-height: 450px;
}

.loading-state {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 20px;
  padding: 80px 20px;
  color: #888;
  min-height: 450px;
}

.spinner {
  width: 48px;
  height: 48px;
  border: 4px solid #ddd;
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

.blog-batch {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
  width: 100%;
}

.blog-card {
  background: #ffffff;
  overflow: hidden;
  transition: all 0.2s;
  border: 1px solid #e0e0e0;
  display: flex;
  flex-direction: column;
  height: 100%;
}

.blog-card:hover {
  border-color: var(--royal-yellow);
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.blog-card:hover .card-title {
  color: var(--royal-yellow);
}

.card-image-wrapper {
  position: relative;
  width: 100%;
  height: 200px;
  overflow: hidden;
  background: #333;
}

.card-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.card-content {
  padding: 20px;
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.card-meta {
  display: flex;
  align-items: center;
  gap: 16px;
  font-size: 0.8rem;
  color: #888;
  text-transform: uppercase;
  font-weight: 600;
  margin-bottom: 8px;
}

.card-meta::before {
  content: '';
  display: inline-block;
  width: 20px;
  height: 2px;
  background: var(--royal-yellow);
}

.blog-card:hover .card-meta {
  color: #333;
}

.card-title {
  font-size: 1.1rem;
  font-weight: 700;
  color: var(--charcoal);
  line-height: 1.4;
  text-transform: uppercase;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  transition: color 0.2s;
}

.card-excerpt {
  font-size: 0.9rem;
  color: #666;
  line-height: 1.5;
  flex: 1;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.blog-card:hover .card-excerpt {
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
  transition: all 0.2s;
  align-self: flex-start;
  padding: 8px 0;
  margin-top: auto;
  text-transform: uppercase;
}

.card-link:hover {
  gap: 12px;
  color: var(--royal-yellow);
}

.card-link svg {
  transition: transform 0.2s;
}

.card-link:hover svg {
  transform: translateX(4px);
}

.card-link.disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

/* Navigation Arrows */
.carousel-nav {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: var(--royal-yellow);
  color: var(--charcoal);
  border: none;
  width: 44px;
  height: 44px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  z-index: 10;
  font-size: 24px;
  font-weight: bold;
}

.carousel-nav:disabled {
  opacity: 0.3;
  cursor: not-allowed;
}

.carousel-nav:hover:not(:disabled) {
  background: var(--white);
}

.carousel-nav.prev {
  left: -22px;
}

.carousel-nav.next {
  right: -22px;
}

/* Dots */
.carousel-dots {
  display: flex;
  gap: 8px;
  justify-content: center;
  margin-top: 30px;
}

.dot {
  width: 12px;
  height: 12px;
  background: #ccc;
  border: none;
  cursor: pointer;
  transition: all 0.1s;
  padding: 0;
}

.dot.active {
  background: var(--royal-yellow);
  width: 36px;
}

.dot:not(.active):hover {
  background: #999;
}

/* Section Footer */
.section-footer {
  text-align: center;
  margin-top: 40px;
}

.view-all-link {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: var(--royal-yellow);
  color: var(--charcoal);
  text-decoration: none;
  padding: 14px 32px;
  font-size: 0.9rem;
  font-weight: 700;
  text-transform: uppercase;
  transition: all 0.1s;
}

.view-all-link:hover {
  background: var(--white);
  gap: 14px;
}

/* Transitions */
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

/* Responsive */
@media (max-width: 1024px) {
  .blog-batch {
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
  }
}

@media (max-width: 768px) {
  .blog-section {
    padding: 40px 0 30px 0;
  }

  .container {
    padding: 0 20px;
  }

  .section-header {
    margin-bottom: 40px;
  }

  .section-title {
    font-size: 1.75rem;
  }

  .carousel-wrapper {
    min-height: auto;
  }

  .blog-batch {
    grid-template-columns: 1fr;
    gap: 20px;
  }

  .card-image-wrapper {
    height: 180px;
  }

  .carousel-nav {
    display: none;
  }

  .carousel-dots {
    margin-top: 24px;
  }

  .view-all-link {
    padding: 12px 24px;
    font-size: 0.85rem;
  }
}
</style>
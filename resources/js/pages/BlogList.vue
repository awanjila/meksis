<template>
  <div class="blogs-page">
    <!-- Hero Section -->
    <section class="hero-section">
      <div class="container">
        <div class="hero-content">
          <h1 class="hero-title">LATEST NEWS</h1>
          <p class="hero-subtitle">
            Industry insights and updates from Meksis Engineering
          </p>
        </div>
      </div>
    </section>

    <!-- Blogs Grid Section -->
    <section class="blogs-grid-section">
      <div class="container">
        <!-- Loading State -->
        <div v-if="loading" class="loading-state">
          <div class="spinner"></div>
          <p>Loading articles...</p>
        </div>

        <!-- Blogs Grid -->
        <div v-else-if="paginatedBlogs.length > 0" class="blogs-grid">
          <article
            v-for="blog in paginatedBlogs"
            :key="blog.id"
            class="blog-card"
          >
            <div class="card-image-wrapper">
              <img 
                :src="blog.image || '/images/blog/default.jpg'" 
                :alt="blog.name" 
                class="card-image" 
              />
              <div v-if="blog.category" class="card-category">{{ blog.category.name }}</div>
            </div>
            <div class="card-content">
              <div class="card-meta">
                <span class="meta-date">
                  {{ formatDate(blog.created_at) }}
                </span>
              </div>
              <h3 class="card-title">{{ blog.name }}</h3>
              <p class="card-excerpt">{{ truncateExcerpt(blog.meta_description) }}</p>
              <a :href="`show/blog/${blog.slug}`" class="card-link">
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

        <!-- Empty State -->
        <div v-else class="empty-state">
          <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
            <line x1="16" y1="13" x2="8" y2="13"></line>
            <line x1="16" y1="17" x2="8" y2="17"></line>
          </svg>
          <h3>No articles found</h3>
          <p>Check back soon for new content.</p>
        </div>

        <!-- Pagination -->
        <div v-if="!loading && blogs.length > blogsPerPage" class="pagination">
          <button 
            class="pagination-btn" 
            :disabled="currentPage === 1"
            @click="goToPage(currentPage - 1)"
          >
            ‹ PREV
          </button>

          <div class="pagination-numbers">
            <button
              v-for="page in visiblePages"
              :key="page"
              :class="['page-number', { active: currentPage === page }]"
              @click="goToPage(page)"
            >
              {{ page }}
            </button>
          </div>

          <button 
            class="pagination-btn" 
            :disabled="currentPage === totalPages"
            @click="goToPage(currentPage + 1)"
          >
            NEXT ›
          </button>
        </div>

        <!-- Results Info -->
        <div v-if="!loading && blogs.length > 0" class="results-info">
          Showing {{ startIndex + 1 }}-{{ Math.min(endIndex, blogs.length) }} of {{ blogs.length }} articles
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'

const blogs = ref([])
const loading = ref(true)
const currentPage = ref(1)
const blogsPerPage = ref(9)

const decodeHtmlEntities = (text) => {
  if (!text) return ''
  const textarea = document.createElement('textarea')
  textarea.innerHTML = text
  return textarea.value
}

const stripHtmlTags = (html) => {
  if (!html) return ''
  const div = document.createElement('div')
  div.innerHTML = html
  return div.textContent || div.innerText || ''
}

const truncateExcerpt = (excerpt) => {
  if (!excerpt) return ''
  
  let cleanText = stripHtmlTags(excerpt)
  cleanText = decodeHtmlEntities(cleanText)
  cleanText = cleanText.trim()
  
  const maxLength = 120
  if (cleanText.length > maxLength) {
    return cleanText.substring(0, maxLength).trim() + '...'
  }
  
  return cleanText
}

const formatDate = (date) => {
  if (!date) return 'Recent'
  const d = new Date(date)
  return d.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' })
}

const totalPages = computed(() => Math.ceil(blogs.value.length / blogsPerPage.value))

const startIndex = computed(() => (currentPage.value - 1) * blogsPerPage.value)
const endIndex = computed(() => currentPage.value * blogsPerPage.value)

const paginatedBlogs = computed(() => {
  return blogs.value.slice(startIndex.value, endIndex.value)
})

const visiblePages = computed(() => {
  const pages = []
  const maxVisible = 5
  let start = Math.max(1, currentPage.value - Math.floor(maxVisible / 2))
  let end = Math.min(totalPages.value, start + maxVisible - 1)
  
  if (end - start < maxVisible - 1) {
    start = Math.max(1, end - maxVisible + 1)
  }
  
  for (let i = start; i <= end; i++) {
    pages.push(i)
  }
  
  return pages
})

const goToPage = (page) => {
  if (page >= 1 && page <= totalPages.value) {
    currentPage.value = page
    window.scrollTo({ top: 0, behavior: 'smooth' })
  }
}

onMounted(async () => {
  try {
    loading.value = true
    const res = await fetch('/api/blogs')
    blogs.value = await res.json()
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

.blogs-page {
  min-height: 100vh;
  background: var(--charcoal);
}

/* Hero Section */
.hero-section {
  background: var(--charcoal);
  padding: 60px 0 50px;
  border-bottom: 5px solid var(--royal-yellow);
}

.hero-content {
  text-align: center;
}

.hero-title {
  font-size: 2.5rem;
  font-weight: 900;
  color: var(--white);
  margin-bottom: 16px;
  text-transform: uppercase;
  letter-spacing: 2px;
}

.hero-subtitle {
  font-size: 1rem;
  color: #999;
  max-width: 500px;
  margin: 0 auto;
  line-height: 1.6;
  text-transform: uppercase;
  font-weight: bold;
}

/* Blogs Grid Section */
.blogs-grid-section {
  padding: 40px 0 60px;
  background: var(--white);
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 50px;
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

/* Blogs Grid */
.blogs-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 2px;
  background: #ddd;
  margin-bottom: 40px;
}

.blog-card {
  background: var(--white);
  overflow: hidden;
  transition: background 0.1s;
  display: flex;
  flex-direction: column;
  height: 100%;
}

.blog-card:hover {
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

.card-category {
  position: absolute;
  top: 16px;
  left: 16px;
  background: var(--charcoal);
  color: var(--white);
  padding: 6px 12px;
  font-size: 0.7rem;
  font-weight: 700;
  text-transform: uppercase;
  z-index: 2;
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
  font-size: 0.75rem;
  color: #888;
  text-transform: uppercase;
  font-weight: bold;
}

.card-title {
  font-size: 1.1rem;
  font-weight: 700;
  color: var(--charcoal);
  line-height: 1.3;
  text-transform: uppercase;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
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
  font-size: 0.8rem;
  font-weight: 700;
  transition: all 0.1s;
  align-self: flex-start;
  padding: 8px 0;
  margin-top: auto;
  text-transform: uppercase;
}

.card-link:hover {
  gap: 12px;
}

/* Empty State */
.empty-state {
  text-align: center;
  padding: 80px 20px;
  color: #888;
}

.empty-state svg {
  margin: 0 auto 24px;
  opacity: 0.5;
}

.empty-state h3 {
  font-size: 1.5rem;
  color: var(--charcoal);
  margin-bottom: 12px;
  text-transform: uppercase;
}

.empty-state p {
  font-size: 1rem;
}

/* Pagination */
.pagination {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  margin-bottom: 24px;
}

.pagination-btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 10px 20px;
  background: var(--charcoal);
  border: none;
  color: var(--white);
  font-size: 0.8rem;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.1s;
  text-transform: uppercase;
}

.pagination-btn:disabled {
  opacity: 0.3;
  cursor: not-allowed;
}

.pagination-btn:not(:disabled):hover {
  background: var(--royal-yellow);
  color: var(--charcoal);
}

.pagination-numbers {
  display: flex;
  gap: 4px;
}

.page-number {
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #eee;
  border: none;
  color: var(--charcoal);
  font-size: 0.85rem;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.1s;
}

.page-number:hover:not(.active) {
  background: var(--royal-yellow);
}

.page-number.active {
  background: var(--charcoal);
  color: var(--white);
}

/* Results Info */
.results-info {
  text-align: center;
  color: #888;
  font-size: 0.85rem;
  text-transform: uppercase;
  font-weight: bold;
}

/* Responsive */
@media (max-width: 1024px) {
  .blogs-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 768px) {
  .hero-section {
    padding: 40px 0 30px;
  }

  .hero-title {
    font-size: 1.75rem;
  }

  .blogs-grid-section {
    padding: 30px 0 40px;
  }

  .container {
    padding: 0 20px;
  }

  .blogs-grid {
    grid-template-columns: 1fr;
    gap: 1px;
  }

  .card-title {
    font-size: 1rem;
  }

  .pagination {
    flex-wrap: wrap;
  }

  .pagination-btn {
    padding: 8px 16px;
    font-size: 0.75rem;
  }
}
</style>

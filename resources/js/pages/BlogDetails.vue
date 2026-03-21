<template>
  <div class="blog-detail-page">
    <!-- Loading State -->
    <div v-if="loading" class="loading-container">
      <div class="spinner"></div>
      <p>Loading article...</p>
    </div>

    <!-- Blog Content -->
    <div v-else-if="blog" class="blog-container">
      <div class="container">
        <div class="blog-layout">
          <!-- Main Content -->
          <article class="blog-main">
            <!-- Breadcrumb -->
            <nav class="breadcrumb">
              <a href="/">Home</a>
              <span class="separator">/</span>
              <a href="/blogs">Blog</a>
              <span class="separator">/</span>
              <span class="current">{{ blog.name }}</span>
            </nav>

            <!-- Category Badge -->
            <div v-if="blog.category" class="category-badge">
              {{ blog.category.name }}
            </div>

            <!-- Title -->
            <h1 class="blog-title">{{ blog.name }}</h1>

            <!-- Meta Information -->
            <div class="blog-meta">
              <div class="meta-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"></circle>
                  <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                <span>{{ formatDate(blog.created_at) }}</span>
              </div>
              <div v-if="blog.author" class="meta-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                  <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span>{{ blog.author }}</span>
              </div>
            </div>

            <!-- Featured Image -->
            <div v-if="blog.image" class="featured-image">
              <img :src="blog.image.startsWith('http') ? blog.image : '/' + blog.image" />
            </div>

            <!-- Blog Content -->
            <div class="blog-content" v-html="blog.description"></div>

            <!-- Share Section -->
            <div class="share-section">
              <span class="share-label">Share</span>
              <div class="share-buttons">
                <button class="share-btn twitter" @click="shareOnTwitter">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                  </svg>
                </button>
                <button class="share-btn facebook" @click="shareOnFacebook">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                  </svg>
                </button>
                <button class="share-btn linkedin" @click="shareOnLinkedIn">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                  </svg>
                </button>
                <button class="share-btn copy" @click="copyLink">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                  </svg>
                </button>
              </div>
              <span v-if="linkCopied" class="copy-message">Link copied</span>
            </div>
          </article>

          <!-- Sidebar -->
          <aside class="blog-sidebar">
            <!-- Recent Posts -->
            <div class="sidebar-widget">
              <h3 class="widget-title">Recent Articles</h3>
              
              <div v-if="loadingRecent" class="widget-loading">
                <div class="mini-spinner"></div>
              </div>
              
              <div v-else-if="recentPosts.length > 0" class="recent-posts">
                <a 
                  v-for="post in recentPosts" 
                  :key="post.id"
                  :href="`/blog/${post.slug}`"
                  class="recent-post-item"
                >
                  <h4 class="recent-post-title">{{ post.name }}</h4>
                  <span class="recent-post-date">{{ formatDate(post.created_at) }}</span>
                </a>
              </div>
            </div>

            <!-- Categories Widget -->
            <div v-if="categories.length > 0" class="sidebar-widget">
              <h3 class="widget-title">Categories</h3>
              
              <div v-if="loadingCategories" class="widget-loading">
                <div class="mini-spinner"></div>
              </div>
              
              <div v-else class="categories-list">
                <a 
                  v-for="category in categories" 
                  :key="category.id"
                  :href="`/blogs?category=${category.slug}`"
                  class="category-item"
                >
                  {{ category.name }}
                </a>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </div>

    <!-- Error State -->
    <div v-else class="error-state">
      <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"></circle>
        <line x1="12" y1="8" x2="12" y2="12"></line>
        <line x1="12" y1="16" x2="12.01" y2="16"></line>
      </svg>
      <h2>Article Not Found</h2>
      <p>The article you're looking for doesn't exist or has been removed.</p>
      <a href="/blogs" class="back-link">Back to All Articles</a>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

// Accept slug as a prop
const props = defineProps({
  slug: {
    type: String,
    required: true
  }
})

const blog = ref(null)
const recentPosts = ref([])
const categories = ref([])
const loading = ref(true)
const loadingRecent = ref(true)
const loadingCategories = ref(true)
const linkCopied = ref(false)

// Format date
const formatDate = (date) => {
  if (!date) return 'Recent'
  const d = new Date(date)
  return d.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })
}

// Share functions
const shareOnTwitter = () => {
  const url = window.location.href
  const text = blog.value.name
  window.open(`https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(text)}`, '_blank')
}

const shareOnFacebook = () => {
  const url = window.location.href
  window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`, '_blank')
}

const shareOnLinkedIn = () => {
  const url = window.location.href
  window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(url)}`, '_blank')
}

const copyLink = async () => {
  try {
    await navigator.clipboard.writeText(window.location.href)
    linkCopied.value = true
    setTimeout(() => {
      linkCopied.value = false
    }, 2000)
  } catch (err) {
    console.error('Failed to copy link:', err)
  }
}

// Fetch blog post
const fetchBlog = async () => {
  try {
    loading.value = true
    const res = await fetch(`/api/blog/${props.slug}`)
    if (res.ok) {
      blog.value = await res.json()
    } else {
      blog.value = null
    }
  } catch (error) {
    console.error('Error fetching blog:', error)
    blog.value = null
  } finally {
    loading.value = false
  }
}

// Fetch recent posts
const fetchRecentPosts = async () => {
  try {
    loadingRecent.value = true
    const res = await fetch('/api/blogs?limit=5')
    const data = await res.json()
    // Filter out current post
    recentPosts.value = data.filter(post => post.slug !== props.slug).slice(0, 4)
  } catch (error) {
    console.error('Error fetching recent posts:', error)
    recentPosts.value = []
  } finally {
    loadingRecent.value = false
  }
}

// Fetch categories
const fetchCategories = async () => {
  try {
    loadingCategories.value = true
    const res = await fetch('/api/blog-categories')
    if (res.ok) {
      categories.value = await res.json()
    }
  } catch (error) {
    console.error('Error fetching categories:', error)
    categories.value = []
  } finally {
    loadingCategories.value = false
  }
}

onMounted(() => {
  fetchBlog()
  fetchRecentPosts()
  fetchCategories()
})
</script>

<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.blog-detail-page {
  min-height: 100vh;
  background: var(--bg-primary, #ffffff);
}

/* Loading State */
.loading-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  gap: 20px;
  color: #666;
}

.spinner {
  width: 48px;
  height: 48px;
  border: 3px solid #f0f0f0;
  border-top-color: var(--accent-primary, #ffc107);
  animation: spin 0.8s linear infinite;
}

.mini-spinner {
  width: 24px;
  height: 24px;
  border: 3px solid #f0f0f0;
  border-top-color: var(--accent-primary, #ffc107);
  animation: spin 0.8s linear infinite;
  margin: 20px auto;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

/* Blog Container */
.blog-container {
  padding: 60px 0 120px;
}

.container {
  max-width: 1400px;
  margin: 0 auto;
  padding: 0 60px;
}

.blog-layout {
  display: grid;
  grid-template-columns: 1fr 300px;
  gap: 80px;
  align-items: start;
}

/* Main Content */
.blog-main {
  background: var(--bg-primary, #ffffff);
  padding: 0;
}

/* Breadcrumb */
.breadcrumb {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 30px;
  font-size: 0.875rem;
  color: #666;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.breadcrumb a {
  color: var(--text-primary, #1a1a1a);
  text-decoration: none;
  transition: color 0.2s;
}

.breadcrumb a:hover {
  color: var(--accent-primary, #ffc107);
}

.breadcrumb .separator {
  color: #ccc;
}

.breadcrumb .current {
  color: #999;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 300px;
}

/* Category Badge */
.category-badge {
  display: inline-block;
  background: var(--accent-primary, #ffc107);
  color: var(--text-primary, #1a1a1a);
  padding: 6px 16px;
  font-size: 0.75rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: 24px;
}

/* Title */
.blog-title {
  font-size: 3.5rem;
  font-weight: 700;
  color: var(--text-primary, #1a1a1a);
  line-height: 1.1;
  margin-bottom: 30px;
  letter-spacing: -0.03em;
  text-transform: uppercase;
}

/* Meta */
.blog-meta {
  display: flex;
  gap: 24px;
  margin-bottom: 50px;
  padding-bottom: 30px;
  border-bottom: 2px solid var(--text-primary, #1a1a1a);
}

.meta-item {
  display: flex;
  align-items: center;
  gap: 6px;
  color: #666;
  font-size: 0.875rem;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.meta-item svg {
  color: var(--accent-primary, #ffc107);
}

/* Featured Image */
.featured-image {
  width: 100%;
  height: 500px;
  overflow: hidden;
  margin-bottom: 60px;
  border: 2px solid var(--text-primary, #1a1a1a);
}

.featured-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* Blog Content */
.blog-content {
  font-size: 1.125rem;
  line-height: 1.8;
  color: #333;
  margin-bottom: 60px;
  font-weight: 400;
}

.blog-content :deep(h2) {
  font-size: 2rem;
  font-weight: 700;
  color: var(--text-primary, #1a1a1a);
  margin: 50px 0 24px;
  letter-spacing: -0.02em;
  text-transform: uppercase;
  border-left: 4px solid var(--accent-primary, #ffc107);
  padding-left: 20px;
}

.blog-content :deep(h3) {
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--text-primary, #1a1a1a);
  margin: 40px 0 20px;
  letter-spacing: -0.01em;
  text-transform: uppercase;
}

.blog-content :deep(p) {
  margin-bottom: 24px;
}

.blog-content :deep(ul),
.blog-content :deep(ol) {
  margin: 24px 0 24px 24px;
}

.blog-content :deep(li) {
  margin-bottom: 12px;
}

.blog-content :deep(a) {
  color: var(--accent-primary, #ffc107);
  text-decoration: underline;
  text-decoration-color: rgba(255, 193, 7, 0.3);
  transition: text-decoration-color 0.2s;
  background: var(--text-primary, #1a1a1a);
  padding: 2px 6px;
}

.blog-content :deep(a:hover) {
  text-decoration-color: rgba(255, 193, 7, 1);
}

.blog-content :deep(img) {
  max-width: 100%;
  height: auto;
  margin: 40px 0;
  border: 2px solid var(--text-primary, #1a1a1a);
}

.blog-content :deep(blockquote) {
  border-left: 4px solid var(--accent-primary, #ffc107);
  padding: 20px 30px;
  margin: 40px 0;
  background: #f9f9f9;
  font-style: italic;
  border-right: 2px solid var(--text-primary, #1a1a1a);
}

/* Share Section */
.share-section {
  display: flex;
  align-items: center;
  gap: 20px;
  padding: 40px 0;
  border-top: 2px solid var(--text-primary, #1a1a1a);
  position: relative;
}

.share-label {
  font-size: 0.875rem;
  font-weight: 700;
  color: var(--text-primary, #1a1a1a);
  text-transform: uppercase;
  letter-spacing: 1px;
}

.share-buttons {
  display: flex;
  gap: 12px;
}

.share-btn {
  width: 40px;
  height: 40px;
  border: 2px solid var(--text-primary, #1a1a1a);
  background: var(--bg-primary, #ffffff);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.2s;
  color: var(--text-primary, #1a1a1a);
}

.share-btn:hover {
  background: var(--accent-primary, #ffc107);
  border-color: var(--accent-primary, #ffc107);
  color: var(--text-primary, #1a1a1a);
}

.copy-message {
  position: absolute;
  bottom: -30px;
  left: 0;
  background: var(--text-primary, #1a1a1a);
  color: var(--accent-primary, #ffc107);
  padding: 6px 12px;
  font-size: 0.75rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
}

/* Sidebar */
.blog-sidebar {
  position: sticky;
  top: 100px;
}

.sidebar-widget {
  background: var(--bg-primary, #ffffff);
  padding: 0;
  margin-bottom: 50px;
}

.widget-title {
  font-size: 0.875rem;
  font-weight: 700;
  color: var(--text-primary, #1a1a1a);
  margin-bottom: 24px;
  text-transform: uppercase;
  letter-spacing: 2px;
  border-bottom: 2px solid var(--text-primary, #1a1a1a);
  padding-bottom: 12px;
}

.widget-loading {
  text-align: center;
  padding: 20px;
}

/* Recent Posts */
.recent-posts {
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.recent-post-item {
  display: flex;
  flex-direction: column;
  gap: 8px;
  text-decoration: none;
  transition: all 0.2s;
  padding-bottom: 24px;
  border-bottom: 1px solid #e5e5e5;
}

.recent-post-item:last-child {
  border-bottom: none;
  padding-bottom: 0;
}

.recent-post-item:hover .recent-post-title {
  color: var(--accent-primary, #ffc107);
}

.recent-post-title {
  font-size: 1rem;
  font-weight: 600;
  color: var(--text-primary, #1a1a1a);
  line-height: 1.4;
  transition: color 0.2s;
  text-transform: uppercase;
}

.recent-post-date {
  font-size: 0.8rem;
  color: #999;
  text-transform: uppercase;
  letter-spacing: 1px;
}

/* Categories List */
.categories-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.category-item {
  display: block;
  padding: 12px 0;
  text-decoration: none;
  color: var(--text-primary, #1a1a1a);
  font-weight: 700;
  font-size: 0.9rem;
  transition: all 0.2s;
  border-bottom: 1px solid #e5e5e5;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.category-item:last-child {
  border-bottom: none;
}

.category-item:hover {
  color: var(--accent-primary, #ffc107);
  padding-left: 10px;
}

/* Error State */
.error-state {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  text-align: center;
  padding: 40px;
  color: #666;
}

.error-state svg {
  margin-bottom: 24px;
  color: var(--accent-primary, #ffc107);
}

.error-state h2 {
  font-size: 2rem;
  color: var(--text-primary, #1a1a1a);
  margin-bottom: 16px;
  font-weight: 700;
  text-transform: uppercase;
}

.error-state p {
  font-size: 1.125rem;
  margin-bottom: 30px;
  max-width: 500px;
}

.back-link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: var(--accent-primary, #ffc107);
  color: var(--text-primary, #1a1a1a);
  text-decoration: none;
  padding: 14px 32px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: all 0.2s;
}

.back-link:hover {
  background: var(--text-primary, #1a1a1a);
  color: var(--accent-primary, #ffc107);
}

/* Responsive */
@media (max-width: 1024px) {
  .blog-layout {
    grid-template-columns: 1fr;
    gap: 60px;
  }

  .blog-sidebar {
    position: static;
    max-width: 600px;
  }
}

@media (max-width: 768px) {
  .blog-container {
    padding: 40px 0 80px;
  }

  .container {
    padding: 0 24px;
  }

  .blog-title {
    font-size: 2.5rem;
  }

  .featured-image {
    height: 300px;
  }

  .blog-content {
    font-size: 1rem;
  }

  .blog-meta {
    gap: 16px;
    flex-wrap: wrap;
  }
}

@media (max-width: 480px) {
  .blog-title {
    font-size: 2rem;
  }

  .breadcrumb .current {
    max-width: 150px;
  }

  .featured-image {
    height: 250px;
  }

  .share-section {
    flex-direction: column;
    align-items: flex-start;
    gap: 16px;
  }
}
</style>
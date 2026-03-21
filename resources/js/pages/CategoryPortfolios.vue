<template>
  <div class="category-portfolios-page">
    <!-- Hero Section -->
    <section class="hero-section">
      <div class="container">
        <h1 class="hero-title">{{ category.name }} Projects</h1>
        <p class="hero-subtitle" v-html="sanitizeHtml(category.description)"></p>
        <p class="hero-description">
          Explore our complete portfolio of {{ portfolios.length }} projects in this category.
        </p>
        <a href="/our-works" class="back-btn">
          ← Back to Our Works
        </a>
      </div>
    </section>

    <!-- Portfolios Grid -->
    <section class="portfolios-section">
      <div class="container">
        <div class="portfolios-grid" v-if="portfolios.length > 0">
          <div class="portfolio-card" v-for="portfolio in portfolios" :key="portfolio.id">
            <div class="portfolio-images" v-if="portfolio.images && portfolio.images.length > 0">
              <div class="main-image">
                <img :src="`/${portfolio.images[0]}`" :alt="portfolio.title" />
              </div>
              <div class="image-thumbnails" v-if="portfolio.images.length > 1">
                <img
                  v-for="(image, index) in portfolio.images.slice(1, 4)"
                  :key="index"
                  :src="`/${image}`"
                  :alt="`${portfolio.title} ${index + 2}`"
                  class="thumbnail"
                />
                <div class="more-images" v-if="portfolio.images.length > 4">
                  +{{ portfolio.images.length - 4 }}
                </div>
              </div>
            </div>
            <div class="portfolio-content">
              <div class="portfolio-header">
                <h3 class="portfolio-title">{{ portfolio.title }}</h3>
                <div class="portfolio-badges">
                  <span class="badge featured" v-if="portfolio.featured">Featured</span>
                  <span class="badge category">{{ portfolio.category.name }}</span>
                </div>
              </div>
              <div class="portfolio-description" v-html="sanitizeHtml(portfolio.description)"></div>

              <div class="portfolio-details">
                <div class="detail-item" v-if="portfolio.live_url">
                  <strong>Live Demo:</strong>
                  <a :href="portfolio.live_url" target="_blank" rel="noopener noreferrer" class="live-link">
                    View Project →
                  </a>
                </div>

                <div class="detail-item" v-if="portfolio.tech_stack && portfolio.tech_stack.length > 0">
                  <strong>Tech Stack:</strong>
                  <div class="tech-tags">
                    <span class="tech-tag" v-for="tech in portfolio.tech_stack" :key="tech">{{ tech }}</span>
                  </div>
                </div>

                <div class="detail-item" v-if="portfolio.key_features">
                  <strong>Key Features:</strong>
                  <div class="key-features" v-html="sanitizeHtml(portfolio.key_features)"></div>
                </div>
              </div>

              <div class="portfolio-footer">
                <small class="created-date">
                  Created: {{ formatDate(portfolio.created_at) }}
                </small>
              </div>
            </div>
          </div>
        </div>
        <div v-else class="no-portfolios">
          <h3>No projects found in this category yet.</h3>
          <p>We're working on adding more amazing projects. Check back soon!</p>
          <a href="/our-works" class="explore-other-btn">
            Explore Other Categories →
          </a>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
      <div class="container">
        <h2 class="cta-title">Ready to Build Something Similar?</h2>
        <p class="cta-text">
          Let's create a solution that fits your business needs perfectly.
        </p>
        <div class="button-group">
          <a href="/contact" class="cta-button primary">Start Your Project →</a>
          <a href="/our-works" class="cta-button secondary">View All Categories</a>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: 'CategoryPortfolios',
  data() {
    return {
      category: {
        name: '',
        slug: '',
        description: ''
      },
      portfolios: []
    }
  },
  mounted() {
    this.fetchCategoryPortfolios()
  },
  watch: {
    '$route.params.categorySlug': function() {
      this.fetchCategoryPortfolios()
    }
  },
  methods: {
    async fetchCategoryPortfolios() {
      try {
        const categorySlug = this.$route.params.categorySlug || window.categorySlug
        const response = await fetch(`/api/portfolios/category/${categorySlug}`)

        if (response.ok) {
          const data = await response.json()
          this.category = data.category
          this.portfolios = data.portfolios
        } else {
          window.location.href = '/our-works'
        }
      } catch (error) {
        console.error('Error fetching category portfolios:', error)
        window.location.href = '/our-works'
      }
    },
    formatDate(dateString) {
      return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      })
    },
    sanitizeHtml(html) {
      if (!html) return ''
      // Remove data-start and data-end attributes while preserving HTML structure
      return html.replace(/\s*data-start="[^"]*"/g, '')
                 .replace(/\s*data-end="[^"]*"/g, '')
                 .trim()
    }
  }
}
</script>

<style scoped>
/* ===== DESIGN SYSTEM - MATCHING OURWORKS.VUE ===== */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.category-portfolios-page {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  color: #1e293b;
  line-height: 1.6;
  background: #ffffff;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 24px;
}

/* ===== HERO SECTION ===== */
.hero-section {
  background: linear-gradient(135deg, #1e3a8a 0%, #0369a1 100%);
  color: white;
  padding: 60px 24px;
  text-align: center;
}

.hero-title {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 16px;
  letter-spacing: -0.01em;
  line-height: 1.2;
}

.hero-subtitle {
  font-size: 1.2rem;
  font-weight: 300;
  margin-bottom: 16px;
  opacity: 0.95;
  line-height: 1.6;
}

.hero-description {
  font-size: 1rem;
  max-width: 700px;
  margin: 0 auto 30px;
  line-height: 1.6;
  opacity: 0.9;
}

.back-btn {
  background: white;
  color: #1e3a8a;
  padding: 12px 24px;
  border-radius: 6px;
  text-decoration: none;
  font-weight: 600;
  font-size: 0.95rem;
  border: 2px solid #0369a1;
  transition: all 0.3s ease;
  display: inline-block;
  box-shadow: 0 4px 12px rgba(30, 58, 138, 0.2);
}

.back-btn:hover {
  background: #f0f9ff;
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(30, 58, 138, 0.3);
}

/* ===== PORTFOLIOS SECTION ===== */
.portfolios-section {
  padding: 50px 24px;
  background: #f8fafc;
}

.portfolios-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
  gap: 24px;
}

.portfolio-card {
  background: white;
  border-radius: 8px;
  box-shadow: 0 2px 12px rgba(30, 58, 138, 0.08);
  overflow: hidden;
  transition: all 0.3s ease;
  border-left: 4px solid #0369a1;
}

.portfolio-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 6px 20px rgba(30, 58, 138, 0.12);
}

.portfolio-images {
  position: relative;
}

.main-image {
  height: 220px;
  overflow: hidden;
}

.main-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.portfolio-card:hover .main-image img {
  transform: scale(1.05);
}

.image-thumbnails {
  display: flex;
  gap: 8px;
  padding: 10px;
  background: rgba(30, 58, 138, 0.9);
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
}

.thumbnail {
  width: 45px;
  height: 45px;
  object-fit: cover;
  border-radius: 4px;
  border: 2px solid white;
  cursor: pointer;
  transition: all 0.3s ease;
}

.thumbnail:hover {
  transform: scale(1.1);
}

.more-images {
  width: 45px;
  height: 45px;
  background: white;
  color: #1e3a8a;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 4px;
  font-weight: 700;
  font-size: 0.75rem;
}

.portfolio-content {
  padding: 24px;
}

.portfolio-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 16px;
  flex-wrap: wrap;
  gap: 12px;
}

.portfolio-title {
  font-size: 1.3rem;
  font-weight: 700;
  color: #1e3a8a;
  margin: 0;
  flex: 1;
}

.portfolio-badges {
  display: flex;
  gap: 8px;
  flex-shrink: 0;
}

.badge {
  padding: 6px 12px;
  border-radius: 6px;
  font-size: 0.75rem;
  font-weight: 600;
}

.badge.featured {
  background: #1e3a8a;
  color: white;
}

.badge.category {
  background: #e0f2fe;
  color: #0369a1;
}

.portfolio-description {
  color: #475569;
  line-height: 1.6;
  margin-bottom: 20px;
  font-size: 0.95rem;
}

/* TinyMCE Content Styling */
.portfolio-description :deep(p) {
  margin-bottom: 12px;
}

.portfolio-description :deep(p:last-child) {
  margin-bottom: 0;
}

.portfolio-description :deep(strong) {
  color: #1e3a8a;
  font-weight: 700;
}

.portfolio-description :deep(br) {
  display: block;
  content: "";
  margin-top: 8px;
}

.portfolio-description :deep(h1),
.portfolio-description :deep(h2),
.portfolio-description :deep(h3),
.portfolio-description :deep(h4) {
  color: #1e3a8a;
  font-weight: 700;
  margin-top: 16px;
  margin-bottom: 12px;
  line-height: 1.3;
}

.portfolio-description :deep(h1) { font-size: 1.5rem; }
.portfolio-description :deep(h2) { font-size: 1.3rem; }
.portfolio-description :deep(h3) { font-size: 1.1rem; }
.portfolio-description :deep(h4) { font-size: 1rem; }

.portfolio-description :deep(ul),
.portfolio-description :deep(ol) {
  margin-left: 20px;
  margin-bottom: 12px;
}

.portfolio-description :deep(li) {
  margin-bottom: 6px;
}

.portfolio-details {
  margin-bottom: 20px;
  background: linear-gradient(135deg, #f8fafc 0%, #e0f2fe 100%);
  padding: 16px;
  border-radius: 6px;
}

.detail-item {
  margin-bottom: 16px;
}

.detail-item:last-child {
  margin-bottom: 0;
}

.detail-item strong {
  color: #1e3a8a;
  display: block;
  margin-bottom: 8px;
  font-size: 0.9rem;
  font-weight: 700;
}

.live-link {
  color: #0369a1;
  text-decoration: none;
  font-weight: 600;
  font-size: 0.9rem;
  transition: all 0.3s ease;
}

.live-link:hover {
  color: #1e3a8a;
  transform: translateX(5px);
  display: inline-block;
}

.tech-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}

.tech-tag {
  background: white;
  color: #0369a1;
  padding: 6px 12px;
  border-radius: 6px;
  font-size: 0.8rem;
  font-weight: 600;
  border: 1px solid #0369a1;
}

.key-features {
  color: #475569;
  font-size: 0.9rem;
  line-height: 1.6;
  margin: 0;
}

/* TinyMCE Content Styling for Key Features */
.key-features :deep(p) {
  margin-bottom: 10px;
}

.key-features :deep(p:last-child) {
  margin-bottom: 0;
}

.key-features :deep(strong) {
  color: #1e3a8a;
  font-weight: 700;
}

.key-features :deep(br) {
  display: block;
  content: "";
  margin-top: 6px;
}

.key-features :deep(ul),
.key-features :deep(ol) {
  margin-left: 18px;
  margin-bottom: 10px;
}

.key-features :deep(li) {
  margin-bottom: 4px;
}

.portfolio-footer {
  border-top: 1px solid #e2e8f0;
  padding-top: 12px;
  margin-top: 16px;
}

.created-date {
  color: #64748b;
  font-size: 0.85rem;
}

/* ===== NO PORTFOLIOS ===== */
.no-portfolios {
  text-align: center;
  padding: 60px 20px;
  background: white;
  border-radius: 8px;
  box-shadow: 0 2px 12px rgba(30, 58, 138, 0.08);
}

.no-portfolios h3 {
  color: #1e3a8a;
  font-size: 1.8rem;
  font-weight: 700;
  margin-bottom: 16px;
}

.no-portfolios p {
  color: #475569;
  font-size: 1rem;
  margin-bottom: 30px;
  line-height: 1.6;
}

.explore-other-btn {
  background: #1e3a8a;
  color: white;
  padding: 12px 24px;
  border-radius: 6px;
  text-decoration: none;
  font-weight: 600;
  font-size: 0.95rem;
  display: inline-block;
  transition: all 0.3s ease;
  box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3);
}

.explore-other-btn:hover {
  background: #0369a1;
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(30, 58, 138, 0.4);
}

/* ===== CTA SECTION ===== */
.cta-section {
  background: linear-gradient(135deg, #1e3a8a 0%, #0369a1 100%);
  color: white;
  text-align: center;
  padding: 60px 24px;
}

.cta-title {
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 16px;
}

.cta-text {
  font-size: 1.05rem;
  max-width: 700px;
  margin: 0 auto 30px;
  line-height: 1.6;
  opacity: 0.95;
}

.button-group {
  display: flex;
  gap: 16px;
  justify-content: center;
  flex-wrap: wrap;
}

.cta-button {
  padding: 12px 24px;
  border-radius: 6px;
  text-decoration: none;
  font-weight: 600;
  font-size: 0.95rem;
  transition: all 0.3s ease;
  display: inline-block;
}

.cta-button.primary {
  background: white;
  color: #1e3a8a;
  box-shadow: 0 4px 12px rgba(30, 58, 138, 0.2);
  border: 2px solid #0369a1;
}

.cta-button.primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(30, 58, 138, 0.3);
  background: #f0f9ff;
}

.cta-button.secondary {
  background: transparent;
  color: white;
  border: 2px solid white;
}

.cta-button.secondary:hover {
  background: white;
  color: #1e3a8a;
  transform: translateY(-2px);
}

/* ===== RESPONSIVE DESIGN ===== */
@media (max-width: 768px) {
  .hero-title {
    font-size: 2rem;
  }

  .hero-subtitle {
    font-size: 1rem;
  }

  .hero-description {
    font-size: 0.95rem;
  }

  .portfolios-section {
    padding: 40px 20px;
  }

  .portfolios-grid {
    grid-template-columns: 1fr;
    gap: 20px;
  }

  .portfolio-header {
    flex-direction: column;
    align-items: flex-start;
  }

  .portfolio-title {
    font-size: 1.2rem;
  }

  .image-thumbnails {
    padding: 8px;
  }

  .thumbnail,
  .more-images {
    width: 40px;
    height: 40px;
  }

  .button-group {
    flex-direction: column;
    align-items: center;
  }

  .cta-button {
    width: 100%;
    max-width: 300px;
    text-align: center;
  }

  .cta-title {
    font-size: 1.6rem;
  }
}

@media (max-width: 480px) {
  .hero-section,
  .portfolios-section,
  .cta-section {
    padding: 40px 20px;
  }

  .portfolio-content {
    padding: 20px;
  }

  .main-image {
    height: 180px;
  }
}
</style>
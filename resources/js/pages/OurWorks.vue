<template>
  <div class="our-works-page">
    <!-- Floating CTA Button -->
    <div class="floating-cta" :class="{ visible: floatingCtaVisible }">
      <span class="cta-text">Start a Project</span>
    </div>

    <!-- Hero Section -->
    <section class="hero-section">
      <div class="container">
        <div class="hero-content">
          <div class="hero-text">
<h1 class="hero-title">OUR WORKS — STEEL TANK PROJECTS</h1>
            <p class="hero-subtitle">From elevated pressed steel tanks to GRP water tanks — we deliver robust water storage solutions across Kenya and East Africa.</p>
          </div>
          <div class="hero-cta">
            <a href="/contact" class="cta-button primary sticky-cta">Start a Project</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Featured / Highlighted Projects -->
    <section class="featured-projects-section">
      <div class="container">
<h2 class="section-title">Featured Projects</h2>
        <p class="section-description">Showcasing our most impactful steel tank installations across Kenya.</p>
        <div class="featured-grid">
          <div class="featured-card" v-for="project in featuredProjects" :key="project.id">
            <div class="project-image">
              <img :src="project.image" :alt="project.title" />
            </div>
            <div class="project-content">
              <h3 class="project-title">{{ project.title }}</h3>
              <p class="project-description" v-html="sanitizeHtml(project.description)"></p>
              <div class="project-actions">
                <a :href="`/portfolio/category/${project.categorySlug}`" @click.prevent="navigateToCategory(project.categorySlug)" class="btn-secondary">View Project</a>
                <a href="/contact" class="btn-primary">Start Similar Project</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Portfolio Categories Section -->
    <section class="portfolio-categories-section">
      <div class="container">
        <h2 class="section-title">Portfolio Categories</h2>
        <p class="section-description">
          Explore our diverse range of solutions across different industries and technologies.
        </p>
        <div class="categories-grid" v-if="portfolioCategories.length > 0">
          <div class="category-card" v-for="category in portfolioCategories" :key="category.id">
            <div class="category-image">
              <img :src="category.random_image ? `/${category.random_image}` : '/images/placeholder.jpg'" :alt="category.name" />
            </div>
            <div class="category-content">
              <h3 class="category-title">{{ category.name }}</h3>
              <div class="category-description" v-html="sanitizeHtml(category.description) || 'Explore our projects in this category.'"></div>
              <div class="category-meta">
                <span class="portfolio-count">{{ category.portfolios_count || category.portfolio_count || 0 }} {{ (category.portfolios_count || category.portfolio_count || 0) === 1 ? 'project' : 'projects' }}</span>
              </div>
              <a :href="`/portfolio/category/${category.slug}`" @click.prevent="navigateToCategory(category.slug)" class="explore-btn">
                Explore Projects →
              </a>
            </div>
          </div>
        </div>
        <div v-else class="no-categories">
          <p>No portfolio categories available yet.</p>
        </div>
      </div>
    </section>

    <!-- Testimonials / Client Quotes -->
    <section class="testimonials-section">
      <div class="container">
        <h2 class="section-title">Client Success Stories</h2>
        <div class="testimonials-slider">
<div class="testimonial-card">
            <blockquote class="testimonial-quote">
              "Meksis Engineering delivered a 500,000 litre elevated tank that has been performing flawlessly for our factory. Excellent craftsmanship."
            </blockquote>
            <div class="testimonial-author">
              <strong>James Kariuki</strong>
              <span>Factory Manager, Rift Valley Foods</span>
            </div>
            <a href="/contact" class="testimonial-cta">Want results like these? Start Your Project</a>
          </div>
          <div class="testimonial-card">
            <blockquote class="testimonial-quote">
              "The GRP tank installation was completed on time and the quality is outstanding. Highly recommend for commercial water storage."
            </blockquote>
            <div class="testimonial-author">
              <strong>Mary Wanjiku</strong>
              <span>Hotel Director, Coastal Resort</span>
            </div>
            <a href="/contact" class="testimonial-cta">Want results like these? Start Your Project</a>
          </div>
          <div class="testimonial-card">
            <blockquote class="testimonial-quote">
              "Professional service from design to installation. Our galvanized steel tank has exceeded expectations."
            </blockquote>
            <div class="testimonial-author">
              <strong>Peter Ochieng</strong>
              <span>Operations Lead, Nakuru Agro</span>
            </div>
            <a href="/contact" class="testimonial-cta">Want results like these? Start Your Project</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Metrics / Achievements -->
    <section class="metrics-section">
      <div class="container">
        <h2 class="section-title">Our Achievements</h2>
<div class="metrics-grid">
          <div class="metric-card">
            <div class="metric-number">500+</div>
            <div class="metric-label">Tanks Installed</div>
          </div>
          <div class="metric-card">
            <div class="metric-number">15+</div>
            <div class="metric-label">Years Experience</div>
          </div>
          <div class="metric-card">
            <div class="metric-number">8</div>
            <div class="metric-label">Countries Served</div>
          </div>
          <div class="metric-card">
            <div class="metric-number">98%</div>
            <div class="metric-label">Client Satisfaction</div>
          </div>
        </div>
        <div class="metrics-cta">
          <a href="/contact" class="cta-button secondary">Get Your Solution Today</a>
        </div>
      </div>
    </section>

    <!-- Media Section -->
    <section class="media-section">
      <div class="container">
        <h2 class="section-title">See Our Solutions in Action</h2>
        <div class="media-content">
          <div class="video-wrapper">
            <iframe
              width="560"
              height="315"
              src="https://www.youtube.com/embed/knig7eODiSY"
              title="Wabe Studio Solutions Demo"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen
            ></iframe>
            <div class="video-overlay">
              <a href="/contact" class="overlay-cta">Book a Consultation</a>
            </div>
          </div>
          <div class="media-description">
            <h3>Experience the Power of Smart Systems</h3>
            <p>Watch how our integrated solutions streamline operations and boost productivity across various industries.</p>
            <div class="media-links">
<a href="https://www.youtube.com/watch?v=knig7eODiSY" target="_blank" class="media-link">🎥 Watch Full Demo</a>
              <a href="/contact" class="media-link">📞 Schedule Consultation</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Bottom / Footer CTA -->
    <section class="bottom-cta-section">
      <div class="container">
<h2 class="cta-title">Ready to Install Your Water Tank?</h2>
        <p class="cta-text">Join the growing number of businesses that trust Meksis Engineering for their water storage needs.</p>
        <div class="cta-buttons">
<a href="/contact" class="cta-button primary">Start a Project</a>
          <a href="/contact" class="cta-button secondary">Book a Consultation</a>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: 'OurWorksPage',
  data() {
    return {
      portfolioCategories: [],
      floatingCtaVisible: false,
featuredProjects: [
        {
          id: 1,
          title: "Elevated Pressed Steel Tank - Nairobi",
          description: "500,000 litre capacity elevated tank installed for a commercial complex in Nairobi's industrial area.",
          image: "https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=800&h=600&fit=crop",
          categorySlug: "elevated-pressed-steel-tanks"
        },
        {
          id: 2,
          title: "GRP Water Tank - Mombasa",
          description: "200,000 litre GRP tank installed for a hotel resort along the coast.",
          image: "https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800&h=600&fit=crop",
          categorySlug: "grp-water-tanks"
        },
        {
          id: 3,
          title: "Galvanized Steel Tank - Nakuru",
          description: "Ground-level 300,000 litre galvanized tank for agricultural processing plant.",
          image: "https://images.unsplash.com/photo-1589939705384-5185137a7f0f?w=800&h=600&fit=crop",
          categorySlug: "galvanized-steel-tanks"
        }
      ]
    }
  },
  mounted() {
    this.fetchPortfolioCategories();
    window.addEventListener('scroll', this.handleScroll);
  },
  beforeUnmount() {
    window.removeEventListener('scroll', this.handleScroll);
  },
  methods: {
    async fetchPortfolioCategories() {
      try {
        const response = await fetch('/api/portfolio-categories')
        if (response.ok) {
          this.portfolioCategories = await response.json()
        }
      } catch (error) {
        console.error('Error fetching portfolio categories:', error)
      }
    },
    handleScroll() {
      this.floatingCtaVisible = window.scrollY > 300;
    },
    navigateToCategory(slug) {
      window.location.href = `/portfolio/category/${slug}`;
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
/* ===== DESIGN SYSTEM - MATCHING ABOUTUS.VUE ===== */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.our-works-page {
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

/* ===== FLOATING CTA ===== */
.floating-cta {
  position: fixed;
  bottom: 24px;
  right: 24px;
  background: #25D366;
  color: white;
  padding: 12px 24px;
  border-radius: 50px;
  font-weight: 600;
  font-size: 0.95rem;
  box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
  z-index: 1000;
  opacity: 0;
  transform: translateY(100px);
  transition: all 0.3s ease;
  cursor: pointer;
}

.floating-cta.visible {
  opacity: 1;
  transform: translateY(0);
}

.floating-cta:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4);
  background: #20bd5a;
}

/* ===== HERO SECTION ===== */
.hero-section {
  background: #1a1a1a;
  color: white;
  padding: 60px 24px;
  text-align: center;
  border-bottom: 4px solid #ffc107;
}

.hero-content {
  max-width: 900px;
  margin: 0 auto;
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
  margin-bottom: 30px;
  opacity: 0.95;
  line-height: 1.6;
  max-width: 700px;
  margin-left: auto;
  margin-right: auto;
}

.hero-cta .cta-button {
  background: #ffc107;
  color: #1a1a1a;
  padding: 12px 24px;
  text-decoration: none;
  font-weight: 700;
  font-size: 0.95rem;
  display: inline-block;
  text-transform: uppercase;
  letter-spacing: 1px;
  border: 2px solid #ffc107;
}

.hero-cta .cta-button:hover {
  background: transparent;
  color: #ffc107;
}

/* ===== SECTIONS ===== */
section {
  padding: 50px 24px;
}

section:nth-child(even) {
  background: #f5f5f5;
}

.section-title {
  font-size: 2rem;
  font-weight: 700;
  color: #1a1a1a;
  text-align: center;
  margin-bottom: 16px;
  line-height: 1.2;
  text-transform: uppercase;
  letter-spacing: 2px;
}

.section-description {
  font-size: 1rem;
  color: #475569;
  text-align: center;
  max-width: 800px;
  margin: 0 auto 30px;
  line-height: 1.7;
}

/* ===== FEATURED PROJECTS ===== */
.featured-projects-section {
  background: #ffffff;
}

.featured-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 0;
}

.featured-card {
  background: white;
  overflow: hidden;
  transition: all 0.2s;
  border-right: 1px solid #e0e0e0;
  border-bottom: 1px solid #e0e0e0;
}

.featured-card:hover {
  background: #ffc107;
}

.featured-card:hover .project-title,
.featured-card:hover .project-description {
  color: #1a1a1a;
}

.project-image {
  height: 200px;
  overflow: hidden;
}

.project-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.featured-card:hover .project-image img {
  transform: scale(1.05);
}

.project-content {
  padding: 24px;
}

.project-title {
  font-size: 1.3rem;
  font-weight: 700;
  color: #1a1a1a;
  margin-bottom: 12px;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.project-description {
  font-size: 0.95rem;
  color: #555;
  margin-bottom: 20px;
  line-height: 1.6;
}

/* TinyMCE Content Styling for Project Description */
.project-description :deep(p) {
  margin-bottom: 10px;
}

.project-description :deep(p:last-child) {
  margin-bottom: 0;
}

.project-description :deep(strong) {
  color: #1e3a8a;
  font-weight: 700;
}

.project-description :deep(br) {
  display: block;
  content: "";
  margin-top: 6px;
}

.project-actions {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
}

.btn-primary, .btn-secondary {
  padding: 10px 20px;
  font-weight: 700;
  font-size: 0.9rem;
  text-decoration: none;
  text-transform: uppercase;
  letter-spacing: 1px;
  display: inline-block;
}

.btn-primary {
  background: #ffc107;
  color: #1a1a1a;
  border: 2px solid #ffc107;
}

.btn-primary:hover {
  background: #1a1a1a;
  color: #ffc107;
}

.btn-secondary {
  background: transparent;
  color: #1a1a1a;
  border: 2px solid #1a1a1a;
}

.btn-secondary:hover {
  background: #1a1a1a;
  color: #ffc107;
}

/* ===== PORTFOLIO CATEGORIES ===== */
.portfolio-categories-section {
  background: #f5f5f5;
}

.categories-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 0;
}

.category-card {
  background: white;
  overflow: hidden;
  transition: all 0.2s;
  border-right: 1px solid #e0e0e0;
  border-bottom: 1px solid #e0e0e0;
}

.category-card:hover {
  background: #ffc107;
}

.category-card:hover .category-title,
.category-card:hover .category-description {
  color: #1a1a1a;
}

.category-image {
  height: 180px;
  overflow: hidden;
}

.category-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.category-card:hover .category-image img {
  transform: scale(1.05);
}

.category-content {
  padding: 20px;
}

.category-title {
  font-size: 1.1rem;
  font-weight: 700;
  color: #1a1a1a;
  margin-bottom: 8px;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.category-description {
  font-size: 0.9rem;
  color: #555;
  margin-bottom: 12px;
  line-height: 1.5;
}

/* TinyMCE Content Styling for Category Description */
.category-description :deep(p) {
  margin-bottom: 8px;
}

.category-description :deep(p:last-child) {
  margin-bottom: 0;
}

.category-description :deep(strong) {
  color: #1e3a8a;
  font-weight: 700;
}

.category-description :deep(br) {
  display: block;
  content: "";
  margin-top: 4px;
}

.category-meta {
  margin-bottom: 12px;
}

.portfolio-count {
  font-size: 0.85rem;
  color: #64748b;
}

.explore-btn {
  display: inline-block;
  color: #1a1a1a;
  text-decoration: none;
  font-weight: 700;
  font-size: 0.9rem;
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: all 0.2s;
}

.explore-btn:hover {
  color: #ffc107;
}

.no-categories {
  text-align: center;
  padding: 40px;
  color: #64748b;
}

/* ===== TESTIMONIALS ===== */
.testimonials-section {
  background: #ffffff;
}

.testimonials-slider {
  display: flex;
  gap: 0;
  overflow-x: auto;
  padding: 20px 0;
  scroll-snap-type: x mandatory;
}

.testimonial-card {
  min-width: 320px;
  background: #1a1a1a;
  padding: 30px;
  scroll-snap-align: start;
  transition: all 0.2s;
  border-right: 1px solid #333;
}

.testimonial-card:hover {
  background: #ffc107;
}

.testimonial-card:hover .testimonial-quote,
.testimonial-card:hover .testimonial-author strong,
.testimonial-card:hover .testimonial-author span {
  color: #1a1a1a;
}

.testimonial-quote {
  font-style: italic;
  font-size: 1rem;
  margin-bottom: 20px;
  color: #ffffff;
  line-height: 1.6;
}

.testimonial-author {
  margin-bottom: 16px;
}

.testimonial-author strong {
  display: block;
  font-size: 1rem;
  font-weight: 700;
  color: #ffc107;
  margin-bottom: 4px;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.testimonial-author span {
  font-size: 0.9rem;
  color: #999;
}

.testimonial-cta {
  display: inline-block;
  color: #ffc107;
  text-decoration: none;
  font-weight: 700;
  font-size: 0.9rem;
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: all 0.2s;
}

.testimonial-cta:hover {
  color: #1a1a1a;
}

/* ===== METRICS ===== */
.metrics-section {
  background: #1a1a1a;
}

.metrics-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 0;
  margin-bottom: 30px;
}

.metric-card {
  text-align: center;
  padding: 30px 20px;
  background: #1a1a1a;
  transition: all 0.2s;
  border-right: 1px solid #333;
}

.metric-card:hover {
  background: #ffc107;
}

.metric-card:hover .metric-number,
.metric-card:hover .metric-label {
  color: #1a1a1a;
}

.metric-number {
  font-size: 2.5rem;
  font-weight: 900;
  color: #ffc107;
  margin-bottom: 8px;
}

.metric-label {
  color: #ffffff;
  font-weight: 700;
  font-size: 0.95rem;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.metrics-cta {
  text-align: center;
}

/* ===== MEDIA ===== */
.media-section {
  background: #f5f5f5;
}

.media-content {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 40px;
  align-items: center;
}

.video-wrapper {
  position: relative;
  overflow: hidden;
  border: 3px solid #ffc107;
}

.video-wrapper iframe {
  width: 100%;
  height: 315px;
  border: none;
  display: block;
}

.video-overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: linear-gradient(transparent, rgba(0,0,0,0.8));
  padding: 20px;
  text-align: center;
  opacity: 0;
  transition: all 0.3s ease;
}

.video-wrapper:hover .video-overlay {
  opacity: 1;
}

.overlay-cta {
  color: white;
  text-decoration: none;
  font-weight: 700;
  padding: 10px 20px;
  background: #ffc107;
  color: #1a1a1a;
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: all 0.2s;
  display: inline-block;
}

.overlay-cta:hover {
  background: #1a1a1a;
  color: #ffc107;
}

.media-description h3 {
  font-size: 1.5rem;
  font-weight: 700;
  color: #1a1a1a;
  margin-bottom: 12px;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.media-description p {
  color: #555;
  line-height: 1.6;
  margin-bottom: 20px;
}

.media-links {
  display: flex;
  gap: 16px;
  flex-wrap: wrap;
}

.media-link {
  color: #1a1a1a;
  text-decoration: none;
  font-weight: 700;
  font-size: 0.95rem;
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: all 0.2s;
}

.media-link:hover {
  color: #ffc107;
}

/* ===== BOTTOM CTA ===== */
.bottom-cta-section {
  background: #1a1a1a;
  color: white;
  text-align: center;
  padding: 60px 24px;
  border-top: 4px solid #ffc107;
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

.cta-buttons {
  display: flex;
  gap: 16px;
  justify-content: center;
  flex-wrap: wrap;
}

.cta-button {
  padding: 12px 24px;
  text-decoration: none;
  font-weight: 700;
  font-size: 0.95rem;
  text-transform: uppercase;
  letter-spacing: 1px;
  display: inline-block;
  transition: all 0.2s;
}

.cta-button.primary {
  background: #ffc107;
  color: #1a1a1a;
  border: 2px solid #ffc107;
}

.cta-button.primary:hover {
  background: transparent;
  color: #ffc107;
}

.cta-button.secondary {
  background: transparent;
  color: #ffc107;
  border: 2px solid #ffc107;
}

.cta-button.secondary:hover {
  background: #ffc107;
  color: #1a1a1a;
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

  section {
    padding: 40px 20px;
  }

  .section-title {
    font-size: 1.6rem;
  }

  .featured-grid,
  .categories-grid {
    grid-template-columns: 1fr;
  }

  .metrics-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .media-content {
    grid-template-columns: 1fr;
    gap: 24px;
  }

  .testimonials-slider {
    padding: 16px 0;
  }

  .testimonial-card {
    min-width: 280px;
  }

  .cta-buttons {
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
  section {
    padding: 40px 20px;
  }

  .project-content,
  .category-content {
    padding: 20px;
  }

  .testimonial-card {
    padding: 24px 20px;
  }
}
</style>
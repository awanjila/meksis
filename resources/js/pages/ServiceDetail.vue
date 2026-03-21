<template>
  <div class="main-content">
    <!-- Breadcrumbs -->
    <div class="rs-breadcrumbs">
      <div class="breadcrumbs-inner text-center">
        <h1 class="page-title">{{ service.name || 'Product Details' }}</h1>
        <ul>
          <li>
            <a href="/">Home</a>
          </li>
          <li>
            <a href="/products">Products</a>
          </li>
          <li>{{ service.name }}</li>
        </ul>
      </div>
    </div>

    <!-- Service Detail Section -->
    <section class="service-detail-section">
      <div class="container">
        <div v-if="loading" class="loading-state">
          <div class="spinner"></div>
          <p>Loading Product details...</p>
        </div>

        <div v-else-if="service.id" class="service-detail-content">
          <!-- Left Side: Service Details -->
          <div class="detail-left">
            <!-- Cover Image -->
            <div v-if="service.image" class="service-cover-image">
              <img :src="`/${service.image}`" :alt="service.name" />
            </div>

            <!-- Service Content -->
            <div class="service-main-content">
              <h2 class="service-detail-title">{{ service.name }}</h2>
              <div class="service-detail-description" v-html="service.description"></div>
            </div>
          </div>

          <!-- Right Side: Services List & Contact -->
          <div class="detail-right">
            <!-- All Services List -->
            <div class="services-sidebar">
              <h3 class="sidebar-title">All Products</h3>
              <ul class="services-list">
                <li v-for="item in allServices" :key="item.id" :class="{ active: item.slug === service.slug }">
                  <a :href="`/show/product/${item.slug}`">
                    <span>{{ item.name }}</span>
                    <i class="fas fa-arrow-right"></i>
                  </a>
                </li>
              </ul>
            </div>

            <!-- Contact Card -->
            <div class="contact-card">
              <div class="contact-icon">
                <i class="fas fa-phone-alt"></i>
              </div>
              <h3 class="contact-title">HAVE QUESTIONS?</h3>
              <p class="contact-subtitle">CALL US TODAY</p>
              <div class="contact-numbers">
                <a href="tel:+254735551515" class="contact-number">+254 735 551515</a>
              </div>
            </div>

            <!-- Email Card -->
            <div class="email-card">
              <div class="email-icon">
                <i class="fas fa-envelope"></i>
              </div>
              <h3 class="email-title">Email Us</h3>
              <div class="email-addresses">
                <a href="mailto:info@meksis.co.ke" class="email-link">
                  <i class="fas fa-paper-plane"></i>
                  info@meksis.co.ke
                </a>
                <a href="mailto:sales@meksis.co.ke" class="email-link">
                  <i class="fas fa-paper-plane"></i>
                  sales@meksis.co.ke
                </a>
              </div>
            </div>

            <!-- Brochure Card -->
            <div class="brochure-card">
              <div class="brochure-icon">
                <i class="fas fa-file-pdf"></i>
              </div>
              <h3 class="brochure-title">Brochures</h3>
              <p class="brochure-text">
                Download our comprehensive Product brochure to learn more about what we offer.
              </p>
              <a href="/contact" class="brochure-button">
                Request Brochure
                <i class="fas fa-download"></i>
              </a>
            </div>
          </div>
        </div>

        <div v-else class="error-state">
          <i class="fas fa-exclamation-circle"></i>
          <p>product not found.</p>
          <a href="/products" class="back-button">Back to Products</a>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <div class="cta-section">
      <div class="container">
        <div class="cta-content">
          <div class="cta-text">
            <span class="cta-label">Plan to Start a Project</span>
            <h2 class="cta-title">Our Experts Ready to Help You</h2>
          </div>
          <div class="cta-button-wrap">
            <a class="cta-button" href="/contact">
              Get In Touch
              <i class="fas fa-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const service = ref({})
const allServices = ref([])
const loading = ref(true)

// Get slug from URL
const getSlugFromUrl = () => {
  const pathParts = window.location.pathname.split('/')
  return pathParts[pathParts.length - 1]
}

const fetchServiceDetail = async () => {
  try {
    loading.value = true
    const slug = getSlugFromUrl()
    
    // Fetch specific service
    const serviceResponse = await axios.get(`/api/service/${slug}`)
    service.value = serviceResponse.data

    // Fetch all services for sidebar
    const servicesResponse = await axios.get('/api/services')
    allServices.value = servicesResponse.data
  } catch (error) {
    console.error('Error fetching service:', error)
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  fetchServiceDetail()
})
</script>

<style scoped>
/* ===== DESIGN SYSTEM ===== */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 50px;
}

.main-content {
  font-family: 'Arial Narrow', sans-serif;
  color: var(--charcoal);
}

/* ===== BREADCRUMBS ===== */
.rs-breadcrumbs {
  padding: 30px 0 20px;
  background: var(--charcoal);
  border-bottom: 5px solid var(--royal-yellow);
}

.breadcrumbs-inner {
  position: relative;
  z-index: 2;
}

.text-center {
  text-align: center;
}

.page-title {
  font-size: 1.5rem;
  font-weight: 900;
  margin-bottom: 8px;
  color: var(--white);
  text-transform: uppercase;
  letter-spacing: 1px;
}

.breadcrumbs-inner ul {
  list-style: none;
  padding: 0;
  display: flex;
  justify-content: center;
  gap: 8px;
  align-items: center;
}

.breadcrumbs-inner ul li {
  color: #999;
  font-size: 0.8rem;
  text-transform: uppercase;
  font-weight: bold;
}

.breadcrumbs-inner ul li::before {
  content: '/';
  margin-right: 8px;
  color: #666;
}

.breadcrumbs-inner ul li:first-child::before {
  display: none;
}

.breadcrumbs-inner ul li a {
  color: var(--royal-yellow);
  text-decoration: none;
  font-weight: bold;
}

.breadcrumbs-inner ul li a:hover {
  color: var(--white);
}

/* ===== SERVICE DETAIL SECTION ===== */
.service-detail-section {
  padding: 60px 0;
  background: var(--charcoal);
}

/* ===== LOADING & ERROR STATES ===== */
.loading-state,
.error-state {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 20px;
  padding: 80px 20px;
  color: #888;
  min-height: 400px;
  justify-content: center;
  background: var(--white);
}

.error-state i {
  font-size: 3rem;
  color: #ef4444;
}

.spinner {
  width: 50px;
  height: 50px;
  border: 4px solid #ddd;
  border-top-color: var(--royal-yellow);
  animation: spin 0.8s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

.back-button {
  margin-top: 12px;
  padding: 12px 28px;
  background: var(--royal-yellow);
  color: var(--charcoal);
  text-decoration: none;
  font-weight: 700;
  text-transform: uppercase;
  font-size: 0.9rem;
  transition: all 0.1s;
}

.back-button:hover {
  background: var(--white);
}

/* ===== CONTENT LAYOUT ===== */
.service-detail-content {
  display: grid;
  grid-template-columns: 1fr 320px;
  gap: 40px;
  align-items: start;
}

/* ===== LEFT SIDE ===== */
.detail-left {
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.service-cover-image {
  width: 100%;
  overflow: hidden;
  background: #333;
}

.service-cover-image img {
  width: 100%;
  height: auto;
  display: block;
  object-fit: cover;
}

.service-main-content {
  background: var(--white);
  padding: 40px;
}

.service-detail-title {
  font-size: 1.75rem;
  font-weight: 900;
  color: var(--charcoal);
  margin-bottom: 20px;
  text-transform: uppercase;
  line-height: 1.3;
}

.service-detail-description {
  font-size: 1rem;
  color: #444;
  line-height: 1.7;
}

.service-detail-description :deep(h1),
.service-detail-description :deep(h2),
.service-detail-description :deep(h3) {
  color: var(--charcoal);
  margin-top: 24px;
  margin-bottom: 14px;
  font-weight: 700;
  text-transform: uppercase;
}

.service-detail-description :deep(h2) {
  font-size: 1.4rem;
}

.service-detail-description :deep(h3) {
  font-size: 1.2rem;
}

.service-detail-description :deep(p) {
  margin-bottom: 14px;
}

.service-detail-description :deep(ul),
.service-detail-description :deep(ol) {
  margin-left: 20px;
  margin-bottom: 14px;
}

.service-detail-description :deep(li) {
  margin-bottom: 8px;
  color: #444;
}

.service-detail-description :deep(strong) {
  color: var(--charcoal);
  font-weight: 700;
}

.service-detail-description :deep(a) {
  color: var(--royal-yellow);
  text-decoration: none;
  font-weight: 700;
}

/* ===== RIGHT SIDE ===== */
.detail-right {
  display: flex;
  flex-direction: column;
  gap: 16px;
  position: sticky;
  top: 100px;
}

.services-sidebar {
  background: var(--white);
  padding: 24px;
}

.sidebar-title {
  font-size: 1rem;
  font-weight: 900;
  color: var(--charcoal);
  margin-bottom: 16px;
  text-transform: uppercase;
  padding-bottom: 8px;
  border-bottom: 2px solid var(--royal-yellow);
}

.services-list {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 2px;
  background: #ddd;
}

.services-list li a {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 12px 16px;
  color: var(--charcoal);
  text-decoration: none;
  font-weight: 700;
  font-size: 0.85rem;
  text-transform: uppercase;
  background: var(--white);
  transition: all 0.1s;
}

.services-list li a i {
  font-size: 0.8rem;
  color: var(--royal-yellow);
  opacity: 0;
  transition: all 0.1s;
}

.services-list li a:hover {
  background: var(--royal-yellow);
  padding-left: 20px;
}

.services-list li a:hover i {
  opacity: 1;
}

.services-list li.active a {
  background: var(--royal-yellow);
}

/* ===== CONTACT CARD ===== */
.contact-card {
  background: var(--royal-yellow);
  padding: 24px;
  text-align: center;
  color: var(--charcoal);
}

.contact-icon {
  width: 50px;
  height: 50px;
  background: var(--charcoal);
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 16px;
}

.contact-icon i {
  font-size: 1.5rem;
  color: var(--royal-yellow);
}

.contact-title {
  font-size: 1rem;
  font-weight: 900;
  margin-bottom: 4px;
  text-transform: uppercase;
}

.contact-subtitle {
  font-size: 0.85rem;
  margin-bottom: 16px;
  font-weight: bold;
}

.contact-numbers {
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.contact-number {
  display: block;
  font-size: 1rem;
  font-weight: 700;
  color: var(--charcoal);
  text-decoration: none;
}

.contact-number:hover {
  text-decoration: underline;
}

/* ===== EMAIL CARD ===== */
.email-card {
  background: var(--white);
  padding: 24px;
}

.email-icon {
  width: 45px;
  height: 45px;
  background: var(--royal-yellow);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 12px;
}

.email-icon i {
  font-size: 1.25rem;
  color: var(--charcoal);
}

.email-title {
  font-size: 1rem;
  font-weight: 900;
  color: var(--charcoal);
  margin-bottom: 12px;
  text-transform: uppercase;
}

.email-addresses {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.email-link {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 10px 12px;
  color: var(--charcoal);
  text-decoration: none;
  font-weight: 700;
  font-size: 0.85rem;
  background: #f5f5f5;
  text-transform: uppercase;
  transition: all 0.1s;
}

.email-link:hover {
  background: var(--royal-yellow);
}

.email-link i {
  font-size: 0.8rem;
}

/* ===== BROCHURE CARD ===== */
.brochure-card {
  background: var(--white);
  padding: 24px;
}

.brochure-icon {
  width: 45px;
  height: 45px;
  background: var(--royal-yellow);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 12px;
}

.brochure-icon i {
  font-size: 1.25rem;
  color: var(--charcoal);
}

.brochure-title {
  font-size: 1rem;
  font-weight: 900;
  color: var(--charcoal);
  margin-bottom: 10px;
  text-transform: uppercase;
}

.brochure-text {
  font-size: 0.9rem;
  color: #666;
  line-height: 1.5;
  margin-bottom: 16px;
}

.brochure-button {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 12px 20px;
  background: var(--royal-yellow);
  color: var(--charcoal);
  text-decoration: none;
  font-weight: 700;
  font-size: 0.9rem;
  text-transform: uppercase;
  transition: all 0.1s;
}

.brochure-button:hover {
  background: var(--charcoal);
  color: var(--royal-yellow);
}

/* ===== CTA SECTION ===== */
.cta-section {
  background: var(--charcoal);
  padding: 50px 0;
  border-top: 5px solid var(--royal-yellow);
}

.cta-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 32px;
}

.cta-label {
  display: inline-block;
  color: var(--royal-yellow);
  font-size: 0.9rem;
  font-weight: 700;
  margin-bottom: 8px;
  text-transform: uppercase;
}

.cta-title {
  font-size: 2rem;
  font-weight: 900;
  color: var(--white);
  margin: 0;
  line-height: 1.2;
  text-transform: uppercase;
}

.cta-button {
  display: inline-flex;
  align-items: center;
  gap: 12px;
  padding: 16px 32px;
  background: var(--royal-yellow);
  color: var(--charcoal);
  text-decoration: none;
  font-weight: 700;
  font-size: 1rem;
  text-transform: uppercase;
  white-space: nowrap;
  transition: all 0.1s;
}

.cta-button:hover {
  background: var(--white);
}

/* ===== RESPONSIVE DESIGN ===== */
@media (max-width: 1024px) {
  .service-detail-content {
    grid-template-columns: 1fr;
    gap: 30px;
  }

  .detail-right {
    position: static;
    grid-template-columns: repeat(2, 1fr);
    display: grid;
  }

  .page-title {
    font-size: 1.5rem;
  }

  .cta-title {
    font-size: 1.5rem;
  }
}

@media (max-width: 768px) {
  .service-detail-section {
    padding: 40px 0;
  }

  .container {
    padding: 0 20px;
  }

  .rs-breadcrumbs {
    padding: 20px 0 16px;
  }

  .page-title {
    font-size: 1.25rem;
  }

  .service-detail-title {
    font-size: 1.4rem;
  }

  .service-main-content {
    padding: 24px 20px;
  }

  .services-sidebar,
  .contact-card,
  .email-card,
  .brochure-card {
    padding: 20px;
  }

  .detail-right {
    grid-template-columns: 1fr;
  }

  .cta-content {
    flex-direction: column;
    text-align: center;
  }

  .cta-title {
    font-size: 1.25rem;
  }
}

@media (max-width: 480px) {
  .service-detail-section {
    padding: 30px 0;
  }

  .service-detail-title {
    font-size: 1.25rem;
  }

  .service-detail-description {
    font-size: 0.95rem;
  }

  .cta-title {
    font-size: 1.1rem;
  }

  .cta-button {
    padding: 14px 24px;
    font-size: 0.9rem;
  }
}
</style>
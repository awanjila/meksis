<template>
  <div class="about-page">
    <!-- Hero Section -->
    <section class="hero-section">
      <div class="hero-overlay"></div>
      <div class="hero-content">
        <h1 class="hero-title">About Meksis Engineering</h1>
        <p class="hero-subtitle">Steel Water Tank Solutions Since 2010</p>
      </div>
      <div class="hero-slider">
        <transition name="fade" mode="out-in">
          <div :key="activeSlide" class="slide">
            <div class="slide-content">
              <h3>{{ heroSlides[activeSlide].title }}</h3>
              <p>{{ heroSlides[activeSlide].description }}</p>
            </div>
          </div>
        </transition>
        <div class="slider-dots">
          <button
            v-for="(slide, index) in heroSlides"
            :key="index"
            @click="activeSlide = index"
            :class="['dot', { active: activeSlide === index }]"
            :aria-label="`Go to slide ${index + 1}`"
          ></button>
        </div>
      </div>
    </section>

    <!-- Company Overview -->
    <section class="section-container">
      <div class="content-wrapper">
        <div class="section-header">
          <div class="icon-wrapper">
            <i class="fas fa-building"></i>
          </div>
          <h2>Company Overview</h2>
        </div>
        <div class="content-card">
          <p class="lead-text">
            Meksis Engineering was established in 2010. Our primary aim is providing the best steel water tank solutions for our clients by taking advantage of today's modern technology. We form partnerships with our clients to ensure they realize the most gain in terms of advice and economy.
          </p>
        </div>
      </div>
    </section>

    <!-- Mission & Vision -->
    <section class="section-container bg-light">
      <div class="content-wrapper">
        <div class="mission-vision-grid">
          <!-- Mission Statement -->
          <div class="mv-card">
            <div class="mv-header">
              <div class="icon-wrapper">
                <i class="fas fa-bullseye"></i>
              </div>
              <h2>Mission Statement</h2>
            </div>
            <ul class="statement-list">
              <li>
                <i class="fas fa-check-circle"></i>
                <div>
                  <strong>To our customers</strong> - we aim to deliver a service in which they can be confident in all aspects: price, delivery and support.
                </div>
              </li>
              <li>
                <i class="fas fa-check-circle"></i>
                <div>
                  <strong>To our staff</strong> - we aim to deliver a stimulating and rewarding working environment.
                </div>
              </li>
            </ul>
          </div>

          <!-- Vision Statement -->
          <div class="mv-card">
            <div class="mv-header">
              <div class="icon-wrapper">
                <i class="fas fa-eye"></i>
              </div>
              <h2>Vision Statement</h2>
            </div>
<p class="vision-text">
              Our vision is to be a market leader in the steel water tank industry through our dedication to providing quality products and the best solutions in the market.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Solutions Section -->
    <section class="section-container">
      <div class="content-wrapper">
        <div class="section-header centered">
          <h2>Our Products</h2>
          <p class="section-subtitle">Comprehensive water storage solutions tailored to your needs</p>
        </div>

        <div class="solutions-grid">
          <!-- Residential Solutions -->
          <div class="solution-card">
            <div class="solution-header">
              <div class="solution-icon residential">
                <i class="fas fa-home"></i>
              </div>
              <h3>Residential Solutions</h3>
            </div>
            <ul class="solution-list">
              <li v-for="item in residentialSolutions" :key="item">
                <i class="fas fa-shield-alt"></i>
                <span>{{ item }}</span>
              </li>
            </ul>
          </div>

          <!-- Commercial Solutions -->
          <div class="solution-card">
            <div class="solution-header">
              <div class="solution-icon commercial">
                <i class="fas fa-briefcase"></i>
              </div>
              <h3>Commercial Solutions</h3>
            </div>
            <ul class="solution-list">
              <li v-for="item in commercialSolutions" :key="item">
                <i class="fas fa-shield-alt"></i>
                <span>{{ item }}</span>
              </li>
            </ul>
          </div>

          <!-- Outdoor Solutions -->
          <div class="solution-card">
            <div class="solution-header">
              <div class="solution-icon outdoor">
                <i class="fas fa-tree"></i>
              </div>
              <h3>Outdoor Solutions</h3>
            </div>
            <ul class="solution-list">
              <li v-for="item in outdoorSolutions" :key="item">
                <i class="fas fa-shield-alt"></i>
                <span>{{ item }}</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const activeSlide = ref(0)
let sliderInterval = null

const heroSlides = [
  {
    title: 'Elevated Pressed Steel Tanks',
    description: 'High-capacity water storage solutions for commercial and industrial applications with superior durability.',
    image: '/images/hero/elevated-tanks.jpg'
  },
  {
    title: 'Galvanized Steel Tanks',
    description: 'Corrosion-resistant tanks with hot-dip galvanization, ideal for long-term water storage.',
    image: '/images/hero/galvanized-tanks.jpg'
  },
  {
    title: 'GRP Water Tanks',
    description: 'Lightweight, durable, and corrosion-free composite tanks for residential and commercial use.',
    image: '/images/hero/grp-tanks.jpg'
  },
  {
    title: 'Professional Installation Services',
    description: 'Expert installation and maintenance services across Kenya and East Africa.',
    image: '/images/hero/tank-installation.jpg'
  }
]

const residentialSolutions = [
  'Elevated Pressed Steel Tanks',
  'GRP Water Tanks',
  'Rooftop Tanks',
  'Ground Level Tanks',
  'Water Tank Accessories',
  'Tank Maintenance Services'
]

const commercialSolutions = [
  'Industrial Steel Tanks',
  'Large Capacity Storage',
  'Custom Tank Fabrication',
  'Installation Services'
]

const outdoorSolutions = [
  'Ground Level Tanks',
  'Elevated Steel Towers',
  'Rainwater Harvesting Systems'
]

onMounted(() => {
  sliderInterval = setInterval(() => {
    activeSlide.value = (activeSlide.value + 1) % heroSlides.length
  }, 5000)
})

onUnmounted(() => {
  if (sliderInterval) {
    clearInterval(sliderInterval)
  }
})
</script>

<style scoped>
/* ===== GLOBAL STYLES ===== */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.about-page {
  font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
  color: #1e293b;
  line-height: 1.6;
}

/* ===== HERO SECTION ===== */
.hero-section {
  position: relative;
  background: #1a1a1a;
  min-height: 500px;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  padding: 80px 24px 120px;
  border-bottom: 4px solid #ffc107;
}

.hero-overlay {
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 30% 50%, rgba(255, 193, 7, 0.2) 0%, transparent 50%),
              radial-gradient(circle at 70% 50%, rgba(26, 26, 26, 0.5) 0%, transparent 50%);
}

.hero-content {
  position: relative;
  z-index: 2;
  text-align: center;
  max-width: 800px;
  margin-bottom: 60px;
}

.hero-title {
  font-size: 3.5rem;
  font-weight: 800;
  color: white;
  margin-bottom: 16px;
  text-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

.hero-subtitle {
  font-size: 1.5rem;
  color: rgba(255, 255, 255, 0.95);
  font-weight: 300;
}

.hero-slider {
  position: absolute;
  bottom: 40px;
  left: 50%;
  transform: translateX(-50%);
  width: 90%;
  max-width: 700px;
  z-index: 2;
}

.slide {
  background: white;
  border-left: 4px solid #ffc107;
  padding: 32px;
}

.slide-content h3 {
  font-size: 1.5rem;
  color: #1a1a1a;
  margin-bottom: 12px;
  font-weight: 700;
}

.slide-content p {
  color: #475569;
  font-size: 1rem;
  line-height: 1.7;
}

.slider-dots {
  display: flex;
  justify-content: center;
  gap: 12px;
  margin-top: 20px;
}

.dot {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.4);
  border: 2px solid white;
  cursor: pointer;
  transition: all 0.3s ease;
}

.dot:hover {
  background: rgba(255, 255, 255, 0.6);
}

.dot.active {
  background: white;
  width: 32px;
  border-radius: 6px;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

/* ===== SECTIONS ===== */
.section-container {
  padding: 80px 24px;
}

.section-container.bg-light {
  background: #f5f5f5;
}

.content-wrapper {
  max-width: 1200px;
  margin: 0 auto;
}

.section-header {
  margin-bottom: 48px;
}

.section-header.centered {
  text-align: center;
}

.section-header h2 {
  font-size: 2.5rem;
  font-weight: 800;
  color: #1a1a1a;
  margin-bottom: 12px;
  text-transform: uppercase;
  letter-spacing: 2px;
}

.section-subtitle {
  font-size: 1.125rem;
  color: #666;
  max-width: 600px;
  margin: 0 auto;
}

.icon-wrapper {
  width: 60px;
  height: 60px;
  background: #ffc107;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 16px;
}

.icon-wrapper i {
  font-size: 1.75rem;
  color: #1a1a1a;
}

/* ===== CONTENT CARD ===== */
.content-card {
  background: white;
  padding: 40px;
  border: 2px solid #1a1a1a;
}

.lead-text {
  font-size: 1.125rem;
  line-height: 1.8;
  color: #333;
}

/* ===== MISSION & VISION ===== */
.mission-vision-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
  gap: 32px;
}

.mv-card {
  background: white;
  padding: 40px;
  border: 2px solid #1a1a1a;
  transition: all 0.2s;
}

.mv-card:hover {
  border-color: #ffc107;
}

.mv-card:hover .mv-header h2 {
  color: #ffc107;
}

.mv-header {
  margin-bottom: 24px;
}

.mv-header h2 {
  font-size: 1.75rem;
  color: #1a1a1a;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.statement-list {
  list-style: none;
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.statement-list li {
  display: flex;
  gap: 16px;
  align-items: flex-start;
}

.statement-list li i {
  color: #ffc107;
  font-size: 1.25rem;
  flex-shrink: 0;
  margin-top: 2px;
}

.statement-list li div {
  font-size: 1rem;
  color: #333;
  line-height: 1.7;
}

.vision-text {
  font-size: 1.125rem;
  line-height: 1.8;
  color: #333;
}

/* ===== SOLUTIONS GRID ===== */
.solutions-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 32px;
  margin-top: 48px;
}

.solution-card {
  background: white;
  padding: 32px;
  border: 2px solid #1a1a1a;
  transition: all 0.2s;
}

.solution-card:hover {
  border-color: #ffc107;
}

.solution-header {
  margin-bottom: 24px;
}

.solution-icon {
  width: 70px;
  height: 70px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 16px;
  background: #1a1a1a;
}

.solution-icon.residential {
  background: #1a1a1a;
}

.solution-icon.commercial {
  background: #1a1a1a;
}

.solution-icon.outdoor {
  background: #1a1a1a;
}

.solution-icon i {
  font-size: 2rem;
  color: white;
}

.solution-header h3 {
  font-size: 1.5rem;
  font-weight: 700;
  color: #1a1a1a;
}

.solution-list {
  list-style: none;
  display: flex;
  flex-direction: column;
  gap: 14px;
}

.solution-list li {
  display: flex;
  align-items: center;
  gap: 12px;
  font-size: 1rem;
  color: #333;
  padding: 8px 0;
  border-bottom: 1px solid #ddd;
}

.solution-list li:last-child {
  border-bottom: none;
}

.solution-list li i {
  color: #ffc107;
  font-size: 0.875rem;
  flex-shrink: 0;
}

/* ===== RESPONSIVE DESIGN ===== */
@media (max-width: 1024px) {
  .hero-title {
    font-size: 2.75rem;
  }

  .mission-vision-grid {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 768px) {
  .hero-section {
    padding: 60px 16px 100px;
    min-height: 450px;
  }

  .hero-title {
    font-size: 2.25rem;
  }

  .hero-subtitle {
    font-size: 1.125rem;
  }

  .slide {
    padding: 24px;
  }

  .slide-content h3 {
    font-size: 1.25rem;
  }

  .section-container {
    padding: 60px 16px;
  }

  .section-header h2 {
    font-size: 2rem;
  }

  .content-card,
  .mv-card {
    padding: 28px;
  }

  .solutions-grid {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 480px) {
  .hero-title {
    font-size: 1.875rem;
  }

  .hero-subtitle {
    font-size: 1rem;
  }

  .section-header h2 {
    font-size: 1.75rem;
  }

  .content-card,
  .mv-card,
  .solution-card {
    padding: 24px;
  }

  .icon-wrapper {
    width: 50px;
    height: 50px;
  }

  .icon-wrapper i {
    font-size: 1.5rem;
  }
}
</style>
<template>
  <section class="hero-section">
    <div class="slider-wrapper">

      <!-- Slides -->
      <transition-group
        name="slide-fade"
        tag="div"
        class="slides-container"
      >
        <div
          v-for="(slide, index) in slides"
          :key="index"
          v-show="currentSlide === index"
          class="slide"
          :style="{ backgroundImage: `url(${slide.image})` }"
        >
          <div class="slide-overlay"></div>

          <div class="container">
            <div class="slide-content">
              <h1 class="slide-title">{{ slide.title }}</h1>
              <p class="slide-description">
                {{ slide.description }}
              </p>

              <div class="slide-actions">
                <a href="/contact" class="btn btn-primary">Contact Us</a>
                <a href="/products" class="btn btn-secondary">Our Products</a>
              </div>
            </div>
          </div>
        </div>
      </transition-group>

      <!-- Navigation -->
      <button class="slider-nav prev" @click="prevSlide">
        ‹
      </button>

      <button class="slider-nav next" @click="nextSlide">
        ›
      </button>

      <!-- Dots -->
      <div class="slider-dots">
        <button
          v-for="(_, index) in slides"
          :key="index"
          :class="['dot', { active: currentSlide === index }]"
          @click="goToSlide(index)"
        />
      </div>

    </div>
  </section>
</template>

<script>
export default {
  name: 'HeroSection',
  data() {
    return {
      currentSlide: 0,
      autoplayInterval: null,
      slides: [
        {
          title: 'ELEVATED STEEL WATER TANKS',
          description:
            'Premium quality pressed steel water tanks for industrial and commercial water storage solutions in Kenya.',
          image: '/images/hero/tank-hero.jpg'
        },
        {
          title: 'GALVANIZED STEEL TANKS',
          description:
            'Hot-dipped galvanized steel tanks with superior corrosion resistance and long-lasting durability.',
          image: '/images/hero/galvanized-tanks.jpg'
        },
        {
          title: 'GRP WATER TANKS',
          description:
            'Lightweight Glass Reinforced Plastic tanks - the modern solution for clean water storage.',
          image: '/images/hero/grp-tanks.jpg'
        },
        {
          title: 'STEEL FABRICATION',
          description:
            'Custom steel fabrication services for industrial and commercial applications.',
          image: '/images/hero/steel-fabrication.jpg'
        }
      ]
    }
  },

  mounted() {
    this.startAutoplay()
  },

  beforeUnmount() {
    this.stopAutoplay()
  },

  methods: {
    startAutoplay() {
      this.autoplayInterval = setInterval(this.nextSlide, 5000)
    },
    stopAutoplay() {
      clearInterval(this.autoplayInterval)
    },
    nextSlide() {
      this.currentSlide =
        (this.currentSlide + 1) % this.slides.length
    },
    prevSlide() {
      this.currentSlide =
        this.currentSlide === 0
          ? this.slides.length - 1
          : this.currentSlide - 1
    },
    goToSlide(index) {
      this.currentSlide = index
      this.stopAutoplay()
      this.startAutoplay()
    }
  }
}
</script>

<style scoped>
/* =========================
   HERO LAYOUT (FIXED)
   ========================= */

.hero-section {
  position: relative;
  width: 100%;
  background: var(--charcoal);
  overflow: hidden;
  min-height: 420px;
  height: clamp(420px, 65vh, 800px);
}

.slider-wrapper,
.slides-container {
  width: 100%;
  height: 100%;
  position: relative;
}

/* =========================
   SLIDES
   ========================= */

.slide {
  position: absolute;
  inset: 0;
  background-size: cover;
  background-position: center;
  display: flex;
  align-items: center;
}

.slide-overlay {
  position: absolute;
  inset: 0;
  background: transparent;
}

.container {
  position: relative;
  z-index: 2;
  max-width: 1200px;
  margin: auto;
  padding: 0 50px;
  width: 100%;
}

.slide-content {
  max-width: 700px;
  background: rgba(26, 26, 26, 0.92);
  padding: 40px 50px;
  border-left: 5px solid var(--royal-yellow);
}

.slide-title {
  font-size: 2.5rem;
  font-weight: 900;
  color: var(--white);
  line-height: 1.1;
  margin-bottom: 16px;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.slide-description {
  font-size: 1.1rem;
  color: #ccc;
  line-height: 1.6;
  margin-bottom: 28px;
}

/* =========================
   ACTIONS
   ========================= */

.slide-actions {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
}

.btn {
  padding: 14px 28px;
  font-size: 0.9rem;
  font-weight: 700;
  text-decoration: none;
  text-transform: uppercase;
  transition: all 0.1s ease;
}

.btn-primary {
  background: var(--royal-yellow);
  color: var(--charcoal);
  border: 2px solid var(--royal-yellow);
}

.btn-primary:hover {
  background: transparent;
  color: var(--royal-yellow);
}

.btn-secondary {
  border: 2px solid var(--white);
  color: var(--white);
}

.btn-secondary:hover {
  background: var(--white);
  color: var(--charcoal);
}

/* =========================
   NAVIGATION
   ========================= */

.slider-nav {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 44px;
  height: 44px;
  border: none;
  background: var(--royal-yellow);
  color: var(--charcoal);
  cursor: pointer;
  z-index: 10;
  font-weight: bold;
  font-size: 20px;
}

.slider-nav.prev { left: 0 }
.slider-nav.next { right: 0 }

/* =========================
   DOTS
   ========================= */

.slider-dots {
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  gap: 8px;
  background: var(--charcoal);
  padding: 12px 20px;
}

.dot {
  width: 12px;
  height: 12px;
  background: #444;
  border: none;
}

.dot.active {
  width: 36px;
  background: var(--royal-yellow);
}

/* =========================
   TRANSITIONS
   ========================= */

.slide-fade-enter-active {
  transition: opacity 0.5s ease;
}
.slide-fade-leave-active {
  transition: opacity 0.3s ease;
}
.slide-fade-enter-from,
.slide-fade-leave-to {
  opacity: 0;
}

/* =========================
   MOBILE FIX (CRITICAL)
   ========================= */

@media (max-width: 768px) {
  .hero-section {
    height: auto;
    min-height: 400px;
    max-height: 600px;
  }

  .slider-wrapper,
  .slides-container {
    min-height: 400px;
  }

  .slide {
    min-height: 400px;
    padding: 20px 0;
    align-items: flex-start;
    padding-top: 40px;
  }

  .container {
    padding: 0 20px;
  }

  .slide-content {
    max-width: 100%;
    padding: 24px;
    border-left: 3px solid var(--royal-yellow);
  }

  .slide-title {
    font-size: 1.5rem;
  }

  .slide-description {
    font-size: 0.95rem;
    margin-bottom: 20px;
  }

  .slide-actions {
    flex-direction: column;
    gap: 10px;
    width: 100%;
  }

  .btn {
    width: 100%;
    padding: 12px 20px;
    font-size: 0.85rem;
    text-align: center;
    justify-content: center;
    display: flex;
  }

  .slider-nav {
    display: none;
  }

  .slider-dots {
    bottom: 0;
    padding: 10px 16px;
  }

  .dot {
    width: 10px;
    height: 10px;
  }

  .dot.active {
    width: 28px;
  }
}

@media (max-width: 480px) {
  .hero-section {
    min-height: 350px;
    max-height: 500px;
  }

  .slide-content {
    padding: 20px 16px;
  }

  .slide-title {
    font-size: 1.25rem;
  }

  .slide-description {
    font-size: 0.875rem;
  }

  .btn {
    padding: 12px 16px;
    font-size: 0.8rem;
  }
}
</style>

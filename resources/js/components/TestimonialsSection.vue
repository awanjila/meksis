<template>
  <section class="testimonials-section">
    <div class="container">
      <div class="testimonials-header">
        <div class="section-label">Client Success Stories</div>
        <h2 class="section-title">
          What Our <span class="gradient-text">Clients Say</span>
        </h2>
        <p class="section-description">
          Don't just take our word for it — hear from the businesses we've helped transform with our innovative solutions.
        </p>
      </div>

      <div class="testimonials-carousel-wrapper">
        <button @click="prevSlide" class="carousel-button prev" aria-label="Previous testimonial">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>

        <div class="testimonials-carousel">
          <div class="carousel-track" :style="{ transform: `translateX(-${currentSlide * 100}%)` }">
            <div v-for="(t, index) in testimonials" :key="index" class="testimonial-slide">
              <div class="testimonial-card">
                <div class="quote-icon">"</div>
                <p class="testimonial-text">{{ t.text }}</p>
                <div class="testimonial-author">
                  <div class="author-avatar">{{ t.name.charAt(0) }}</div>
                  <div class="author-info">
                    <h4 class="author-name">{{ t.name }}</h4>
                    <p class="author-role">{{ t.role }}</p>
                  </div>
                </div>
                <div class="testimonial-rating">
                  <span class="stars">⭐⭐⭐⭐⭐</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <button @click="nextSlide" class="carousel-button next" aria-label="Next testimonial">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
      </div>

      <div class="carousel-dots">
        <button
          v-for="(t, index) in testimonials"
          :key="index"
          @click="goToSlide(index)"
          :class="['dot', { active: currentSlide === index }]"
          :aria-label="`Go to testimonial ${index + 1}`"
        ></button>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const testimonials = [
  { name: 'Abraham Kimani', text: 'Wabe Studio transformed our manual billing into a seamless automated system. The support is unmatched and their team truly understands business needs.', role: 'Tech Lead, Foxtrot UC' },
  { name: 'Esther Wanjiru', text: 'Their web design team completely redefined our online presence. Our conversion rates increased by 150% within the first month. Highly recommend!', role: 'Marketing Director, Lorbhex Ltd' },
  { name: 'Brian Omondi', text: 'CCTV installation was precise and professional — integrated with our biometric system perfectly. The attention to detail was impressive.', role: 'Operations Manager, SecurePro' },
  { name: 'Sarah Muthoni', text: 'Outstanding e-commerce platform development! Our online sales tripled after launch. The team delivered beyond our expectations with excellent post-launch support.', role: 'CEO, TrendMart Kenya' },
  { name: 'David Kipchoge', text: 'The custom ERP system they built streamlined our entire operation. What used to take hours now takes minutes. Best investment we\'ve made in technology.', role: 'Managing Director, LogiFlow Solutions' },
]

const currentSlide = ref(0)
let autoplayInterval = null

const nextSlide = () => {
  currentSlide.value = (currentSlide.value + 1) % testimonials.length
}

const prevSlide = () => {
  currentSlide.value = currentSlide.value === 0 ? testimonials.length - 1 : currentSlide.value - 1
}

const goToSlide = (index) => {
  currentSlide.value = index
}

const startAutoplay = () => {
  autoplayInterval = setInterval(() => {
    nextSlide()
  }, 5000) // Change slide every 5 seconds
}

const stopAutoplay = () => {
  if (autoplayInterval) {
    clearInterval(autoplayInterval)
  }
}

onMounted(() => {
  startAutoplay()
})

onUnmounted(() => {
  stopAutoplay()
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
  max-width: 1280px;
  margin: 0 auto;
  padding: 0 24px;
}

/* ===== TESTIMONIALS SECTION - HORIZONTAL CAROUSEL ===== */
.testimonials-section {
  padding: 80px 24px;
  background: white;
  position: relative;
  overflow: hidden;
}

.testimonials-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: radial-gradient(circle at 50% 50%, rgba(96, 165, 250, 0.05) 0%, transparent 70%);
  pointer-events: none;
}

/* ===== HEADER ===== */
.testimonials-header {
  text-align: center;
  margin-bottom: 50px;
  position: relative;
  z-index: 1;
}

.section-label {
  font-size: 0.875rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  color: #0369a1;
  margin-bottom: 12px;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 800;
  color: #1e3a8a;
  line-height: 1.2;
  letter-spacing: -0.02em;
  font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
  margin-bottom: 16px;
}

.gradient-text {
  background: linear-gradient(135deg, #0369a1 0%, #60a5fa 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  display: inline-block;
}

.section-description {
  font-size: 1.05rem;
  color: #64748b;
  line-height: 1.7;
  font-family: 'Segoe UI', system-ui, sans-serif;
  max-width: 700px;
  margin: 0 auto;
}

/* ===== CAROUSEL WRAPPER ===== */
.testimonials-carousel-wrapper {
  position: relative;
  max-width: 900px;
  margin: 0 auto 40px;
}

.testimonials-carousel {
  overflow: hidden;
  border-radius: 20px;
}

.carousel-track {
  display: flex;
  transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.testimonial-slide {
  min-width: 100%;
  padding: 0 10px;
}

.testimonial-card {
  background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
  padding: 40px;
  border-radius: 20px;
  box-shadow: 0 10px 40px rgba(30, 58, 138, 0.1);
  border-left: 4px solid #0369a1;
  text-align: left;
  position: relative;
  overflow: hidden;
  min-height: 280px;
}

.testimonial-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, rgba(96, 165, 250, 0.03) 0%, transparent 100%);
}

.quote-icon {
  font-size: 4rem;
  color: #e0f2fe;
  font-family: Georgia, serif;
  line-height: 0.8;
  margin-bottom: 16px;
  font-weight: 700;
}

.testimonial-text {
  font-style: italic;
  font-size: 1.05rem;
  color: #475569;
  line-height: 1.8;
  margin-bottom: 24px;
  font-family: 'Segoe UI', system-ui, sans-serif;
}

.testimonial-author {
  display: flex;
  align-items: center;
  gap: 16px;
  padding-top: 20px;
  border-top: 2px solid #e0f2fe;
}

.author-avatar {
  width: 55px;
  height: 55px;
  background: linear-gradient(135deg, #1e3a8a 0%, #0369a1 100%);
  color: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 800;
  font-size: 1.35rem;
  flex-shrink: 0;
  box-shadow: 0 4px 15px rgba(30, 58, 138, 0.25);
}

.author-info {
  flex: 1;
}

.author-name {
  font-size: 1.1rem;
  font-weight: 700;
  color: #1e3a8a;
  margin-bottom: 4px;
  font-family: 'Segoe UI', system-ui, sans-serif;
}

.author-role {
  font-size: 0.9rem;
  color: #64748b;
  font-weight: 500;
  font-family: 'Segoe UI', system-ui, sans-serif;
  margin: 0;
}

.testimonial-rating {
  margin-top: 16px;
}

.testimonial-rating .stars {
  font-size: 1.1rem;
}

/* ===== CAROUSEL BUTTONS ===== */
.carousel-button {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 50px;
  height: 50px;
  background: white;
  border: 2px solid #e0f2fe;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
  z-index: 10;
  box-shadow: 0 4px 15px rgba(30, 58, 138, 0.1);
}

.carousel-button:hover {
  background: linear-gradient(135deg, #1e3a8a 0%, #0369a1 100%);
  border-color: #0369a1;
  transform: translateY(-50%) scale(1.1);
  box-shadow: 0 6px 20px rgba(30, 58, 138, 0.2);
}

.carousel-button:hover svg path {
  stroke: white;
}

.carousel-button.prev {
  left: -25px;
}

.carousel-button.next {
  right: -25px;
}

.carousel-button svg path {
  stroke: #0369a1;
  transition: stroke 0.3s ease;
}

/* ===== CAROUSEL DOTS ===== */
.carousel-dots {
  display: flex;
  justify-content: center;
  gap: 12px;
  margin-top: 30px;
}

.dot {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background: #cbd5e1;
  border: none;
  cursor: pointer;
  transition: all 0.3s ease;
  padding: 0;
}

.dot:hover {
  background: #94a3b8;
  transform: scale(1.2);
}

.dot.active {
  background: linear-gradient(135deg, #1e3a8a 0%, #0369a1 100%);
  width: 32px;
  border-radius: 6px;
}

/* ===== ANIMATIONS ===== */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* ===== RESPONSIVE DESIGN ===== */
@media (max-width: 1024px) {
  .section-title {
    font-size: 2.25rem;
  }

  .carousel-button.prev {
    left: -15px;
  }

  .carousel-button.next {
    right: -15px;
  }
}

@media (max-width: 768px) {
  .testimonials-section {
    padding: 60px 20px;
  }

  .section-title {
    font-size: 2rem;
  }

  .section-description {
    font-size: 1rem;
  }

  .testimonial-card {
    padding: 32px 24px;
    min-height: 300px;
  }

  .quote-icon {
    font-size: 3rem;
  }

  .testimonial-text {
    font-size: 0.95rem;
  }

  .author-avatar {
    width: 50px;
    height: 50px;
    font-size: 1.2rem;
  }

  .carousel-button {
    width: 45px;
    height: 45px;
  }

  .carousel-button.prev {
    left: 0;
  }

  .carousel-button.next {
    right: 0;
  }
}

@media (max-width: 480px) {
  .testimonials-section {
    padding: 40px 16px;
  }

  .section-title {
    font-size: 1.75rem;
  }

  .section-description {
    font-size: 0.95rem;
  }

  .testimonial-card {
    padding: 28px 20px;
    min-height: 320px;
  }

  .quote-icon {
    font-size: 2.5rem;
  }

  .testimonial-text {
    font-size: 0.9rem;
  }

  .author-avatar {
    width: 45px;
    height: 45px;
    font-size: 1.1rem;
  }

  .author-name {
    font-size: 1rem;
  }

  .author-role {
    font-size: 0.85rem;
  }

  .carousel-button {
    width: 40px;
    height: 40px;
  }

  .carousel-button.prev {
    left: -5px;
  }

  .carousel-button.next {
    right: -5px;
  }
}
</style>
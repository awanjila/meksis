<template>
  <section class="process-section">
    <div class="container">
      <div class="process-header">
        <div class="section-label">How We Work</div>
        <h2 class="section-title">
          Our Process — <span class="gradient-text">Precision</span> in Every Step
        </h2>
        <p class="section-description">
          From initial consultation to ongoing support, we ensure every phase delivers excellence. Our proven methodology guarantees results.
        </p>
      </div>

      <div class="process-strip">
        <div v-for="(step, index) in steps" :key="step.title" class="process-card">
          <div class="step-number">{{ index + 1 }}</div>
          <div class="step-icon-wrapper">
            <i :class="step.icon" class="step-icon"></i>
          </div>
          <h3 class="step-title">{{ step.title }}</h3>
          <p class="step-description">{{ step.text }}</p>
          <div class="step-arrow" v-if="index < steps.length - 1">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M9 18L15 12L9 6" stroke="#0369a1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>
      </div>

      <div class="process-cta">
        <p class="cta-text">Ready to start your project?</p>
        <a href="/contact" class="talk-to-us-button">
          <span class="button-text">Talk to Us</span>
          <svg class="button-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7.5 15L12.5 10L7.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>
      </div>
    </div>
  </section>
</template>

<script setup>
const steps = [
  { title: 'Consultation', text: 'We understand your goals and challenges.', icon: 'fas fa-comments' },
  { title: 'Design', text: 'Wireframes and visuals for clarity.', icon: 'fas fa-pencil-ruler' },
  { title: 'Development', text: 'Code built for speed, security, and scale.', icon: 'fas fa-laptop-code' },
  { title: 'Testing', text: 'Rigorous testing and deployment.', icon: 'fas fa-vials' },
  { title: 'Support', text: 'Ongoing optimization and support.', icon: 'fas fa-headset' },
]
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

/* ===== PROCESS SECTION - HORIZONTAL STRIP ===== */
.process-section {
  padding: 80px 24px;
  background: linear-gradient(135deg, #f8fafc 0%, #e0f2fe 50%, #dbeafe 100%);
  position: relative;
  overflow: hidden;
}

.process-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: radial-gradient(circle at 50% 50%, rgba(96, 165, 250, 0.1) 0%, transparent 70%);
  pointer-events: none;
}

/* ===== HEADER ===== */
.process-header {
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

/* ===== HORIZONTAL PROCESS STRIP ===== */
.process-strip {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 20px;
  position: relative;
  z-index: 1;
  margin-bottom: 50px;
}

.process-card {
  position: relative;
  background: white;
  padding: 32px 24px;
  border-radius: 16px;
  text-align: center;
  box-shadow: 0 4px 20px rgba(30, 58, 138, 0.08);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  border-top: 4px solid #0369a1;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 16px;
}

.process-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 40px rgba(30, 58, 138, 0.15);
  border-top-color: #fbbf24;
}

.step-number {
  position: absolute;
  top: -20px;
  left: 50%;
  transform: translateX(-50%);
  width: 45px;
  height: 45px;
  background: linear-gradient(135deg, #1e3a8a 0%, #0369a1 100%);
  color: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 800;
  font-size: 1.1rem;
  box-shadow: 0 4px 15px rgba(30, 58, 138, 0.3);
  font-family: 'Segoe UI', system-ui, sans-serif;
  transition: all 0.3s ease;
}

.process-card:hover .step-number {
  transform: translateX(-50%) scale(1.15);
  box-shadow: 0 6px 25px rgba(30, 58, 138, 0.4);
}

.step-icon-wrapper {
  width: 70px;
  height: 70px;
  background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
  border-radius: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
  margin-top: 10px;
}

.step-icon {
  font-size: 2rem;
  color: #0369a1;
  transition: all 0.3s ease;
}

.process-card:hover .step-icon-wrapper {
  background: linear-gradient(135deg, #1e3a8a 0%, #0369a1 100%);
  transform: scale(1.1) rotate(5deg);
}

.process-card:hover .step-icon {
  color: white;
}

.step-title {
  font-size: 1.125rem;
  font-weight: 700;
  color: #1e3a8a;
  font-family: 'Segoe UI', system-ui, sans-serif;
  line-height: 1.3;
  transition: color 0.3s ease;
}

.process-card:hover .step-title {
  color: #0369a1;
}

.step-description {
  font-size: 0.9rem;
  color: #64748b;
  line-height: 1.5;
  font-family: 'Segoe UI', system-ui, sans-serif;
}

.step-arrow {
  position: absolute;
  right: -22px;
  top: 50%;
  transform: translateY(-50%);
  z-index: 2;
  opacity: 0.5;
}

/* ===== PROCESS CTA ===== */
.process-cta {
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 20px;
  padding: 40px 24px;
  background: white;
  border-radius: 20px;
  box-shadow: 0 4px 20px rgba(30, 58, 138, 0.08);
  position: relative;
  z-index: 1;
}

.cta-text {
  font-size: 1.25rem;
  font-weight: 600;
  color: #1e3a8a;
  font-family: 'Segoe UI', system-ui, sans-serif;
  margin: 0;
}

.talk-to-us-button {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 16px 32px;
  background: linear-gradient(135deg, #1e3a8a 0%, #0369a1 100%);
  color: white;
  text-decoration: none;
  border-radius: 12px;
  font-size: 1rem;
  font-weight: 600;
  font-family: 'Segoe UI', system-ui, sans-serif;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 6px 20px rgba(30, 58, 138, 0.3);
  position: relative;
  overflow: hidden;
}

.talk-to-us-button::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transition: left 0.5s;
}

.talk-to-us-button:hover::before {
  left: 100%;
}

.talk-to-us-button:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 30px rgba(30, 58, 138, 0.4);
}

.button-icon {
  transition: transform 0.3s ease;
}

.talk-to-us-button:hover .button-icon {
  transform: translateX(4px);
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
  .process-strip {
    grid-template-columns: repeat(3, 1fr);
  }

  .step-arrow {
    display: none;
  }

  .section-title {
    font-size: 2.25rem;
  }
}

@media (max-width: 768px) {
  .process-section {
    padding: 60px 20px;
  }

  .process-strip {
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
  }

  .section-title {
    font-size: 2rem;
  }

  .section-description {
    font-size: 1rem;
  }

  .process-card {
    padding: 28px 20px;
  }

  .step-icon-wrapper {
    width: 60px;
    height: 60px;
  }

  .step-icon {
    font-size: 1.75rem;
  }

  .step-title {
    font-size: 1.05rem;
  }

  .step-description {
    font-size: 0.875rem;
  }

  .process-cta {
    padding: 32px 20px;
  }

  .cta-text {
    font-size: 1.1rem;
  }
}

@media (max-width: 480px) {
  .process-section {
    padding: 40px 16px;
  }

  .process-strip {
    grid-template-columns: 1fr;
    gap: 30px;
  }

  .section-title {
    font-size: 1.75rem;
  }

  .section-description {
    font-size: 0.95rem;
  }

  .process-card {
    padding: 32px 20px;
  }

  .step-number {
    width: 40px;
    height: 40px;
    font-size: 1rem;
    top: -18px;
  }

  .step-icon-wrapper {
    width: 60px;
    height: 60px;
  }

  .step-icon {
    font-size: 1.5rem;
  }

  .step-title {
    font-size: 1rem;
  }

  .step-description {
    font-size: 0.85rem;
  }

  .process-cta {
    padding: 28px 20px;
  }

  .cta-text {
    font-size: 1rem;
  }

  .talk-to-us-button {
    width: 100%;
    justify-content: center;
  }
}
</style>
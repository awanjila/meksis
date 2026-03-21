<template>
  <section class="cta-section">
    <div class="container">
      <div class="cta-content">
        <!-- Left Side: Text & CTA -->
        <div class="cta-left">
          <div class="cta-badge">
            <span class="badge-icon">🚀</span>
            <span class="badge-text">Let's Get Started</span>
          </div>
          <h2 class="cta-title">
            Ready to <span class="highlight-text">Automate</span>,
            <span class="highlight-text">Integrate</span>, and
            <span class="highlight-text">Grow</span>?
          </h2>
          <p class="cta-description">
            Let's design a system that works — not one that just looks good. Transform your business with solutions built for real-world impact.
          </p>
          <div class="cta-buttons">
            <a href="#contact" class="cta-button primary">
              <span class="button-text">Book a Free Consultation</span>
              <svg class="button-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.5 15L12.5 10L7.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </a>
            <a href="#services" class="cta-button secondary">
              <span class="button-text">View Our Services</span>
            </a>
          </div>
          <div class="cta-features">
            <div class="feature-item">
              <span class="feature-icon">✓</span>
              <span class="feature-text">Free Consultation</span>
            </div>
            <div class="feature-item">
              <span class="feature-icon">✓</span>
              <span class="feature-text">24/7 Support</span>
            </div>
            <div class="feature-item">
              <span class="feature-icon">✓</span>
              <span class="feature-text">Money-Back Guarantee</span>
            </div>
          </div>
        </div>

        <!-- Right Side: Visual Element -->
        <div class="cta-right">
          <div class="cta-visual">
            <div class="visual-card card-1">
              <div class="card-icon">💼</div>
              <div class="card-title">Enterprise Ready</div>
            </div>
            <div class="visual-card card-2">
              <div class="card-icon">⚡</div>
              <div class="card-title">Fast Deployment</div>
            </div>
            <div class="visual-card card-3">
              <div class="card-icon">🔒</div>
              <div class="card-title">Secure & Reliable</div>
            </div>
            <div class="cta-illustration">
              <svg viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
                <!-- Background Circle -->
                <circle cx="200" cy="200" r="150" fill="url(#ctaGradient1)" opacity="0.15"/>
                
                <!-- Central Rocket/Growth Symbol -->
                <path d="M 200 100 L 220 180 L 240 160 L 220 200 L 260 220 L 220 220 L 200 280 L 180 220 L 140 220 L 180 200 L 160 160 L 180 180 Z"
                      fill="url(#ctaGradient2)" opacity="0.9"/>
                
                <!-- Orbiting Elements -->
                <circle cx="280" cy="150" r="20" fill="#fbbf24" opacity="0.8">
                  <animateTransform attributeName="transform" type="rotate" from="0 200 200" to="360 200 200" dur="10s" repeatCount="indefinite"/>
                </circle>
                <circle cx="120" cy="250" r="15" fill="#60a5fa" opacity="0.8">
                  <animateTransform attributeName="transform" type="rotate" from="0 200 200" to="360 200 200" dur="15s" repeatCount="indefinite"/>
                </circle>
                <circle cx="280" cy="280" r="18" fill="#34d399" opacity="0.8">
                  <animateTransform attributeName="transform" type="rotate" from="0 200 200" to="360 200 200" dur="12s" repeatCount="indefinite"/>
                </circle>
                
                <!-- Decorative Stars -->
                <text x="150" y="120" font-size="20" fill="#fbbf24" opacity="0.6">⭐</text>
                <text x="260" y="240" font-size="18" fill="#fbbf24" opacity="0.5">⭐</text>
                <text x="140" y="300" font-size="16" fill="#fbbf24" opacity="0.7">⭐</text>
                
                <!-- Gradients -->
                <defs>
                  <linearGradient id="ctaGradient1" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#1e3a8a;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#0369a1;stop-opacity:1" />
                  </linearGradient>
                  <linearGradient id="ctaGradient2" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#fbbf24;stop-opacity:1" />
                    <stop offset="50%" style="stop-color:#f59e0b;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#d97706;stop-opacity:1" />
                  </linearGradient>
                </defs>
              </svg>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'CallToAction'
}
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

/* ===== CTA SECTION - SPLIT LAYOUT ===== */
.cta-section {
  padding: 100px 24px;
  background: linear-gradient(135deg, #dc2626 0%, #ea580c 50%, #f59e0b 100%);
  position: relative;
  overflow: hidden;
}

.cta-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: radial-gradient(circle at 30% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
              radial-gradient(circle at 70% 80%, rgba(0, 0, 0, 0.1) 0%, transparent 50%);
  pointer-events: none;
}

.cta-content {
  display: grid;
  grid-template-columns: 1.2fr 1fr;
  gap: 60px;
  align-items: center;
  position: relative;
  z-index: 1;
}

/* ===== LEFT SIDE - TEXT & CTA ===== */
.cta-left {
  display: flex;
  flex-direction: column;
  gap: 28px;
  animation: fadeInLeft 1s ease-out;
}

.cta-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(10px);
  padding: 10px 20px;
  border-radius: 50px;
  width: fit-content;
  border: 2px solid rgba(255, 255, 255, 0.3);
}

.badge-icon {
  font-size: 1.25rem;
  line-height: 1;
}

.badge-text {
  font-size: 0.875rem;
  font-weight: 700;
  color: white;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.cta-title {
  font-size: 3rem;
  font-weight: 800;
  color: white;
  line-height: 1.2;
  letter-spacing: -0.02em;
  font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
}

.highlight-text {
  color: #fef3c7;
  text-shadow: 0 2px 10px rgba(254, 243, 199, 0.3);
}

.cta-description {
  font-size: 1.125rem;
  color: rgba(255, 255, 255, 0.95);
  line-height: 1.7;
  font-family: 'Segoe UI', system-ui, sans-serif;
}

/* ===== CTA BUTTONS ===== */
.cta-buttons {
  display: flex;
  gap: 16px;
  flex-wrap: wrap;
}

.cta-button {
  padding: 16px 32px;
  border-radius: 12px;
  text-decoration: none;
  font-weight: 600;
  font-size: 1rem;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  font-family: 'Segoe UI', system-ui, sans-serif;
  position: relative;
  overflow: hidden;
}

.cta-button::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
  transition: left 0.5s;
}

.cta-button:hover::before {
  left: 100%;
}

.cta-button.primary {
  background: white;
  color: #dc2626;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.cta-button.primary:hover {
  transform: translateY(-3px);
  box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
}

.cta-button.secondary {
  background: rgba(255, 255, 255, 0.15);
  color: white;
  border: 2px solid rgba(255, 255, 255, 0.4);
  backdrop-filter: blur(10px);
}

.cta-button.secondary:hover {
  background: rgba(255, 255, 255, 0.25);
  border-color: rgba(255, 255, 255, 0.6);
  transform: translateY(-3px);
}

.button-icon {
  transition: transform 0.3s ease;
}

.cta-button:hover .button-icon {
  transform: translateX(4px);
}

/* ===== CTA FEATURES ===== */
.cta-features {
  display: flex;
  gap: 24px;
  flex-wrap: wrap;
}

.feature-item {
  display: flex;
  align-items: center;
  gap: 8px;
}

.feature-icon {
  width: 24px;
  height: 24px;
  background: rgba(255, 255, 255, 0.2);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.875rem;
  color: white;
  font-weight: 700;
}

.feature-text {
  font-size: 0.95rem;
  color: rgba(255, 255, 255, 0.95);
  font-weight: 500;
  font-family: 'Segoe UI', system-ui, sans-serif;
}

/* ===== RIGHT SIDE - VISUAL ===== */
.cta-right {
  position: relative;
  animation: fadeInRight 1s ease-out;
}

.cta-visual {
  position: relative;
  width: 100%;
  height: 400px;
}

.cta-illustration {
  width: 100%;
  height: 100%;
  filter: drop-shadow(0 20px 60px rgba(0, 0, 0, 0.2));
}

.cta-illustration svg {
  width: 100%;
  height: 100%;
}

/* ===== VISUAL CARDS ===== */
.visual-card {
  position: absolute;
  background: white;
  backdrop-filter: blur(10px);
  padding: 16px 20px;
  border-radius: 12px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
  display: flex;
  align-items: center;
  gap: 12px;
  animation: floatCard 3s ease-in-out infinite;
}

.card-1 {
  top: 10%;
  left: 5%;
  animation-delay: 0s;
}

.card-2 {
  top: 45%;
  right: 5%;
  animation-delay: 1s;
}

.card-3 {
  bottom: 15%;
  left: 10%;
  animation-delay: 2s;
}

.card-icon {
  font-size: 1.5rem;
  line-height: 1;
}

.card-title {
  font-size: 0.875rem;
  font-weight: 700;
  color: #1e3a8a;
  white-space: nowrap;
}

/* ===== ANIMATIONS ===== */
@keyframes fadeInLeft {
  from {
    opacity: 0;
    transform: translateX(-50px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes fadeInRight {
  from {
    opacity: 0;
    transform: translateX(50px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes floatCard {
  0%, 100% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-20px);
  }
}

/* ===== RESPONSIVE DESIGN ===== */
@media (max-width: 1024px) {
  .cta-content {
    grid-template-columns: 1fr;
    gap: 50px;
  }

  .cta-right {
    order: -1;
  }

  .cta-visual {
    height: 300px;
  }

  .cta-title {
    font-size: 2.5rem;
  }
}

@media (max-width: 768px) {
  .cta-section {
    padding: 60px 20px;
  }

  .cta-content {
    gap: 40px;
  }

  .cta-title {
    font-size: 2rem;
  }

  .cta-description {
    font-size: 1rem;
  }

  .cta-visual {
    height: 250px;
  }

  .cta-buttons {
    flex-direction: column;
  }

  .cta-button {
    width: 100%;
    justify-content: center;
  }

  .cta-features {
    flex-direction: column;
    gap: 12px;
  }

  .visual-card {
    padding: 12px 16px;
  }

  .card-title {
    font-size: 0.8rem;
  }
}

@media (max-width: 480px) {
  .cta-section {
    padding: 40px 16px;
  }

  .cta-title {
    font-size: 1.75rem;
  }

  .cta-description {
    font-size: 0.95rem;
  }

  .cta-button {
    padding: 14px 24px;
    font-size: 0.95rem;
  }

  .visual-card {
    display: none;
  }
}
</style>

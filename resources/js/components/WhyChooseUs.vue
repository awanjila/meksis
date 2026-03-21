<template>
  <section class="why-choose-section">
    <div class="container">
      <div class="why-choose-content">
        <!-- Left Side: Text & Benefits -->
        <div class="why-choose-left">
          <div class="why-choose-header">
            <div class="section-label">Why Choose Us</div>
            <h2 class="section-title">
              Why Businesses <span class="gradient-text">Choose</span> Wabe Studio
            </h2>
            <p class="section-description">
              Trusted expertise, innovative solutions, and a commitment to your success every step of the way. We don't just deliver projects — we build lasting partnerships.
            </p>
          </div>

          <div class="benefits-list">
            <div v-for="(point, index) in points" :key="point.text" class="benefit-item">
              <div class="benefit-number">{{ String(index + 1).padStart(2, '0') }}</div>
              <div class="benefit-icon-wrapper">
                <i :class="point.icon" class="benefit-icon"></i>
              </div>
              <p class="benefit-text">{{ point.text }}</p>
            </div>
          </div>
        </div>

        <!-- Right Side: Visual Representation -->
        <div class="why-choose-right">
          <div class="why-choose-visual">
            <div class="achievement-badge badge-1">
              <div class="badge-icon">🏆</div>
              <div class="badge-content">
                <div class="badge-number">10+</div>
                <div class="badge-label">Years Experience</div>
              </div>
            </div>
            <div class="achievement-badge badge-2">
              <div class="badge-icon">⭐</div>
              <div class="badge-content">
                <div class="badge-number">98%</div>
                <div class="badge-label">Client Satisfaction</div>
              </div>
            </div>
            <div class="achievement-badge badge-3">
              <div class="badge-icon">🚀</div>
              <div class="badge-content">
                <div class="badge-number">50+</div>
                <div class="badge-label">Projects Delivered</div>
              </div>
            </div>
            <div class="why-choose-illustration">
              <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg">
                <!-- Background Circle -->
                <circle cx="250" cy="250" r="180" fill="url(#whyChooseGradient1)" opacity="0.1"/>
                
                <!-- Central Trophy/Award -->
                <path d="M 200 200 L 200 150 L 180 150 L 180 140 L 320 140 L 320 150 L 300 150 L 300 200
                         C 300 220 290 240 250 240 C 210 240 200 220 200 200 Z"
                      fill="url(#whyChooseGradient2)" opacity="0.9"/>
                <rect x="230" y="240" width="40" height="60" rx="5" fill="url(#whyChooseGradient2)" opacity="0.9"/>
                <rect x="210" y="300" width="80" height="20" rx="10" fill="url(#whyChooseGradient2)" opacity="0.9"/>
                
                <!-- Stars Around -->
                <text x="150" y="180" font-size="30" fill="#fbbf24" opacity="0.8">⭐</text>
                <text x="320" y="180" font-size="30" fill="#fbbf24" opacity="0.8">⭐</text>
                <text x="150" y="320" font-size="25" fill="#fbbf24" opacity="0.7">⭐</text>
                <text x="330" y="320" font-size="25" fill="#fbbf24" opacity="0.7">⭐</text>
                <text x="250" y="120" font-size="28" fill="#fbbf24" opacity="0.9">⭐</text>
                
                <!-- Achievement Rings -->
                <circle cx="250" cy="250" r="140" fill="none" stroke="#60a5fa" stroke-width="3" opacity="0.3" stroke-dasharray="10,5"/>
                <circle cx="250" cy="250" r="160" fill="none" stroke="#34d399" stroke-width="2" opacity="0.2" stroke-dasharray="8,4"/>
                
                <!-- Checkmarks -->
                <text x="120" y="250" font-size="35" fill="#34d399" opacity="0.6">✓</text>
                <text x="350" y="250" font-size="35" fill="#34d399" opacity="0.6">✓</text>
                <text x="250" y="380" font-size="30" fill="#34d399" opacity="0.5">✓</text>
                
                <!-- Decorative Elements -->
                <circle cx="100" cy="150" r="25" fill="#60a5fa" opacity="0.15"/>
                <circle cx="400" cy="150" r="30" fill="#fbbf24" opacity="0.15"/>
                <circle cx="100" cy="350" r="28" fill="#34d399" opacity="0.15"/>
                <circle cx="400" cy="350" r="32" fill="#a78bfa" opacity="0.15"/>
                
                <!-- Gradients -->
                <defs>
                  <linearGradient id="whyChooseGradient1" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#1e3a8a;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#0369a1;stop-opacity:1" />
                  </linearGradient>
                  <linearGradient id="whyChooseGradient2" x1="0%" y1="0%" x2="100%" y2="100%">
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

<script setup>
const points = [
  { icon: 'fas fa-rocket', text: '10+ Years of Full-Stack Experience' },
  { icon: 'fas fa-shield-alt', text: 'Security & Data Privacy by Default' },
  { icon: 'fas fa-lightbulb', text: 'Innovative Design-Thinking Approach' },
  { icon: 'fas fa-handshake', text: 'Long-Term Partnership Mentality' },
  { icon: 'fas fa-chart-line', text: 'Enterprise-Grade Scalability' },
  { icon: 'fas fa-clock', text: 'Fast Delivery, Reliable Support' },
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

/* ===== WHY CHOOSE SECTION - SPLIT LAYOUT ===== */
.why-choose-section {
  padding: 100px 24px;
  background: linear-gradient(135deg, #f8fafc 0%, #e0f2fe 50%, #dbeafe 100%);
  position: relative;
  overflow: hidden;
}

.why-choose-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: radial-gradient(circle at 70% 50%, rgba(251, 191, 36, 0.08) 0%, transparent 50%),
              radial-gradient(circle at 30% 80%, rgba(96, 165, 250, 0.1) 0%, transparent 50%);
  pointer-events: none;
}

.why-choose-content {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 80px;
  align-items: center;
  position: relative;
  z-index: 1;
}

/* ===== LEFT SIDE - TEXT & BENEFITS ===== */
.why-choose-left {
  display: flex;
  flex-direction: column;
  gap: 40px;
  animation: fadeInLeft 1s ease-out;
}

.why-choose-header {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.section-label {
  font-size: 0.875rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  color: #0369a1;
}

.section-title {
  font-size: 2.75rem;
  font-weight: 800;
  color: #1e3a8a;
  line-height: 1.2;
  letter-spacing: -0.02em;
  font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
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
}

/* ===== BENEFITS LIST ===== */
.benefits-list {
  display: grid;
  grid-template-columns: 1fr;
  gap: 16px;
}

.benefit-item {
  display: flex;
  align-items: center;
  gap: 16px;
  padding: 20px;
  background: white;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(30, 58, 138, 0.08);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  border-left: 4px solid #0369a1;
  position: relative;
  overflow: hidden;
}

.benefit-item::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, rgba(96, 165, 250, 0.03) 0%, transparent 100%);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.benefit-item:hover {
  transform: translateX(8px);
  box-shadow: 0 8px 30px rgba(30, 58, 138, 0.15);
  border-left-color: #fbbf24;
}

.benefit-item:hover::before {
  opacity: 1;
}

.benefit-number {
  flex-shrink: 0;
  width: 36px;
  height: 36px;
  background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 800;
  font-size: 0.95rem;
  color: #0369a1;
  transition: all 0.3s ease;
}

.benefit-item:hover .benefit-number {
  background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
  color: #d97706;
  transform: scale(1.1);
}

.benefit-icon-wrapper {
  flex-shrink: 0;
  width: 48px;
  height: 48px;
  background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
}

.benefit-icon {
  font-size: 1.5rem;
  color: #0369a1;
  transition: all 0.3s ease;
}

.benefit-item:hover .benefit-icon-wrapper {
  background: linear-gradient(135deg, #1e3a8a 0%, #0369a1 100%);
  transform: rotate(5deg);
}

.benefit-item:hover .benefit-icon {
  color: white;
}

.benefit-text {
  flex: 1;
  font-size: 0.95rem;
  font-weight: 600;
  color: #1e3a8a;
  line-height: 1.5;
  font-family: 'Segoe UI', system-ui, sans-serif;
  margin: 0;
  transition: color 0.3s ease;
}

.benefit-item:hover .benefit-text {
  color: #0369a1;
}

/* ===== RIGHT SIDE - VISUAL ===== */
.why-choose-right {
  position: relative;
  animation: fadeInRight 1s ease-out;
}

.why-choose-visual {
  position: relative;
  width: 100%;
  height: 600px;
}

.why-choose-illustration {
  width: 100%;
  height: 100%;
  filter: drop-shadow(0 20px 60px rgba(30, 58, 138, 0.15));
}

.why-choose-illustration svg {
  width: 100%;
  height: 100%;
}

/* ===== ACHIEVEMENT BADGES ===== */
.achievement-badge {
  position: absolute;
  background: white;
  backdrop-filter: blur(10px);
  padding: 16px 20px;
  border-radius: 16px;
  box-shadow: 0 10px 30px rgba(30, 58, 138, 0.2);
  display: flex;
  align-items: center;
  gap: 12px;
  animation: floatBadge 3s ease-in-out infinite;
  border: 2px solid rgba(251, 191, 36, 0.2);
}

.badge-1 {
  top: 10%;
  right: 5%;
  animation-delay: 0s;
}

.badge-2 {
  top: 50%;
  left: 5%;
  animation-delay: 1s;
}

.badge-3 {
  bottom: 15%;
  right: 10%;
  animation-delay: 2s;
}

.badge-icon {
  font-size: 2rem;
  line-height: 1;
}

.badge-content {
  display: flex;
  flex-direction: column;
  gap: 2px;
}

.badge-number {
  font-size: 1.5rem;
  font-weight: 800;
  color: #1e3a8a;
  line-height: 1;
}

.badge-label {
  font-size: 0.75rem;
  font-weight: 600;
  color: #64748b;
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

@keyframes floatBadge {
  0%, 100% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-15px);
  }
}

/* ===== RESPONSIVE DESIGN ===== */
@media (max-width: 1024px) {
  .why-choose-content {
    grid-template-columns: 1fr;
    gap: 60px;
  }

  .why-choose-right {
    order: -1;
  }

  .why-choose-visual {
    height: 400px;
  }

  .section-title {
    font-size: 2.25rem;
  }

  .achievement-badge {
    display: none;
  }
}

@media (max-width: 768px) {
  .why-choose-section {
    padding: 60px 20px;
  }

  .why-choose-content {
    gap: 40px;
  }

  .section-title {
    font-size: 2rem;
  }

  .section-description {
    font-size: 1rem;
  }

  .why-choose-visual {
    height: 300px;
  }

  .benefit-item {
    padding: 18px;
    gap: 14px;
  }

  .benefit-number {
    width: 32px;
    height: 32px;
    font-size: 0.875rem;
  }

  .benefit-icon-wrapper {
    width: 44px;
    height: 44px;
  }

  .benefit-icon {
    font-size: 1.3rem;
  }

  .benefit-text {
    font-size: 0.9rem;
  }
}

@media (max-width: 480px) {
  .why-choose-section {
    padding: 40px 16px;
  }

  .section-title {
    font-size: 1.75rem;
  }

  .section-description {
    font-size: 0.95rem;
  }

  .benefit-item {
    padding: 16px;
    gap: 12px;
  }

  .benefit-number {
    width: 30px;
    height: 30px;
    font-size: 0.8rem;
  }

  .benefit-icon-wrapper {
    width: 40px;
    height: 40px;
  }

  .benefit-icon {
    font-size: 1.2rem;
  }

  .benefit-text {
    font-size: 0.875rem;
  }
}
</style>
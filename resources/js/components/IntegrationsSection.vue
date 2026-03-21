<template>
  <section class="integrations-section">
    <div class="container">
      <div class="integrations-content">
        <!-- Left Side: Branded Illustration -->
        <div class="integrations-left">
          <div class="integrations-image-wrapper">
            <div class="connection-line line-1"></div>
            <div class="connection-line line-2"></div>
            <div class="connection-line line-3"></div>
            <div class="integrations-illustration">
              <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg">
                <!-- Central Hub -->
                <circle cx="250" cy="250" r="80" fill="url(#integrationsGradient1)"/>
                <circle cx="250" cy="250" r="60" fill="white" opacity="0.9"/>
                <text x="250" y="260" font-size="40" fill="#1e3a8a" text-anchor="middle" font-weight="bold">HUB</text>
                
                <!-- Connection Nodes -->
                <circle cx="150" cy="150" r="40" fill="#60a5fa" opacity="0.9"/>
                <circle cx="350" cy="150" r="40" fill="#fbbf24" opacity="0.9"/>
                <circle cx="150" cy="350" r="40" fill="#34d399" opacity="0.9"/>
                <circle cx="350" cy="350" r="40" fill="#f472b6" opacity="0.9"/>
                <circle cx="250" cy="100" r="35" fill="#a78bfa" opacity="0.9"/>
                <circle cx="250" cy="400" r="35" fill="#fb923c" opacity="0.9"/>
                
                <!-- Connection Lines -->
                <line x1="250" y1="250" x2="150" y2="150" stroke="#60a5fa" stroke-width="3" opacity="0.4" stroke-dasharray="5,5">
                  <animate attributeName="stroke-dashoffset" from="0" to="10" dur="1s" repeatCount="indefinite"/>
                </line>
                <line x1="250" y1="250" x2="350" y2="150" stroke="#fbbf24" stroke-width="3" opacity="0.4" stroke-dasharray="5,5">
                  <animate attributeName="stroke-dashoffset" from="0" to="10" dur="1s" repeatCount="indefinite"/>
                </line>
                <line x1="250" y1="250" x2="150" y2="350" stroke="#34d399" stroke-width="3" opacity="0.4" stroke-dasharray="5,5">
                  <animate attributeName="stroke-dashoffset" from="0" to="10" dur="1s" repeatCount="indefinite"/>
                </line>
                <line x1="250" y1="250" x2="350" y2="350" stroke="#f472b6" stroke-width="3" opacity="0.4" stroke-dasharray="5,5">
                  <animate attributeName="stroke-dashoffset" from="0" to="10" dur="1s" repeatCount="indefinite"/>
                </line>
                <line x1="250" y1="250" x2="250" y2="100" stroke="#a78bfa" stroke-width="3" opacity="0.4" stroke-dasharray="5,5">
                  <animate attributeName="stroke-dashoffset" from="0" to="10" dur="1s" repeatCount="indefinite"/>
                </line>
                <line x1="250" y1="250" x2="250" y2="400" stroke="#fb923c" stroke-width="3" opacity="0.4" stroke-dasharray="5,5">
                  <animate attributeName="stroke-dashoffset" from="0" to="10" dur="1s" repeatCount="indefinite"/>
                </line>
                
                <!-- Node Icons (simplified) -->
                <text x="150" y="160" font-size="24" text-anchor="middle" fill="white">💳</text>
                <text x="350" y="160" font-size="24" text-anchor="middle" fill="white">📱</text>
                <text x="150" y="360" font-size="24" text-anchor="middle" fill="white">👤</text>
                <text x="350" y="360" font-size="24" text-anchor="middle" fill="white">🔧</text>
                <text x="250" y="110" font-size="20" text-anchor="middle" fill="white">☁️</text>
                <text x="250" y="410" font-size="20" text-anchor="middle" fill="white">🌐</text>
                
                <!-- Background Circle -->
                <circle cx="250" cy="250" r="220" fill="none" stroke="#e0f2fe" stroke-width="2" opacity="0.3"/>
                <circle cx="250" cy="250" r="180" fill="none" stroke="#bfdbfe" stroke-width="2" opacity="0.3"/>
                
                <!-- Gradients -->
                <defs>
                  <linearGradient id="integrationsGradient1" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#1e3a8a;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#0369a1;stop-opacity:1" />
                  </linearGradient>
                </defs>
              </svg>
            </div>
          </div>
        </div>

        <!-- Right Side: Text & Integrations -->
        <div class="integrations-right">
          <div class="integrations-header">
            <div class="section-label">Powerful Connections</div>
            <h2 class="section-title">
              Seamless <span class="gradient-text">Integrations</span>
              <br/>Real-World Power
            </h2>
            <p class="section-description">
              We connect your systems with the tools that matter — from biometric and billing devices to CRMs, M-Pesa, Twilio, and beyond. Everything works together, seamlessly.
            </p>
          </div>

          <div class="integrations-grid">
            <div class="integration-card">
              <div class="integration-icon">💳</div>
              <p class="integration-name">M-Pesa</p>
              <p class="integration-desc">Payment Gateway</p>
            </div>
            <div class="integration-card">
              <div class="integration-icon">📱</div>
              <p class="integration-name">Twilio</p>
              <p class="integration-desc">SMS & Voice API</p>
            </div>
            <div class="integration-card">
              <div class="integration-icon">👤</div>
              <p class="integration-name">Biometrics</p>
              <p class="integration-desc">Access Control</p>
            </div>
            <div class="integration-card">
              <div class="integration-icon">🔧</div>
              <p class="integration-name">CRM Systems</p>
              <p class="integration-desc">Customer Management</p>
            </div>
            <div class="integration-card">
              <div class="integration-icon">☁️</div>
              <p class="integration-name">Cloud Services</p>
              <p class="integration-desc">AWS, Azure, GCP</p>
            </div>
            <div class="integration-card">
              <div class="integration-icon">🌐</div>
              <p class="integration-name">IoT Devices</p>
              <p class="integration-desc">Smart Hardware</p>
            </div>
          </div>

          <div class="integration-cta">
            <p class="cta-text">Need a custom integration?</p>
            <a href="#contact" class="cta-link">Let's talk →</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'IntegrationsSection'
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

/* ===== INTEGRATIONS SECTION - SPLIT LAYOUT ===== */
.integrations-section {
  padding: 100px 24px;
  background: linear-gradient(135deg, #f8fafc 0%, #e0f2fe 50%, #dbeafe 100%);
  position: relative;
  overflow: hidden;
}

.integrations-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: radial-gradient(circle at 30% 50%, rgba(96, 165, 250, 0.1) 0%, transparent 50%),
              radial-gradient(circle at 70% 80%, rgba(251, 191, 36, 0.08) 0%, transparent 50%);
  pointer-events: none;
}

.integrations-content {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 80px;
  align-items: center;
  position: relative;
  z-index: 1;
}

/* ===== LEFT SIDE - ILLUSTRATION ===== */
.integrations-left {
  position: relative;
  animation: fadeInLeft 1s ease-out;
}

.integrations-image-wrapper {
  position: relative;
  width: 100%;
  height: 500px;
}

.integrations-illustration {
  width: 100%;
  height: 100%;
  filter: drop-shadow(0 20px 60px rgba(30, 58, 138, 0.15));
}

.integrations-illustration svg {
  width: 100%;
  height: 100%;
}

/* ===== CONNECTION LINES (DECORATIVE) ===== */
.connection-line {
  position: absolute;
  background: linear-gradient(90deg, transparent, #60a5fa, transparent);
  height: 2px;
  opacity: 0.2;
  animation: pulse 2s ease-in-out infinite;
}

.line-1 {
  top: 20%;
  left: 0;
  right: 0;
  animation-delay: 0s;
}

.line-2 {
  top: 50%;
  left: 0;
  right: 0;
  animation-delay: 0.7s;
}

.line-3 {
  top: 80%;
  left: 0;
  right: 0;
  animation-delay: 1.4s;
}

/* ===== RIGHT SIDE - TEXT & INTEGRATIONS ===== */
.integrations-right {
  display: flex;
  flex-direction: column;
  gap: 40px;
  animation: fadeInRight 1s ease-out;
}

.integrations-header {
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

/* ===== INTEGRATIONS GRID ===== */
.integrations-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
}

.integration-card {
  background: white;
  padding: 24px 20px;
  border-radius: 16px;
  box-shadow: 0 4px 20px rgba(30, 58, 138, 0.08);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  border-top: 3px solid #0369a1;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.integration-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, rgba(96, 165, 250, 0.05) 0%, transparent 100%);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.integration-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 40px rgba(30, 58, 138, 0.15);
  border-top-color: #fbbf24;
}

.integration-card:hover::before {
  opacity: 1;
}

.integration-icon {
  font-size: 2.5rem;
  line-height: 1;
  transition: transform 0.3s ease;
}

.integration-card:hover .integration-icon {
  transform: scale(1.2) rotate(5deg);
}

.integration-name {
  font-size: 1rem;
  font-weight: 700;
  color: #1e3a8a;
  font-family: 'Segoe UI', system-ui, sans-serif;
  margin: 0;
  transition: color 0.3s ease;
}

.integration-card:hover .integration-name {
  color: #0369a1;
}

.integration-desc {
  font-size: 0.8rem;
  color: #64748b;
  font-family: 'Segoe UI', system-ui, sans-serif;
  margin: 0;
}

/* ===== CTA SECTION ===== */
.integration-cta {
  display: flex;
  align-items: center;
  gap: 16px;
  padding: 24px 28px;
  background: white;
  border-radius: 16px;
  box-shadow: 0 4px 20px rgba(30, 58, 138, 0.08);
  border-left: 4px solid #fbbf24;
}

.cta-text {
  font-size: 1.05rem;
  font-weight: 600;
  color: #1e3a8a;
  font-family: 'Segoe UI', system-ui, sans-serif;
  margin: 0;
}

.cta-link {
  font-size: 1rem;
  font-weight: 700;
  color: #0369a1;
  text-decoration: none;
  font-family: 'Segoe UI', system-ui, sans-serif;
  transition: all 0.3s ease;
  white-space: nowrap;
}

.cta-link:hover {
  color: #1e3a8a;
  transform: translateX(5px);
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

@keyframes pulse {
  0%, 100% {
    opacity: 0.2;
  }
  50% {
    opacity: 0.5;
  }
}

/* ===== RESPONSIVE DESIGN ===== */
@media (max-width: 1024px) {
  .integrations-content {
    grid-template-columns: 1fr;
    gap: 60px;
  }

  .integrations-left {
    order: 2;
  }

  .integrations-right {
    order: 1;
  }

  .integrations-image-wrapper {
    height: 400px;
  }

  .section-title {
    font-size: 2.25rem;
  }

  .integrations-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 768px) {
  .integrations-section {
    padding: 60px 20px;
  }

  .integrations-content {
    gap: 40px;
  }

  .section-title {
    font-size: 2rem;
  }

  .section-description {
    font-size: 1rem;
  }

  .integrations-image-wrapper {
    height: 300px;
  }

  .integrations-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
  }

  .integration-card {
    padding: 20px 16px;
  }

  .integration-icon {
    font-size: 2rem;
  }

  .integration-cta {
    flex-direction: column;
    text-align: center;
    gap: 12px;
  }
}

@media (max-width: 480px) {
  .integrations-section {
    padding: 40px 16px;
  }

  .section-title {
    font-size: 1.75rem;
  }

  .section-description {
    font-size: 0.95rem;
  }

  .integrations-grid {
    grid-template-columns: 1fr;
  }

  .integration-card {
    padding: 20px;
  }

  .integration-name {
    font-size: 0.95rem;
  }

  .integration-desc {
    font-size: 0.75rem;
  }

  .cta-text {
    font-size: 0.95rem;
  }

  .cta-link {
    font-size: 0.95rem;
  }
}
</style>
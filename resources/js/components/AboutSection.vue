<template>
  <section class="about-section">
    <div class="container">
      <div class="about-content">
        <!-- Left Side: Image -->
        <div class="about-image-wrapper">
          <div class="image-container">
            <img 
              src="/images/about/tank-factory.jpeg" 
              alt="Meksis Engineering Steel Tank Manufacturing" 
              class="about-image"
            />
            
            <!-- Stats Badge -->
            <div class="stats-badge">
              <div class="stat-item">
                <div class="stat-number">15+</div>
                <div class="stat-label">YEARS EXPERIENCE</div>
              </div>
              <div class="stat-divider"></div>
              <div class="stat-item">
                <div class="stat-number">1000+</div>
                <div class="stat-label">HAPPY CLIENTS</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Side: Content -->
        <div class="about-text-wrapper">
          <div class="section-label">ABOUT MEKSIS ENGINEERING</div>
          <h2 class="section-title">
            PREMIUM STEEL TANK
            <span class="highlight">SOLUTIONS</span>
          </h2>
          
          <p class="about-description">
            Meksis Engineering prides itself as one of the most prominent fabricator, supplier and installer of pressed steel tanks & GRP Tanks in Kenya. We also do general steel fabrication.
          </p>

          <p class="about-description">
            Established in 2010, we specialize in manufacturing high-quality elevated pressed steel tanks, galvanized steel tanks, and GRP water tanks for industrial, commercial, and residential applications across Kenya and East Africa.
          </p>
      
          <div class="cta-buttons">
            <a href="/contact" class="btn-primary">
              GET A QUOTE
              <i class="fas fa-arrow-right"></i>
            </a>
            <a href="/products" class="btn-secondary">
              <i class="fas fa-box"></i>
              OUR PRODUCTS
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
</script>

<style scoped>
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

/* ===== ABOUT SECTION ===== */
.about-section {
  padding: 60px 0;
  background: var(--charcoal);
  font-family: 'Arial Narrow', sans-serif;
}

.about-content {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 60px;
  align-items: center;
}

/* ===== LEFT SIDE - IMAGE ===== */
.about-image-wrapper {
  position: relative;
}

.image-container {
  position: relative;
  overflow: hidden;
  background: #333;
}

.about-image {
  width: 100%;
  height: auto;
  display: block;
}

/* ===== STATS BADGE ===== */
.stats-badge {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: var(--royal-yellow);
  padding: 20px;
  display: flex;
  align-items: center;
  justify-content: space-around;
}

.stat-item {
  text-align: center;
}

.stat-number {
  font-size: 2rem;
  font-weight: 900;
  color: var(--charcoal);
  line-height: 1;
  margin-bottom: 4px;
}

.stat-label {
  font-size: 0.7rem;
  color: var(--charcoal);
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.stat-divider {
  width: 1px;
  height: 40px;
  background: var(--charcoal);
}

/* ===== RIGHT SIDE - CONTENT ===== */
.about-text-wrapper {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.section-label {
  font-size: 0.85rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 2px;
  color: var(--royal-yellow);
}

.section-title {
  font-size: 2.25rem;
  font-weight: 900;
  color: var(--white);
  line-height: 1.2;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.section-title .highlight {
  color: var(--royal-yellow);
  display: block;
}

.about-description {
  font-size: 1rem;
  color: #bbb;
  line-height: 1.7;
}

/* ===== CTA BUTTONS ===== */
.cta-buttons {
  display: flex;
  gap: 12px;
  margin-top: 16px;
  flex-wrap: wrap;
}

.btn-primary,
.btn-secondary {
  padding: 14px 28px;
  font-size: 0.9rem;
  font-weight: 700;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 10px;
  transition: all 0.1s ease;
  white-space: nowrap;
  text-transform: uppercase;
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

.btn-primary i {
  transition: transform 0.1s;
}

.btn-primary:hover i {
  transform: translateX(4px);
}

.btn-secondary {
  background: transparent;
  color: var(--white);
  border: 2px solid #555;
}

.btn-secondary:hover {
  border-color: var(--royal-yellow);
  color: var(--royal-yellow);
}

/* ===== RESPONSIVE DESIGN ===== */
@media (max-width: 1024px) {
  .about-content {
    grid-template-columns: 1fr;
    gap: 40px;
  }

  .section-title {
    font-size: 1.75rem;
  }
}

@media (max-width: 768px) {
  .about-section {
    padding: 40px 0;
  }

  .container {
    padding: 0 20px;
  }

  .section-title {
    font-size: 1.5rem;
  }

  .about-description {
    font-size: 0.95rem;
  }

  .stats-badge {
    position: relative;
    margin-top: 0;
  }

  .cta-buttons {
    flex-direction: column;
  }

  .btn-primary,
  .btn-secondary {
    width: 100%;
    justify-content: center;
  }
}
</style>

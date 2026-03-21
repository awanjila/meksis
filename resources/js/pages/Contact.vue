<template>
  <div class="main-content">
    <!-- Breadcrumbs -->
    <div class="rs-breadcrumbs">
      <div class="breadcrumbs-inner text-center">
        <h1 class="page-title">CONTACT US</h1>
        <ul>
          <li>
            <a href="/">HOME</a>
          </li>
          <li>CONTACT</li>
        </ul>
      </div>
    </div>

    <!-- Contact Section Component -->
    <ContactSection />

    <!-- Google Map Section -->
    <section class="map-section">
      <div class="container">
        <div class="map-header">
          <h2 class="map-title">FIND US</h2>
          <p class="map-description">Industrial Area, Nairobi, Kenya</p>
        </div>
        <div class="map-wrapper">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8587858865117!2d36.80878337496547!3d-1.2566086987314193!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f171bdb51d753%3A0x1ba101f21acf2aca!2sMeksis%20Engineering%20Limited!5e0!3m2!1sen!2ske!4v1768636773651!5m2!1sen!2ske" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import ContactSection from '../components/ContactSection.vue'
</script>

<style scoped>
/* ===== BREADCRUMBS ===== */
.rs-breadcrumbs {
  padding: 50px 0 40px;
  background: var(--charcoal);
  border-bottom: 5px solid var(--royal-yellow);
}

.breadcrumbs-inner {
  color: var(--white);
}

.page-title {
  font-size: 2.5rem;
  font-weight: 900;
  margin-bottom: 16px;
  color: var(--white);
  text-transform: uppercase;
  letter-spacing: 2px;
}

.breadcrumbs-inner ul {
  list-style: none;
  padding: 0;
  display: flex;
  justify-content: center;
  gap: 10px;
}

.breadcrumbs-inner ul li {
  color: #999;
  text-transform: uppercase;
  font-weight: bold;
  font-size: 0.85rem;
}

.breadcrumbs-inner ul li::before {
  content: '/';
  margin-right: 10px;
  color: #666;
}

.breadcrumbs-inner ul li:first-child::before {
  display: none;
}

.breadcrumbs-inner ul li a {
  color: var(--royal-yellow);
  text-decoration: none;
  transition: color 0.1s;
  font-weight: bold;
}

.breadcrumbs-inner ul li a:hover {
  color: var(--white);
}

/* ===== MAP SECTION ===== */
.map-section {
  padding: 60px 24px;
  background: var(--charcoal);
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 50px;
}

.map-header {
  text-align: center;
  margin-bottom: 40px;
}

.map-title {
  font-size: 2rem;
  font-weight: 900;
  color: var(--white);
  margin-bottom: 12px;
  text-transform: uppercase;
  letter-spacing: 2px;
}

.map-description {
  font-size: 1rem;
  color: #999;
  text-transform: uppercase;
  font-weight: bold;
}

.map-wrapper {
  overflow: hidden;
  border: 3px solid var(--royal-yellow);
}

.map-wrapper iframe {
  display: block;
  width: 100%;
}

/* ===== RESPONSIVE DESIGN ===== */
@media (max-width: 768px) {
  .map-section {
    padding: 40px 20px;
  }

  .map-title {
    font-size: 1.5rem;
  }

  .map-wrapper iframe {
    height: 350px;
  }

  .page-title {
    font-size: 1.75rem;
  }
}

@media (max-width: 480px) {
  .map-section {
    padding: 30px 16px;
  }

  .container {
    padding: 0 16px;
  }

  .map-title {
    font-size: 1.25rem;
  }

  .map-description {
    font-size: 0.9rem;
  }

  .map-wrapper iframe {
    height: 280px;
  }

  .page-title {
    font-size: 1.5rem;
  }
}
</style>
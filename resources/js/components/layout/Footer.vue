<template>
  <footer class="site-footer">
    <!-- Main Footer Content -->
    <div class="footer-main">
      <div class="container">
        <div class="footer-grid">
          <!-- Company Info -->
          <div class="footer-column">
            <div class="footer-logo">
              <a href="/"><img src="/front_assets/images/logo-dark.png" alt="Meksis Engineering"></a>
            </div>
            <p class="footer-description">
              Meksis Engineering prides itself as one of the most prominent fabricator, supplier and installer of pressed steel tanks & GRP Tanks in Kenya. We also do general steel fabrication.
            </p>
            <div class="social-links">
              <a href="#" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Facebook">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Twitter">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="LinkedIn">
                <i class="fab fa-linkedin-in"></i>
              </a>
              <a href="#" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Instagram">
                <i class="fab fa-instagram"></i>
              </a>
            </div>
          </div>

          <!-- Products -->
          <div class="footer-column">
            <h3 class="footer-title">Our Products</h3>
            <ul v-if="services.length > 0" class="footer-links">
              <li v-for="service in services.slice(0, 6)" :key="service.id">
                <a :href="`/show/product/${service.slug}`">
                  <i class="fas fa-chevron-right"></i>
                  {{ service.name }}
                </a>
              </li>
            </ul>
            <ul v-else class="footer-links">
              <li><a href="/products"><i class="fas fa-chevron-right"></i>View All Products</a></li>
            </ul>
          </div>

          <!-- Contact Info -->
          <div class="footer-column">
            <h3 class="footer-title">Contact Info</h3>
            <ul class="contact-info">
              <li>
                <i class="fas fa-map-marker-alt"></i>
                <span>Industrial Area, Nairobi</span>
              </li>
              <li>
                <i class="fas fa-phone"></i>
                <div class="contact-group">
                  <a href="tel:+254735551515">+254 735 551515</a>
                </div>
              </li>
              <li>
                <i class="fas fa-envelope"></i>
                <div class="contact-group">
                  <a href="mailto:info@meksis.co.ke">info@meksis.co.ke</a>
                </div>
              </li>
              <li>
                <i class="fas fa-clock"></i>
                <span>Mon - Fri: 08:00 - 17:00</span>
              </li>
            </ul>
          </div>

          <!-- Newsletter -->
          <div class="footer-column">
            <h3 class="footer-title">Newsletter</h3>
            <p class="newsletter-desc">
              Stay updated with our latest news and exclusive offers. Subscribe to our newsletter today!
            </p>
            <form @submit.prevent="subscribeNewsletter" class="newsletter-form">
              <div class="input-wrapper">
                <input
                  v-model="newsletterEmail"
                  type="email"
                  placeholder="Your email address"
                  required
                  :disabled="isSubscribing"
                />
                <button type="submit" :disabled="isSubscribing" aria-label="Subscribe">
                  <i v-if="!isSubscribing" class="fas fa-paper-plane"></i>
                  <i v-else class="fas fa-spinner fa-spin"></i>
                </button>
              </div>
              <p v-if="newsletterMessage" class="newsletter-message" :class="newsletterMessageType">
                {{ newsletterMessage }}
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
      <div class="container">
        <div class="footer-bottom-content">
          <div class="copyright">
            <span id="current-year">{{ currentYear }}</span> © All Rights Reserved. Meksis Engineering
          </div>
          <ul class="footer-menu">
            <li><a href="/">HOME</a></li>
            <li><a href="/about">ABOUT</a></li>
            <li><a href="/blogs">BLOG</a></li>
            <li><a href="/products">PRODUCTS</a></li>
            <li><a href="/contact">CONTACT</a></li>
          </ul>
          <div class="made-with-love">
            Made with <i class="fas fa-heart"></i> by <a href="https://wabestudio.co.ke" target="_blank" rel="noopener noreferrer">WabeStudio</a>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import axios from 'axios'

const services = ref([])
const newsletterEmail = ref('')
const isSubscribing = ref(false)
const newsletterMessage = ref('')
const newsletterMessageType = ref('')

const currentYear = computed(() => new Date().getFullYear())

const fetchServices = async () => {
  try {
    const response = await axios.get('/api/services')
    services.value = response.data
  } catch (error) {
    console.error('Error fetching services:', error)
  }
}

const subscribeNewsletter = async () => {
  isSubscribing.value = true
  newsletterMessage.value = ''
  
  try {
    await new Promise(resolve => setTimeout(resolve, 1000))
    newsletterMessage.value = 'Thank you for subscribing!'
    newsletterMessageType.value = 'success'
    newsletterEmail.value = ''
    
    setTimeout(() => {
      newsletterMessage.value = ''
    }, 5000)
  } catch (error) {
    newsletterMessage.value = 'Subscription failed. Please try again.'
    newsletterMessageType.value = 'error'
  } finally {
    isSubscribing.value = false
  }
}

onMounted(() => {
  fetchServices()
})
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

.site-footer {
  background: var(--charcoal);
  color: var(--white);
  font-family: 'Arial Narrow', sans-serif;
}

.footer-main {
  padding: 60px 0;
  border-bottom: 5px solid var(--royal-yellow);
}

.footer-grid {
  display: grid;
  grid-template-columns: 1.5fr 1fr 1fr 1.2fr;
  gap: 40px;
}

.footer-column {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.footer-logo img {
  height: 45px;
  width: auto;
}

.footer-description {
  font-size: 14px;
  line-height: 1.6;
  color: #ccc;
}

.social-links {
  display: flex;
  gap: 8px;
}

.social-link {
  width: 36px;
  height: 36px;
  background: var(--royal-yellow);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--charcoal);
  text-decoration: none;
  font-weight: bold;
  transition: background 0.1s;
}

.social-link:hover {
  background: var(--white);
}

.footer-title {
  font-size: 16px;
  font-weight: bold;
  text-transform: uppercase;
  color: var(--royal-yellow);
  padding-bottom: 12px;
  border-bottom: 2px solid #444;
  margin-bottom: 4px;
}

.footer-links {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.footer-links li a {
  color: var(--white);
  text-decoration: none;
  font-size: 14px;
  text-transform: uppercase;
  font-weight: bold;
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 4px 0;
}

.footer-links li a i {
  font-size: 10px;
  color: var(--royal-yellow);
}

.footer-links li a:hover {
  color: var(--royal-yellow);
}

.contact-info {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.contact-info li {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  font-size: 14px;
  color: #ccc;
}

.contact-info li i {
  color: var(--royal-yellow);
  font-size: 14px;
  flex-shrink: 0;
  margin-top: 2px;
}

.contact-info li a {
  color: var(--white);
  text-decoration: none;
  font-weight: bold;
}

.contact-info li a:hover {
  color: var(--royal-yellow);
}

.contact-group {
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.newsletter-desc {
  font-size: 14px;
  line-height: 1.5;
  color: #ccc;
}

.newsletter-form {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.input-wrapper {
  position: relative;
  display: flex;
}

.input-wrapper input {
  flex: 1;
  padding: 12px 50px 12px 14px;
  border: 2px solid var(--royal-yellow);
  background: var(--white);
  color: var(--charcoal);
  font-size: 14px;
}

.input-wrapper input::placeholder {
  color: #888;
}

.input-wrapper input:focus {
  outline: none;
  border-color: var(--white);
}

.input-wrapper button {
  position: absolute;
  right: 4px;
  top: 50%;
  transform: translateY(-50%);
  width: 36px;
  height: 36px;
  background: var(--royal-yellow);
  border: none;
  color: var(--charcoal);
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
}

.input-wrapper button:hover:not(:disabled) {
  background: var(--white);
}

.input-wrapper button:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.newsletter-message {
  font-size: 13px;
  padding: 8px 12px;
}

.newsletter-message.success {
  background: #10b981;
  color: white;
}

.newsletter-message.error {
  background: #ef4444;
  color: white;
}

.footer-bottom {
  padding: 20px 0;
  background: #1a1a1a;
}

.footer-bottom-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  flex-wrap: wrap;
}

.copyright {
  font-size: 13px;
  color: #888;
}

.made-with-love {
  font-size: 12px;
  color: #666;
  display: flex;
  align-items: center;
  gap: 4px;
}

.made-with-love i {
  color: #e11d48;
  font-size: 10px;
}

.made-with-love a {
  color: #888;
  text-decoration: none;
  transition: color 0.2s;
}

.made-with-love a:hover {
  color: var(--royal-yellow);
}

.footer-menu {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
}

.footer-menu li a {
  color: var(--white);
  text-decoration: none;
  font-size: 13px;
  font-weight: bold;
  text-transform: uppercase;
}

.footer-menu li a:hover {
  color: var(--royal-yellow);
}

@media (max-width: 1024px) {
  .footer-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
  }
  
  .container {
    padding: 0 24px;
  }
}

@media (max-width: 768px) {
  .footer-main {
    padding: 40px 0;
  }

  .footer-grid {
    grid-template-columns: 1fr;
    gap: 30px;
  }

  .footer-bottom-content {
    flex-direction: column;
    text-align: center;
    gap: 12px;
  }

  .footer-menu {
    justify-content: center;
    gap: 16px;
  }

  .copyright {
    font-size: 12px;
  }

  .made-with-love {
    font-size: 11px;
  }
}

@media (max-width: 480px) {
  .footer-main {
    padding: 30px 0;
  }

  .container {
    padding: 0 16px;
  }

  .footer-grid {
    gap: 24px;
  }

  .footer-title {
    font-size: 14px;
  }

  .footer-description,
  .newsletter-desc {
    font-size: 13px;
  }

  .footer-links li a,
  .contact-info li {
    font-size: 13px;
  }

  .social-links {
    gap: 6px;
  }

  .social-link {
    width: 32px;
    height: 32px;
  }

  .footer-menu {
    gap: 12px;
  }

  .footer-menu li a {
    font-size: 11px;
  }
}
</style>

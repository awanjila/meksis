<template>
  <section id="contact" class="contact-section">
    <div class="container">
      <div class="contact-content">
        <!-- Left Side: Contact Info -->
        <div class="contact-left">
          <div class="contact-header">
            <div class="section-label">CONTACT US</div>
            <h2 class="section-title">
              GET A <span class="highlight">QUOTE</span>
            </h2>
            <p class="section-description">
              Ready to start your project? Fill out the form and we'll get back to you within 24 hours.
            </p>
          </div>

          <div class="contact-info-list">
            <div class="contact-info-item">
              <div class="info-icon-wrapper">
                <i class="fas fa-phone-alt info-icon"></i>
              </div>
              <div class="info-content">
                <h4 class="info-title">PHONE</h4>
                <a href="tel:+254735551515" class="info-link">+254 735 551515</a>
              </div>
            </div>
            <div class="contact-info-item">
              <div class="info-icon-wrapper">
                <i class="fas fa-envelope info-icon"></i>
              </div>
              <div class="info-content">
                <h4 class="info-title">EMAIL</h4>
                <a href="mailto:info@meksis.co.ke" class="info-link">info@meksis.co.ke</a>
              </div>
            </div>
            <div class="contact-info-item">
              <div class="info-icon-wrapper">
                <i class="fas fa-map-marker-alt info-icon"></i>
              </div>
              <div class="info-content">
                <h4 class="info-title">LOCATION</h4>
                <p class="info-text">Industrial Area</p>
                <p class="info-text">Nairobi, Kenya</p>
              </div>
            </div>
            <div class="contact-info-item">
              <div class="info-icon-wrapper">
                <i class="fas fa-clock info-icon"></i>
              </div>
              <div class="info-content">
                <h4 class="info-title">WORKING HOURS</h4>
                <p class="info-text">Mon - Fri: 08:00 - 17:00</p>
                <p class="info-text">Sat: 09:00 - 13:00</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Side: Contact Form -->
        <div class="contact-right">
          <!-- Success Message -->
          <div v-if="successMessage" class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ successMessage }}
          </div>

          <!-- Error Message -->
          <div v-if="errorMessage" class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            {{ errorMessage }}
          </div>

          <form @submit.prevent="submitForm" class="contact-form">
            <div class="form-group">
              <label class="form-label">YOUR NAME *</label>
              <input
                v-model="formData.name"
                type="text"
                placeholder="Enter your name"
                class="form-input"
                :disabled="isSubmitting"
                required
              />
            </div>
            <div class="form-group">
              <label class="form-label">COMPANY / ORGANIZATION</label>
              <input
                v-model="formData.company"
                type="text"
                placeholder="Your company name"
                class="form-input"
                :disabled="isSubmitting"
              />
            </div>
            <div class="form-row">
              <div class="form-group">
                <label class="form-label">EMAIL ADDRESS *</label>
                <input
                  v-model="formData.email"
                  type="email"
                  placeholder="your@email.com"
                  class="form-input"
                  :disabled="isSubmitting"
                  required
                />
              </div>
              <div class="form-group">
                <label class="form-label">PHONE NUMBER *</label>
                <input
                  v-model="formData.phone"
                  type="tel"
                  placeholder="+254 735 551515"
                  class="form-input"
                  :disabled="isSubmitting"
                  required
                />
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">PRODUCT INTERESTED IN</label>
              <select
                v-model="formData.service"
                class="form-input"
                :disabled="isSubmitting"
              >
                <option value="">Select a product...</option>
                <option value="Elevated Pressed Steel Tanks">Elevated Pressed Steel Tanks</option>
                <option value="Galvanized Steel Tanks">Galvanized Steel Tanks</option>
                <option value="GRP Water Tanks">GRP Water Tanks</option>
                <option value="Ground Level Tanks">Ground Level Tanks</option>
                <option value="Rooftop Tanks">Rooftop Tanks</option>
                <option value="Steel Fabrication">Steel Fabrication</option>
                <option value="Other">Other</option>
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">TELL US ABOUT YOUR REQUIREMENTS *</label>
              <textarea
                v-model="formData.message"
                placeholder="Describe your water storage requirements, capacity needed, and any specific specifications..."
                class="form-textarea"
                :disabled="isSubmitting"
                required
              ></textarea>
            </div>
            
            <button type="submit" class="form-submit" :disabled="isSubmitting">
              <span v-if="!isSubmitting" class="button-text">SEND MESSAGE</span>
              <span v-else class="button-text">SENDING...</span>
              <i v-if="!isSubmitting" class="fas fa-arrow-right"></i>
              <i v-else class="fas fa-spinner fa-spin"></i>
            </button>
            <p class="form-note">
              <i class="fas fa-lock"></i>
              Your information is secure and will never be shared.
            </p>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const formData = ref({
  name: '',
  company: '',
  email: '',
  phone: '',
  service: '',
  message: ''
})

const isSubmitting = ref(false)
const successMessage = ref('')
const errorMessage = ref('')

const submitForm = async () => {
  isSubmitting.value = true
  successMessage.value = ''
  errorMessage.value = ''

  try {
    const response = await axios.post('/api/contact', formData.value)
    
    if (response.data.success) {
      successMessage.value = 'Thank you for contacting Meksis Engineering! We have received your message and will get back to you within 24 hours.'
      
      formData.value = {
        name: '',
        company: '',
        email: '',
        phone: '',
        service: '',
        message: ''
      }

      setTimeout(() => {
        successMessage.value = ''
      }, 10000)
    }
  } catch (error) {
    if (error.response && error.response.data && error.response.data.errors) {
      const errors = Object.values(error.response.data.errors).flat()
      errorMessage.value = errors.join(' ')
    } else if (error.response && error.response.data && error.response.data.message) {
      errorMessage.value = error.response.data.message
    } else {
      errorMessage.value = 'An error occurred. Please try again or contact us directly.'
    }

    setTimeout(() => {
      errorMessage.value = ''
    }, 8000)
  } finally {
    isSubmitting.value = false
  }
}
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

/* ===== CONTACT SECTION ===== */
.contact-section {
  padding: 60px 24px;
  background: var(--charcoal);
  font-family: 'Arial Narrow', sans-serif;
}

.contact-content {
  display: grid;
  grid-template-columns: 1fr 1.2fr;
  gap: 50px;
  align-items: start;
}

/* ===== LEFT SIDE - CONTACT INFO ===== */
.contact-left {
  display: flex;
  flex-direction: column;
  gap: 30px;
}

.contact-header {
  display: flex;
  flex-direction: column;
  gap: 12px;
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
}

.section-title .highlight {
  color: var(--royal-yellow);
  display: block;
}

.section-description {
  font-size: 1rem;
  color: #999;
  line-height: 1.6;
}

/* ===== CONTACT INFO LIST ===== */
.contact-info-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.contact-info-item {
  display: flex;
  align-items: flex-start;
  gap: 16px;
  padding: 16px;
  background: var(--white);
  transition: background 0.1s;
}

.contact-info-item:hover {
  background: var(--royal-yellow);
}

.info-icon-wrapper {
  width: 44px;
  height: 44px;
  background: var(--charcoal);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.contact-info-item:hover .info-icon-wrapper {
  background: var(--white);
}

.info-icon {
  font-size: 1.2rem;
  color: var(--royal-yellow);
}

.contact-info-item:hover .info-icon {
  color: var(--charcoal);
}

.info-content {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 2px;
}

.info-title {
  font-size: 0.75rem;
  font-weight: 700;
  color: var(--charcoal);
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: 2px;
}

.info-text {
  font-size: 0.9rem;
  color: #555;
  margin: 0;
}

.info-link {
  font-size: 0.95rem;
  color: var(--charcoal);
  text-decoration: none;
  font-weight: 700;
}

.info-link:hover {
  text-decoration: underline;
}

/* ===== RIGHT SIDE - CONTACT FORM ===== */
.contact-right {
  background: var(--white);
  padding: 32px;
}

.contact-form {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.form-group {
  margin-bottom: 0;
}

.form-label {
  display: block;
  font-size: 0.75rem;
  font-weight: 700;
  color: var(--charcoal);
  margin-bottom: 6px;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
}

.form-input,
select.form-input {
  width: 100%;
  padding: 12px 16px;
  border: 2px solid #ddd;
  font-size: 0.95rem;
  color: var(--charcoal);
  background: var(--white);
  transition: border-color 0.1s;
}

.form-input:focus,
select.form-input:focus {
  outline: none;
  border-color: var(--royal-yellow);
}

.form-textarea {
  width: 100%;
  padding: 12px 16px;
  border: 2px solid #ddd;
  font-size: 0.95rem;
  color: var(--charcoal);
  background: var(--white);
  transition: border-color 0.1s;
  resize: vertical;
  min-height: 120px;
  line-height: 1.5;
}

.form-textarea:focus {
  outline: none;
  border-color: var(--royal-yellow);
}

.form-submit {
  width: 100%;
  padding: 16px 32px;
  background: var(--royal-yellow);
  color: var(--charcoal);
  border: 2px solid var(--royal-yellow);
  font-size: 0.95rem;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.1s;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  text-transform: uppercase;
}

.form-submit:hover:not(:disabled) {
  background: var(--charcoal);
  color: var(--royal-yellow);
  border-color: var(--charcoal);
}

.form-submit:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

.form-note {
  margin-top: 12px;
  font-size: 0.8rem;
  color: #888;
  text-align: center;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
}

.form-note i {
  color: var(--royal-yellow);
}

/* ===== ALERT MESSAGES ===== */
.alert {
  padding: 14px 18px;
  margin-bottom: 16px;
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 0.9rem;
  font-weight: 600;
}

.alert-success {
  background: #10b981;
  color: var(--white);
}

.alert-error {
  background: #ef4444;
  color: var(--white);
}

/* ===== RESPONSIVE DESIGN ===== */
@media (max-width: 1024px) {
  .contact-content {
    grid-template-columns: 1fr;
    gap: 40px;
  }

  .section-title {
    font-size: 1.75rem;
  }
}

@media (max-width: 768px) {
  .contact-section {
    padding: 40px 20px;
  }

  .container {
    padding: 0 20px;
  }

  .section-title {
    font-size: 1.5rem;
  }

  .contact-right {
    padding: 24px 20px;
  }

  .form-row {
    grid-template-columns: 1fr;
    gap: 0;
  }

  .form-input,
  .form-textarea {
    padding: 12px 14px;
    font-size: 0.9rem;
  }
}
</style>

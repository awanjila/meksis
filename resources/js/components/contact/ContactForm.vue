<template>
  <div class="contact-widget">
    <div class="section-header">
      <div class="icon-wrapper">
        <i class="fas fa-envelope"></i>
      </div>
      <span class="sub-text">Get In Touch</span>
      <h2 class="title">Fill The Form Below</h2>
      <p class="description">Have questions? We're here to help. Send us a message and we'll respond as soon as possible.</p>
    </div>

    <div class="form-messages">
      <div v-if="successMessage" class="alert success">
        <i class="fas fa-check-circle"></i>
        {{ successMessage }}
      </div>
      <div v-if="errorMessage" class="alert error">
        <i class="fas fa-exclamation-circle"></i>
        {{ errorMessage }}
      </div>
    </div>

    <form @submit.prevent="handleSubmit" class="contact-form">
      <fieldset>
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">
              <i class="fas fa-user"></i>
              Full Name
            </label>
            <input
              v-model="form.name"
              class="form-input"
              :class="{ 'has-error': errors.name }"
              type="text"
              placeholder="Enter your name"
              required
            >
            <span v-if="errors.name" class="error-message">
              <i class="fas fa-exclamation-triangle"></i>
              {{ errors.name[0] }}
            </span>
          </div>

          <div class="form-group">
            <label class="form-label">
              <i class="fas fa-envelope"></i>
              Email Address
            </label>
            <input
              v-model="form.email"
              class="form-input"
              :class="{ 'has-error': errors.email }"
              type="email"
              placeholder="your.email@example.com"
              required
            >
            <span v-if="errors.email" class="error-message">
              <i class="fas fa-exclamation-triangle"></i>
              {{ errors.email[0] }}
            </span>
          </div>

          <div class="form-group">
            <label class="form-label">
              <i class="fas fa-phone"></i>
              Phone Number
            </label>
            <input
              v-model="form.phone"
              class="form-input"
              :class="{ 'has-error': errors.phone }"
              type="text"
              placeholder="+254 (0)722 850008"
              required
            >
            <span v-if="errors.phone" class="error-message">
              <i class="fas fa-exclamation-triangle"></i>
              {{ errors.phone[0] }}
            </span>
          </div>

          <div class="form-group">
            <label class="form-label">
              <i class="fas fa-tag"></i>
              Subject
            </label>
            <input
              v-model="form.subject"
              class="form-input"
              :class="{ 'has-error': errors.subject }"
              type="text"
              placeholder="How can we help you?"
              required
            >
            <span v-if="errors.subject" class="error-message">
              <i class="fas fa-exclamation-triangle"></i>
              {{ errors.subject[0] }}
            </span>
          </div>

          <div class="form-group full-width">
            <label class="form-label">
              <i class="fas fa-comment-dots"></i>
              Your Message
            </label>
            <textarea
              v-model="form.message"
              class="form-input"
              :class="{ 'has-error': errors.message }"
              placeholder="Tell us more about your inquiry..."
              rows="5"
              required
            ></textarea>
            <span v-if="errors.message" class="error-message">
              <i class="fas fa-exclamation-triangle"></i>
              {{ errors.message[0] }}
            </span>
          </div>

          <div class="form-group full-width">
            <vue-recaptcha
              ref="recaptcha"
              :sitekey="recaptchaSiteKey"
              @verify="onRecaptchaVerified"
              @expired="onRecaptchaExpired"
              @error="onRecaptchaError"
            />
            <span v-if="errors['g-recaptcha-response']" class="error-message">
              <i class="fas fa-exclamation-triangle"></i>
              {{ errors['g-recaptcha-response'][0] }}
            </span>
          </div>
        </div>

        <div class="submit-wrapper">
          <button
            type="submit"
            class="submit-button"
            :disabled="loading"
          >
            <span v-if="loading">
              <i class="fas fa-spinner fa-spin"></i>
              Sending...
            </span>
            <span v-else>
              Submit Now
              <i class="fas fa-paper-plane"></i>
            </span>
          </button>
        </div>
      </fieldset>
    </form>

    <!-- Contact Information -->
    <div class="contact-info-cards">
      <div class="info-card">
        <div class="info-icon">
          <i class="fas fa-phone-alt"></i>
        </div>
        <h4>Call Us</h4>
        <a href="tel:+254722850008">+254 (0)722 850008</a>
        <a href="tel:+254734850008">+254 (0)734 850008</a>
      </div>

      <div class="info-card">
        <div class="info-icon">
          <i class="fas fa-envelope"></i>
        </div>
        <h4>Email Us</h4>
        <a href="mailto:info@meksis.co.ke">info@meksis.co.ke</a>
        <a href="mailto:sales@meksis.co.ke">sales@meksis.co.ke</a>
      </div>

      <div class="info-card">
        <div class="info-icon">
          <i class="fas fa-map-marker-alt"></i>
        </div>
        <h4>Visit Us</h4>
        <p>3rd Parklands Ave,<br>Nairobi, Kenya</p>
      </div>
    </div>
  </div>
</template>

<script>
import { VueRecaptcha } from 'vue-recaptcha'
import axios from 'axios'

export default {
  name: 'ContactForm',
  components: {
    VueRecaptcha
  },
  data() {
    return {
      form: {
        name: '',
        email: '',
        phone: '',
        subject: '',
        message: '',
        'g-recaptcha-response': ''
      },
      loading: false,
      errors: {},
      successMessage: '',
      errorMessage: '',
      recaptchaSiteKey: import.meta.env.VITE_RECAPTCHA_SITE_KEY
    }
  },
  mounted() {
    if (!this.recaptchaSiteKey) {
      console.error('reCAPTCHA site key is not configured')
    }
  },
  methods: {
    async handleSubmit() {
      if (!this.form['g-recaptcha-response']) {
        this.errorMessage = 'Please complete the reCAPTCHA verification'
        return
      }

      this.loading = true
      this.errors = {}
      this.successMessage = ''
      this.errorMessage = ''

      try {
        const response = await axios.post('/contact', this.form)
        this.successMessage = 'Thank you! Your message has been sent successfully. We\'ll get back to you soon.'
        this.resetForm()
        
        // Scroll to success message
        setTimeout(() => {
          this.$el.querySelector('.form-messages').scrollIntoView({ behavior: 'smooth', block: 'nearest' })
        }, 100)
      } catch (error) {
        if (error.response?.data?.errors) {
          this.errors = error.response.data.errors
        } else {
          this.errorMessage = 'An error occurred while sending your message. Please try again or contact us directly.'
        }
      } finally {
        this.loading = false
        this.$refs.recaptcha.reset()
      }
    },
    onRecaptchaVerified(response) {
      this.form['g-recaptcha-response'] = response
      this.errors['g-recaptcha-response'] = null
    },
    onRecaptchaExpired() {
      this.form['g-recaptcha-response'] = ''
    },
    onRecaptchaError() {
      this.errorMessage = 'reCAPTCHA error occurred. Please refresh the page and try again.'
    },
    resetForm() {
      this.form = {
        name: '',
        email: '',
        phone: '',
        subject: '',
        message: '',
        'g-recaptcha-response': ''
      }
    }
  }
}
</script>

<style scoped>
/* ===== DESIGN SYSTEM ===== */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.contact-widget {
  font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
  max-width: 900px;
  margin: 0 auto;
  padding: 40px 24px;
}

/* ===== SECTION HEADER ===== */
.section-header {
  text-align: center;
  margin-bottom: 48px;
}

.icon-wrapper {
  width: 60px;
  height: 60px;
  background: linear-gradient(135deg, #01aeef 0%, #02375f 100%);
  border-radius: 12px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 16px;
}

.icon-wrapper i {
  font-size: 1.75rem;
  color: white;
}

.sub-text {
  display: block;
  color: #01aeef;
  font-size: 0.95rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: 12px;
}

.title {
  font-size: 2.5rem;
  font-weight: 800;
  color: #02375f;
  margin-bottom: 12px;
  line-height: 1.2;
}

.description {
  font-size: 1rem;
  color: #64748b;
  max-width: 600px;
  margin: 0 auto;
  line-height: 1.6;
}

/* ===== FORM MESSAGES ===== */
.form-messages {
  margin-bottom: 32px;
}

.alert {
  padding: 16px 20px;
  border-radius: 12px;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  gap: 12px;
  font-size: 0.95rem;
  font-weight: 500;
  animation: slideDown 0.3s ease;
}

.alert i {
  font-size: 1.25rem;
  flex-shrink: 0;
}

.alert.success {
  background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
  color: #065f46;
  border: 1px solid #6ee7b7;
}

.alert.error {
  background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
  color: #991b1b;
  border: 1px solid #fca5a5;
}

@keyframes slideDown {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* ===== FORM STYLES ===== */
.contact-form {
  background: white;
  padding: 40px;
  border-radius: 16px;
  box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
  border: 1px solid rgba(1, 174, 239, 0.1);
}

fieldset {
  border: none;
  padding: 0;
  margin: 0;
}

.form-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 24px;
}

.form-group {
  position: relative;
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.form-group.full-width {
  grid-column: span 2;
}

.form-label {
  display: flex;
  align-items: center;
  gap: 8px;
  color: #02375f;
  font-size: 0.9rem;
  font-weight: 600;
}

.form-label i {
  color: #01aeef;
  font-size: 0.875rem;
}

.form-input {
  width: 100%;
  padding: 14px 16px;
  border: 2px solid #e2e8f0;
  border-radius: 8px;
  font-size: 0.95rem;
  font-family: 'Segoe UI', system-ui, sans-serif;
  transition: all 0.3s ease;
  background: #f8fafc;
  color: #1e293b;
}

.form-input::placeholder {
  color: #94a3b8;
}

.form-input:focus {
  outline: none;
  border-color: #01aeef;
  background: white;
  box-shadow: 0 0 0 3px rgba(1, 174, 239, 0.1);
}

.form-input.has-error {
  border-color: #ef4444;
  background: #fef2f2;
}

.form-input.has-error:focus {
  box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

textarea.form-input {
  min-height: 140px;
  resize: vertical;
  line-height: 1.6;
}

.error-message {
  color: #ef4444;
  font-size: 0.85rem;
  display: flex;
  align-items: center;
  gap: 6px;
  margin-top: 4px;
  font-weight: 500;
}

.error-message i {
  font-size: 0.75rem;
}

/* ===== SUBMIT BUTTON ===== */
.submit-wrapper {
  text-align: center;
  margin-top: 32px;
}

.submit-button {
  background: linear-gradient(135deg, #01aeef 0%, #0284c7 100%);
  color: white;
  padding: 16px 48px;
  border: none;
  border-radius: 8px;
  font-size: 1.05rem;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 4px 16px rgba(1, 174, 239, 0.3);
  display: inline-flex;
  align-items: center;
  gap: 10px;
  font-family: 'Segoe UI', system-ui, sans-serif;
}

.submit-button:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(1, 174, 239, 0.4);
}

.submit-button:active:not(:disabled) {
  transform: translateY(0);
}

.submit-button:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

.submit-button i {
  font-size: 1rem;
}

/* ===== CONTACT INFO CARDS ===== */
.contact-info-cards {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
  margin-top: 48px;
}

.info-card {
  background: white;
  padding: 32px 24px;
  border-radius: 16px;
  text-align: center;
  box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
  border: 1px solid rgba(1, 174, 239, 0.1);
  transition: all 0.3s ease;
}

.info-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 32px rgba(1, 174, 239, 0.15);
}

.info-icon {
  width: 56px;
  height: 56px;
  background: linear-gradient(135deg, #01aeef 0%, #0284c7 100%);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 16px;
}

.info-icon i {
  font-size: 1.5rem;
  color: white;
}

.info-card h4 {
  font-size: 1.1rem;
  font-weight: 700;
  color: #02375f;
  margin-bottom: 12px;
}

.info-card a {
  display: block;
  color: #01aeef;
  text-decoration: none;
  font-size: 0.95rem;
  font-weight: 600;
  margin-bottom: 6px;
  transition: color 0.3s ease;
}

.info-card a:hover {
  color: #0284c7;
}

.info-card p {
  color: #64748b;
  font-size: 0.95rem;
  line-height: 1.6;
  margin: 0;
}

/* ===== RESPONSIVE DESIGN ===== */
@media (max-width: 768px) {
  .contact-widget {
    padding: 32px 16px;
  }

  .title {
    font-size: 2rem;
  }

  .description {
    font-size: 0.95rem;
  }

  .contact-form {
    padding: 32px 24px;
  }

  .form-grid {
    grid-template-columns: 1fr;
  }

  .form-group.full-width {
    grid-column: auto;
  }

  .contact-info-cards {
    grid-template-columns: 1fr;
    gap: 20px;
  }

  .submit-button {
    padding: 14px 36px;
    font-size: 1rem;
  }
}

@media (max-width: 480px) {
  .icon-wrapper {
    width: 50px;
    height: 50px;
  }

  .icon-wrapper i {
    font-size: 1.5rem;
  }

  .title {
    font-size: 1.75rem;
  }

  .contact-form {
    padding: 24px 20px;
  }

  .form-input {
    padding: 12px 14px;
    font-size: 0.9rem;
  }

  .submit-button {
    width: 100%;
    padding: 14px 24px;
  }

  .info-card {
    padding: 24px 20px;
  }
}
</style>
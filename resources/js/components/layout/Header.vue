<template>
  <header class="site-header" ref="headerRef">
    <div class="header-top">
      <div class="container">
        <div class="top-content">
          <!-- Contact Info -->
          <div class="contact-info">
            <a href="tel:+254735551515" class="contact-link">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
              </svg>
              <span>+254 735 551515</span>
            </a>
            <a href="mailto:info@meksis.co.ke" class="contact-link">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect width="20" height="16" x="2" y="4"/>
                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
              </svg>
              <span>INFO@MEKSIS.CO.KE</span>
            </a>
            <span class="location">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                <circle cx="12" cy="10" r="3"/>
              </svg>
              <span>INDUSTRIAL AREA, NAIROBI</span>
            </span>
          </div>
          
          <!-- CTA Buttons -->
          <div class="top-cta">
            <a :href="whatsappLink" target="_blank" rel="noopener noreferrer" class="btn-whatsapp">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
              </svg>
              <span>WHATSAPP</span>
            </a>
            <a href="/contact" class="btn-get-started">
              GET STARTED
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="5" y1="12" x2="19" y2="12"/>
                <polyline points="12 5 19 12 12 19"/>
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="header-main">
      <div class="container">
        <div class="header-content">
          <!-- Logo -->
          <div class="logo-part">
            <a href="/"><img src="/front_assets/images/logo-dark.png" alt="Meksis Engineering"></a>
          </div>

          <!-- Desktop Navigation -->
          <nav class="desktop-nav">
            <a href="/" class="nav-link">HOME</a>
            <a href="/about" class="nav-link">ABOUT US</a>
            <a href="/store" class="nav-link">SHOP</a>

            <!-- Products Dropdown -->
            <div class="products-dropdown">
              <button class="nav-link dropdown-toggle" @click="toggleProductsDropdown">
                PRODUCTS
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" :class="{ rotate: showProductsDropdown }">
                  <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
              </button>
              <div class="products-dropdown-menu" :class="{ show: showProductsDropdown }">
                <a
                  v-for="service in services"
                  :key="service.id"
                  :href="`/show/product/${service.slug}`"
                  class="service-item"
                  @mouseenter="showProductsDropdown = true"
                >
                  <span class="service-name">{{ service.name }}</span>
                </a>
              </div>
            </div>

            <a href="/blogs" class="nav-link">BLOG</a>
            <a href="/faqs" class="nav-link">FAQS</a>
            <a href="/contact" class="nav-link">CONTACT</a>
          </nav>

          <cart-link></cart-link>

          <!-- Mobile Menu Toggle -->
          <button class="mobile-menu-toggle" @click="mobileMenuOpen = !mobileMenuOpen" aria-label="Toggle menu">
            <svg v-if="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="3" y1="6" x2="21" y2="6"/>
              <line x1="3" y1="12" x2="21" y2="12"/>
              <line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
            <svg v-else xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M18 6 6 18"/>
              <path d="m6 6 12 12"/>
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Navigation -->
    <transition name="slide">
      <div v-show="mobileMenuOpen" class="mobile-nav">
        <div class="mobile-nav-content">
          <a href="/" class="mobile-nav-link">HOME</a>
          <a href="/about" class="mobile-nav-link">ABOUT US</a>
          
          <!-- Mobile Products Dropdown -->
          <div class="mobile-dropdown">
            <button class="mobile-dropdown-toggle" @click="mobileProductsOpen = !mobileProductsOpen">
              PRODUCTS
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" :class="{ rotate: mobileProductsOpen }">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </button>
            <transition name="expand">
              <div v-show="mobileProductsOpen" class="mobile-dropdown-content">
                <a
                  v-for="service in services"
                  :key="service.id"
                  :href="`/show/product/${service.slug}`"
                  class="mobile-dropdown-link"
                  @click="mobileMenuOpen = false; mobileProductsOpen = false"
                >
                  {{ service.name }}
                </a>
              </div>
            </transition>
          </div>

          <a href="/blogs" class="mobile-nav-link">BLOG</a>
          <a href="/faqs" class="mobile-nav-link">FAQS</a>
          <a href="/contact" class="mobile-nav-link">CONTACT</a>
          <a href="/store" class="mobile-nav-link">SHOP</a>
          <a href="/cart" class="mobile-nav-link">CART</a>

          <!-- Mobile CTA Buttons -->
          <div class="mobile-cta-buttons">
            <a :href="whatsappLink" target="_blank" rel="noopener noreferrer" class="btn-whatsapp mobile">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
              </svg>
              WHATSAPP US
            </a>
            <a href="/contact" class="btn-get-started mobile" @click="mobileMenuOpen = false">GET STARTED</a>
          </div>
        </div>
      </div>
    </transition>
  </header>
</template>

<script>
import axios from 'axios'

export default {
  name: 'SiteHeader',
  data() {
    return {
      whatsappNumber: '254735551515',
      mobileMenuOpen: false,
      showResourcesDropdown: false,
      mobileResourcesOpen: false,
      services: [],
      servicesLoading: true,
      showProductsDropdown: false,
      mobileProductsOpen: false
    }
  },
  computed: {
    whatsappLink() {
      return `https://wa.me/${this.whatsappNumber}?text=Hi%20Meksis%2C%20I'm%20interested%20in%20learning%20more%20about%20your%20services`
    }
  },
  watch: {
    mobileMenuOpen(newVal) {
      if (newVal) {
        document.body.style.overflow = 'hidden'
      } else {
        document.body.style.overflow = ''
        this.mobileResourcesOpen = false
        this.mobileProductsOpen = false
      }
    }
  },
  mounted() {
    this.fetchServices()
    // Close dropdown when clicking outside
    this.boundHandleClickOutside = this.handleClickOutside.bind(this)
    document.addEventListener('click', this.boundHandleClickOutside)
    
    // Add hover listeners for desktop dropdowns
    this.$nextTick(() => {
      if (this.$refs.headerRef) {
        const dropdown = this.$refs.headerRef.querySelector('.dropdown')
        const productsDropdown = this.$refs.headerRef.querySelector('.products-dropdown')
        
        if (dropdown) {
          this.boundShowDropdown = this.showDropdown.bind(this)
          this.boundHideDropdown = this.hideDropdown.bind(this)
          dropdown.addEventListener('mouseenter', this.boundShowDropdown)
          dropdown.addEventListener('mouseleave', this.boundHideDropdown)
        }
        
        if (productsDropdown) {
          this.boundShowProducts = () => { 
            this.showProductsDropdown = true
            // Clear any pending hide timeout
            if (this.productsHideTimeout) {
              clearTimeout(this.productsHideTimeout)
              this.productsHideTimeout = null
            }
          }
          this.boundHideProducts = () => { 
            // Add a small delay before hiding to allow navigation
            this.productsHideTimeout = setTimeout(() => {
              this.showProductsDropdown = false
              this.productsHideTimeout = null
            }, 200)
          }
          productsDropdown.addEventListener('mouseenter', this.boundShowProducts)
          productsDropdown.addEventListener('mouseleave', this.boundHideProducts)
        }
      }
    })
  },
  beforeUnmount() {
    document.body.style.overflow = ''
    document.removeEventListener('click', this.boundHandleClickOutside)
    
    if (this.$refs.headerRef) {
      const dropdown = this.$refs.headerRef.querySelector('.dropdown')
      const productsDropdown = this.$refs.headerRef.querySelector('.products-dropdown')
      
      if (dropdown && this.boundShowDropdown && this.boundHideDropdown) {
        dropdown.removeEventListener('mouseenter', this.boundShowDropdown)
        dropdown.removeEventListener('mouseleave', this.boundHideDropdown)
      }
      
      if (productsDropdown && this.boundShowProducts && this.boundHideProducts) {
        productsDropdown.removeEventListener('mouseenter', this.boundShowProducts)
        productsDropdown.removeEventListener('mouseleave', this.boundHideProducts)
      }
      
      // Clear any pending timeout
      if (this.productsHideTimeout) {
        clearTimeout(this.productsHideTimeout)
        this.productsHideTimeout = null
      }
    }
  },
  methods: {
    async fetchServices() {
      try {
        this.servicesLoading = true
        const response = await axios.get('/api/services')
        this.services = response.data
        // Fix image URLs by removing the incorrect path
        this.services = this.services.map(service => {
          if (service.image) {
            service.image = service.image.replace('/wabe_digital_agency/upload/service_image/', '/upload/service_image/')
          }
          return service
        })
      } catch (error) {
        console.error('Error fetching services:', error)
        // Fallback to hardcoded services if API fails
        this.services = [
          {
            id: 1,
            name: 'Elevated Pressed Steel Tanks',
            slug: 'elevated-pressed-steel-tanks'
          },
          {
            id: 2,
            name: 'Galvanized Steel Tanks',
            slug: 'galvanized-steel-tanks'
          },
          {
            id: 3,
            name: 'GRP Water Tanks',
            slug: 'grp-water-tanks'
          },
          {
            id: 4,
            name: 'Ground Level Tanks',
            slug: 'ground-level-tanks'
          },
          {
            id: 5,
            name: 'Rooftop Tanks',
            slug: 'rooftop-tanks'
          },
          {
            id: 6,
            name: 'Steel Tank Accessories',
            slug: 'steel-tank-accessories'
          },
          {
            id: 7,
            name: 'Tank Installation',
            slug: 'tank-installation'
          },
          {
            id: 8,
            name: 'Tank Maintenance',
            slug: 'tank-maintenance'
          }
        ]
      } finally {
        this.servicesLoading = false
      }
    },
    handleClickOutside(event) {
      if (!this.$refs.headerRef) return
      
      const dropdown = this.$refs.headerRef.querySelector('.dropdown')
      const productsDropdown = this.$refs.headerRef.querySelector('.products-dropdown')
      const productsDropdownMenu = this.$refs.headerRef.querySelector('.products-dropdown-menu')
      const mobileToggle = this.$refs.headerRef.querySelector('.mobile-menu-toggle')
      
      // Check if click is outside dropdown
      if (dropdown && !dropdown.contains(event.target) && (!mobileToggle || !mobileToggle.contains(event.target))) {
        this.showResourcesDropdown = false
      }
      
      // For products dropdown, check both the dropdown container and the menu itself
      if (productsDropdown) {
        const isClickInside = productsDropdown.contains(event.target) || 
                             (productsDropdownMenu && productsDropdownMenu.contains(event.target))
        const isMobileToggle = mobileToggle && mobileToggle.contains(event.target)
        
        if (!isClickInside && !isMobileToggle) {
          this.showProductsDropdown = false
        }
      }
    },
    showDropdown() {
      this.showResourcesDropdown = true
    },
    hideDropdown() {
      this.showResourcesDropdown = false
    },
    toggleProductsDropdown() {
      this.showProductsDropdown = !this.showProductsDropdown
      // Clear any pending hide timeout when toggling
      if (this.productsHideTimeout) {
        clearTimeout(this.productsHideTimeout)
        this.productsHideTimeout = null
      }
    }
  }
}
</script>

<style scoped>
* {
  margin: 0;
  padding: 0;
  border-radius: 0 !important;
  box-sizing: border-box;
}

/* Header */
.site-header {
  background: var(--charcoal);
  color: var(--white);
  position: sticky;
  top: 0;
  z-index: 1000;
  font-family: 'Arial Narrow', sans-serif;
}

.container {
  max-width: 1400px;
  margin: 0 auto;
  padding: 0 40px;
}

/* Header Top - Contact Info + CTA */
.header-top {
  background: var(--charcoal);
  border-bottom: 1px solid rgba(255, 193, 7, 0.2);
  padding: 10px 0;
}

.top-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
}

.contact-info {
  display: flex;
  align-items: center;
  gap: 30px;
  flex-wrap: wrap;
}

.contact-link,
.location {
  display: flex;
  align-items: center;
  gap: 8px;
  color: var(--white);
  text-decoration: none;
  font-size: 13px;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.contact-link svg,
.location svg {
  color: var(--royal-yellow);
  flex-shrink: 0;
}

.contact-link:hover {
  color: var(--royal-yellow);
}

.top-cta {
  display: flex;
  align-items: center;
  gap: 12px;
}

.btn-whatsapp {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 16px;
  background: transparent;
  border: 1px solid var(--royal-yellow);
  color: var(--royal-yellow);
  text-decoration: none;
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: all 0.2s;
}

.btn-whatsapp:hover {
  background: var(--royal-yellow);
  color: var(--charcoal);
}

.btn-get-started {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 20px;
  background: var(--royal-yellow);
  border: 1px solid var(--royal-yellow);
  color: var(--charcoal);
  text-decoration: none;
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
  transition: all 0.2s;
}

.btn-get-started:hover {
  background: transparent;
  color: var(--royal-yellow);
}

/* Header Main - Logo + Nav */
.header-main {
  background: var(--charcoal);
  padding: 12px 0;
}

.header-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 30px;
}

/* Logo */
.logo-part {
  padding: 6px 10px;
  flex-shrink: 0;
}

.logo-part a {
  display: block;
  line-height: 0;
}

.logo-part img {
  height: 45px;
  width: auto;
  display: block;
}

/* Desktop Navigation */
.desktop-nav {
  display: flex;
  align-items: center;
  gap: 8px;
  flex: 1;
  justify-content: center;
}

.nav-link {
  color: var(--white);
  text-decoration: none;
  font-size: 13px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
  padding: 10px 12px;
  position: relative;
  background: none;
  border: none;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 5px;
  transition: color 0.2s;
}

.nav-link:hover {
  color: var(--royal-yellow);
}

/* Cart Link */
.cart-link {
  position: relative;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 8px;
  color: var(--white);
  text-decoration: none;
  transition: color 0.2s;
}

.cart-link:hover {
  color: var(--royal-yellow);
}

/* Products Dropdown */
.products-dropdown {
  position: relative;
}

.products-dropdown-menu {
  position: absolute;
  top: 100%;
  left: 50%;
  transform: translateX(-50%);
  margin-top: 8px;
  background: var(--charcoal);
  min-width: 700px;
  max-width: 900px;
  padding: 0;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 2px;
  border: 2px solid var(--royal-yellow);
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.2s, visibility 0.2s;
  pointer-events: none;
  z-index: 1000;
}

.products-dropdown-menu.show {
  opacity: 1;
  visibility: visible;
  pointer-events: auto;
}

.service-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 30px 15px;
  color: var(--charcoal);
  text-decoration: none;
  font-size: 0.85rem;
  font-weight: 700;
  text-transform: uppercase;
  text-align: center;
  background: var(--white);
  transition: all 0.2s;
}

.service-item:hover {
  background: var(--royal-yellow);
}

.service-name {
  font-weight: 700;
  line-height: 1.4;
  color: inherit;
}

/* Mobile Menu Toggle */
.mobile-menu-toggle {
  display: none;
  background: none;
  border: none;
  color: var(--white);
  cursor: pointer;
  padding: 8px;
}

/* Mobile Navigation */
.mobile-nav {
  background: var(--charcoal);
  border-top: 3px solid var(--royal-yellow);
  max-height: calc(100vh - 70px);
  overflow-y: auto;
}

.mobile-nav-content {
  padding: 20px 24px;
}

.mobile-nav-link {
  display: block;
  padding: 14px 16px;
  color: var(--white);
  text-decoration: none;
  font-size: 14px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: 4px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.mobile-nav-link:hover {
  background: var(--royal-yellow);
  color: var(--charcoal);
}

/* Mobile Dropdown */
.mobile-dropdown {
  margin-bottom: 4px;
}

.mobile-dropdown-toggle {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 14px 16px;
  background: none;
  border: none;
  color: var(--white);
  font-size: 14px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
  cursor: pointer;
  text-align: left;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.mobile-dropdown-toggle:hover {
  background: var(--royal-yellow);
  color: var(--charcoal);
}

.mobile-dropdown-toggle svg {
  transition: transform 0.2s;
}

.mobile-dropdown-toggle svg.rotate {
  transform: rotate(180deg);
}

.mobile-dropdown-content {
  padding-left: 16px;
  margin-top: 4px;
}

.mobile-dropdown-link {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 12px 16px;
  color: var(--white);
  text-decoration: none;
  font-size: 13px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-bottom: 2px;
}

.mobile-dropdown-link:hover {
  background: var(--royal-yellow);
  color: var(--charcoal);
  padding-left: 24px;
}

/* Mobile CTA Buttons */
.mobile-cta-buttons {
  display: flex;
  flex-direction: column;
  gap: 10px;
  margin-top: 24px;
  padding-top: 20px;
  border-top: 1px solid #444;
}

.btn-whatsapp.mobile,
.btn-get-started.mobile {
  width: 100%;
  justify-content: center;
  padding: 14px 20px;
  font-size: 13px;
}

/* Animations */
.slide-enter-active,
.slide-leave-active {
  transition: all 0.3s;
}

.slide-enter-from,
.slide-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}

.expand-enter-active,
.expand-leave-active {
  transition: all 0.3s;
  overflow: hidden;
}

.expand-enter-from,
.expand-leave-to {
  max-height: 0;
  opacity: 0;
}

.expand-enter-to,
.expand-leave-from {
  max-height: 300px;
  opacity: 1;
}

/* Responsive */
@media (max-width: 1200px) {
  .container {
    padding: 0 30px;
  }
  
  .products-dropdown-menu {
    min-width: 600px;
    max-width: 700px;
    grid-template-columns: repeat(2, 1fr);
  }
  
  .contact-info {
    gap: 20px;
  }
}

@media (max-width: 992px) {
  .header-top {
    display: none;
  }
  
  .desktop-nav {
    display: none;
  }
  
  .mobile-menu-toggle {
    display: block;
  }
  
  .header-main {
    padding: 10px 0;
  }
  
  .logo-part img {
    height: 40px;
  }
  
  .site-header {
    border-bottom: 3px solid var(--royal-yellow);
  }
}

@media (max-width: 768px) {
  .container {
    padding: 0 20px;
  }
  
  .mobile-nav-content {
    padding: 16px;
  }
  
  .logo-part img {
    height: 36px;
  }
  
  .mobile-dropdown-link {
    padding: 14px 20px;
    font-size: 12px;
  }
}
</style>
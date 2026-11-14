import { createApp } from 'vue';
import { createPinia } from 'pinia';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core';

// Import Font Awesome icons
import { faFacebook, faTwitter, faInstagram, faWhatsapp } from '@fortawesome/free-brands-svg-icons';
import {
  faCartPlus,
  faCheck,
  faShoppingCart,
  faTimes,
  faTrash,
  // Process Section Icons
  faComments,
  faPencilRuler,
  faLaptopCode,
  faVials,
  faHeadset,
  // Services Section Icons
  faCode,
  faGlobe,
  faVideo,
  faFingerprint,
  faPlug,
  faCashRegister,
  // Why Choose Us Icons
  faRocket,
  faShieldAlt,
  faLightbulb,
  faHandshake,
  faChartLine,
  faClock,
  // Contact Section Icons
  faPhone,
  faEnvelope,
  faMapMarkerAlt
} from '@fortawesome/free-solid-svg-icons';

// Import components
import ShopCategories from '@/components/ShopCategories.vue';
import FaqsSection from '@/components/FaqsSection.vue';
import ContactPage from './pages/Contact.vue';
import OurWorks from './pages/OurWorks.vue';
import AboutUs from './pages/AboutUs.vue';
import Welcome from './pages/Welcome.vue';
import Services from './pages/Services.vue';
import ServiceDetail from './pages/ServiceDetail.vue';
import CategoryPortfolios from './pages/CategoryPortfolios.vue';
import ContactForm from './components/contact/ContactForm.vue';
import ContactInfoCard from './components/contact/ContactInfoCard.vue';
import WhatsAppButton from './components/WhatsAppButton.vue';
import AddToCart from './components/shop/AddToCart.vue';
import CartPage from './components/shop/CartPage.vue';
import CartLink from './components/shop/CartLink.vue';
import CheckoutPage from './components/shop/CheckoutPage.vue';
import ProductCard from './components/shop/ProductCard.vue';
import ShopTrustBar from './components/shop/ShopTrustBar.vue';
import { VueRecaptcha } from 'vue-recaptcha';
import GoogleLoginButton from './components/auth/GoogleLoginButton.vue';
import Header from './components/layout/Header.vue';
import Footer from './components/layout/Footer.vue';
import BlogList from './pages/BlogList.vue';
import BlogDetails from './pages/BlogDetails.vue';
import FaqsPage from './pages/FaqsPage.vue';


// Add the imported icons to the library
library.add(
  faCartPlus,
  faCheck,
  faFacebook,
  faTwitter,
  faInstagram,
  faWhatsapp,
  faShoppingCart,
  faTimes,
  faTrash,
  // Process Section Icons
  faComments,
  faPencilRuler,
  faLaptopCode,
  faVials,
  faHeadset,
  // Services Section Icons
  faCode,
  faGlobe,
  faVideo,
  faFingerprint,
  faPlug,
  faCashRegister,
  // Why Choose Us Icons
  faRocket,
  faShieldAlt,
  faLightbulb,
  faHandshake,
  faChartLine,
  faClock,
  // Contact Section Icons
  faPhone,
  faEnvelope,
  faMapMarkerAlt
);

// Create Pinia store instance
const pinia = createPinia();

// Create a Vue application instance
const app = createApp({});

// Register Font Awesome icon component globally
app.component('font-awesome-icon', FontAwesomeIcon);

// Register components
app.component('shop-categories', ShopCategories);
app.component('faqs-section', FaqsSection);
app.component('contact-page', ContactPage);
app.component('contact-form', ContactForm);
app.component('contact-info-card', ContactInfoCard);
app.component('vue-recaptcha', VueRecaptcha);
app.component('whatsapp-button', WhatsAppButton);
app.component('add-to-cart', AddToCart);
app.component('product-card', ProductCard);
app.component('shop-trust-bar', ShopTrustBar);
app.component('cart-page', CartPage);
app.component('cart-link', CartLink);
app.component('checkout-page', CheckoutPage);
app.component('google-login-button', GoogleLoginButton);
app.component('header-component', Header);
app.component('footer-component', Footer);
app.component('about-us', AboutUs);
app.component('our-works', OurWorks);
app.component('category-portfolios', CategoryPortfolios);
app.component('services-page', Services);
app.component('service-detail', ServiceDetail);
app.component('welcome-page', Welcome);
app.component('blog-list', BlogList);
app.component('blog-details', BlogDetails);
app.component('faqs-page', FaqsPage);

// Use Pinia
app.use(pinia);

// Mount the application instance to the specified element
app.mount('#app');

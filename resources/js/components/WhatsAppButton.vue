<template>
  <div class="whatsapp-button" @click="openWhatsApp">
    <font-awesome-icon :icon="['fab', 'whatsapp']" />
    <span class="tooltip">Chat with us</span>
  </div>
</template>

<script>
import { faWhatsapp } from '@fortawesome/free-brands-svg-icons';
import { library } from '@fortawesome/fontawesome-svg-core';

// Add WhatsApp icon to the library
library.add(faWhatsapp);

export default {
  name: 'WhatsAppButton',
  methods: {
openWhatsApp() {
      const phoneNumber = '254735551515';
      const message = 'Hello! I am interested in your steel water tank services.';
      const url = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
      window.open(url, '_blank');
    }
  }
}
</script>

<style scoped>
.whatsapp-button {
  position: fixed;
  bottom: 20px;
  right: 20px;
  background-color: #25D366;
  color: white;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: 2px 2px 10px rgba(0,0,0,0.3);
  z-index: 1000;
  transition: all 0.3s ease;
}

.whatsapp-button:hover {
  transform: scale(1.1);
  box-shadow: 2px 2px 15px rgba(0,0,0,0.4);
}

.whatsapp-button svg {
  font-size: 30px;
}

.tooltip {
  position: absolute;
  right: 70px;
  background: #333;
  color: white;
  padding: 5px 10px;
  border-radius: 5px;
  font-size: 14px;
  white-space: nowrap;
  opacity: 0;
  visibility: hidden;
  transition: all 0.3s ease;
}

.whatsapp-button:hover .tooltip {
  opacity: 1;
  visibility: visible;
}
</style> 
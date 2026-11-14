<template>
  <div class="checkout-page">
    <div v-if="cartItems.length > 0" class="checkout-content">
      <div v-if="errorMessage" class="checkout-alert">
        <p>{{ errorMessage }}</p>
        <ul v-if="validationErrors.length">
          <li v-for="message in validationErrors" :key="message">{{ message }}</li>
        </ul>
        <a v-if="showCartLink" href="/cart" class="alert-link">Return to your cart</a>
      </div>

      <form @submit.prevent="submit" class="checkout-form">
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label" for="checkout-name">Full Name</label>
            <input id="checkout-name" v-model="form.name" class="form-input" type="text" placeholder="Enter your name" required>
          </div>

          <div class="form-group">
            <label class="form-label" for="checkout-email">Email Address</label>
            <input id="checkout-email" v-model="form.email" class="form-input" type="email" placeholder="your.email@example.com" required>
          </div>

          <div class="form-group">
            <label class="form-label" for="checkout-phone">Phone Number</label>
            <input id="checkout-phone" v-model="form.phone" class="form-input" type="text" placeholder="+254 (0)722 850008" required>
          </div>

          <div class="form-group">
            <label class="form-label" for="checkout-company">Company (optional)</label>
            <input id="checkout-company" v-model="form.company" class="form-input" type="text" placeholder="Company name">
          </div>

          <div class="form-group full-width">
            <label class="form-label" for="checkout-address">Delivery Address</label>
            <textarea id="checkout-address" v-model="form.address" class="form-input form-textarea" placeholder="Street, building, town" rows="3" required></textarea>
          </div>

          <div class="form-group full-width">
            <label class="form-label" for="checkout-notes">Order Notes (optional)</label>
            <textarea id="checkout-notes" v-model="form.notes" class="form-input form-textarea" placeholder="Anything we should know about your order" rows="4"></textarea>
          </div>
        </div>

        <div class="checkout-summary">
          <h3 class="summary-title">Your Order</h3>
          <div v-for="item in cartItems" :key="item.id" class="summary-row">
            <span>{{ item.name }} &times; {{ item.quantity }}</span>
            <span>Ksh {{ item.price * item.quantity }}</span>
          </div>
          <div class="summary-total">
            <span>Total</span>
            <strong>Ksh {{ cartTotal }}</strong>
          </div>
        </div>

        <div class="honeypot" aria-hidden="true">
          <label for="checkout-website">Leave this field empty</label>
          <input id="checkout-website" v-model="form.website" name="website" type="text" tabindex="-1" autocomplete="off" aria-hidden="true">
        </div>

        <div class="submit-wrapper">
          <button type="submit" class="submit-button" :disabled="isSubmitting">
            {{ isSubmitting ? 'Placing Order...' : 'Place Order' }}
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { computed, reactive, ref } from 'vue';
import axios from 'axios';
import { useCartStore } from '../../store/cart';

export default {
  name: 'CheckoutPage',
  setup() {
    const cartStore = useCartStore();

    if (cartStore.cartItems.length === 0) {
      window.location.href = '/cart';
    }

    const form = reactive({
      name: '',
      email: '',
      phone: '',
      company: '',
      address: '',
      notes: '',
      website: ''
    });

    const isSubmitting = ref(false);
    const errorMessage = ref('');
    const validationErrors = ref([]);
    const showCartLink = ref(false);

    const submit = async () => {
      if (isSubmitting.value) {
        return;
      }

      isSubmitting.value = true;
      errorMessage.value = '';
      validationErrors.value = [];
      showCartLink.value = false;

      try {
        const response = await axios.post('/api/orders', {
          ...form,
          items: cartStore.cartItems.map(({ id, quantity }) => ({ id, quantity })),
          website: form.website
        });

        cartStore.clearCart();
        window.location.href = '/order/' + response.data.reference;
      } catch (error) {
        isSubmitting.value = false;

        if (error.response?.status === 422) {
          const errors = error.response.data.errors || {};

          errorMessage.value = error.response.data.message || 'Please check your details and try again.';
          validationErrors.value = Object.values(errors).flat();
          showCartLink.value = Boolean(errors.items);
        } else {
          errorMessage.value = 'We could not place your order. Please try again.';
        }
      }
    };

    return {
      form,
      isSubmitting,
      errorMessage,
      validationErrors,
      showCartLink,
      submit,
      cartItems: computed(() => cartStore.cartItems),
      cartTotal: computed(() => cartStore.cartTotal)
    };
  }
}
</script>

<style scoped>
* {
  border-radius: 0 !important;
  box-sizing: border-box;
}

.checkout-page {
  position: relative;
  color: var(--charcoal);
  font-family: 'Arial Narrow', sans-serif;
  max-width: 900px;
  margin: 0 auto;
}

.checkout-alert {
  border: 1px solid #fca5a5;
  background: #fee2e2;
  color: #991b1b;
  padding: 16px 20px;
  margin-bottom: 30px;
}

.checkout-alert p {
  font-weight: 700;
  margin-bottom: 8px;
}

.checkout-alert ul {
  margin: 0 0 8px 18px;
}

.alert-link {
  color: #991b1b;
  font-weight: 700;
  text-decoration: underline;
}

.checkout-form {
  border: 1px solid #e5e5e5;
  padding: 32px;
}

.form-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 24px;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.form-group.full-width {
  grid-column: span 2;
}

.form-label {
  color: var(--charcoal);
  font-size: 0.9rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.form-input {
  width: 100%;
  padding: 14px 16px;
  border: 1px solid #d4d4d4;
  font-size: 0.95rem;
  font-family: 'Arial Narrow', sans-serif;
  background: #fafafa;
  color: var(--charcoal);
  transition: all 0.2s ease;
}

.form-input:focus {
  outline: none;
  border-color: var(--royal-yellow);
  background: var(--white);
}

.form-textarea {
  resize: vertical;
  line-height: 1.6;
}

.checkout-summary {
  margin-top: 32px;
  border-top: 1px solid #e5e5e5;
  padding-top: 24px;
}

.summary-title {
  font-size: 18px;
  font-weight: 700;
  text-transform: uppercase;
  margin-bottom: 16px;
}

.summary-row,
.summary-total {
  display: flex;
  justify-content: space-between;
  padding: 10px 0;
}

.summary-total {
  border-top: 1px solid #e5e5e5;
  margin-top: 8px;
  font-size: 18px;
  text-transform: uppercase;
}

.honeypot {
  position: absolute;
  left: -10000px;
  width: 1px;
  height: 1px;
  overflow: hidden;
}

.submit-wrapper {
  text-align: right;
  margin-top: 32px;
}

.submit-button {
  padding: 14px 28px;
  background: var(--royal-yellow);
  border: 1px solid var(--royal-yellow);
  color: var(--charcoal);
  font-size: 13px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
  cursor: pointer;
  transition: all 0.2s;
}

.submit-button:hover:not(:disabled) {
  background: transparent;
  color: var(--royal-yellow);
}

.submit-button:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

@media (max-width: 768px) {
  .checkout-form {
    padding: 20px;
  }

  .form-grid {
    grid-template-columns: 1fr;
  }

  .form-group.full-width {
    grid-column: auto;
  }

  .submit-button {
    width: 100%;
  }
}
</style>

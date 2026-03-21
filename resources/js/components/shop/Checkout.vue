<template>
  <div class="checkout-container">
    <div class="checkout-header">
      <h2>Checkout</h2>
      <button class="close-btn" @click="$emit('close')">
        <font-awesome-icon :icon="['fas', 'times']" />
      </button>
    </div>

    <div class="checkout-content">
      <div class="cart-summary">
        <h3>Order Summary</h3>
        <div class="cart-items">
          <div v-for="item in cartItems" :key="item.id" class="cart-item">
            <div class="item-image">
              <img :src="item.image" :alt="item.name">
            </div>
            <div class="item-details">
              <h4>{{ item.name }}</h4>
              <p class="item-price">KES {{ item.price }}</p>
              <p class="item-quantity">Quantity: {{ item.quantity }}</p>
            </div>
          </div>
        </div>
        <div class="cart-total">
          <h3>Total: KES {{ cartTotal }}</h3>
        </div>
      </div>

      <div class="payment-section">
        <h3>Payment Method</h3>
        
        <!-- Payment Status Messages -->
        <div v-if="paymentStatus === 'pending'" class="payment-status pending">
          Processing payment...
        </div>
        <div v-if="paymentStatus === 'success'" class="payment-status success">
          Payment successful! Your order has been placed.
        </div>
        <div v-if="paymentStatus === 'failed' && errorMessage" class="payment-status failed">
          Payment failed. {{ errorMessage }}
        </div>
        
        <div class="payment-methods">
          <div 
            class="payment-method mpesa" 
            :class="{ active: paymentMethod === 'mpesa' }"
            @click="selectPaymentMethod('mpesa')"
          >
            <img src="/images/mpesa-logo.png" alt="M-Pesa" class="payment-logo">
          </div>
          <div 
            class="payment-method paypal" 
            :class="{ active: paymentMethod === 'paypal' }"
            @click="selectPaymentMethod('paypal')"
          >
            <img src="/images/paypal-logo.png" alt="PayPal" class="payment-logo">
          </div>
        </div>

        <!-- M-Pesa Payment Form -->
        <div v-if="paymentMethod === 'mpesa'" class="payment-form">
          <div class="form-group">
            <label for="phone">Phone Number (M-Pesa)</label>
            <input 
              type="tel" 
              id="phone" 
              v-model="phoneNumber" 
              placeholder="e.g. 254712345678"
              required
            >
          </div>
          <button class="pay-btn mpesa-btn" @click="processMpesaPayment" :disabled="!phoneNumber || isProcessing">
            {{ isProcessing ? 'Processing...' : 'Pay with M-Pesa' }}
          </button>
        </div>

        <!-- PayPal Payment Button -->
        <div v-if="paymentMethod === 'paypal'" class="payment-form">
          <div id="paypal-button-container"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, computed, onMounted, watch } from 'vue';
import { useCartStore } from '../../store/cart';
import { faTimes } from '@fortawesome/free-solid-svg-icons';
import { library } from '@fortawesome/fontawesome-svg-core';
import axios from 'axios';

library.add(faTimes);

export default {
  name: 'Checkout',
  emits: ['close'],
  setup(props, { emit }) {
    const cartStore = useCartStore();
    const paymentMethod = ref('mpesa');
    const phoneNumber = ref('');
    const paymentStatus = ref(''); // 'pending', 'success', 'failed'
    const errorMessage = ref('');
    const isProcessing = ref(false);

    const cartItems = computed(() => cartStore.cartItems);
    const cartTotal = computed(() => cartStore.cartTotal);

    // Load PayPal SDK
    const loadPayPalScript = () => {
      return new Promise((resolve, reject) => {
        if (window.paypal) {
          resolve(window.paypal);
          return;
        }

        const script = document.createElement('script');
        const mode = window.paypalMode || 'live';
        script.src = `https://www.paypal.com/sdk/js?client-id=${window.paypalClientId}&currency=USD&intent=capture`;
        script.async = true;
        script.onload = () => resolve(window.paypal);
        script.onerror = () => {
          console.error('Failed to load PayPal SDK');
          paymentStatus.value = 'failed';
          errorMessage.value = 'Failed to load PayPal. Please try again later.';
          reject(new Error('Failed to load PayPal SDK'));
        };
        document.body.appendChild(script);
      });
    };

    const initPayPalButton = async () => {
      try {
        const paypal = await loadPayPalScript();
        console.log('PayPal SDK loaded:', paypal);

        if (!paypal) {
          throw new Error('PayPal SDK not loaded');
        }

        const container = document.getElementById('paypal-button-container');
        if (!container) {
          throw new Error('PayPal button container not found');
        }

        // Clear any existing buttons
        container.innerHTML = '';

        paypal.Buttons({
          style: {
            layout: 'vertical',
            color: 'blue',
            shape: 'rect',
            label: 'pay'
          },
          createOrder: async () => {
            try {
              console.log('Creating PayPal order...');
              const response = await axios.post('/api/paypal/create-order', {
                items: cartItems.value,
                total: cartTotal.value
              });
              console.log('Order created:', response.data);
              return response.data.orderId;
            } catch (error) {
              console.error('Error creating PayPal order:', error);
              paymentStatus.value = 'failed';
              errorMessage.value = 'Failed to create order. Please try again.';
              throw error;
            }
          },
          onApprove: async (data) => {
            try {
              console.log('Payment approved:', data);
              paymentStatus.value = 'pending';
              isProcessing.value = true;
              
              const response = await axios.post('/api/paypal/capture-order', {
                orderId: data.orderID
              });
              
              console.log('Payment captured:', response.data);
              
              if (response.data.success) {
                paymentStatus.value = 'success';
                cartStore.clearCart();
                
                setTimeout(() => {
                  emit('close');
                  window.location.href = '/order/success';
                }, 2000);
              } else {
                throw new Error('Failed to capture payment');
              }
            } catch (error) {
              console.error('Error capturing PayPal payment:', error);
              paymentStatus.value = 'failed';
              errorMessage.value = 'Payment verification failed. Please contact support.';
            } finally {
              isProcessing.value = false;
            }
          },
          onError: (err) => {
            console.error('PayPal error:', err);
            paymentStatus.value = 'failed';
            errorMessage.value = 'There was a problem with PayPal. Please try again.';
          }
        }).render('#paypal-button-container')
          .catch((error) => {
            console.error('Error rendering PayPal button:', error);
            paymentStatus.value = 'failed';
            errorMessage.value = 'Failed to initialize PayPal button. Please try again.';
          });
      } catch (error) {
        console.error('Error initializing PayPal:', error);
        paymentStatus.value = 'failed';
        errorMessage.value = 'Failed to initialize PayPal. Please try again.';
      }
    };

    const selectPaymentMethod = (method) => {
      paymentMethod.value = method;
      paymentStatus.value = ''; // Reset payment status
      errorMessage.value = '';
    };

    const processMpesaPayment = async () => {
      if (!phoneNumber.value) return;
      
      try {
        paymentStatus.value = 'pending';
        isProcessing.value = true;
        
        // Format phone number for display
        const formattedPhone = phoneNumber.value.replace(/\D/g, '');
        
        // Show loading message
        errorMessage.value = 'Initiating M-Pesa payment...';
        
        const response = await axios.post('/api/mpesa/stk-push', {
          phoneNumber: formattedPhone,
          amount: cartTotal.value,
          items: cartItems.value
        });

        if (response.data.success) {
          paymentStatus.value = 'pending';
          errorMessage.value = 'Please check your phone for the M-Pesa prompt and enter your PIN to complete the payment.';
          
          // Start polling for payment status
          startPaymentStatusCheck(response.data.data.CheckoutRequestID);
        } else {
          paymentStatus.value = 'failed';
          errorMessage.value = response.data.message || 'Payment failed. Please try again.';
        }
      } catch (error) {
        console.error('M-Pesa payment failed:', error);
        paymentStatus.value = 'failed';
        errorMessage.value = error.response?.data?.message || 'Network error. Please try again.';
      } finally {
        isProcessing.value = false;
      }
    };

    const startPaymentStatusCheck = (checkoutRequestId) => {
      // In a real implementation, you would poll your backend to check the payment status
      // For now, we'll simulate a successful payment after 30 seconds
      setTimeout(() => {
        paymentStatus.value = 'success';
        errorMessage.value = 'Payment successful! Your order has been placed.';
        cartStore.clearCart();
        
        // Redirect or show success page after 2 seconds
        setTimeout(() => {
          emit('close');
          window.location.href = '/order/success';
        }, 2000);
      }, 30000);
    };

    // Watch for payment method changes to reinitialize PayPal if needed
    watch(paymentMethod, (newMethod) => {
      if (newMethod === 'paypal') {
        console.log('Payment method changed to PayPal, initializing...');
        // Small delay to ensure container is rendered
        setTimeout(() => {
          initPayPalButton();
        }, 100);
      }
    });

    onMounted(() => {
      console.log('Component mounted, payment method:', paymentMethod.value);
      if (paymentMethod.value === 'paypal') {
        initPayPalButton();
      }
    });

    return {
      cartItems,
      cartTotal,
      paymentMethod,
      phoneNumber,
      paymentStatus,
      errorMessage,
      isProcessing,
      selectPaymentMethod,
      processMpesaPayment
    };
  }
}
</script>

<style scoped>
.checkout-container {
  position: fixed;
  top: 0;
  right: 0;
  width: 400px;
  height: 100vh;
  background-color: white;
  box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
  z-index: 1000;
  display: flex;
  flex-direction: column;
  overflow-y: auto;
  font-family: 'Poppins', sans-serif;
}

.checkout-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.5rem;
  border-bottom: 1px solid #eee;
  background-color: #f8f9fa;
}

.checkout-header h2 {
  margin: 0;
  font-size: 1.5rem;
  color: #333;
  font-weight: 600;
}

.close-btn {
  background: none;
  border: none;
  font-size: 1.2rem;
  cursor: pointer;
  color: #666;
  transition: color 0.3s ease;
}

.close-btn:hover {
  color: #333;
}

.checkout-content {
  padding: 1.5rem;
  flex: 1;
}

.cart-summary {
  margin-bottom: 2rem;
  background-color: #f8f9fa;
  border-radius: 8px;
  padding: 1.5rem;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.cart-summary h3 {
  margin-top: 0;
  margin-bottom: 1rem;
  color: #333;
  font-weight: 600;
  font-size: 1.2rem;
}

.cart-items {
  margin: 1rem 0;
}

.cart-item {
  display: flex;
  margin-bottom: 1.5rem;
  padding-bottom: 1.5rem;
  border-bottom: 1px solid #eee;
}

.cart-item:last-child {
  margin-bottom: 0;
  padding-bottom: 0;
  border-bottom: none;
}

.item-image {
  width: 80px;
  height: 80px;
  margin-right: 1rem;
  overflow: hidden;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.item-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.item-details {
  flex: 1;
}

.item-details h4 {
  margin: 0 0 0.5rem 0;
  font-size: 1rem;
  font-weight: 600;
  color: #333;
}

.item-price {
  color: #25D366;
  font-weight: bold;
  margin: 0.25rem 0;
}

.item-quantity {
  color: #666;
  margin: 0.25rem 0;
  font-size: 0.9rem;
}

.cart-total {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 1.5rem;
  padding-top: 1.5rem;
  border-top: 1px solid #eee;
  font-weight: bold;
}

.cart-total h3 {
  margin: 0;
  font-size: 1.2rem;
  color: #333;
}

.payment-section {
  margin-top: 2rem;
  background-color: #f8f9fa;
  border-radius: 8px;
  padding: 1.5rem;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.payment-section h3 {
  margin-top: 0;
  margin-bottom: 1rem;
  color: #333;
  font-weight: 600;
  font-size: 1.2rem;
}

.payment-methods {
  display: flex;
  gap: 1rem;
  margin: 1.5rem 0;
  justify-content: center;
}

.payment-method {
  width: 120px;
  height: 60px;
  border: 1px solid #ddd;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease;
  background-color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0;
  overflow: hidden;
}

.payment-logo {
  width: 100%;
  height: 100%;
  object-fit: contain;
  padding: 8px;
}

.payment-method:hover {
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.payment-method.mpesa:hover {
  border-color: #25D366;
}

.payment-method.paypal:hover {
  border-color: #0070ba;
}

.payment-method.mpesa.active {
  border-color: #25D366;
  background-color: #f0fff0;
  box-shadow: 0 2px 8px rgba(37, 211, 102, 0.2);
}

.payment-method.paypal.active {
  border-color: #0070ba;
  background-color: #f0f7ff;
  box-shadow: 0 2px 8px rgba(0, 112, 186, 0.2);
}

.payment-form {
  margin-top: 1.5rem;
}

.form-group {
  margin-bottom: 1.5rem;
}

.form-group label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 500;
  color: #333;
}

.form-group input {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 1rem;
  transition: border-color 0.3s ease;
}

.form-group input:focus {
  outline: none;
  border-color: #25D366;
  box-shadow: 0 0 0 2px rgba(37, 211, 102, 0.2);
}

.pay-btn {
  width: 100%;
  padding: 0.75rem;
  color: white;
  border: none;
  border-radius: 8px;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s ease;
  font-size: 1rem;
}

.mpesa-btn {
  background-color: #25D366;
}

.mpesa-btn:hover {
  background-color: #1ea84d;
}

.pay-btn:disabled {
  background-color: #ccc;
  cursor: not-allowed;
}

/* Payment Status Styles */
.payment-status {
  padding: 1rem;
  margin: 1rem 0;
  border-radius: 8px;
  text-align: center;
  font-weight: 500;
}

.payment-status.pending {
  background-color: #fff8e1;
  color: #ff8f00;
  border: 1px solid #ffe082;
}

.payment-status.success {
  background-color: #e8f5e9;
  color: #2e7d32;
  border: 1px solid #a5d6a7;
}

.payment-status.failed {
  background-color: #ffebee;
  color: #c62828;
  border: 1px solid #ef9a9a;
}

/* PayPal Button Container */
#paypal-button-container {
  margin-top: 1rem;
  min-height: 150px;
}
</style>
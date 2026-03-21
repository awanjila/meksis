import { defineStore } from 'pinia';

// Helper function to load cart from localStorage
const loadCartFromStorage = () => {
  const savedCart = localStorage.getItem('cart');
  return savedCart ? JSON.parse(savedCart) : [];
};

// Helper function to save cart to localStorage
const saveCartToStorage = (cart) => {
  localStorage.setItem('cart', JSON.stringify(cart));
};

export const useCartStore = defineStore('cart', {
  state: () => ({
    items: loadCartFromStorage()
  }),
  
  getters: {
    cartItems: (state) => state.items,
    cartTotal: (state) => {
      return state.items.reduce((total, item) => {
        return total + (item.price * item.quantity);
      }, 0);
    },
    itemCount: (state) => {
      return state.items.reduce((count, item) => count + item.quantity, 0);
    }
  },
  
  actions: {
    addToCart(item) {
      const existingItem = this.items.find(i => i.id === item.id);
      
      if (existingItem) {
        existingItem.quantity += item.quantity;
      } else {
        this.items.push(item);
      }
      
      // Save to localStorage after adding item
      saveCartToStorage(this.items);
    },
    
    updateQuantity(itemId, quantity) {
      const item = this.items.find(i => i.id === itemId);
      if (item) {
        item.quantity = quantity;
        // Save to localStorage after updating quantity
        saveCartToStorage(this.items);
      }
    },
    
    removeFromCart(itemId) {
      this.items = this.items.filter(item => item.id !== itemId);
      // Save to localStorage after removing item
      saveCartToStorage(this.items);
    },
    
    clearCart() {
      this.items = [];
      // Clear localStorage after clearing cart
      localStorage.removeItem('cart');
    }
  }
}); 
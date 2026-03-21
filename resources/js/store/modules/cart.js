const state = {
  items: []
};

const mutations = {
  ADD_TO_CART(state, item) {
    const existingItem = state.items.find(i => i.id === item.id);
    if (existingItem) {
      existingItem.quantity += item.quantity;
    } else {
      state.items.push(item);
    }
  },
  UPDATE_QUANTITY(state, { id, quantity }) {
    const item = state.items.find(i => i.id === id);
    if (item) {
      item.quantity = quantity;
    }
  },
  REMOVE_FROM_CART(state, itemId) {
    state.items = state.items.filter(item => item.id !== itemId);
  },
  CLEAR_CART(state) {
    state.items = [];
  }
};

const actions = {
  addToCart({ commit }, item) {
    commit('ADD_TO_CART', item);
  },
  updateQuantity({ commit }, payload) {
    commit('UPDATE_QUANTITY', payload);
  },
  removeFromCart({ commit }, itemId) {
    commit('REMOVE_FROM_CART', itemId);
  },
  clearCart({ commit }) {
    commit('CLEAR_CART');
  }
};

const getters = {
  cartItems: state => state.items,
  cartTotal: state => {
    return state.items.reduce((total, item) => {
      return total + (item.price * item.quantity);
    }, 0);
  },
  itemCount: state => {
    return state.items.reduce((count, item) => count + item.quantity, 0);
  }
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}; 
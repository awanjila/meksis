<template>
    <div class="rs-project style3 modify1 case-style3">
      <div class="container">
        <div class="row">
          <div v-for="cat in categories" :key="cat.id" class="col-lg-4 col-md-6 mb-30">
            <div class="project-item">
              <div class="project-img">
                <a :href="`/products/${cat.slug}`">
                  <img :src="getImageUrl(cat.category_image)" :alt="cat.category_name">
                </a>
              </div>
              <div class="project-content">
                <div class="portfolio-inner">
                  <h3 class="title">
                    <a :href="`/products/${cat.slug}`">{{ cat.category_name }}</a>
                  </h3>
                  <span class="category">
                    <a :href="`/products/${cat.slug}`">Shop {{ cat.category_name }}</a>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        categories: [],
        baseURL: 'http://127.0.0.1:8000/' // Define your base URL here
      };
    },
    mounted() {
      this.fetchCategories();
    },
    methods: {
      async fetchCategories() {
        try {
          const response = await axios.get('/api/categories'); // Adjust URL as needed
          this.categories = response.data;
        } catch (error) {
          console.error('Error fetching categories:', error);
        }
      },
      getImageUrl(imagePath) {
        return `${this.baseURL}${imagePath}`; // Construct the full URL
      }
    }
  }
  </script>
  
  <style scoped>
  /* Add any component-specific styles here */
  </style>
  
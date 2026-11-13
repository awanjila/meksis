<template>
  <div class="faqs-page">
    <!-- Breadcrumbs -->
    <div class="rs-breadcrumbs">
      <div class="breadcrumbs-inner text-center">
        <h1 class="page-title">{{ title }}</h1>
        <p v-if="subtitle" class="page-subtitle">{{ subtitle }}</p>
        <ul>
          <li>
            <a href="/">HOME</a>
          </li>
          <li>FAQS</li>
        </ul>
      </div>
    </div>

    <FaqsSection
      v-if="data"
      :initial-data="data"
      :show-header="false"
      :show-view-all="false"
      :inject-schema="true"
    />

    <div v-if="loaded && data && data.faqs.length === 0" class="empty-state">
      <p>No FAQs yet. Please check back soon.</p>
    </div>
  </div>
</template>

<script setup>
import { computed, onMounted, ref } from 'vue'
import FaqsSection from '@/components/FaqsSection.vue'

const data = ref(null)
const loaded = ref(false)

const title = computed(() => data.value?.title || 'FREQUENTLY ASKED QUESTIONS')
const subtitle = computed(() => data.value?.subtitle || '')

onMounted(async () => {
  document.title = 'FAQs | Meksis Engineering'

  try {
    const res = await fetch('/api/faqs')
    if (!res.ok) throw new Error('Unable to load FAQs')
    data.value = await res.json()
    if (data.value.title) {
      document.title = `${data.value.title} | Meksis Engineering`
    }
  } catch (error) {
    console.error('Error fetching FAQs:', error)
    data.value = { title: 'FREQUENTLY ASKED QUESTIONS', subtitle: '', faqs: [] }
  } finally {
    loaded.value = true
  }
})
</script>

<style scoped>
/* ===== BREADCRUMBS ===== */
.rs-breadcrumbs {
  padding: 50px 0 40px;
  background: var(--charcoal);
  border-bottom: 5px solid var(--royal-yellow);
}

.breadcrumbs-inner {
  color: var(--white);
}

.page-title {
  font-size: 2.5rem;
  font-weight: 900;
  margin-bottom: 16px;
  color: var(--white);
  text-transform: uppercase;
  letter-spacing: 2px;
}

.page-subtitle {
  font-size: 0.95rem;
  color: #999;
  text-transform: uppercase;
  font-weight: bold;
  margin-bottom: 16px;
}

.breadcrumbs-inner ul {
  list-style: none;
  padding: 0;
  display: flex;
  justify-content: center;
  gap: 10px;
}

.breadcrumbs-inner ul li {
  color: #999;
  text-transform: uppercase;
  font-weight: bold;
  font-size: 0.85rem;
}

.breadcrumbs-inner ul li::before {
  content: '/';
  margin-right: 10px;
  color: #666;
}

.breadcrumbs-inner ul li:first-child::before {
  display: none;
}

.breadcrumbs-inner ul li a {
  color: var(--royal-yellow);
  text-decoration: none;
  transition: color 0.1s;
  font-weight: bold;
}

.breadcrumbs-inner ul li a:hover {
  color: var(--white);
}

/* ===== EMPTY STATE ===== */
.empty-state {
  max-width: 900px;
  margin: 0 auto;
  padding: 60px 24px;
  text-align: center;
  color: #666;
}

/* ===== RESPONSIVE DESIGN ===== */
@media (max-width: 768px) {
  .page-title {
    font-size: 1.75rem;
  }
}

@media (max-width: 480px) {
  .page-title {
    font-size: 1.5rem;
  }
}
</style>

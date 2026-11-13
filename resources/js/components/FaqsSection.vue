<template>
  <section v-if="faqs.length" class="faqs-section">
    <div class="container">
      <div v-if="showHeader" class="section-header">
        <h2 class="section-title">{{ title }}</h2>
        <p v-if="subtitle" class="section-subtitle">{{ subtitle }}</p>
      </div>

      <div class="faq-list">
        <div
          v-for="(faq, index) in faqs"
          :key="faq.id"
          :class="['faq-item', { open: openIndex === index }]"
        >
          <button
            type="button"
            class="faq-question"
            :aria-expanded="openIndex === index"
            :aria-controls="`faq-answer-${faq.id}`"
            @click="toggle(index)"
          >
            <span class="faq-question-text">{{ faq.question }}</span>
            <span class="faq-icon" aria-hidden="true">{{ openIndex === index ? '−' : '+' }}</span>
          </button>

          <div
            v-show="openIndex === index"
            :id="`faq-answer-${faq.id}`"
            class="faq-answer"
            role="region"
          >
            <p>{{ faq.answer }}</p>
          </div>
        </div>
      </div>

      <div v-if="showViewAll" class="section-footer">
        <a href="/faqs" class="view-all-link">
          VIEW ALL FAQs
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
          </svg>
        </a>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, watch, onMounted, onBeforeUnmount } from 'vue'

const props = defineProps({
  limit: {
    type: Number,
    default: 6
  },
  showViewAll: {
    type: Boolean,
    default: true
  },
  showHeader: {
    type: Boolean,
    default: true
  },
  injectSchema: {
    type: Boolean,
    default: false
  },
  initialData: {
    type: Object,
    default: null
  }
})

const faqs = ref([])
const title = ref('FREQUENTLY ASKED QUESTIONS')
const subtitle = ref('')
const openIndex = ref(0)

const applyData = (data) => {
  if (!data) return
  title.value = data.title || 'FREQUENTLY ASKED QUESTIONS'
  subtitle.value = data.subtitle || ''
  faqs.value = Array.isArray(data.faqs) ? data.faqs : []
  openIndex.value = 0
}

const injectFaqSchema = () => {
  if (!props.injectSchema) return

  const existing = document.getElementById('faq-schema')
  if (existing) existing.remove()

  if (!faqs.value.length) return

  const schema = {
    '@context': 'https://schema.org',
    '@type': 'FAQPage',
    mainEntity: faqs.value.map((faq) => ({
      '@type': 'Question',
      name: faq.question,
      acceptedAnswer: {
        '@type': 'Answer',
        text: faq.answer
      }
    }))
  }

  const script = document.createElement('script')
  script.type = 'application/ld+json'
  script.id = 'faq-schema'
  script.textContent = JSON.stringify(schema)
  document.head.appendChild(script)
}

const toggle = (index) => {
  openIndex.value = openIndex.value === index ? -1 : index
}

watch(
  () => props.initialData,
  (data) => {
    if (data) {
      applyData(data)
      injectFaqSchema()
    }
  }
)

onMounted(async () => {
  if (props.initialData) {
    applyData(props.initialData)
    injectFaqSchema()
    return
  }

  try {
    const res = await fetch(`/api/faqs?limit=${props.limit}`)
    if (!res.ok) throw new Error('Unable to load FAQs')
    applyData(await res.json())
    injectFaqSchema()
  } catch (error) {
    console.error('Error fetching FAQs:', error)
    faqs.value = []
  }
})

onBeforeUnmount(() => {
  const existing = document.getElementById('faq-schema')
  if (existing) existing.remove()
})
</script>

<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.faqs-section {
  padding: 60px 0;
  background: #f5f5f5;
}

.container {
  max-width: 900px;
  margin: 0 auto;
  padding: 0 50px;
}

.section-header {
  text-align: center;
  margin-bottom: 40px;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 900;
  color: var(--charcoal);
  margin-bottom: 16px;
  text-transform: uppercase;
  letter-spacing: 2px;
}

.section-subtitle {
  font-size: 1rem;
  color: #666;
  max-width: 500px;
  margin: 0 auto;
  line-height: 1.6;
  text-transform: uppercase;
  font-weight: bold;
}

.faq-list {
  display: flex;
  flex-direction: column;
}

.faq-item {
  background: #ffffff;
  border: 1px solid #e0e0e0;
  margin-bottom: 12px;
  transition: border-color 0.2s;
}

.faq-item:hover {
  border-color: var(--royal-yellow);
}

.faq-item.open {
  border-color: var(--royal-yellow);
  border-left: 4px solid var(--royal-yellow);
}

.faq-question {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  padding: 20px 24px;
  background: none;
  border: none;
  cursor: pointer;
  text-align: left;
  color: var(--charcoal);
  font-family: inherit;
  font-size: 1rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  transition: color 0.2s;
}

.faq-question:hover {
  color: var(--royal-yellow);
}

.faq-question-text {
  overflow-wrap: anywhere;
}

.faq-icon {
  flex-shrink: 0;
  font-size: 1.5rem;
  line-height: 1;
  color: var(--royal-yellow);
}

.faq-answer {
  padding: 0 24px 20px;
  color: #666;
  font-size: 0.95rem;
  line-height: 1.7;
  white-space: pre-line;
  overflow-wrap: anywhere;
}

.faq-answer p {
  margin: 0;
}

.section-footer {
  text-align: center;
  margin-top: 36px;
}

.view-all-link {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: var(--royal-yellow);
  color: var(--charcoal);
  text-decoration: none;
  padding: 14px 32px;
  font-size: 0.9rem;
  font-weight: 700;
  text-transform: uppercase;
  transition: background 0.1s, gap 0.1s;
}

.view-all-link:hover {
  background: var(--white);
  gap: 14px;
}

.view-all-link svg {
  transition: transform 0.2s;
}

.view-all-link:hover svg {
  transform: translateX(4px);
}

@media (max-width: 768px) {
  .faqs-section {
    padding: 40px 0;
  }

  .container {
    padding: 0 20px;
  }

  .section-header {
    margin-bottom: 30px;
  }

  .section-title {
    font-size: 1.75rem;
  }

  .faq-question {
    padding: 16px 18px;
    font-size: 0.9rem;
    gap: 12px;
  }

  .faq-answer {
    padding: 0 18px 16px;
    font-size: 0.9rem;
  }

  .view-all-link {
    padding: 12px 24px;
    font-size: 0.85rem;
  }
}
</style>

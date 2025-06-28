<template>
  <div class="relative">
    <div @click="open = !open">
      <slot name="trigger" />
    </div>

    <div v-show="open"
         class="absolute z-50 mt-2 rounded-md shadow-lg"
         :class="[widthClass, alignmentClasses]"
         style="display: none;"
         @click="open = false">
      <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white">
        <slot name="content" />
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, onUnmounted } from 'vue'

export default {
  props: {
    align: {
      type: String,
      default: 'right'
    },
    width: {
      type: String,
      default: '48'
    }
  },

  setup() {
    const open = ref(false)

    const closeOnEscape = (e) => {
      if (open.value && e.key === 'Escape') {
        open.value = false
      }
    }

    onMounted(() => document.addEventListener('keydown', closeOnEscape))
    onUnmounted(() => document.removeEventListener('keydown', closeOnEscape))

    return {
      open
    }
  },

  computed: {
    widthClass() {
      return {
        '48': 'w-48',
      }[this.width.toString()]
    },

    alignmentClasses() {
      if (this.align === 'left') {
        return 'origin-top-left left-0'
      } else if (this.align === 'right') {
        return 'origin-top-right right-0'
      } else {
        return 'origin-top'
      }
    }
  }
}
</script>
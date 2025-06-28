<template>
  <transition
    enter-active-class="transition ease-out duration-300 transform"
    enter-from-class="opacity-0 -translate-y-2"
    enter-to-class="opacity-100 translate-y-0"
    leave-active-class="transition ease-in duration-200 transform"
    leave-from-class="opacity-100 translate-y-0"
    leave-to-class="opacity-0 -translate-y-2"
  >
    <div
      v-if="visible"
      class="fixed top-6 left-1/2 transform -translate-x-1/2 z-[9999] pointer-events-none min-w-[300px]"
    >
      <div
        class="px-5 py-4 rounded-xl shadow-xl backdrop-blur-sm border border-white/10 text-center font-sans font-medium text-sm tracking-wide flex items-center space-x-3"
        :class="{
          'bg-emerald-600/90 text-white': type === 'success',
          'bg-rose-600/90 text-white': type === 'error',
          'bg-sky-600/90 text-white': type === 'info',
          'bg-indigo-600/90 text-white': type === 'primary',
          'bg-amber-500/90 text-white': type === 'warning',
          'animate-pulse': pulse
        }"
      >
        <!-- Iconos SVG personalizados -->
        <svg v-if="type === 'success'" class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>

        <svg v-else-if="type === 'error'" class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>

        <svg v-else-if="type === 'info'" class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>

        <svg v-else-if="type === 'warning'" class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>

        <svg v-else class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>

        <div class="flex-1 text-left">
          <p class="font-semibold">{{ title }}</p>
          <p v-if="message" class="text-white/90 text-xs mt-1">{{ message }}</p>
        </div>

        <!-- Barra de progreso animada -->
        <div 
          v-if="progressBar"
          class="absolute bottom-0 left-0 right-0 h-1 bg-white/20 rounded-full overflow-hidden"
        >
          <div 
            class="h-full bg-white/50 transition-all duration-300 ease-linear"
            :style="{ width: `${progress}%` }"
          ></div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'

const props = defineProps({
  title: {
    type: String,
    required: true
  },
  message: {
    type: String,
    default: ''
  },
  type: {
    type: String,
    default: 'success',
    validator: (value) => ['success', 'error', 'info', 'warning', 'primary'].includes(value)
  },
  duration: {
    type: Number,
    default: 1000
  },
  pulse: {
    type: Boolean,
    default: false
  },
  progressBar: {
    type: Boolean,
    default: true
  }
})

const visible = ref(true)
const progress = ref(100)

onMounted(() => {
  let startTime
  let animationFrame

  const animate = (time) => {
    if (!startTime) startTime = time
    const elapsed = time - startTime
    progress.value = 100 - (elapsed / props.duration) * 100
    
    if (elapsed < props.duration) {
      animationFrame = requestAnimationFrame(animate)
    } else {
      visible.value = false
    }
  }

  animationFrame = requestAnimationFrame(animate)

  setTimeout(() => {
    visible.value = false
    cancelAnimationFrame(animationFrame)
  }, props.duration)
})
</script>
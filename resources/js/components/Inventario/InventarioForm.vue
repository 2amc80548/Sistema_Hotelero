<script setup>  
const props = defineProps({
  inventario: {
    type: Object,
    default: () => ({
      producto: '',
      cantidad: 0,
      stock_minimo: 0,
      ubicacion: '',
      observaciones: '',
    }),
  },
  submitLabel: {
    type: String,
    default: 'Guardar'
  }
})

const form = props.inventario
</script>

<template>
  <form @submit.prevent="$emit('submit', form)" class="max-w-3xl mx-auto">
    <!-- Encabezado del formulario -->
    <div class="mb-6">
      <h2 class="text-2xl font-bold text-gray-800">Datos del Producto</h2>
      <p class="text-gray-600">Complete los campos requeridos</p>
    </div>

    <!-- Campos del formulario -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Grupo Producto -->
      <div class="space-y-2 md:col-span-2">
        <label class="block font-medium text-gray-700">
          Producto <span class="text-red-500">*</span>
        </label>
        <input
          v-model="form.producto"
          type="text"
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
          placeholder="Ej: Martillo profesional"
          required
        >
        <div v-if="form.errors?.producto" class="text-red-500 text-sm mt-1">
          <i class="fas fa-exclamation-circle mr-1"></i> {{ form.errors.producto }}
        </div>
      </div>

      <!-- Grupo Cantidad -->
      <div class="space-y-2">
        <label class="block font-medium text-gray-700">
          Cantidad <span class="text-red-500">*</span>
        </label>
        <input
          v-model.number="form.cantidad"
          type="number"
          min="0"
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
          placeholder="Ej: 10"
          required
        >
        <div v-if="form.errors?.cantidad" class="text-red-500 text-sm mt-1">
          <i class="fas fa-exclamation-circle mr-1"></i> {{ form.errors.cantidad }}
        </div>
      </div>

      <!-- Grupo Stock Mínimo -->
      <div class="space-y-2">
        <label class="block font-medium text-gray-700">
          Stock Mínimo <span class="text-red-500">*</span>
        </label>
        <input
          v-model.number="form.stock_minimo"
          type="number"
          min="0"
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
          placeholder="Ej: 5"
          required
        >
        <div v-if="form.errors?.stock_minimo" class="text-red-500 text-sm mt-1">
          <i class="fas fa-exclamation-circle mr-1"></i> {{ form.errors.stock_minimo }}
        </div>
      </div>

      <!-- Grupo Ubicación -->
      <div class="space-y-2">
        <label class="block font-medium text-gray-700">Ubicación</label>
        <input
          v-model="form.ubicacion"
          type="text"
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
          placeholder="Ej: Estantería A, Nivel 2"
        >
        <div v-if="form.errors?.ubicacion" class="text-red-500 text-sm mt-1">
          <i class="fas fa-exclamation-circle mr-1"></i> {{ form.errors.ubicacion }}
        </div>
      </div>

      <!-- Grupo Observaciones (full width) -->
      <div class="md:col-span-2 space-y-2">
        <label class="block font-medium text-gray-700">Observaciones</label>
        <textarea
          v-model="form.observaciones"
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
          placeholder="Notas adicionales sobre el producto"
          rows="3"
        ></textarea>
        <div v-if="form.errors?.observaciones" class="text-red-500 text-sm mt-1">
          <i class="fas fa-exclamation-circle mr-1"></i> {{ form.errors.observaciones }}
        </div>
      </div>
    </div>

    <!-- Botón de submit -->
    <div class="mt-8 flex justify-end">
      <button
        type="submit"
        class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-500 text-white font-medium rounded-lg shadow-md hover:from-blue-700 hover:to-blue-600 transition-all transform hover:scale-105"
      >
        <i class="fas fa-save mr-2"></i> {{ submitLabel }}
      </button>
    </div>
  </form>
</template>

<style scoped>
/* Transiciones suaves */
input, textarea, button {
  transition: all 0.3s ease;
}
</style>
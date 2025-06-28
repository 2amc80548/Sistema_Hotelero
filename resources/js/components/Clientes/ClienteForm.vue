<script setup>
const props = defineProps({
  cliente: {
    type: Object,
    default: () => ({
      nombre: '',
      documento_identidad: '',
      telefono: '',
      email: '',
      direccion: '',
    }),
  },
  submitLabel: {
    type: String,
    default: 'Guardar'
  }
})

const form = props.cliente
</script>

<template>
  
  <form @submit.prevent="$emit('submit', form)" class="max-w-3xl mx-auto">
    <!-- Encabezado del formulario -->
    <div class="mb-6">
      <h2 class="text-2xl font-bold text-gray-800">Datos del Cliente</h2>
      <p class="text-gray-600">Complete todos los campos requeridos</p>
    </div>

    <!-- Campos del formulario -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Grupo Nombre -->
      <div class="space-y-2">
        <label class="block font-medium text-gray-700">
          Nombre <span class="text-red-500">*</span>
        </label>
        <input
          v-model="form.nombre"
          type="text"
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
          placeholder="Ej: Juan Pérez"
          required
        >
        <div v-if="form.errors?.nombre" class="text-red-500 text-sm mt-1">
          <i class="fas fa-exclamation-circle mr-1"></i> {{ form.errors.nombre }}
        </div>
      </div>

      <!-- Grupo Documento -->
      <div class="space-y-2">
        <label class="block font-medium text-gray-700">
          Documento de Identidad <span class="text-red-500">*</span>
        </label>
        <input
          v-model="form.documento_identidad"
          type="text"
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
          placeholder="Ej: 12345678A"
          required
        >
        <div v-if="form.errors?.documento_identidad" class="text-red-500 text-sm mt-1">
          <i class="fas fa-exclamation-circle mr-1"></i> {{ form.errors.documento_identidad }}
        </div>
      </div>

      <!-- Grupo Teléfono -->
      <div class="space-y-2">
        <label class="block font-medium text-gray-700">Teléfono</label>
        <input
          v-model="form.telefono"
          type="tel"
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
          placeholder="Ej: +51 987654321"
        >
        <div v-if="form.errors?.telefono" class="text-red-500 text-sm mt-1">
          <i class="fas fa-exclamation-circle mr-1"></i> {{ form.errors.telefono }}
        </div>
      </div>

      <!-- Grupo Email -->
      <div class="space-y-2">
        <label class="block font-medium text-gray-700">Email</label>
        <input
          v-model="form.email"
          type="email"
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
          placeholder="Ej: cliente@example.com"
        >
        <div v-if="form.errors?.email" class="text-red-500 text-sm mt-1">
          <i class="fas fa-exclamation-circle mr-1"></i> {{ form.errors.email }}
        </div>
      </div>

      <!-- Grupo Dirección (full width) -->
      <div class="md:col-span-2 space-y-2">
        <label class="block font-medium text-gray-700">Dirección</label>
        <input
          v-model="form.direccion"
          type="text"
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
          placeholder="Ej: Av. Principal 123"
        >
        <div v-if="form.errors?.direccion" class="text-red-500 text-sm mt-1">
          <i class="fas fa-exclamation-circle mr-1"></i> {{ form.errors.direccion }}
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
input, button {
  transition: all 0.3s ease;
}


</style>
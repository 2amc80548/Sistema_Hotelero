<script setup>
const props = defineProps({
  habitacion: {
    type: Object,
    default: () => ({
      numero: '',
      tipo: '',
      precio: '',
      estado: 'disponible',
      piso: '',
      observaciones: '',
    }),
  },
  submitLabel: {
    type: String,
    default: 'Guardar'
  }
})

const form = props.habitacion
</script>

<template>
  <form @submit.prevent="$emit('submit', form)">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block font-medium text-sm mb-1">Número</label>
        <input v-model="form.numero" type="text" class="input" />
        <div v-if="form.errors?.numero" class="text-red-500 text-sm">{{ form.errors.numero }}</div>
      </div>

      <div>
        <label class="block font-medium text-sm mb-1">Tipo</label>
        <select v-model="form.tipo" class="input">
          <option value="">-- Seleccione --</option>
          <option value="simple">Simple</option>
          <option value="doble">Doble</option>
          <option value="suite">Suite</option>
        </select>
        <div v-if="form.errors?.tipo" class="text-red-500 text-sm">{{ form.errors.tipo }}</div>
      </div>

      <div>
        <label class="block font-medium text-sm mb-1">Precio (Bs)</label>
        <input v-model="form.precio" type="number" step="0.01" class="input" />
        <div v-if="form.errors?.precio" class="text-red-500 text-sm">{{ form.errors.precio }}</div>
      </div>

      <div>
        <label class="block font-medium text-sm mb-1">Estado</label>
        <select v-model="form.estado" class="input">
          <option value="disponible">Disponible</option>
          <option value="reservada">Reservada</option>
          <option value="ocupada">Ocupada</option>
          <option value="limpieza">Limpieza</option>
        </select>
        <div v-if="form.errors?.estado" class="text-red-500 text-sm">{{ form.errors.estado }}</div>
      </div>

      <div class="md:col-span-2">
        <label class="block font-medium text-sm mb-1">Piso</label>
        <input v-model="form.piso" type="text" class="input" />
      </div>

      <div class="md:col-span-2">
        <label class="block font-medium text-sm mb-1">Observaciones</label>
        <textarea v-model="form.observaciones" class="input"></textarea>
      </div>
    </div>

    <div class="mt-6">
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        {{ submitLabel }}
      </button>
    </div>
  </form>
</template>

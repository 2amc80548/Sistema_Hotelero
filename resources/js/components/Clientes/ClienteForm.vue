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
    

   <form @submit.prevent="$emit('submit', form)">
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block font-medium text-sm mb-1">Nombre</label>
        <input v-model="form.nombre" type="text" class="input w-full" />
        <div v-if="form.errors.nombre" class="text-red-500 text-sm">{{ form.errors.nombre }}</div>
      </div>




      <div>
        <label class="block font-medium text-sm mb-1">Documento de Identidad</label>
        <input v-model="form.documento_identidad" type="text" class="input w-full" />
        <div v-if="form.errors.documento_identidad" class="text-red-500 text-sm">{{ form.errors.documento_identidad }}</div>
      </div>

      <div>
        <label class="block font-medium text-sm mb-1">Teléfono</label>
        <input v-model="form.telefono" type="text" class="input w-full" />
        <div v-if="form.errors.telefono" class="text-red-500 text-sm">{{ form.errors.telefono }}</div>
      </div>

      <div>
        <label class="block font-medium text-sm mb-1">Email</label>
        <input v-model="form.email" type="email" class="input w-full" />
        <div v-if="form.errors.email" class="text-red-500 text-sm">{{ form.errors.email }}</div>
      </div>

      <div>
        <label class="block font-medium text-sm mb-1">Dirección</label>
        <input v-model="form.direccion" type="text" class="input w-full" />
        <div v-if="form.errors.direccion" class="text-red-500 text-sm">{{ form.errors.direccion }}</div>
      </div>
    </div>

    <div class="mt-6">
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        {{ submitLabel }}
      </button>
    </div>
  </form>
</template>



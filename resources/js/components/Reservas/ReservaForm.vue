<script setup>
defineProps({
  form: Object,
  habitaciones: Array,
  clientes: Array,
  // Etiqueta del botón de envío

  submitLabel: {
    type: String,
    default: 'Guardar'
  }
})
  

</script>

<template>
  <form @submit.prevent="$emit('submit')">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      
      <div>
        <label class="block font-medium text-sm mb-1">Habitación</label>
        <select v-model="form.habitacion_id" class="input w-full">
          <option value="">-- Seleccione una habitación --</option>
          <option v-for="hab in habitaciones" :key="hab.id" :value="hab.id">
            N° {{ hab.numero }} - {{ hab.tipo }}
          </option>
        </select>
        <div v-if="form.errors.habitacion_id" class="text-red-500 text-sm">{{ form.errors.habitacion_id }}</div>
      </div>

      <div>
        <label class="block font-medium text-sm mb-1">Cliente</label>
        <select v-model="form.cliente_id" class="input w-full">
          <option value="">-- Seleccione un cliente --</option>
          <option v-for="cliente in clientes" :key="cliente.id" :value="cliente.id">
            {{ cliente.nombre }} 
          </option>
        </select>
        <div v-if="form.errors.cliente_id" class="text-red-500 text-sm">{{ form.errors.cliente_id }}</div>
      </div>


      <div>
        <label class="block font-medium text-sm mb-1">Fecha de Ingreso</label>
        <input v-model="form.fecha_ingreso" type="date" class="input w-full" />
        <div v-if="form.errors.fecha_ingreso" class="text-red-500 text-sm">{{ form.errors.fecha_ingreso }}</div>
      </div>

      <div>
        <label class="block font-medium text-sm mb-1">Fecha de Salida</label>
        <input v-model="form.fecha_salida" type="date" class="input w-full" />
        <div v-if="form.errors.fecha_salida" class="text-red-500 text-sm">{{ form.errors.fecha_salida }}</div>
      </div>

      <div>
        <label class="block font-medium text-sm mb-1">Estado</label>
        <select v-model="form.estado" class="input w-full">
          <option value="pendiente">Pendiente</option>
          <option value="confirmada">Confirmada</option>
          <option value="finalizada">Finalizada</option>
          <option value="cancelada">Cancelada</option>
        </select>
        <div v-if="form.errors.estado" class="text-red-500 text-sm">{{ form.errors.estado }}</div>
      </div>

      <div>
        <label class="block font-medium text-sm mb-1">Total (Bs)</label>
        <input v-model="form.total" type="number" step="0.01" class="input w-full" />
        <div v-if="form.errors.total" class="text-red-500 text-sm">{{ form.errors.total }}</div>
      </div>

      <div class="md:col-span-2">
        <label class="block font-medium text-sm mb-1">Observaciones</label>
        <textarea v-model="form.observaciones" class="input w-full"></textarea>
      </div>
    </div>

    <div class="mt-6">
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
       {{ submitLabel }}
      </button>
       
    </div>
  </form>
</template>

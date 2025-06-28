<script setup>
const props = defineProps({
  cliente: Object
})
</script>

<template>
  <div class="p-6 max-w-2xl mx-auto bg-white rounded shadow">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Detalle del Cliente</h1>

    <div class="space-y-2">
      <p><strong>Nombre:</strong> {{ cliente.nombre }}</p>
      <p><strong>CI:</strong> {{ cliente.documento_identidad }}</p>
      <p><strong>Teléfono:</strong> {{ cliente.telefono || 'No registrado' }}</p>
      <p><strong>Email:</strong> {{ cliente.email || 'No registrado' }}</p>
      <p><strong>Dirección:</strong> {{ cliente.direccion || 'No registrado' }}</p>
    </div>

    <div class="mt-6">
      <button @click="$inertia.visit('/clientes')" class="text-blue-600 hover:underline">← Volver al listado</button>
    </div>
  </div>
</template>

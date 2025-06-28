<script setup>
defineProps({
  cliente: Object
})
</script>

<template>
  <div class="p-6 max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Cliente: {{ cliente.nombre }}</h1>
    <p><strong>CI:</strong> {{ cliente.documento_identidad }}</p>
    <p><strong>Teléfono:</strong> {{ cliente.telefono }}</p>
    <p><strong>Email:</strong> {{ cliente.email }}</p>
    <p><strong>Dirección:</strong> {{ cliente.direccion }}</p>

    <hr class="my-6" />

    <h2 class="text-xl font-semibold mb-3">Historial de Reservas</h2>

    <div v-if="cliente.reservas.length">
      <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-4 py-2 text-left">Habitación</th>
            <th class="px-4 py-2 text-left">Ingreso</th>
            <th class="px-4 py-2 text-left">Salida</th>
            <th class="px-4 py-2 text-left">Estado</th>
            <th class="px-4 py-2 text-right">Total</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="reserva in cliente.reservas" :key="reserva.id" class="hover:bg-gray-50">
            <td class="px-4 py-2">{{ reserva.habitacion?.numero }}</td>
            <td class="px-4 py-2">{{ reserva.fecha_ingreso }}</td>
            <td class="px-4 py-2">{{ reserva.fecha_salida }}</td>
            <td class="px-4 py-2 capitalize">{{ reserva.estado }}</td>
            <!-- <td class="px-4 py-2 text-right">Bs {{ reserva.total.toFixed(2) }}</td> -->
          </tr>
        </tbody>
      </table>
    </div>
    <p v-else class="text-gray-500">Este cliente no tiene reservas registradas.</p>
  </div>
</template>

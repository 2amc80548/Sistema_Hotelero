<script setup>
defineProps({
  reserva: Object,

})


</script>


<template>
  <div class="p-6 max-w-3xl mx-auto bg-white rounded shadow">
    <!-- Cabecera con título y botón -->
    <div class="flex justify-between items-center mb-6 print:hidden">
      <h1 class="text-2xl font-bold text-gray-800">Comprobante de Reserva</h1>
      <button
        @click="window.print()"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
      >
        🖨 Imprimir
      </button>
    </div>

    <!-- Contenido del comprobante -->
    <div class="space-y-4 text-gray-700">
      <h2 class="text-xl font-semibold mb-2 border-b pb-2">Datos de la Reserva</h2>

      <p><strong>Habitación:</strong> {{ reserva.habitacion.numero }} ({{ reserva.habitacion.tipo }})</p>
      <p><strong>Cliente:</strong> {{ reserva.cliente.nombre }}</p>
      <p><strong>Fecha de Ingreso:</strong> {{ reserva.fecha_ingreso }}</p>
      <p><strong>Fecha de Salida:</strong> {{ reserva.fecha_salida }}</p>
      <p><strong>Estado:</strong> <span class="capitalize">{{ reserva.estado }}</span></p>
      <p><strong>Total (Bs):</strong> {{ reserva.total }}</p>
      <p><strong>Observaciones:</strong> {{ reserva.observaciones || 'Sin observaciones' }}</p>
    </div>

    <!-- Volver al listado -->
  <div class="p-6 max-w-3xl mx-auto">
      <button @click="$inertia.visit('/reservas')" class="text-blue-600 hover:underline">← Volver al listado</button>
    </div>
  </div>
</template>

<style>

@media print 
{
  body {
    background: white !important;
    -webkit-print-color-adjust: exact;
    print-color-adjust: exact;
  }

  .print\\:hidden {
    display: none !important;
  }

  .shadow,
  .rounded {
    box-shadow: none !important;
    border-radius: 0 !important;
  }

  .p-6 {
    padding: 0 !important;
  }

  html, body {
    margin: 0;
    padding: 0;
  }

  h1, h2 {
    color: #000 !important;
  }
}
</style>

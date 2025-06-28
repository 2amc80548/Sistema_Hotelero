<script setup>
import ReservaForm from '@/components/Reservas/ReservaForm.vue'
import { useForm } from '@inertiajs/vue3'
import { defineProps } from 'vue'



// Recibe habitaciones del backend
defineProps({
  habitaciones: Array,
  clientes: Array,
})
const form = useForm({
  habitacion_id: '',
  fecha_ingreso: '',
  fecha_salida: '',
  estado: 'pendiente',
  total: '',
  observaciones: '',
  cliente_id: ''
})

// Al enviar el formulario
const submit = () => {
  form.post('/reservas')
}
</script>

<template>
  <div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Nueva Reserva</h1>
    <ReservaForm :form="form" :clientes="clientes" :habitaciones="habitaciones" @submit="submit" submit-label="Registrar" />
  </div>
</template>

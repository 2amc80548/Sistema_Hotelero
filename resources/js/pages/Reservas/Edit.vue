<script setup>
import { useForm } from '@inertiajs/vue3'
import ReservaForm from '@/components/Reservas/ReservaForm.vue'

const props = defineProps({
  reserva: Object,
  habitaciones: Array,
  clientes: Array
})

// Creamos el formulario cargando los datos existentes
const form = useForm({
  habitacion_id: props.reserva.habitacion_id,
  cliente_id: props.reserva.cliente_id,
  fecha_ingreso: props.reserva.fecha_ingreso,
  fecha_salida: props.reserva.fecha_salida,
  estado: props.reserva.estado,
  total: props.reserva.total,
  observaciones: props.reserva.observaciones
})

// Al enviar, usamos `put` para actualizar
const submit = () => {
  form.put(`/reservas/${props.reserva.id}`)
}
</script>

<template>
  <div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Editar Reserva</h1>
    <ReservaForm :form="form" :habitaciones="habitaciones" :clientes="clientes" @submit="submit" submit-label="Actualizar" />
  </div>
</template>

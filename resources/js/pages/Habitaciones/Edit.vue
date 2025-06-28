<script setup>
import HabitacionForm from '@/components/Habitaciones/HabitacionForm.vue'
import { useForm } from '@inertiajs/vue3'


const props = defineProps({
  habitacion: Object
})

const form = useForm({
  numero: props.habitacion.numero,
  tipo: props.habitacion.tipo,
  precio: props.habitacion.precio,
  estado: props.habitacion.estado,
  piso: props.habitacion.piso,
  observaciones: props.habitacion.observaciones,
})

const submit = () => {
  form.put(`/habitaciones/${props.habitacion.id}`)
}
</script>

<template>
      <div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-xl font-bold mb-4">Editar Habitación</h1>
    <HabitacionForm :habitacion="form" @submit="submit" submitLabel="Actualizar" />
  </div>
</template>

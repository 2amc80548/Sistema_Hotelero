<script setup>
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale,
  ArcElement,
  PointElement,
  LineElement
} from 'chart.js'
import { Bar, Pie, Line } from 'vue-chartjs'
import AppLayout from '@/layouts/AppLayout.vue'

ChartJS.register(
  Title, Tooltip, Legend, 
  BarElement, CategoryScale, 
  LinearScale, ArcElement,
  PointElement, LineElement
)

const props = defineProps({
  metricas: Object,
  ocupacionData: Array,
  ingresosData: Array,
  clientesData: Array,
  totalHabitaciones: Number,
  reservasActivas: Number,
  fechas: Object
})

// Datos para gráficos
const ocupacionChart = computed(() => ({
  labels: props.ocupacionData.map(item => item.fecha),
  datasets: [{
    label: 'Porcentaje de Ocupación',
    data: props.ocupacionData.map(item => item.porcentaje),
    backgroundColor: 'rgba(99, 102, 241, 0.2)',
    borderColor: '#6366F1',
    borderWidth: 2,
    tension: 0.4,
    fill: {
      target: 'origin',
      above: 'rgba(99, 102, 241, 0.1)'
    }
  }]
}))

const ingresosChart = computed(() => ({
  labels: props.ingresosData.map(item => item.fecha),
  datasets: [{
    label: 'Ingresos Diarios (Bs)',
    data: props.ingresosData.map(item => item.ingresos),
    backgroundColor: 'rgba(16, 185, 129, 0.6)',
    borderColor: '#10B981',
    borderWidth: 1,
    borderRadius: 4
  }]
}))

const clientesChart = computed(() => ({
  labels: props.clientesData.map(item => item.nombre),
  datasets: [{
    label: 'Reservas por Cliente',
    data: props.clientesData.map(item => item.reservas),
    backgroundColor: [
      '#8B5CF6',
      '#EC4899',
      '#F59E0B',
      '#10B981',
      '#3B82F6'
    ],
    borderWidth: 0,
    spacing: 2
  }]
}))

// Métricas formateadas
const metricasFormateadas = computed(() => [
  {
    title: 'Ocupación',
    value: props.metricas.ocupacion + '%',
    icon: '🏨',
    trend: props.metricas.ocupacion > 70 ? 'up' : 'down',
    color: props.metricas.ocupacion > 70 ? 'green' : 'red'
  },
  {
    title: 'Ingresos',
    value: 'Bs. ' + props.metricas.ingresos.toLocaleString(),
    icon: '💰',
    trend: 'up',
    color: 'green'
  },
  {
    title: 'Reservas',
    value: props.metricas.reservas,
    icon: '📅',
    trend: 'up',
    color: 'green'
  },
  {
    title: 'ADR',
    value: 'Bs. ' + props.metricas.adr.toLocaleString(),
    icon: '📊',
    trend: props.metricas.adr > 500 ? 'up' : 'down',
    color: props.metricas.adr > 500 ? 'green' : 'red'
  },
  {
    title: 'RevPAR',
    value: 'Bs. ' + props.metricas.revpar.toLocaleString(),
    icon: '📈',
    trend: props.metricas.revpar > 400 ? 'up' : 'down',
    color: props.metricas.revpar > 400 ? 'green' : 'red'
  }
])
</script>


<template>
  <AppLayout>
    <Head title="Dashboard" />
    
    <div class="min-h-screen bg-gray-50 p-1">
      <!-- Encabezado más compacto -->
      <div class="mb-1 flex justify-between items-center">
        <div>
          <h1 class="text-xl md:text-2xl font-bold text-gray-800">Dashboard Hotelero</h1>
          <p class="text-xs text-gray-500">Resumen operativo - {{ fechas.mes_actual }}</p>
        </div>
        <div class="bg-white px-3 py-1 rounded-lg shadow-xs text-xs border border-gray-100">
          Actualizado: {{ new Date().toLocaleTimeString() }}
        </div>
      </div>

      <!-- Tarjetas de Métricas más compactas -->
      <div class="grid grid-cols-2 sm:grid-cols-5 gap-3 mb-4">
        <div v-for="(metrica, index) in metricasFormateadas" :key="index" 
             class="bg-white rounded-lg shadow-xs p-3 flex items-start border border-gray-100">
          <span class="text-xl mr-2 p-1 rounded-full"
                :class="{
                  'bg-green-100 text-green-600': metrica.color === 'green',
                  'bg-red-100 text-red-600': metrica.color === 'red'
                }">
            {{ metrica.icon }}
          </span>
          <div>
            <p class="text-xs text-gray-500">{{ metrica.title }}</p>
            <p class="text-lg font-bold" 
               :class="{
                 'text-green-600': metrica.color === 'green',
                 'text-red-600': metrica.color === 'red'
               }">
              {{ metrica.value }}
            </p>
          </div>
        </div>
      </div>

      <!-- Gráficos más compactos -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
        <!-- Gráfico de Ocupación ajustado -->
        <div class="bg-white rounded-lg shadow-xs p-3 border border-gray-100">
          <div class="flex justify-between items-center mb-2">
            <h2 class="text-sm font-semibold">Ocupación Diaria</h2>
            <span class="text-xs bg-indigo-100 text-indigo-800 px-2 py-0.5 rounded-full">7 días</span>
          </div>
          <div class="h-40"> <!-- Altura reducida -->
            <Line :data="ocupacionChart" :options="{
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                legend: { display: false },
                tooltip: { callbacks: { label: ctx => ctx.parsed.y + '%' } }
              },
              scales: {
                y: { 
                  beginAtZero: true,
                  max: 100,
                  grid: { drawBorder: false },
                  ticks: { callback: v => v + '%' }
                },
                x: { grid: { display: false } }
              }
            }" />
          </div>
        </div>

        <!-- Gráfico de Ingresos ajustado -->
        <div class="bg-white rounded-lg shadow-xs p-3 border border-gray-100">
          <div class="flex justify-between items-center mb-2">
            <h2 class="text-sm font-semibold">Ingresos Diarios</h2>
            <span class="text-xs bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded-full">7 días</span>
          </div>
          <div class="h-40"> <!-- Altura reducida -->
            <Bar :data="ingresosChart" :options="{
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                legend: { display: false },
                tooltip: { callbacks: { label: ctx => 'Bs. ' + ctx.parsed.y.toLocaleString() } }
              },
              scales: {
                y: { 
                  beginAtZero: true,
                  grid: { drawBorder: false },
                  ticks: { callback: v => 'Bs. ' + v.toLocaleString() }
                },
                x: { grid: { display: false } }
              }
            }" />
          </div>
        </div>
      </div>

      <!-- Sección Inferior más compacta -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <!-- Clientes Top ajustado -->
        <div class="bg-white rounded-lg shadow-xs p-3 border border-gray-100">
          <div class="flex justify-between items-center mb-2">
            <h2 class="text-sm font-semibold">Clientes Frecuentes</h2>
            <span class="text-xs bg-purple-100 text-purple-800 px-2 py-0.5 rounded-full">Top 5</span>
          </div>
          <div class="flex">
            <div class="w-32 h-32 mr-2"> <!-- Tamaño reducido del gráfico -->
              <Pie :data="clientesChart" :options="{
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                cutout: '65%'
              }" />
            </div>
            <ul class="flex-1 space-y-1 text-xs">
              <li v-for="(cliente, index) in clientesData" :key="cliente.id" 
                  class="flex justify-between items-center p-1.5 hover:bg-gray-50 rounded">
                <div class="flex items-center truncate">
                  <span class="w-5 h-5 rounded-full flex items-center justify-center text-xs font-bold mr-2"
                        :class="[
                          'bg-purple-100 text-purple-800',
                          'bg-pink-100 text-pink-800',
                          'bg-amber-100 text-amber-800',
                          'bg-emerald-100 text-emerald-800',
                          'bg-blue-100 text-blue-800'
                        ][index]">
                    {{ index + 1 }}
                  </span>
                  <span class="truncate">{{ cliente.nombre.split(' ')[0] }}</span>
                </div>
                <span class="font-medium">Bs. {{ cliente.gasto_total.toLocaleString() }}</span>
              </li>
            </ul>
          </div>
        </div>
<!-- Estado Habitaciones con gráfico a la izquierda -->
<div class="bg-white rounded-lg shadow-xs p-3 border border-gray-100">
  <h2 class="text-sm font-semibold mb-2">Estado Habitaciones</h2>
  <div class="flex items-start gap-4"> <!-- Contenedor flex -->
    <!-- Gráfico circular -->
    <div class="relative w-20 h-20"> <!-- Tamaño reducido -->
      <svg class="w-full h-full" viewBox="0 0 100 100">
        <circle 
          fill="transparent"
          stroke="#f3f4f6" 
          stroke-width="6" 
          r="40" 
          cx="50" 
          cy="50"
        />
        <circle 
          fill="transparent"
          stroke="#6366f1"
          stroke-width="6" 
          stroke-linecap="round"
          :stroke-dasharray="`${(reservasActivas/totalHabitaciones)*251}, 251`" 
          r="40" 
          cx="50" 
          cy="50"
          transform="rotate(-90 50 50)"
        />
      </svg>
      <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center">
        <span class="text-lg font-bold text-gray-800">
          {{ Math.round((reservasActivas/totalHabitaciones)*100) }}%
        </span>
      </div>
    </div>

    <!-- Estadísticas -->
    <div class="grid grid-cols-2 gap-2 text-xs flex-1">
      <div class="bg-indigo-50 p-1.5 rounded">
        <p class="text-indigo-800">Total</p>
        <p class="font-bold">{{ totalHabitaciones }}</p>
      </div>
      <div class="bg-emerald-50 p-1.5 rounded">
        <p class="text-emerald-800">Ocupadas</p>
        <p class="font-bold">{{ reservasActivas }}</p>
      </div>
      <div class="bg-amber-50 p-1.5 rounded">
        <p class="text-amber-800">Disponibles</p>
        <p class="font-bold">{{ totalHabitaciones - reservasActivas }}</p>
      </div>
      <div class="bg-gray-50 p-1.5 rounded">
        <p class="text-gray-800">Mantenimiento</p>
        <p class="font-bold">0</p>
      </div>
    </div>
  </div>
</div>

        <!-- Reservas Recientes ajustado -->
        <div class="bg-white rounded-lg shadow-xs p-3 border border-gray-100">
          <h2 class="text-sm font-semibold mb-2">Reservas Recientes</h2>
          <div class="space-y-2 text-xs">
            <div v-for="(item, index) in ocupacionData.slice(0, 4)" :key="index" 
                 class="pb-2 border-b border-gray-100 last:border-0 last:pb-0">
              <div class="flex justify-between items-center">
                <div>
                  <p class="font-medium">{{ item.fecha }}</p>
                  <p class="text-gray-500">{{ item.reservas }} reservas</p>
                </div>
                <span class="px-1.5 py-0.5 bg-indigo-100 text-indigo-800 rounded-full font-medium">
                  {{ item.porcentaje }}%
                </span>
              </div>
              <div class="mt-1 w-full bg-gray-200 rounded-full h-1">
                <div class="bg-indigo-500 h-1 rounded-full" :style="{width: item.porcentaje + '%'}"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
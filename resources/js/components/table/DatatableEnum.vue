<template>
    <div v-if="row[`${field}`]">
        {{ lists[row[`${field}`]] ?? row[`${field}`]}}
    </div>
</template>

  <script setup>
  defineProps(['field', 'row'])
  const lists = {
      1: 'نقداً',
      2: 'بنكك',
      3: 'بطاقة صراف',
      4: 'اخرى'
  };
  </script>

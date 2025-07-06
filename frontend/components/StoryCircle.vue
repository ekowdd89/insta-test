<template>
  <div class="flex overflow-x-auto gap-4 px-4 py-2">
    <div v-for="n in 10" :key="n" class="flex flex-col items-center">
      <UAvatar size="xl" :src="`https://i.pravatar.cc/150?img=${n}`" />
      <span class="text-xs mt-1 text-center truncate w-16">user{{n}}</span>
    </div>
  </div>
</template>
<script setup lang="ts">
defineOptions({
    name: 'StoryCircle',
})

</script>
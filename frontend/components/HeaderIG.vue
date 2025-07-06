<template>
    <UContainer class="flex items-center justify-between py-2 border-b bg-white sticky top-0 z-50">
        <NuxtLink to="/" class="text-xl font-bold text-black">
        Instagram
        </NuxtLink>
        <div class="flex items-center gap-5 text-gray-700">
        <NuxtLink to="/">
            <UIcon name="i-heroicons-home" class="w-6 h-6" />
        </NuxtLink>
        <NuxtLink v-if="auth" to="/new-post">
            <UIcon name="i-heroicons-plus-circle" class="w-6 h-6" />
        </NuxtLink>
        <NuxtLink to="/notifications">
            <UIcon name="i-heroicons-heart" class="w-6 h-6" />
        </NuxtLink>
        <NuxtLink to="/profile">
            <UAvatar size="sm" src="https://i.pravatar.cc/150?img=7" />
        </NuxtLink>
        </div>
    </UContainer>
</template>

<script setup lang="ts">
   defineProps({
       auth: Boolean
   })
</script>
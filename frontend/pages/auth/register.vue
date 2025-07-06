<script setup lang="ts">
import GuestLayout from '~/layout/GuestLayout.vue';

</script>

<template>
    <GuestLayout>
        <h1>Posts</h1>
         <UFormField
            label="Post"
            description="We'll never share your email with anyone else."
            hint="Optional"
            help="Please enter a valid email address."
            size="xl"
            class="flex flex-col gap-2"
        >
            <UInput type="file" class="w-full mb-4" />
            <UTextarea placeholder="caption" class="w-full" />
        </UFormField>
    </GuestLayout>
</template>
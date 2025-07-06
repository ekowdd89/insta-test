<template>
  <UContainer class="max-w-xl mx-auto mt-8 space-y-4 flex flex-col">
    <h2 class="text-2xl font-bold text-center">Create New Post</h2>

    <UInput
    type="file"
    multiple
    accept="image/*"
    @change="handleFileChange"  />

    <div class="flex gap-4 mt-4 flex-wrap">
      <img
        v-for="(img, i) in previewImages"
        :key="i"
        :src="img"
        class="w-24 h-24 object-cover rounded border"
      />
    </div>

    <UTextarea v-model="caption" placeholder="Caption" />

    <UButton class="w-full justify-center items-center" :disabled="loading" :loading="loading" @click="submitPost">
      {{ loading ? 'Posting...' : 'Post' }}
    </UButton>

    <UAlert v-if="errorMsg" color="primary" variant="subtle">{{ errorMsg }}</UAlert>
  </UContainer>
</template>

<script setup lang="ts">

import { ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
import auth from '~/middlewares/auth.g'
const caption = ref('')
const files = ref<File[]>([])
const previewImages = ref<string[]>([])
const loading = ref(false)
const errorMsg = ref('')
const router = useRouter()
const token = localStorage.getItem('token')
definePageMeta({
    middleware: [auth]
})

const handleFileChange = (e: Event) => {
    const target = e.target as HTMLInputElement
    const fileList = target.files

    if (fileList) {
        files.value = Array.from(fileList)
        previewImages.value = files.value.map(file => URL.createObjectURL(file))
    }
}

const submitPost = async () => {
    errorMsg.value = ''
    if (!caption.value || files.value.length === 0) {
        errorMsg.value = 'Caption dan gambar wajib diisi.'
        return
    }

    try {
        loading.value = true

        const form: FormData = new FormData()
        form.append(
            'operations',
            JSON.stringify({
                query: `
                mutation($caption: String!, $media: [Upload!]) {
                    createPost(caption: $caption, media: $media) {
                    id
                    caption
                    media { url type }
                    }
                }
                `,
                variables: {
                caption: caption.value,
                media: files.value.map(() => null),
                },
            })
        )
        const map: Record<string, string[]> = {}

        files.value.forEach((_, i) => {
            map[i] = [`variables.media.${i}`]
        })

        form.append('map', JSON.stringify(map))


        files.value.forEach((file, i) => {
            form.append(i.toString(), file)
        })
        console.log(
            "token",
            token
        )
        await axios.post('http://localhost:8000/v1/post', form, {
        headers: {
            Authorization: `Bearer ${token}`,
        },
        })

        router.push('/')
    } catch (err: any) {
        errorMsg.value = err.response?.data?.message || 'Gagal posting.'
    } finally {
        loading.value = false
    }
}
</script>

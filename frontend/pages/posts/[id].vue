

<template>
    <div class="max-w-2xl mx-auto p-4 space-y-6">
        <div v-if="data?.post" class="border rounded-md p-4 shadow bg-white">
        <div class="flex items-center gap-3 mb-2">
            <img :src="``" class="w-8 h-8 rounded-full" />
            <p class="font-semibold">{{ data.post.user.name }}</p>
        </div>

        <img :src="data.post.media[0].url" class="rounded mb-2" />
        <p>{{ data.post.caption }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow space-y-4">
        <h2 class="text-lg font-semibold">Komentar</h2>

        <div class="flex gap-2">
            <UInput v-model="commentText" placeholder="Tulis komentar..." class="flex-1" />
            <UButton @click="submitComment">Kirim</UButton>
        </div>

        <div v-for="comment in data.post.comments" :key="comment.id" class="mt-4 border-t pt-2">
            <div class="flex items-center gap-2 mb-1">
            <img :src="comment.user.avatar_url" class="w-6 h-6 rounded-full" />
            <p class="text-sm font-medium">{{ comment.user.name }}</p>
            </div>
            <p class="text-sm">{{ comment.content }}</p>
            <p class="text-xs text-gray-400">{{ new Date(comment.created_at).toLocaleString() }}</p>
        </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useRoute } from 'vue-router'
import { gql, useQuery, useMutation } from '@urql/vue'

const route = useRoute()
const postId = route.params.id
const commentText = ref('')

const GET_POST = gql`
    query($id: ID!) {
        postById(id: $id) {
        id
        caption
        media{
            id
            url
        }
        user {
            name
        }
        comments {
            id
            comment
        }
        }
    }
`

const { data } = useQuery({
  query: GET_POST,
  variables: { id: postId }
})

const COMMENT_MUTATION = gql`
  mutation($post_id: ID!, $content: String!) {
    addComment(post_id: $post_id, content: $content) {
      id
      content
    }
  }
`

const { executeMutation } = useMutation(COMMENT_MUTATION)

const submitComment = async () => {
  if (!commentText.value.trim()) return
  await executeMutation({
    post_id: postId,
    content: commentText.value
  })
  commentText.value = ''
  await refresh()
}
</script>
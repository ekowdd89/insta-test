

<template>
    <div class="max-w-2xl mx-auto p-4 space-y-6">
       <CommentPost  v-if="post" :key="post.id" :post="post" :liked="liked" />

        <div class="bg-white p-4 rounded shadow space-y-4">
        <h2 class="text-lg font-semibold">Komentar</h2>

        <div class="flex gap-2">
            <UInput placeholder="Tulis komentar..." class="flex-1" />
            <UButton class="px-4 py-2">Kirim</UButton>
        </div>

        <div v-for="comment in post?.comments" :key="comment.id" class="mt-4 border-t pt-2">
            <div class="flex items-center gap-2 mb-1">
            <img src="https://i.pravatar.cc/150?img=2" class="w-6 h-6 rounded-full" />
            <p class="text-sm font-medium">{{ comment.comment }}</p>
            </div>
            <p class="text-sm">{{ comment.comment }}</p>
        </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useRoute } from 'vue-router'
import { gql, useQuery, provideClient } from '@urql/vue'
import { useUrqlClientByResource } from '~/utils/useUrqlClientByResource';
import CommentPost from '~/components/Comment.vue';
import { ref } from 'vue';
import { UInput } from '#components';

interface PostType {
        id: string | number;
        caption: string;
        user: {
            id: string | number;
            name: string;
            email: string;
        };
        media: Array<{
            id: string | number;
            url: string;
        }>;
        comments: Array<{
            id: string | number;
            comment: string;
        }>;
        likes: Array<{
            liked: boolean;
        }>;
    }

const liked = () => {
    alert('liked')
}
const route = useRoute()
const postId = route.params.id
const post = ref<PostType>()
// const commentText = ref('')
const client = useUrqlClientByResource('public')
provideClient(client)
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

// const { data } = useQuery({
//   query: GET_POST,
//   variables: { id: postId }
// })

// const { data } = await useQuery({
//     query: GET_POST,
//     variables: { id: postId }
//   })

const gerDataPost = async () => {
  const { data } = await useQuery({
    query: GET_POST,
    variables: { id: postId }
  })
  post.value = data?.value?.postById
  console.log("post", data.value)
}

// const COMMENT_MUTATION = gql`
//   mutation($post_id: ID!, $content: String!) {
//     addComment(post_id: $post_id, content: $content) {
//       id
//       content
//     }
//   }
// `

// const { executeMutation } = useMutation(COMMENT_MUTATION)

// const submitComment = async () => {
//   if (!commentText.value.trim()) return
//   await executeMutation({
//     post_id: postId,
//     content: commentText.value
//   })
//   commentText.value = ''
//   // await refresh()
// }
// watchEffect(() => {
//   if (data.value?.postById) {
//     post.value = data.value.postById
//     console.log('post loaded:', post.value)
//   }
// })
onMounted(() => {
  gerDataPost()
})
</script>
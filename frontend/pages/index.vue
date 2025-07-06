<template>
    <UContainer class="max-w-xl mx-auto">
        <HeaderIG :auth="!!auth.token" />
        <StoryCircle />
        <Post v-for="post in posts" :key="post.id" :post="post" :liked="liked" />
        <!-- <BottomNav /> -->
    </UContainer>
</template>
<script setup lang="ts">
import { gql, provideClient, useQuery } from '@urql/vue'
import Post from '~/components/Post.vue';
import { useUrqlClientByResource } from '~/utils/useUrqlClientByResource';
const auth = useAuthStore();
const liked = () => {
    alert('liked')
}


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

const posts = ref<PostType[]>([]);
const client = useUrqlClientByResource('public')
provideClient(client)
const GET_ALL_POSTS = gql`
    query {
        getPosts {
            id
            caption
            user {
                id
                name
                email
            }
            media {
                id
                url
            }
            comments {
                id
                comment
            }
            likes {
                liked
            }
            }
    }
`;
const fetchPosts = async  ()  => {
    const {data} = await useQuery({ query: GET_ALL_POSTS })
    posts.value = data?.value?.getPosts
    console.log("posts", posts.value)
}


onMounted(() => {
    fetchPosts()
})

</script>

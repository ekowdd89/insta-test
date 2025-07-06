<template>
    <div>
        <UCard class="mb-4">
        <template #header>
        <div class="flex items-center gap-2">
            <UAvatar size="sm" src="https://i.pravatar.cc/150?img=2" />
            <span class="font-medium">{{ post.user.name  }}</span>
        </div>
        </template>
        <UCarousel v-slot="{ item }" dots :items="post.media ?? []"
            :ui="{
                container: 'transition-[height]',
                controls: 'absolute -top-8 inset-x-12',
                dots: '-top-7',
                dot: 'w-6 h-1'
            }"
            class="flex flex-col items-center justify-center">
            <img :src="item.url" width="320" height="320" class="rounded-md w-full object-cover mb-2">
        </UCarousel>

        <div class="flex items-center gap-3 mb-2 mt-3 text-lg text-gray-700">
            <UIcon name="i-heroicons-heart" @click="liked" class="text-red-700" />
            <UIcon name="i-heroicons-paper-airplane" />
        </div>

        <p class="text-sm">
        <strong>{{ post.user.name }}</strong> {{ props.post.caption }}
        </p>
    </UCard>
  </div>
</template>
<script setup lang="ts">// Adjust the path as needed

    defineOptions({
        name: 'CommentPost'
    });
    const router = useRouter()

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
    const props = defineProps<{
        post: PostType,
        liked: () => void
    }>()
</script>

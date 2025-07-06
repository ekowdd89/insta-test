<script setup lang="ts">
import GuestLayout from '~/layout/GuestLayout.vue';
import { useAuthStore } from '~/stores/auth';
import { gql, provideClient, useMutation } from '@urql/vue';
import { useUrqlClientByResource } from '~/utils/useUrqlClientByResource';

const email = ref('');
const password = ref('');
const auth = useAuthStore();

const client = useUrqlClientByResource('user')
provideClient(client)

const LOGIN_MUTATION = gql`
    mutation($email: String!, $password: String!) {
    login(email: $email, password: $password) { access_token token_type expires_in user {id name email }  }
}
`
const { executeMutation } = useMutation(LOGIN_MUTATION)

const logIn = async () => {
    const response = await executeMutation({email: email.value, password: password.value});
    console.log("response", response);
    const result = response?.data?.login;
    auth.login(result.access_token);
    auth.user = result.user;
    navigateTo('/');
}
</script>

<template>
    <GuestLayout>
       <UContainer class="flex justify-center items-center w-full min-h-screen">
            <UCard class="w-3/4">
                <div class="flex flex-col gap-4 max-h-screen mx-auto justify-center items-center w-full">
                <h1 class="text-2xl font-bold text-gray-700">Login</h1>
                    <UInput v-model="email" placeholder="Email" />
                    <UInput v-model="password" type="password" placeholder="Password" />
                    <UButton @click="logIn">Login</UButton>
                </div>
            </UCard>
        </UContainer>
    </GuestLayout>
</template>
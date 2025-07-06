import { createClient, cacheExchange, fetchExchange } from '@urql/vue'
export const useUrqlClientByResource = (resource: string) => {
    console.log("URL", `http://localhost:8000/v1/${resource}`);
    return createClient({
        url: `http://localhost:8000/v1/${resource}`,
        exchanges: [cacheExchange, fetchExchange],
        fetchOptions: () => {
            const token = import.meta.client ? localStorage.getItem('token') : null
            console.log("token", token);
        return {
            headers: {
            ...(token ? { Authorization: `Bearer ${token}` } : {}),
            },
        }
        },
    })
}

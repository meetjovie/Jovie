// import createAuth0Client from '@auth0/auth0-spa-js';
// import { reactive } from 'vue';
// import store from "../store";
//
// export const AuthState = reactive({
//     user: null,
//     loading: false,
//     isAuthenticated: false,
//     auth0: null,
// });
//
// const config = {
//     domain: process.env.VITE_AUTH0_DOMAIN,
//     client_id: process.env.VITE_AUTH0_CLIENT_ID
// };
//
// export const useAuth0 = () => {
//     const handleStateChange = async () => {
//         store.state.AuthState.isAuthenticated = !!(await store.state.AuthState.auth0.isAuthenticated());
//         store.state.AuthState.user = await store.dispatch('me');
//         store.state.AuthState.loading = false;
//     }
//
//     const initAuth = () => {
//         store.state.AuthState.loading = true;
//         createAuth0Client({
//             domain: config.domain,
//             client_id: config.client_id,
//             cacheLocation: 'localstorage',
//             redirect_uri: window.location.origin
//         }).then(async auth => {
//             store.state.AuthState.auth0 = auth;
//             await handleStateChange();
//         });
//     }
//
//     const login = async () => {
//         await store.state.AuthState.auth0.loginWithPopup();
//         await handleStateChange();
//     };
//
//     const logout = async () => {
//         store.state.AuthState.auth0.logout({
//             returnTo: window.location.origin,
//         });
//     }
//
//     return {
//         login,
//         logout,
//         initAuth,
//     }
//
// }

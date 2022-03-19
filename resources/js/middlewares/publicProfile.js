import router from "../router";
import store from "../store";

export const publicProfile = (to, from, next) => {

    const username = to.params.username

    store.dispatch('getPublicProfile', {username: username}).then(response => {
        if (response.status) {
            return next()
        } else {
            router.push({name: 'Home'})
        }
    }).catch(error => {
        router.push({name: 'Home'})
    })
}

import router from "../router";
import store from "../store";

export const publicProfile = async (to, from, next) => {

    const username = to.params.username

    await store.dispatch('getPublicProfile', {username: username}).then(response => {
        console.log('response');
        console.log(response);
        if (response.status) {
            return next({
                params: {
                    profile: response.data
                }
            })
        } else {
            console.log('response as');
            console.log(response);
            // router.push({name: 'Home'})
        }
    }).catch(error => {
        console.log('error');
        console.log(error);
        router.push({name: 'Home'})
    })
}

import userService from "../services/api/user.service";
import AuthService from "../services/auth/auth.service";
import router from "../router";
import creatorService from "../services/api/creator.service";
import UserService from "../services/api/user.service";

export default {

    async logout(context) {
        AuthService.logout().then(response => {
            router.push({name: 'Login'})
        })
    },

    async me({state, commit}, params) {
        console.log('params.config');
        console.log(params.config);
        return new Promise((resolve, reject) => {
            userService.me(params.config, params.login).then(response => {
                response = response.data
                commit('setAuthStateUser', response)
                return resolve(response)
            }).catch(error => {
                commit('setAuthStateUser', null)
                return reject(error)
            })
        })
    },

    async updateCreator(context, { id, index, network, key, value }) {
        const data = {
            id: id,
        };
        let keySplits = key.split('.');
        if (keySplits.length > 1) {
            var key1 = keySplits[0];
            var key2 = keySplits[1];
            data[key1] = {
                [key2]: value,
            };
        } else if (key == 'emails') {
            if (typeof value == 'string') {
                value = value.split(',')
                data[key] = value;
            }
        } else {
            data[key] = value;
        }
        return await userService.updateCreator(data)
    },
    async updateOverviewCreator(context, { id, index, network, key, value }) {
        const data = {
            id: id,
        };
        let keySplits = key.split('.');
        if (keySplits.length > 1) {
            var key1 = keySplits[0];
            var key2 = keySplits[1];
            data[key1] = {
                [key2]: value,
            };
        } else if (key == 'emails') {
            if (typeof value == 'string') {
                value = value.split(',')
                data[key] = value;
            }
        } else {
            data[key] = value;
        }
        return await creatorService.updateOverviewCreator(data)
    },

    getPublicProfile(context, payload) {
        return new Promise((resolve, reject) => {
            userService.getPublicProfile(payload).then(response => {
                resolve(response.data)
            }).catch(error => {
                return reject(error)
            })
        })
    },

    async moveCreator(context, payload) {
        return await userService.moveCreator(payload)
    },

    async toggleCreatorsFromList(context, payload) {
        return await userService.toggleCreatorsFromList(payload)
    },

    async toggleArchiveCreators(context, payload) {
        return await userService.toggleArchiveCreators(payload)
    },

    async updateCrmMeta(context, payload) {
        return await userService.updateCrmMeta(payload.id, payload.meta)
    },

    async uploadTempFileFromUrl(context, payload) {
        return new Promise((resolve, reject) => {
            userService.uploadTempFileFromUrl(payload).then(response => {
                resolve(response.data)
            }).catch(error => {
                return reject(error)
            })
        })
    },

    async sortFields(context, payload) {
        UserService.sortFields(
            { newIndex: payload.newIndex, oldIndex: payload.oldIndex, custom: payload.custom, listId: payload.listId, hide: payload.hide },
            payload.itemId
        )
            .then((response) => {
                response = response.data;
                if (response.status) {
                    payload.self.$notify({
                        group: 'user',
                        type: 'success',
                        duration: 15000,
                        title: 'Successful',
                        text: response.message,
                    });
                } else {
                    payload.self.$notify({
                        group: 'user',
                        type: 'error',
                        duration: 15000,
                        title: 'Error',
                        text: response.message,
                    });
                    // show toast error here later
                }
            })
            .catch((error) => {
                if (error.response && error.response.status == 422) {
                    self.errors = error.data.errors;
                    if (payload.self.errors.field[0]) {
                        payload.self.$notify({
                            group: 'user',
                            type: 'success',
                            duration: 15000,
                            title: 'Successful',
                            text: payload.self.errors.field[0],
                        });
                    }
                }
            })
            .finally((response) => {});
    },

    async toggleFieldHide(context, payload) {
        UserService.toggleFieldHide(
            { listId: payload.listId, hide: payload.hide, custom: payload.custom },
            payload.itemId
        )
            .then((response) => {
                response = response.data;
                if (response.status) {
                } else {

                }
            })
            .catch((error) => {
                if (error.response && error.response.status == 422) {
                    payload.self.errors = error.data.errors;
                    if (payload.self.errors.field[0]) {
                        payload.self.$notify({
                            group: 'user',
                            type: 'success',
                            duration: 15000,
                            title: 'Successful',
                            text: payload.self.errors.field[0],
                        });
                    }
                }
            })
            .finally((response) => {});
    },
    async deleteField(context, payload) {
        UserService.deleteField(payload.itemId)
            .then((response) => {
                response = response.data;
                if (response.status) {
                    payload.self.$notify({
                        group: 'user',
                        type: 'success',
                        duration: 15000,
                        title: 'Successful',
                        text: response.message,
                    });
                } else {

                }
            })
            .catch((error) => {
                if (error.response && error.response.status == 422) {
                    payload.self.errors = error.data.errors;
                    if (payload.self.errors.field[0]) {
                        payload.self.$notify({
                            group: 'user',
                            type: 'success',
                            duration: 15000,
                            title: 'Successful',
                            text: payload.self.errors.field[0],
                        });
                    }
                }
            })
            .finally((response) => {});
    }
}

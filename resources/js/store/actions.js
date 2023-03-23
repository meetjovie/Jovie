import userService from "../services/api/user.service";
import AuthService from "../services/auth/auth.service";
import router from "../router";
import ContactService from "../services/api/contact.service";
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

    async updateContact(context, { id, index, network, key, value }) {
        const data = {
            id: id,
        };
        data[key] = value;
        return await userService.updateContact(data)
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

    async toggleContactsFromList(context, payload) {
        return await userService.toggleContactsFromList(payload)
    },

    async toggleArchiveContacts(context, payload) {
        return await userService.toggleArchiveContacts(payload)
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
        return new Promise((resolve, reject) => {
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
                .finally((response) => {
                    return resolve()
                });
        })
    },
    async markEnrichedViewed(context, payload) {
        return new Promise((resolve, reject) => {
            ContactService.markEnrichedViewed(payload)
                .then((response) => {
                })
                .catch((error) => {
                })
                .finally(() => {
                    return resolve()
                });
        })
    },
    async checkContactsEnrichable(context, payload) {
        return new Promise((resolve, reject) => {
            ContactService.checkContactsEnrichable(payload)
                .then((response) => {
                    return resolve(response)
                })
                .catch((error) => {
                    return reject(error)
                })
                .finally(() => {
                });
        })
    },
    async enrichContacts(context, payload) {
        return new Promise((resolve, reject) => {
            ContactService.enrichContacts(payload.contact_ids)
                .then((response) => {
                    response = response.data;
                    if (response.status) {
                        context.state.crmRecords.filter(record => response.data.includes(record.id)).forEach(record => {
                            record.enriching = true
                        })
                        payload.self.$notify({
                            group: 'user',
                            type: 'success',
                            duration: 15000,
                            title: 'Successful',
                            text: response.message,
                        });
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
                .finally(() => {
                });
        })
    },
    async checkListsEnrichable(context, payload) {
        return new Promise((resolve, reject) => {
            ContactService.checkListsEnrichable(payload)
                .then((response) => {
                    return resolve(response)
                })
                .catch((error) => {
                    return reject(error)
                })
                .finally(() => {
                });
        })
    },
    async enrichLists(context, payload) {
        return new Promise((resolve, reject) => {
            ContactService.enrichLists(payload.list_ids)
                .then((response) => {
                    response = response.data;
                    if (response.status) {
                        context.state.crmRecords.filter(record => response.data.contact_ids.includes(record.id)).forEach(record => {
                            record.enriching = true
                        })
                        payload.self.$notify({
                            group: 'user',
                            type: 'success',
                            duration: 15000,
                            title: 'Successful',
                            text: response.message,
                        });
                        resolve(response.data.list_ids)
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
                .finally(() => {
                });
        })
    }
}

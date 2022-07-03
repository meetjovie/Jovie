import store from '../../store';

const baseApiUrl = '/api'
const baseUrlWeb = ''

export default {
    async getColumnsFromCsv(data) {
        return axios.post(`${baseApiUrl}/get-columns-from-csv`, data, {
            headers: await store.dispatch('headers', {'Content-Type': 'multipart/form-data'})
        })
    },
    async import(data) {
        return axios.post(`${baseApiUrl}/import`, data, {
            headers: await store.dispatch('headers', {'Content-Type': 'multipart/form-data'})
        })
    },
    async getNotifications() {
        return axios.get(`${baseApiUrl}/notifications`)
    },
    async importSingle(url) {
        return axios.post(`${baseApiUrl}/import-single`, {url: url})
    }
}

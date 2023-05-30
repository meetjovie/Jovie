import store from '../../store';

const baseApiUrl = '/api'
const baseUrlWeb = ''

export default {
    async getColumnsFromCsv(data) {
        return axios.post(`${baseApiUrl}/get-columns-from-csv`, data)
    },
    async import(data) {
        return axios.post(`${baseApiUrl}/import`, data)
    },
    async importContact(data) {
        return axios.post(`${baseApiUrl}/import-contact`, data)
    },
    async getNotifications() {
        return axios.get(`${baseApiUrl}/notifications`)
    },
    async importSingle(url) {
        return axios.post(`${baseApiUrl}/import-single`, {url: url})
    },
    async getColumnsToMap(teamId) {
        return axios.get(`${baseApiUrl}/get-columns-to-map/${teamId}`)
    }
}

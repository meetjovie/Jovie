import store from '../../../store';

const baseUrl = '/api'
const baseUrlWeb = ''
const baseUrlAdmin = '/api/admin'

export default {
    async getColumnsFromCsv(data) {
        return axios.post(`${baseUrlAdmin}/get-columns-from-csv`, data, {
            headers: await store.dispatch('headers')
        })
    }
}

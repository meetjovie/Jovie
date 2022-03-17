
const baseApiUrlTeams = '/api/teams';
const baseUrlWeb = '';
const baseUrlAdmin = '/api/admin';

export default {
    getTeams() {
        return axios.get(`${baseApiUrlTeams}/`);
    },
    async createTeam(data) {
        return axios.post(`${baseApiUrlTeams}/teams`, data);
    },
    getTeam(id) {
        return axios.get(`${baseApiUrlTeams}/team/${id}`);
    },
    async updateTeam(data, id) {
        return axios.post(`${baseApiUrlTeams}/update/${id}?_method=PUT`, data);
    },
    async deleteTeam(data, id) {
        return axios.post(`${baseApiUrlTeams}/destroy/${id}?_method=DELETE`, data);
    },
    switchTeam(id) {
        return axios.get(`${baseApiUrlTeams}/switch/${id}`);
    },
    getMembers(id) {
        return axios.get(`${baseApiUrlTeams}/members/${id}`);
    },
    resendInvite(id) {
        return axios.get(`${baseApiUrlTeams}/members/resend/${id}`);
    },
    async inviteMember(data, id) {
        return axios.post(`${baseApiUrlTeams}/members/${id}`, data);
    },
    async deleteMember(id, user_id) {
        return axios.post(`${baseApiUrlTeams}/members/${id}/${user_id}?_method=DELETE`);
    },
    acceptInvitation(token) {
        return axios.get(`${baseApiUrlTeams}/accept/${token}`);
    },
}

class Overview {
    static all(){
        return axios.get('/dashboard/overview');
    }
}

export default Overview;
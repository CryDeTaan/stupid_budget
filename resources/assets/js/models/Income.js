class Income {
    static all(){
        return axios.get('/income');
    }
}

export default Income;
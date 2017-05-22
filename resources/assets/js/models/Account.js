class Account {
    static all(){
        return axios.get('/accounts');
    }
}

export default Account;
class Expense {
    static all(){
        return axios.get('/expenses');
    }
}

export default Expense;
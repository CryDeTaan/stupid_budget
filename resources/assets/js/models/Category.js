class Category {
    static all(){
        return axios.get('/categories');
    };


}

export default Category;
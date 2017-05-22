class Subcategory {
    static all(id){
        return axios.get('/subcategories/'+id);
    };
}

export default Subcategory;
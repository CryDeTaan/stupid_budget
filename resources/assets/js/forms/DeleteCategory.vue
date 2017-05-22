<template>
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Delete Category</p>
                <button class="delete" @click="$emit('close')"></button>
            </header>
            <section class="modal-card-body">
                Are you sure you want to delete the following Category from your profile:</br></br>
                <strong>  Category Name : </strong>
                {{ category[0].categoryName }}</br>
                <strong>  This delete all the subcategories associated with this Category.</strong>
            </section>
            <footer class="modal-card-foot">
                <a type="submit" class="button is-danger" @click="onSubmit(category[0].id)">Delete Category</a>
                <a class="button" @click="$emit('close')">Cancel</a>
            </footer>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['category'],
        methods: {
            onSubmit(categoryId) {
                axios.delete('/categories/' + categoryId);
                this.$emit('completed', categoryId);
            }
        }
    }
</script>
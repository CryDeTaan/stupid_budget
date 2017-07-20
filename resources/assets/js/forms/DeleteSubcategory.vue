<template>
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Delete Subcategory</p>
                <button class="delete" @click="$emit('close')"></button>
            </header>
            <section class="modal-card-body">
                Are you sure you want to delete the following Category from your profile:</br></br>
                <strong>  Subcategory Name : </strong>
                {{ subcategory[0].subcategoryName }}</br>
            </section>
            <footer class="modal-card-foot">
                <a type="submit" class="button is-danger" @click="onSubmit(subcategory[0])">Delete Subcategory</a>
                <a class="button" @click="$emit('close')">Cancel</a>
            </footer>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['subcategory'],
        methods: {
            onSubmit(subcategory) {
                axios.delete('/subcategories/' + subcategory.id);
                this.$emit('completed', subcategory);
            }
        }
    }
</script>